<?php
namespace App\Calendar\Builder;
use App\Calendar\Timeable\CalendarTime;
use DateTime;

/**
 * Abstract class for calendar builders.
 */
abstract class AbstractCalendarBuilder
{
    private CalendarTime $calendarTime;
    private DateTime $calendarDateTime;

    /** @var bool Enables the header of a calendar */
    private bool $withHeader = true;

    /** @var string Output of the built calendar */
    private string $composedCalendar = "";

    public function __construct()
    {
        $this->calendarTime = new CalendarTime();
        $this->setCalendarDateTime(new DateTime());
    }

    /**
     * @param DateTime $calendarDateTime
     * @return AbstractCalendarBuilder
     */
    public function setCalendarDateTime(DateTime $calendarDateTime): self
    {
        $this->calendarDateTime = $calendarDateTime;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCalendarDateTime(): DateTime
    {
        return $this->calendarDateTime;
    }

    /**
     * @return CalendarTime
     */
    protected function getCalendarTime(): CalendarTime
    {
        return $this->calendarTime;
    }

    /**
     * @return array
     */
    public function getCalendarDateTimeParsed(): array
    {
        return $this->calendarTime->parseDateTime($this->getCalendarDateTime());
    }

    /**
     * Outputs the built calendar.
     * @return string
     */
    public function getComposedCalendar(): string
    {
        $this->buildCalendar();
        return $this->composedCalendar;
    }

    /**
     * Build the calendar and write it to the builtCalendar property.
     * @return void
     */
    public function buildCalendar()
    {
        if(!empty($this->composedCalendar)) {
            $this->resetComposedCalendar();
        }
        if($this->isWithHeader()) {
            $this->addToBuiltCalendar($this->getHeader());
        }
        $this->addToBuiltCalendar($this->getCalendar());
    }

    /**
     * Adds a text to the composed calendar wich may be rendered
     * as html in a later time
     * @param string $Output
     * @return void
     */
    private function addToBuiltCalendar(string $Output) {
        $this->composedCalendar .= $Output;
    }

    /**
     * Check if the header (Month & Year) is enabled
     * @return bool
     */
    public function isWithHeader(): bool
    {
        return $this->withHeader;
    }

    /**
     * Set if the header (Month & Year) is enabled
     * @param bool $withHeader
     */
    public function setWithHeader(bool $withHeader): void
    {
        $this->withHeader = $withHeader;
    }

    /**
     * Header of the calendar.
     * @return string
     */
    abstract protected function getHeader(): string;

    /**
     * Body of the calendar.
     * @return string
     */
    abstract protected function getCalendar(): string;

    /**
     * Resets the composed calendar
     * @return void
     */
    private function resetComposedCalendar(): void
    {
        $this->composedCalendar = "";
    }
}