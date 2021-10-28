# TkStarJDC
TkStar Jalali Date Class + Occasions and Holidays

a Full Complated PHP Library for Jalali and Gregorian Date Converter with Occasions of Gregorian and Jalali in one Class

Coming Soon...: Lunar Support for Occasions and Date Converter

Date Converter Supports: aAcdDFgGhHijlmMnrsStwWyYUz

## Date Converter Samples:

```
use \TkStar\LaunchPad\Components as Component;
echo(Component\TkStarJDC::date('Y/m/d H:i:s', time())); // Sample: 1378/11/16 12:30:00
echo(Component\TkStarJDC::date('Y/m/d H:i:s', date('U'))); // Sample: 1378/11/16 12:30:00
echo(Component\TkStarJDC::date('l, d F Y ساعت H:i:s', time())); // شنبه, 16 بهمن 1378 ساعت 12:30:00
echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 day')));  // Sample: 1378/11/16 12:30:00
echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 week'))); // Sample: 1378/11/16 12:30:00
echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 month'))); // Sample: 1378/11/16 12:30:00
echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('-1 year'))); // Sample: 1378/11/16 12:30:00
echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('2000-02-05'))); // Sample: 1378/11/16 12:30:00
echo(Component\TkStarJDC::date('Y/m/d H:i:s', strtotime('2000-02-05 12:30:00'))); // Sample: 1378/11/16 12:30:00
```



## Jalali => Gregorian and Gregorian => Jalali Converter Samples:
```
use \TkStar\LaunchPad\Components as Component;
print_r(Component\TkStarJDC::JalaliToGregorian(1378, 11, 16)); // Sample: array(year, month, day)
echo(join('-', Component\TkStarJDC::JalaliToGregorian(1378, 11, 16))); // Sample: 2000-2-5
echo(strtotime(join('-', Component\TkStarJDC::JalaliToGregorian(1378, 11, 16)))); // Sample: 949705200
print_r(Component\TkStarJDC::GregorianToJalali(2000, 02, 05)); // Sample: array(year, month, day)
echo(join('/', Component\TkStarJDC::GregorianToJalali(2000, 02, 05))); // Sample: 1378/11/16
```



## Gregorian Occasions Sample:
```
use \TkStar\LaunchPad\Components as Component;
print_r(Component\TkStarJDC::Occasions('1378-11-16', 'gregorian'));
print_r(Component\TkStarJDC::Occasions('1378/11/16', 'gregorian'));
print_r(Component\TkStarJDC::Occasions('2000-02-05', 'gregorian'));
print_r(Component\TkStarJDC::Occasions('2000/02/05', 'gregorian'));
```


## Jalali Occasions Sample:
```
use \TkStar\LaunchPad\Components as Component;
print_r(Component\TkStarJDC::Occasions('1378-11-16', 'jalali'));
print_r(Component\TkStarJDC::Occasions('1378/11/16', 'jalali'));
print_r(Component\TkStarJDC::Occasions('2000-02-05', 'jalali'));
print_r(Component\TkStarJDC::Occasions('2000/02/05', 'jalali'));
```


and Lunar Support for All of these: Coming Soon...
