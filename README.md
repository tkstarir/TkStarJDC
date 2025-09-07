# TkStarJDC

TkStar Jalali Date Class + _Occasions_ and _Holidays_

Fully comprehensive PHP library for Jalali and Gregorian date converting to each other with _Occasions_ and _Holidays_ of both Gregorian and galali in a Single Class

Coming Soon: Lunar support for _Occasions_, _Holidays_ and Date Converting ...

## Table of Contents
* [TkStarJDC library description](#where-come-from-this-package)
* [Converting dates to each other formats](#jalali-to-gregorian-and-gregorian-to-jalali-converting)
* [Gregorian occasions](#gregorian-occasions)
* [Jalali occasions](#jalali-occasions)
* [Getting distances between two dates](#distance-between-two-gregorian-dates-based-on-year-month-days-hours-minutes-and-days)


## Where come from this package
**_This Package is a part of [LaunchPad Framework](https://github.com/TkStarIR/LaunchPad)_**


## Installing Package:
    composer require tkstarir/tkstarjdc


## To date method symbols:
    a: To display current half day in abbreviation: ق.ظ or ب.ظ
    A: To display current half day: قبل از ظهر or بعد از ظهر
    c: To display complete datetime in format of YYYY/MM/DD HH:ii:ss
    d: To display the day such as 11 or 24
    l: To display day of week such as یک شنبه or جمعه
    D: To display first character of day of the week such as ی for یک شنبه or ج for جمعه
    F: To display complete name of month such as فروردین or بهمن
    h: To display the hour in 12-hour format with 0 for hours less than 10
    H: To display the hour in 24-hour format without 0 for hours less than 10
    i: To display the minute with 0 for minutes less than 10
    s: To display the second with 0 for seconds less than 10
    S: To display the second without 0 for seconds less than 10
    m: To display the month number with 0 for months less than 10 such as 06 for شهریور
    M: To display the first three characters of month name such as شهر for شهریور or اسف for اسفند
    n: To display the month number without 0 for months less than 10 such as 6 for شهریور
    r: To display the current format of date: l, d F Y ساعت H:i:s such as شنبه, 16 بهمن 1378 ساعت 11:54:37
    w: To display the number of current weekday such as 3 for Tuesday
    W: To display the week number of year based on ISO-8601 standard
    y: To display the year as two digits such as 78 for 1378
    Y: To display the year as four digits
    U: To display the timestamp of your time


## Date converter samples:
```
use LaunchPad\Components\TkStarJDC;

echo(TkStarJDC::date('Y/m/d H:i:s')); // Result => 1378/11/16 00:00:00

echo(TkStarJDC::date('Y/m/d H:i:s', date('U'))); // Result => 1378/11/16 00:00:00

echo(TkStarJDC::date('l, d F Y ساعت H:i:s', time())); // Result => شنبه, 16 بهمن 1378 ساعت 00:00:00

echo(TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 day'))); // Result => 1378/11/15 00:00:00

echo(TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 week'))); // Result => 1378/11/8 00:00:00

echo(TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 month'))); // Result => 1378/10/16 00:00:00

echo(TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 year'))); // Result => 1377/11/16 00:00:00

echo(TkStarJDC::date('Y/m/d H:i:s', strtotime('2000-02-05'))); // Result => 1378/11/16 00:00:00

echo(TkStarJDC::date('Y/m/d H:i:s', strtotime('2000-02-05 12:30:00'))); // Result => 1378/11/16 12:00:00
```


## Jalali to gregorian and gregorian to jalali converting:
```
use LaunchPad\Components\TkStarJDC;

echo(join('-', TkStarJDC::JalaliToGregorian(1378, 11, 16))); // Result => 2000-2-5

echo(join('/', TkStarJDC::GregorianToJalali(2000, 02, 05))); // Result => 1378/11/16

$array = TkStarJDC::JalaliToGregorian(1378, 11, 16)); // Result => [ year, month, day ]

$array = TkStarJDC::GregorianToJalali(2000, 02, 05)); // Result => [ year, month, day ]
```


## Gregorian occasions:
```
use LaunchPad\Components\TkStarJDC;

$array = TkStarJDC::Occasions('2000-02-05', 'gregorian'); // Result => [ ... ]

$array = TkStarJDC::Occasions('2000/02/05', 'gregorian'); // Result => [ ... ]
```


## Jalali occasions:
```
use LaunchPad\Components\TkStarJDC;

$array = TkStarJDC::Occasions('1378-11-16', 'jalali'); // Result => [ ... ]

$array = TkStarJDC::Occasions('1378/11/16', 'jalali'); // Result => [ ... ]
```

## Distance of two gregorian dates:
```
use LaunchPad\Components\TkStarJDC;

$check_distance = TkStarJDC::Check_Distance('2022-11-09', '2000-02-05'); // Result => [ ... ]

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
