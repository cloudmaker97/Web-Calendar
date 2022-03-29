<?php
use App\Calendar;
require "vendor/autoload.php";
$calendar = new Calendar();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kalender</title>
    <style>
        :root {
            --TableFont: white;
            --TableHeader: #cdffff;
            --TableBorder: white;
            --TableBackground: #161616;
            --TableSecondaryBorder: #3a3a3a;
            --TableCalendarWeek: #ff59bd;
            --CurrentDayBackground: #815858;
            --CurrentDayColor: red;
        }

        * {
            font-size: 1.5em;
        }

        body {
            user-select: none;
            padding: 1rem;
            font-family: Calibri, serif;
            background-color: #1e1e1e;
            color: var(--TableFont);
        }

        table {
            background-color: var(--TableBackground);
            border: 1px solid var(--TableBorder);
        }

        tr.headerOfDays {
            color: var(--TableHeader);
            font-size: .8rem;
        }

        tr > td {
            text-align: center;
            border: 1px solid var(--TableSecondaryBorder);
            font-size: 1rem;
        }

        td {
            padding: .3em;
        }

        td.calendarWeekEntry {
            color: var(--TableCalendarWeek);
        }
        
        td.calendarDay:hover {
            cursor: pointer;
            background-color: var(--TableBorder);
            color: var(--TableBackground);
        }

        td.currentDay {
            background-color: var(--CurrentDayBackground);
        }

        td.currentDay {
            background-color: var(--CurrentDayBackground);
        }

        td.currentDay:hover {
            background-color: var(--TableBorder);
            color: var(--CurrentDayColor);
        }
    </style>
</head>
<body>
    <?= $calendar->getComposedCalendar(); ?>
</body>
</html>