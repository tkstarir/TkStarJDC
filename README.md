# World of Warcraft Herbalism Checker
jalali date class + occasions and holidays

a dull complated PHP library for jalali and gregorian date converter with occasions of gregorian and jalali in one Class

Coming soon...: Lunar support for occasions and date converter

Date converter supports: aAcdDFgGhHijlmMnrsStwWyYUz
Date converter supports: aAcdDFgGhHijlmMnrsStwWyYUz

## Date converter samples:

```
use \TkStar\LaunchPad\Components as Components;
echo(Components\TkStarJDC::date('Y/m/d H:i:s', time())); // Sample: 1378/11/16 12:30:00
echo(Components\TkStarJDC::date('Y/m/d H:i:s', date('U'))); // Sample: 1378/11/16 12:30:00
echo(Components\TkStarJDC::date('l, d F Y ساعت H:i:s', time())); // شنبه, 16 بهمن 1378 ساعت 12:30:00
echo(Components\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 day')));  // Sample: 1378/11/16 12:30:00
echo(Components\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 week'))); // Sample: 1378/11/16 12:30:00
echo(Components\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 month'))); // Sample: 1378/11/16 12:30:00
echo(Components\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 year'))); // Sample: 1378/11/16 12:30:00
echo(Components\TkStarJDC::date('Y/m/d H:i:s', strtotime('2000-02-05'))); // Sample: 1378/11/16 12:30:00
echo(Components\TkStarJDC::date('Y/m/d H:i:s', strtotime('2000-02-05 12:30:00'))); // Sample: 1378/11/16 12:30:00
```



## (Jalali => Gregorian) and (Gregorian => Jalali) Converter samples:
```
use \TkStar\LaunchPad\Components as Components;
print_r(Components\TkStarJDC::JalaliToGregorian(1378, 11, 16)); // Sample: array(year, month, day)
echo(join('-', Components\TkStarJDC::JalaliToGregorian(1378, 11, 16))); // Sample: 2000-2-5
echo(strtotime(join('-', Components\TkStarJDC::JalaliToGregorian(1378, 11, 16)))); // Sample: 949705200
print_r(Components\TkStarJDC::GregorianToJalali(2000, 02, 05)); // Sample: array(year, month, day)
echo(join('/', Components\TkStarJDC::GregorianToJalali(2000, 02, 05))); // Sample: 1378/11/16
```



## Gregorian Occasions Sample:
```
use \TkStar\LaunchPad\Components as Components;
print_r(Components\TkStarJDC::Occasions('1378-11-16', 'gregorian'));
print_r(Components\TkStarJDC::Occasions('1378/11/16', 'gregorian'));
print_r(Components\TkStarJDC::Occasions('2000-02-05', 'gregorian'));
print_r(Components\TkStarJDC::Occasions('2000/02/05', 'gregorian'));
```


## Jalali Occasions Sample:
```
use \TkStar\LaunchPad\Components as Components;
print_r(Components\TkStarJDC::Occasions('1378-11-16', 'jalali'));
print_r(Components\TkStarJDC::Occasions('1378/11/16', 'jalali'));
print_r(Components\TkStarJDC::Occasions('2000-02-05', 'jalali'));
print_r(Components\TkStarJDC::Occasions('2000/02/05', 'jalali'));
```


and Lunar Support for All of these: Coming Soon...
