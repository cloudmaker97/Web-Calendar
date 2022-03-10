<?php
/* Coding Kata | Dennis H. */
const DAYS_IN_WEEK = 7;
$args = $argv;

// Holt sich ein Array der Wochentage oder gibt den spezifischen Wert des Index aus
function GetDaysShort($index=-1) {
	$days = ["Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"];
	if($index == -1) {
		return $days;
	} else {
		return $days[$index];
	}
}

// Holt sich ein Array der Monatsnamen oder gibt den spezifischen Wert des Index aus
function GetMonth($index=-1) {
	$index = $index-1;
	$days = ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"];
	if($index == -1) {
		return $days;
	} else {
		return $days[$index];
	}
}

// Holt die Anzahl der Tage im Gregoranischen Kalender zum angegebenen Datum
function GetDaysOfMonth() {
	$yearAndMonth = GetYearAndMonth();
	return cal_days_in_month(CAL_GREGORIAN, $yearAndMonth[1], $yearAndMonth[0]);
}

// Holt den ersten Wochentag (1-7, 1 = Montag) zum angegebenen Datum
function FirstWeekday() {
	$yearAndMonth = GetYearAndMonth();
	return date('N', mktime(0, 0, 0, $yearAndMonth[1], 1, $yearAndMonth[0])); 
}

// Holt Jahr und Monat aus den Programm-Argumenten oder nimmt das aktuelle
function GetYearAndMonth() {
	global $args;
	$month = null;
	$year = null;
	if(isset($args[1]) && isset($args[2])) {
		$month = $args[1];
		$year = $args[2];
	}
	if($year == null && $month == null) {
		if(isset($args[1])) {
			throw new Exception("Argumente unvollständig, es wurde kein Jahr angegeben");
		}	

		$time = new DateTime();
		return [(int)$time->format("Y"), (int)$time->format("m")];
	} else {
		return [(int)$year, (int)$month];
	}
}

// Prüft ob das Datum mit dem aktuellen angezeigten Kalender übereinstimmt
function GetIsCurrentCalendar() {
	$time = new DateTime();
	$currentTimeArr = [$time->format("Y"), $time->format("m")];
	$selectedTimeArr = GetYearAndMonth();
	return ($currentTimeArr[0] == $selectedTimeArr[0] && $currentTimeArr[1] == $selectedTimeArr[1]);
}

// Hole den aktuellen Tag des jetzigen Monats
function GetCurrentDayOfMonth() {
	$time = new DateTime();
	return $time->format("d");
}

function GetCalendarWeek($datetime=null) {
	if(is_null($datetime)) {
		$dateTime = new DateTime();
	} else {
		$dateTime = new DateTime($datetime);
	}
	return "KW".$dateTime->format("W"). " |";
}

// Erstellt den Kalender und gibt diesen aus
function BuildCalendar() {
	$yearAndMonth = GetYearAndMonth();
	$daysInMonth = GetDaysOfMonth();
	$firstWeekday = FirstWeekday();
	$currentDayOfMonth = GetCurrentDayOfMonth();
	$isCurrentCalendar = GetIsCurrentCalendar();
	$monthOfCalendar = GetMonth($yearAndMonth[1]);
	echo "\r\n\t";
	echo sprintf("== %s, %s ==\r\n", $monthOfCalendar, $yearAndMonth[0]);	

	echo "\r\n";
	foreach(GetDaysShort() as $Day) {
		echo "\t".$Day;
	}

	echo "\r\n\t- - - - - - - - - - - - - - - - - - - - - - - - - - - - \r\n\r\n";
	echo GetCalendarWeek(sprintf("%s.%s.%s", 1, $yearAndMonth[1], $yearAndMonth[0]));

	$offsetDays = $firstWeekday-1;
	for ($x=0; $x < $offsetDays; $x++) { 
		echo " "."\t";
	}

	for ($i=1; $i <= $daysInMonth; $i++) { 
		echo "\t";

		if(($i+$offsetDays) % 7 == 0) {
			echo "\033[31m";
		}

		if($i == $currentDayOfMonth && $isCurrentCalendar) {
			echo sprintf("(%s)", $i);
		} else {
			echo $i;
		}
		
		echo "\033[37m";

		if(($i+$offsetDays) % DAYS_IN_WEEK == 0) {
			echo "\r\n\r\n";
			echo GetCalendarWeek(sprintf("%s.%s.%s", $i+1, $yearAndMonth[1], $yearAndMonth[0]));
		}
	}

	echo "\r\n";
}

// Prüfe ob die Benutzereingaben valide sind
function CheckValidUserInput() {
	$valid = true;

	$yearAndMonth = GetYearAndMonth();
	$year = $yearAndMonth[0];
	$month = $yearAndMonth[1];

	if($month < 1 || $month > 12) {
		$valid = false;
	}

	if($year < 0 || $year > 9999) {
		$valid = false;
	}

	return $valid;
}

try {
	if(CheckValidUserInput()) {
		BuildCalendar();
	} else {
		echo "Die Benutzereingaben stimmen nicht; index.php {Monat|00} {Jahr|0000}";
	}
} catch(Exception $e) {
	echo "Fehler: ".$e->getMessage();
}