<?php
namespace App\Calendar\Timeable;

class CalendarDays
{
    /** @var int This is the amount of the days in a week */
    public const DAYS_IN_WEEK = 7;
    /** @var int This is the length of characters if a day is abbreviated */
    private const ABBREVIATION_LENGTH = 2;

    /**
     * Returns the day of the index of the week.
     * @param int $Index
     * @param bool $Abbreviation
     * @return string
     */
    public function getDayAtIndex(int $Index, bool $Abbreviation = false): string
    {
        $Days = $this->getDays($Abbreviation);
        return $Days[$Index];
    }

    /**
     * Get the days of the week.
     * @param bool $dayAbbreviation Whether to return the days of the week with abbreviations.
     * @return string[]
     */
    public function getDays(bool $dayAbbreviation = false): array
    {
        if($dayAbbreviation == true) {
            $days = self::getDays();
            array_walk($days, function (&$value) {
                $value = substr($value, 0, self::ABBREVIATION_LENGTH);
            });
            return $days;
        } else {
            return [
                'Montag',
                'Dienstag',
                'Mittwoch',
                'Donnerstag',
                'Freitag',
                'Samstag',
                'Sonntag',
            ];
        }
    }
}