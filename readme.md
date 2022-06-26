# Web Calendar
## Preview
![calendar](https://user-images.githubusercontent.com/4189795/175835416-e3032cf8-4d90-4323-ab2d-d9b269814b6c.png)

## Description
This an easy-to-use and modifiable software for creating a monthly calendar on a PHP-driven Webserver. It has the
functionality to display the week-days, calendar-weeks and the offset for the first calendar-day 
(corresponding to its day-number).

### CLI Version
There is also a simplified CLI version of it which uses ASCII Characters for separation. 
It is located in the "console" folder and can be called with this command. You will only need PHP (without composer).
```
php console/index.php
```

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
After the installation you are able to access the calendar via. your Web-Browser by opening your chosen/configured URL.
