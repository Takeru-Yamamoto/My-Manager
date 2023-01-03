<?php

namespace App\Library\Base;

use Carbon\Carbon;

class BaseDateUtil
{
    public static string $FORMAT_ZERO_DATE              = '0000-00-00';
    public static string $FORMAT_DAY_START_TIME         = '00:00:00';
    public static string $FORMAT_DAY_END_TIME           = '23:59:59';
    public static string $FORMAT_DATE                   = 'Y-m-d';
    public static string $FORMAT_MONTH                  = 'Y-m';
    public static string $FORMAT_DATE_JP                = 'Y年n月j日';
    public static string $FORMAT_MONTH_JP               = 'Y年n月';
    public static string $FORMAT_DATE_CHAR              = 'Ymd';
    public static string $FORMAT_DATE_FORMAT_CHAR_SHORT = 'ymd';
    public static string $FORMAT_TIME                   = 'H:i:s';
    public static string $FORMAT_DATETIME               = 'Y-m-d H:i:s';
    public static string $FORMAT_DATETIME_JP            = 'Y年n月j日 G時i分';
    public static string $FORMAT_DATETIME_CHAR          = 'YmdHis';

    private Carbon $carbon;
    private $any;

    function __construct(mixed $any = null)
    {
        $this->set($any);
    }

    final public function carbon(): Carbon
    {
        return $this->carbon;
    }

    final public function copy(): self
    {
        $carbon = $this->carbon->copy();
        return new BaseDateUtil($carbon);
    }

    final public function isCarbon(): bool
    {
        return !is_null($this->any) && $this->any instanceof Carbon;
    }

    final private function set(mixed $any = null): self
    {
        $this->any = $any;

        if ($this->isCarbon()) {
            $this->carbon = $this->any;
        } else {
            $this->carbon = new Carbon($this->any);
        }

        return $this;
    }

    final public function reset(mixed $any = null): self
    {
        return $this->set($any);
    }


    /* format */
    final public function format(string $format): string
    {
        return $this->carbon->format($format);
    }

    final public function toDate(): string
    {
        return $this->carbon->format(self::$FORMAT_DATE);
    }

    final public function toDatetime(): string
    {
        return $this->carbon->format(self::$FORMAT_DATETIME);
    }

    final public function toTime(): string
    {
        return $this->carbon->format(self::$FORMAT_TIME);
    }


    /* to string */
    final public function toDateString(): string
    {
        return $this->carbon->toDateString();
    }

    final public function toDatetimeString(): string
    {
        return $this->carbon->toDateTimeString();
    }

    final public function toTimeString(): string
    {
        return $this->carbon->toTimeString();
    }


    /* getter */
    final public function year(): int
    {
        return $this->carbon->year;
    }

    final public function month(): int
    {
        return $this->carbon->month;
    }

    final public function day(): int
    {
        return $this->carbon->day;
    }

    final public function hour(): int
    {
        return $this->carbon->hour;
    }

    final public function minute(): int
    {
        return $this->carbon->minute;
    }

    final public function second(): int
    {
        return $this->carbon->second;
    }

    final public function dayOfYear(): int
    {
        return $this->carbon->dayOfYear;
    }

    final public function weekOfYear(): int
    {
        return $this->carbon->weekOfYear;
    }

    final public function daysInMonth(): int
    {
        return $this->carbon->daysInMonth;
    }

    final public function weekNumberInMonth(): int
    {
        return $this->carbon->weekNumberInMonth;
    }

    final public function yearsAgo(int $subYears): int
    {
        return $this->subYear($subYears)->year();
    }

    final public function age(): int
    {
        return $this->carbon->age;
    }

    final public function firstOfMonth(): string
    {
        return $this->carbon->firstOfMonth()->toDateTimeString();
    }

    final public function endOfMonth(): string
    {
        return $this->carbon->endOfMonth()->toDateTimeString();
    }

    final public function startOfWeek(): string
    {
        return $this->carbon->startOfWeek()->toDateTimeString();
    }

    final public function endOfWeek(): string
    {
        return $this->carbon->endOfWeek()->toDateTimeString();
    }

    final public function startOfDay(): string
    {
        return $this->carbon->startOfDay()->toDateTimeString();
    }

    final public function endOfDay(): string
    {
        return $this->carbon->endOfDay()->toDateTimeString();
    }


    /* setter */
    final public function setYear(int $year): self
    {
        $this->carbon->setDateTime($year, $this->month(), $this->day(), $this->hour(), $this->minute(), $this->second());
        return $this;
    }

    final public function setMonth(int $month): self
    {
        $this->carbon->setDateTime($this->year(), $month, $this->day(), $this->hour(), $this->minute(), $this->second());
        return $this;
    }

    final public function setDay(int $day): self
    {
        $this->carbon->setDateTime($this->year(), $this->month(), $day, $this->hour(), $this->minute(), $this->second());
        return $this;
    }

