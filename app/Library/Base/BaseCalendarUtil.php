<?php

namespace App\Library\Base;

use Carbon\Carbon;
use App\Consts\DayOfWeekConst;
use App\Library\Entity\Calendar;

class BaseCalendarUtil
{
    /* bootstrap 推奨 */

    /* システム変数 */
    private Carbon $carbon;
    private array $data;
    private string $cellUrl;

    /* CSS変数 */
    private string $classCalendar;
    private string $classCalendarTable;
    private string $classDay;
    private string $classSaturday;
    private string $classSunday;
    private string $classOutRange;
    private string $classEvent;

    private int $calendarHeight;

    private array $dayOfWeek;

    function __construct(Carbon $carbon = null)
    {
        if (is_null($carbon)) $carbon = now();
        $this->carbon  = $carbon;
        $this->data    = [];
        $this->cellUrl = "";

        $this->classCalendar      = "calendar";
        $this->classCalendarTable = "table table-bordered";
        $this->classDay           = "calendar-cell position-relative";
        $this->classSaturday      = "table-primary";
        $this->classSunday        = "table-danger";
        $this->classOutRange      = "table-active invalid";
        $this->classEvent         = "calendar-event rounded px-1 position-relative";

        $this->calendarHeight  = 750;
        $this->dayOfWeekUpperCase();
    }

    public function getTitle(): string
    {
        return $this->carbon->format("Y年n月");
    }

    public function getMonth(): string
    {
        return $this->carbon->format("Y-m");
    }

    final public function dayOfWeekLowerCase(): self
    {
        $this->dayOfWeek = DayOfWeekConst::DAY_OF_WEEK_SHORT;
        return $this;
    }

    final public function dayOfWeekUpperCase(): self
    {
        $this->dayOfWeek = DayOfWeekConst::DAY_OF_WEEK_UPPER_CASE_SHORT;
        return $this;
    }

    final public function dayOfWeekKanji(): self
    {
        $this->dayOfWeek = DayOfWeekConst::DAY_OF_WEEK_KANJI;
        return $this;
    }

    final public function show(): string
    {
        $html = "";
        $html .= "<div class='" . $this->classCalendar . "'>";
        $html .= "<table class='" . $this->classCalendarTable . "'>";
        $html .= $this->tableHeader();
        $html .= $this->tableBody();
        $html .= "</table></div>";

        return $html;
    }

    final public function addData(int $id, string $eventDate, string $eventText, string $eventUrl = null, string $eventClass = null): self
    {
        $this->data[$eventDate][] = new Calendar($id, $eventDate, $eventText, $eventUrl, $eventClass);
        return $this;
    }

    final public function setHeight(int $height): self
    {
        $this->calendarHeight = $height;
        return $this;
    }

    final public function setCellUrl(string $cellUrl): self
    {
        $this->cellUrl = $cellUrl;
        return $this;
    }

    final private function tableHeader(): string
    {
        $html = "<thead><tr>";

        foreach ($this->dayOfWeek as $dayOfWeek) {
            $html .= "<th>" . $dayOfWeek . "</th>";
        }

        $html .= "</tr></thead>";

        return $html;
    }

    final private function tableBody(): string
    {
        $html = "<tbody>";
        $tmpDay = $this->carbon->copy()->firstOfMonth();
        $monthLastDay = $this->carbon->copy()->lastOfMonth();

        while ($tmpDay->lte($monthLastDay)) {
            $html .= "<tr style='height:" . ($this->calendarHeight / 5) . "px'>";

            $weekTmpDay = $tmpDay->copy()->startOfWeek()->subDay();
            $weekLastDay = $tmpDay->copy()->endOfWeek()->subDay();

            while ($weekTmpDay->lte($weekLastDay)) {
                $html .= $this->render($weekTmpDay);

                $weekTmpDay->addDay();
            }

            $html .= '</tr>';

            $tmpDay->addDays(7);
        }

        $html .= '</tbody>';

        return $html;
    }

    final private function render(Carbon $day): string
    {
        $html = "<td class='" . $this->getCellClassName($day) . "' data-date='" . $day->toDateString() . "' data-url='" . $this->cellUrl . "' style='width:" . (100 / 7) . "%;z-index:1;'>";

        $html .= "<p class='calendar-day'>" . $day->format("j") . "</p>";

        $html .= "<div class='calendar-event-box'>";

        if (isset($this->data[$day->toDateString()])) {
            foreach ($this->data[$day->toDateString()] as $data) {
                $html .= "<p class='" . $this->classEvent . " " . $data->eventClass . "' data-id='" . $data->id . "' data-url='" . $data->eventUrl . "' data-date='" . $data->eventDate . "' style='z-index:2;'>";
                $html .= $data->eventText;
                $html .= "</p>";
            }
        }

        $html .= "</div></td>";

        return $html;
    }

    private function getCellClassName(Carbon $day): string
    {
        if ($day->month !== $this->carbon->month) return $this->classOutRange;
        if ($day->isDayOfWeek(Carbon::SATURDAY)) return $this->classDay . " " . $this->classSaturday;
        if ($day->isDayOfWeek(Carbon::SUNDAY)) return $this->classDay . " " . $this->classSunday;

        return $this->classDay;
    }
}
