<?php
namespace App\Calendar\Timeable;

class CalendarMonth
{
    /** @var int This is the length of characters if a month is abbreviated */
    private const ABBREVIATION_LENGTH = 2;

    /**
     * Get the amount of days in the month by the given year and month
     * @param int $Month
     * @param int $Year
     * @return int
     */
    public function getDaysOfMonthByYearAndMonth(int $Month, int $Year): int
    {
        return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
    }

    /**
     * Get the month name of the given index
     * @param int $Index
     * @param bool $Abbreviation
     * @return string
     */
    public function getMonthAtIndex(int $Index, bool $Abbreviation = false): string
    {
        $months = $this->getMonths($Abbreviation);
        return $months[$Index];
    }

    /**
     * Get the month names.
     * @param bool $dayAbbreviation Whether to return abbreviations or full names.
     * @return string[]
     */
    public function getMonths(bool $dayAbbreviation = false): array
    {
        if($dayAbbreviation == true) {
            $days = self::getMonths();
            array_walk($days, function (&$value) {
                $value = substr($value, 0, self::ABBREVIATION_LENGTH);
            });
            return $days;
        } else {
            return [
                "Januar",
                "Februar",
                "März",
                "April",
                "Mai",
                "Juni",
                "Juli",
                "August",
                "September",
                "Oktober",
                "November",
                "Dezember"
            ];
        }
    }

}