    final public function setHour(int $hour): self
    {
        $this->carbon->setDateTime($this->year(), $this->month(), $this->day(), $hour, $this->minute(), $this->second());
        return $this;
    }

    final public function setMinute(int $minute): self
    {
        $this->carbon->setDateTime($this->year(), $this->month(), $this->day(), $this->hour(), $minute, $this->second());
        return $this;
    }

    final public function setSecond(int $second): self
    {
        $this->carbon->setDateTime($this->year(), $this->month(), $this->day(), $this->hour(), $this->minute(), $second);
        return $this;
    }


    /* calculation */
    final public function addYear(int $year): self
    {
        $this->carbon->addYears($year);
        return $this;
    }

    final public function subYear(int $year): self
    {
        $this->carbon->subYears($year);
        return $this;
    }

    final public function diffYear(Carbon $carbon): int
    {
        return $this->carbon->diffInYears($carbon);
    }

    final public function addMonth(int $month): self
    {
        $this->carbon->addMonths($month);
        return $this;
    }

    final public function subMonth(int $month): self
    {
        $this->carbon->subMonths($month);
        return $this;
    }

    final public function diffMonth(Carbon $carbon): int
    {
        return $this->carbon->diffInMonths($carbon);
    }

    final public function addWeek(int $week): self
    {
        $this->carbon->addDays($week * 7);
        return $this;
    }

    final public function subWeek(int $week): self
    {
        $this->carbon->subDays($week * 7);
        return $this;
    }

    final public function diffWeek(Carbon $carbon): int
    {
        return $this->carbon->diffInWeeks($carbon);
    }

    final public function addDay(int $day): self
    {
        $this->carbon->addDays($day);
        return $this;
    }

    final public function subDay(int $day): self
    {
        $this->carbon->subDays($day);
        return $this;
    }

    final public function diffDay(Carbon $carbon): int
    {
        return $this->carbon->diffInDays($carbon);
    }

    final public function addHour(int $hour): self
    {
        $this->carbon->addHours($hour);
        return $this;
    }

    final public function subHour(int $hour): self
    {
        $this->carbon->subHours($hour);
        return $this;
    }

    final public function diffHour(Carbon $carbon): int
    {
        return $this->carbon->diffInHours($carbon);
    }

    final public function addMinute(int $minute): self
    {
        $this->carbon->addMinutes($minute);
        return $this;
    }

    final public function subMinute(int $minute): self
    {
        $this->carbon->subMinutes($minute);
        return $this;
    }

    final public function diffMinute(Carbon $carbon): int
    {
        return $this->carbon->diffInMinutes($carbon);
    }

    final public function addSecond(int $second): self
    {
        $this->carbon->addSeconds($second);
        return $this;
    }

    final public function subSecond(int $second): self
    {
        $this->carbon->subSeconds($second);
        return $this;
    }

    final public function diffSecond(Carbon $carbon): int
    {
        return $this->carbon->diffInSeconds($carbon);
    }


    /* check */
    final public function isMatchFormat(string $format): bool
    {
        return Carbon::hasFormat($this->carbon, $format);
    }

    final public function isMonday(): bool
    {
        return $this->carbon->isMonday();
    }

    final public function isTuesday(): bool
    {
        return $this->carbon->isTuesday();
    }

    final public function isWednesday(): bool
    {
        return $this->carbon->isWednesday();
    }

    final public function isThursDay(): bool
    {
        return $this->carbon->isThursDay();
    }

    final public function isFriday(): bool
    {
        return $this->carbon->isFriday();
    }

    final public function isSaturday(): bool
    {
        return $this->carbon->isSaturday();
    }

    final public function isSunday(): bool
    {
        return $this->carbon->isSunday();
    }

    final public function isWeekday(): bool
    {
        return $this->carbon->isWeekday();
    }

    final public function isWeekend(): bool
    {
        return $this->carbon->isWeekend();
    }

    final public function isToday(): bool
    {
        return $this->carbon->isToday();
    }

    final public function isLast(): bool
    {
        return $this->carbon->isLastOfMonth();
    }

    final public function isFuture(): bool
    {
        return $this->carbon->isFuture();
    }

    final public function isPast(): bool
    {
        return $this->carbon->isPast();
    }

    final public function isEqual(Carbon $carbon): bool
    {
        return $this->carbon->eq($carbon);
    }

    final public function isGreater(Carbon $carbon): bool
    {
        return $this->carbon->gt($carbon);
    }

    final public function isGreaterEqual(Carbon $carbon): bool
    {
        return $this->carbon->gte($carbon);
    }

    final public function isLess(Carbon $carbon): bool
    {
        return $this->carbon->lt($carbon);
    }

    final public function isLessEqual(Carbon $carbon): bool
    {
        return $this->carbon->lte($carbon);
    }
}
