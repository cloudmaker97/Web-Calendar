# Web Calendar

## Description
This an easy-to-use and modifiable software for creating a monthly calendar on a PHP-driven Webserver. It has the
functionality to display the week-days, calendar-weeks and the offset for the first calendar-day 
(corresponding to its day-number).

## Requirements
- PHP >= 7.0
- PHP-Composer

### If you use Scoop.sh
Scoop is a package-manager for windows (Developer Tools, Software, Games etc.). You can check it out on GitHub or https://scoop.sh
```
scoop install php composer
```

## Installation
Put it on the webserver and run the composer dump-autoload command for using the autoloader for dependencies.
```
composer dump-autoload
```
After that you are able to access the calendar via. your Web-Browser by opening your chosen/configured URL.