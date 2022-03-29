<?php
namespace App\Calendar\Timeable;
use DateTime;

class CalendarWeek
{
    /**
     * Get the calendar week by the given datetime but respects the first day
     * of month if not specified with forceDate argument
     * @param DateTime $DateTime
     * @param bool $forceDate
     * @return int
     */
    public function getCalendarWeekByDatetime(DateTime $DateTime, bool $forceDate=false): int
    {
        if(!$forceDate) {
            try {
                $DateTime = new DateTime(sprintf("01.%s.%s", $DateTime->format("m"), $DateTime->format("Y")));
            } catch (\Exception $e) {
                $DateTime = new DateTime();
            }
        }
        return $DateTime->format('W');
    }

    /**
     * Get the index of the first day of the month by the given year and month
     * @param int $Month
     * @param int $Year
     * @return int
     */
    public function getFirstWeekdayIndexByMonthAndYear(int $Month, int $Year): int
    {
        return date('N', mktime(0, 0, 0, $Month, 1, $Year));
    }
}