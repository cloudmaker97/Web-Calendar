<?php
namespace App;
use App\Calendar\Builder\AbstractCalendarBuilder;
use App\Calendar\Timeable\CalendarDays;
use App\Calendar\Timeable\CalendarMonth;
use App\Calendar\Timeable\CalendarWeek;

class Calendar extends AbstractCalendarBuilder
{
    private CalendarWeek $calendarWeek;
    private CalendarDays $calendarDays;
    private CalendarMonth $calendarMonth;
    private bool $PrefixWeekNumber;

    public function __construct()
    {
        // Call parent
        parent::__construct();
        // Initialize the class dependencies
        $this->initializeDependencies();
        // Disable the header of the calendar
        $this->setWithHeader(false);
        // Show Calendar with prefix calendar week
        $this->setPrefixWeekNumber(true);
    }

    /**
     * @return bool
     */
    public function isPrefixWeekNumber(): bool
    {
        return $this->PrefixWeekNumber;
    }

    /**
     * @param bool $PrefixWeekNumber
     */
    public function setPrefixWeekNumber(bool $PrefixWeekNumber): void
    {
        $this->PrefixWeekNumber = $PrefixWeekNumber;
    }

    /**
     * Get the content of the header
     * @return string
     */
    protected function getHeader(): string
    {
        $currentParsedTime = $this->getCalendarDateTimeParsed();
        $parsedMonth = $currentParsedTime["month"];
        $parsedYear = $currentParsedTime["year"];
        $monthText = $this->calendarMonth->getMonthAtIndex($parsedMonth);
        return sprintf("%s %s", $monthText, $parsedYear);
    }

    /**
     * Get the content of the calendar
     * @return string
     */
    protected function getCalendar(): string
    {
        $currentParsedTime = $this->getCalendarDateTimeParsed();
        $parsedMonth = $currentParsedTime["month"];
        $parsedYear = $currentParsedTime["year"];
        $daysOfMonth = $this->calendarMonth->getDaysOfMonthByYearAndMonth($parsedMonth, $parsedYear);
        $firstWeekday = $this->calendarWeek->getFirstWeekdayIndexByMonthAndYear($parsedMonth, $parsedYear);
        return $this->createCalendarTable($firstWeekday, $daysOfMonth);
    }

    /**
     * Creates an HTML table with the calendar
     * @param int $firstWeekday
     * @param int $daysOfMonth
     * @return string
     */
    protected function createCalendarTable(int $firstWeekday, int $daysOfMonth): string
    {
        $calendar = new Calendar\Table\Table();
        $offsetDays = $firstWeekday - 1;
        $this->addCalendarWeekDaysHeader($calendar);
        $this->addCalendarDayRows($calendar, $offsetDays, $daysOfMonth);
        return $calendar->getHtml();
    }

    /**
     * Initialize the class dependencies
     * @return void
     */
    protected function initializeDependencies(): void
    {
        $this->calendarWeek = new CalendarWeek();
        $this->calendarDays = new CalendarDays();
        $this->calendarMonth = new CalendarMonth();
    }

    /**
     * Add the header with the abbreviated day names
     * @param Calendar\Table\Table $calendar
     * @return void
     */
    protected function addCalendarWeekDaysHeader(Calendar\Table\Table $calendar): void
    {
        $weekDays = $this->calendarDays->getDays(true);
        $calendarHeader = $calendar->createRow();
        $calendarHeader->setCssClasses(["headerOfDays"]);

        // If calendar weeks should be displayed add an extra column
        if($this->isPrefixWeekNumber()) {
            $calendarHeader->addColumn($calendarHeader->createColumn()->setContent(""));
        }

        foreach ($weekDays as $day) {
            $dayColumn = $calendarHeader->createColumn();
            $dayColumn->setContent($day);
            $calendarHeader->addColumn($dayColumn);
        }
        $calendar->addRow($calendarHeader);
    }

    /**
     * Add the calendar days of the month to the calendar
     * @param Calendar\Table\Table $calendar
     * @param int $offsetDays
     * @param int $daysOfMonth
     * @return void
     */
    protected function addCalendarDayRows(Calendar\Table\Table $calendar, int $offsetDays, int $daysOfMonth): void
    {
        $isCurrentCalendar = $this->getCalendarTime()->getIsCurrentCalendar($this->getCalendarDateTimeParsed());
        $calendarWeek = $this->calendarWeek->getCalendarWeekByDatetime($this->getCalendarDateTime());
        $calendarDayRows = $calendar->createRow();

        // If calendar weeks should be displayed
        if($this->isPrefixWeekNumber()) {
            $calendarDayRows->addColumn($calendarDayRows->createColumn()->setContent($calendarWeek)->setCssClasses(["calendarWeekEntry"]));
        }

        // Create an offset for the first starting day in month
        for ($offsetDay = 0; $offsetDay < $offsetDays; $offsetDay++) {
            $calendarDayRows->addColumn($calendarDayRows->createColumn());
        }

        // Display all days in a month with a display offset of 1
        for ($i = 1; $i < $daysOfMonth+1; $i++) {
            if($isCurrentCalendar && $i == (new \DateTime())->format("d")) {
                $calendarDayRows->addColumn($calendarDayRows->createColumn()->setContent($i)->setCssClasses(["currentDay", "calendarDay"]));
            } else {
                $calendarDayRows->addColumn($calendarDayRows->createColumn()->setContent($i)->setCssClasses(["calendarDay"]));
            }
            if (($i + $offsetDays) % CalendarDays::DAYS_IN_WEEK == 0) {
                $calendar->addRow($calendarDayRows);
                $calendarDayRows = $calendar->createRow();

                // If calendar weeks should be displayed increment it and adds it
                if($this->isPrefixWeekNumber()) {
                    $calendarDayRows->addColumn($calendarDayRows->createColumn()->setContent(++$calendarWeek)->setCssClasses(["calendarWeekEntry"]));
                }
            }
        }
        if($calendarDayRows->hasColumns()) {
            $calendar->addRow($calendarDayRows);
        }
    }
}