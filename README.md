# TkStarJDC

TkStar Jalali Date Class + Occasions and Holidays

Fully comprehensive PHP library for jalali and gregorian date converting to each other with occasions of both gregorian and galali in a Single Class

Coming Soon: Lunar support for occasions and date converter

Date Converter Symbols: **_a A c d D F g G h H i j l m M n r s S t w W Y U z_**


## Date Converter Samples:
```
<?php
use \TkStar\LaunchPad\Components as Component;

echo(Component\TkStarJDC::date('Y/m/d H:i:s')); // Result => 1378/11/16 00:00:00

echo(Component\TkStarJDC::date('Y/m/d H:i:s', date('U'))); // Result => 1378/11/16 00:00:00

echo(Component\TkStarJDC::date('l, d F Y ساعت H:i:s', time())); // Result => شنبه, 16 بهمن 1378 ساعت 00:00:00

echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 day'))); // Result => 1378/11/15 00:00:00

echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 week'))); // Result => 1378/11/8 00:00:00

echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 month'))); // Result => 1378/10/16 00:00:00

echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 year'))); // Result => 1377/11/16 00:00:00

echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('2000-02-05'))); // Result => 1378/11/16 00:00:00

echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('2000-02-05 12:30:00'))); // Result => 1378/11/16 12:00:00
?>
```


## "Jalali" to "Gregorian" & "Gregorian" => "Jalali" Converter Samples:
```
<?php
use \TkStar\LaunchPad\Components as Component;

echo(join('-', Component\TkStarJDC::JalaliToGregorian(1378, 11, 16))); // Result => 2000-2-5

echo(strtotime(join('-', Component\TkStarJDC::JalaliToGregorian(1378, 11, 16)))); // Result => 949705200

echo(join('/', Component\TkStarJDC::GregorianToJalali(2000, 02, 05))); // Result => 1378/11/16

$array = Component\TkStarJDC::JalaliToGregorian(1378, 11, 16)); // Result => Array ( year, month, day )

$array = Component\TkStarJDC::GregorianToJalali(2000, 02, 05)); // Result => Array ( year, month, day )

?>
```


## Gregorian Occasions Sample:
```
<?php
use \TkStar\LaunchPad\Components as Component;

$array = Component\TkStarJDC::Occasions('1378-11-16', 'gregorian'); // Result => Array ( ... )

$array = Component\TkStarJDC::Occasions('1378/11/16', 'gregorian'); // Result => Array ( ... )

$array = Component\TkStarJDC::Occasions('2000-02-05', 'gregorian'); // Result => Array ( ... )

$array = Component\TkStarJDC::Occasions('2000/02/05', 'gregorian'); // Result => Array ( ... )
?>
```


## Jalali Occasions Sample:
```
<?php
use \TkStar\LaunchPad\Components as Component;

$array = Component\TkStarJDC::Occasions('1378-11-16', 'jalali'); // Result => Array ( ... )

$array = Component\TkStarJDC::Occasions('1378/11/16', 'jalali'); // Result => Array ( ... )

$array = Component\TkStarJDC::Occasions('2000-02-05', 'jalali'); // Result => Array ( ... )

$array = Component\TkStarJDC::Occasions('2000/02/05', 'jalali'); // Result => Array ( ... )
?>
```

**_Lunar Support for All of Above Types and Methods: Coming Soon ..._**
