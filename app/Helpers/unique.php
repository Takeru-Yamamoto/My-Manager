<?php

if (!function_exists('getAttendanceTypeText')) {
    function getAttendanceTypeText(string $type): string
    {
        switch ($type) {
            case "start_work":
                return "出勤";
                break;
            case "end_work":
                return "退勤";
                break;
            case "start_break":
                return "休憩開始";
                break;
            case "end_break":
                return "休憩開終了";
                break;
            default:
                return "未出勤";
        }
    }
}

if (!function_exists('taskCalendar')) {
    function taskCalendar(): string
    {
        return calendar(url("task/create"), "GET", url("task/update"), "GET", url("task/fetch"), "POST");
    }
}
