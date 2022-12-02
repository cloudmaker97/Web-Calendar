<?php
namespace App\Calendar\Timeable;
use DateTime;

class CalendarTime
{
    /**
     * Get the current DateTime
     * @return DateTime
     */
    public function getCurrentDateTime(): DateTime
    {
        return new DateTime();
    }

    /**
     * Parse a DateTime into an associative array
     * @param DateTime $dateTime
     * @return array
     */
    public function parseDateTime(DateTime $dateTime): array
    {
        return [
            "year" => $dateTime->format("Y"),
            "month" => $dateTime->format("m"),
            "day" => $dateTime->format("d")
        ];
    }

    /**
     * Returns whether the given parsed date is the current
     * @param array $parsedDate
     * @return bool
     */
    public function getIsCurrentCalendar(array $parsedDate): bool
    {
        $parsedYear = $parsedDate["year"];
        $parsedMonth = $parsedDate["month"];
        $currentDateTime = new DateTime();
        $currentTimeArr = [$currentDateTime->format("Y"), $currentDateTime->format("m")];
        return ($parsedYear == $currentTimeArr[0] && $parsedMonth == $currentTimeArr[1]);
    }

    /**
     * Gets an array wich contains the keys for the current year, month and day
     * @return void
     */
    public function getCurrentParsedTime(): array
    {
        $currentDateTime = $this->getCurrentDateTime();
        return $this->parseDateTime($currentDateTime);
    }
}