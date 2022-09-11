# TkStarJDC

TkStar Jalali Date Class + _Occasions_ and _Holidays_

Fully comprehensive PHP library for Jalali and Gregorian date converting to each other with _Occasions_ and _Holidays_ of both Gregorian and galali in a Single Class

Coming Soon: Lunar support for _Occasions_, _Holidays_ and Date Converting ...

## Table of Contents
-----------------
* [TkStarJDC library description](#where-come-from-this-package)
* [Converting dates to each other formats](#jalali-to-gregorian-and-gregorian-to-jalali-converting)
* [Gregorian occasions](#gregorian-occasions)
* [Jalali occasions](#jalali-occasions)
* [Getting distances between two dates](#distance-between-two-gregorian-dates-based-on-year-month-days-hours-minutes-and-days)


## Where come from this package
**_This Package is a part of [LaunchPad Framework](https://github.com/TkStarIR/LaunchPad)_**


## To date method symbols:
    **__a A c d D F g G h H i j l m M n r s S t w W Y U z__**


## Date converter samples:
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


## Jalali to gregorian and gregorian to jalali converting:
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


## Gregorian occasions:
```
<?php
use \TkStar\LaunchPad\Components as Component;

$array = Component\TkStarJDC::Occasions('2000-02-05', 'gregorian'); // Result => Array ( ... )

$array = Component\TkStarJDC::Occasions('2000/02/05', 'gregorian'); // Result => Array ( ... )
?>
```


## Jalali occasions:
```
<?php
use \TkStar\LaunchPad\Components as Component;

$array = Component\TkStarJDC::Occasions('1378-11-16', 'jalali'); // Result => Array ( ... )

$array = Component\TkStarJDC::Occasions('1378/11/16', 'jalali'); // Result => Array ( ... )
?>
```

## Distance between two gregorian dates based on Year, Month, Days, Hours, Minutes and Days:
```
<?php
use \TkStar\LaunchPad\Components as Component;

$check_distance = Component\TkStarJDC::Check_Distance('2022-11-09', '2000-02-05'); // Result => Array ( ... )

var_export($check_distance);

/*
  array (
    'is_reverse' => false,
    'total_seconds' => 718243200.0,
    'years' => 22,
    'months' => 4,
    'days' => 5,
    'hours' => 0,
    'minutes' => 0,
    'seconds' => 0.0,
  )
*/
```

**_Lunar Support for All of Above Types and Methods: Coming Soon ..._**
