<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\Attendance as Forms;
use App\Consts\TextConst;

use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;
use App\Consts\GateConst;

class AttendanceService extends BaseService
{
    public $limit = 10;

    public function getPaginatedAttendances(Forms\IndexForm $form): LengthAwarePaginator|null
    {
        $dateUtil = dateUtil($form->month);

        $repository = $this->AttendanceRepository
            ->where("user_id", authUserId())
            ->whereBetween("datetime", $dateUtil->firstOfMonth(), $dateUtil->endOfMonth())
            ->desc("datetime");

        return paginatorByRepository($repository, $this->limit, $form->page);
    }

    public function getAttendanceInMonth(int $userId, ?string $month): stdClass
    {
        $dateUtil = dateUtil($month);

        $attendances = $this->AttendanceRepository
            ->where("user_id", $userId)
            ->whereBetween("datetime", $dateUtil->firstOfMonth(), $dateUtil->endOfMonth())
            ->whereNull("relation")->get();

        $result = new stdClass();

        $result->workDays        = 0;
        $result->totalWorkActual = 0;
        $result->totalWork       = 0;
        $result->totalBreak      = 0;

        if (is_null($attendances)) return $result;

        $buffer = [];

        foreach ($attendances as $attendance) {
            $buffer = [];

            $relatedAttendances = $this->AttendanceRepository->whereClosure(function ($query) use ($attendance) {
                $query->whereNull("relation")->orWhere("relation", $attendance->id);
            })->get();

            foreach ($relatedAttendances as $relatedAttendance) {
                $dateUtil = dateUtil($relatedAttendance->datetime);

                switch ($relatedAttendance->type) {
                    case "start_work":
                        $buffer["work"] = $dateUtil;
                        break;
                    case "end_work":
                        $result->totalWork += $buffer["work"]->diffSecond($dateUtil->carbon()) / squared(60);
                        $buffer["work"] = null;
                        break;
                    case "start_break":
                        $buffer["break"] = $dateUtil;
                        break;
                    case "end_break":
                        $result->totalBreak += $buffer["break"]->diffSecond($dateUtil->carbon()) / squared(60);
                        $buffer["break"] = null;
                        break;
                }
            }
        }

        $result->workDays        = count($attendances);
        $result->totalWorkActual = $result->totalWork - $result->totalBreak;

        return $result;
    }

    public function create(Forms\CreateForm $form): string
    {
        $attendance = $this->AttendanceRepository->createEntity(
            authUserId(),
            $form->relation,
            $form->type,
            dateUtil()->toDatetimeString()
        );

        $attendance->safeCreate();

        return TextConst::ATTENDANCE_CREATED;
    }

    public function getUserAttendanceInMonth(Forms\AdminIndexForm $form): LengthAwarePaginator|null
    {
        $results  = [];

        $repository = $this->UserRepository->whereGreater("role", GateConst::ADMIN_NUMBER);

        if (!is_null($form->name)) $repository->whereLike("name", $form->name);
        if (!is_null($form->isValid)) $repository->isValid($form->isValid);

        $paginate = $repository->paginate($form->page, $this->limit);

        if (is_null($paginate->items)) return null;

        foreach ($paginate->items as $user) {
            $result = new stdClass();

            $result->user       = $user;
            $result->attendance = $this->getAttendanceInMonth($user->id, $form->month);

            $results[] = $result;
        }

        return paginator($results, $paginate->total, $this->limit, $form->page);
    }
}
