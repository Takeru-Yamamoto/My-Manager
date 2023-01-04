<?php

namespace App\Services;

use App\Services\BaseService;
use stdClass;

class HomeService extends BaseService
{
    public function getAttendance(): stdClass|null
    {
        $dateUtil   = dateUtil();
        $attendance = $this->AttendanceRepository
            ->where("user_id", authUserId())
            ->whereBetween("datetime", $dateUtil->startOfDay(), $dateUtil->endOfDay())
            ->whereNull("relation")->find();

        if (is_null($attendance)) {
            $attendance = $this->AttendanceRepository
                ->where("user_id", authUserId())
                ->desc("id")->find();
            if (is_null($attendance) || $attendance->type === "end_work") return null;

            if (!is_null($attendance->relation)) $attendance = $this->AttendanceRepository->findById($attendance->relation);
        }

        $attendances = $this->AttendanceRepository->whereClosure(function ($query) use ($attendance) {
            $query->whereNull("relation")->orWhere("relation", $attendance->id);
        })->get();

        $result = new stdClass();

        $result->relation   = $attendance->id;
        $result->totalBreak = 0;

        foreach ($attendances as $attendance) {
            switch ($attendance->type) {
                case "start_work":
                    $result->type      = "勤務中";
                    $result->startWork = $attendance->datetime;
                    break;
                case "end_work":
                    $result->type    = "退勤";
                    $result->endWork = $attendance->datetime;
                    break;
                case "start_break":
                    $result->type = "休憩中";
                    $dateUtil->reset($attendance->datetime);
                    break;
                case "end_break":
                    $result->type = "勤務中";
                    $result->totalBreak += $dateUtil->diffSecond(dateUtil($attendance->datetime)->carbon()) / squared(60);
                    break;
            }
        }

        if (isset($result->endWork)) {
            $result->totalWork       = $dateUtil->reset($result->startWork)->diffSecond(dateUtil($result->endWork)->carbon()) / squared(60);
            $result->totalWorkActual = $result->totalWork - $result->totalBreak;
        }

        return $result;
    }

    public function getTodaysTask(): array|null
    {
        return $this->TaskRepository->whereGreaterEqual("start_date", dateUtil()->toDateString())->get();
    }
}
