<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\Attendance as Forms;
use App\Consts\TextConst;

use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class AttendanceService extends BaseService
{
    public $limit = 10;

    public function getPaginatedAttendances(Forms\IndexForm $form): LengthAwarePaginator|null
    {
        $dateUtil = dateUtil($form->month);

        $attendances = $this->AttendanceRepository
            ->where("user_id", authUserId())
            ->whereBetween("datetime", $dateUtil->firstOfMonth(), $dateUtil->endOfMonth())
            ->forPage($form->page, $this->limit)->desc("datetime")->get();

        if (is_null($attendances)) return null;

        $totalRows = $this->AttendanceRepository
            ->where("user_id", authUserId())
            ->whereBetween("datetime", $dateUtil->firstOfMonth(), $dateUtil->endOfMonth())->count();

        return paginator($attendances, $totalRows, $this->limit, $form->path, $form->page, ["month" => $form->month]);
    }

    public function getAttendanceInMonth(Forms\IndexForm $form): stdClass
    {
        $dateUtil = dateUtil($form->month);

        $attendances = $this->AttendanceRepository
            ->where("user_id", authUserId())
            ->whereBetween("datetime", $dateUtil->firstOfMonth(), $dateUtil->endOfMonth())->whereNull("relation")->get();

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
                $dateUtil->reset($relatedAttendance->datetime);

                switch ($relatedAttendance->type) {
                    case "start_work":
                        $buffer["work"] = $dateUtil;
                        break;
                    case "end_work":
                        $result->totalWork += $buffer["work"]->diffSecond($dateUtil->carbon()) / squared(60);
                        break;
                    case "start_break":
                        $buffer["break"] = $dateUtil;
                        break;
                    case "end_break":
                        $result->totalBreak += $buffer["break"]->diffSecond($dateUtil->carbon()) / squared(60);
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

        Transaction(
            '勤怠情報 登録',
            function () use ($attendance) {
                $attendance->save();
            }
        );

        return TextConst::ATTENDANCE_CREATED;
    }
}
