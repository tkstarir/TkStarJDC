<?php

namespace LaunchPad\Components {

	if(!class_exists(__NAMESPACE__ . '\\TkStarJDC')){

		// TkStarJDC for getting time by your identifiers with all details such as occasions, holidays, diffrences and distances
		class TkStarJDC {

			// @property:public String $timezone
			protected static ?String $timezone = null;

			// @property:public String $requests_agent
			protected static ?String $requests_agent = 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0';

			/**
				* Convert your identifiers to jalali date
				* 
				* @param String|Null $type
				* @param Int $time
				* @return String|Null
			*/
			public static function date(?String $type = null, Int $time = 0) : ?String {
				(self::$timezone == 'default' ? '' : date_default_timezone_set(self::$timezone));
				$current_timezone = date_default_timezone_get();
				$result = array();
				$time = (empty($time) OR $time == 0) ? time() : $time;
				$jalali_date = self::Gregorian_To_Jalali(date('Y', $time), date('m', $time), date('d', $time));
				$jalali_year = $jalali_date[0];
				$jalali_month = $jalali_date[1];
				$jalali_day = $jalali_date[2];
				for($i = 0; $i < strlen($type); $i++){
					switch($type[$i]){
						case('a'): $result[] = date('a', $time) == 'pm' ? 'ق.ظ' : 'ب.ظ'; break;
						case('A'): $result[] = date('a', $time) == 'pm' ? 'قبل از ظهر' : 'بعد از ظهر'; break;
						case('c'): $result[] = self::date('Y/m/d H:i:s', $time); break;
						case('d'):
							$jalali_day = mb_substr($jalali_day, 0, 1, 'utf-8') == '0' ? mb_substr($jalali_day, 1, (strlen($jalali_day) - 1), 'utf-8') : $jalali_day;
							$result[] = $jalali_day <= 9 ? '0' . $jalali_day : $jalali_day;
						break;
						case('D'): $result[] = self::Days_Of_Week(date('D', $time), true); break;
						case('F'): $result[] = self::Month_Name($jalali_month, false); break;
						case('g'): $result[] = date('g', $time); break;
						case('G'): $result[] = date('G', $time); break;
						case('h'): $result[] = date('h', $time); break;
						case('H'): $result[] = date('H', $time); break;
						case('i'): $result[] = date('i', $time); break;
						case('j'): $result[] = $jalali_day; break;
						case('l'): $result[] = self::Days_Of_Week(date('l', $time), false); break;
						case('m'):
							$jalali_month = mb_substr($jalali_month, 0, 1, 'utf-8') == '0' ? mb_substr($jalali_month, 1, (strlen($jalali_month) - 1), 'utf-8') : $jalali_month;
							$result[] = $jalali_month <= 9 ? '0' . $jalali_month : $jalali_month;
							break;
						case('M'): $result[] = self::Month_Name($jalali_month, true); break;
						case('n'): $result[] = $jalali_month; break;
						case('r'): $result[] = self::date('l, d F Y ساعت H:i:s', $time); break;
						case('s'): $result[] = date('s', $time); break;
						case('S'): $result[] = 'ام'; break;
						case('t'): $result[] = self::Last_Day_Of_Week(date('Y', $time), $month, $day); break;
						case('w'):
							$day_of_week = date('D', $time);
							$day_of_week = mb_strtolower($day_of_week, 'utf-8');
							switch($day_of_week){
								case('sat'): $result[] = 0; break;
								case('sun'): $result[] = 1; break;
								case('mon'): $result[] = 2; break;
								case('tue'): $result[] = 3; break;
								case('wed'): $result[] = 4; break;
								case('thu'): $result[] = 5; break;
								case('friday'): $result[] = 6; break;
								default: $result[] = null; break;
								}
								break;
						case('W'):
							$days = self::Days_Of_Year($jalali_year, $jalali_month, $jalali_day);
							$weeks = $days / 7;
							$weeks = floor($weeks);
							break;
						case('y'): $result[] = mb_substr($jalali_year, 2, 4, 'utf-8'); break;
						case('Y'): $result[] = $jalali_year; break;
						case('U'): $result[] = time(); break;
						default: $result[] = $type[$i]; break;
					}
				}
				date_default_timezone_set($current_timezone);
				$result = join('', $result);
				return $result;
			}

			/**
				* Get occasions of a day by it's time
				* 
				* @param String|Null|Int $time
				* @param String|Null $occasions_type
				* @return Array
			*/
			public static function Occasions(String | Null | Int $time = 'default', ?String $occasions_type = 'jalali') : Array {
				$output = array('count' => 0, 'month_name' => '', 'jalali_date' => '', 'gregorian_date' => '', 'time' => '', 'occasions' => array());
				$occasions_type = mb_strtolower($occasions_type, 'utf-8');
				$occasions_type = in_array($occasions_type, array('gregorian', 'jalali')) ? $occasions_type : 'jalali';
				$time = $time == 'default' ? ($occasions_type == 'jalali' ? self::date('Y/m/d', time()) : date('Y/m/d', time())) : $time;
				$time = str_replace(array('-', '/'), array('/', '/'), $time);
				$real_time = $time;
				if(strtotime($real_time) <= 0){
					$real_time_split = explode('/', $real_time);
					$real_time_split_day = (isset($real_time_split[2]) AND !empty($real_time_split[2]) AND $real_time_split[2] >= 1) ? $real_time_split[2] : 1;
					$real_time_gregorian = self::Jalali_To_Gregorian($real_time_split[0], $real_time_split[1], $real_time_split_day);
					$real_time = $real_time_gregorian[0] . '/' . $real_time_gregorian[1];
					$real_time = (isset($real_time_split[2]) AND !empty($real_time_split[2]) AND $real_time_split[2] >= 1) ? ($real_time . '/' . $real_time_gregorian[2]) : ($real_time . '/0');
				}
				$real_time = strtotime($real_time);
				$time = explode('/', $time);
				if(count($time) <= 1 OR empty($time[0]) OR empty($time[1])){
					return($output);
				}else{
					$time_in_url = $time[0] . '/' . $time[1] . '/';
					$time_in_url = (isset($time[2]) AND $time[2] >= 1) ? ($time_in_url . $time[2] . '/') : $time_in_url;
					$url = 'https://www.time.ir/fa/event/list/';
					$url = $occasions_type == 'jalali' ? ($url . '0') : ($url . '1');
					$url = $url . '/' . $time_in_url;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_USERAGENT, self::$requests_agent);
					curl_setopt($ch, CURLOPT_URL, $url);
					$result = curl_exec($ch);
					settype($result, 'String');
					$result = trim($result);
					libxml_use_internal_errors(true);
					$dom_document = new DOMDocument;
					$dom_document->loadHTML($result);
					$occasions = $dom_document->getElementsByTagName('ul')->item(0);
					$occasions = $dom_document->saveHTML($occasions);
					settype($occasions, 'String');
					$occasions = trim($occasions);
					preg_match_all('/\<li(.*?)\>(.*?)\<\/li\>/imuxs', $occasions, $occasions);
					$i = 0;
					$output['month_name'] = self::date('F', $real_time);
					$output['jalali_date'] = self::date('Y/m', $real_time);
					$output['gregorian_date'] = date('Y-m', $real_time);
					$output['time'] = $real_time;
					foreach($occasions[0] as $occasion){
						$output['count']++;
						$occasion = trim($occasion);
						$occasion = str_replace(array('  ', chr(10) . chr(13), chr(10), chr(13)), array('', '', '', ''), $occasion);
						$occasion = explode('<li>', $occasion);
						foreach($occasion as $text){
							if(empty($text)){
								continue;
							}else{
								$text = str_replace(array('</li>'), array(''), $text);
								preg_match('/\<span(.*?)\>(.*?)\<\/span\>/imuxs', $text, $day_details);
								$occasion_details = preg_replace('/\<span(.*?)\>(.*?)\<\/span\>(.*?)\<span(.*?)\>(.*?)\<\/span\>/imuxs', '$3', $text);
								$occasion_details = str_replace(array('</span>'), array(''), $occasion_details);
								$day = trim(self::Convert_To_English_Numbers(preg_replace('/\D/imuxs', '', $day_details[2])));
								$holiday = strpos($occasions[0][$i], 'eventHoliday') !== false ? 'true' : 'false';
								$day_time = join('-', self::Jalali_To_Gregorian(self::date('Y', $real_time), self::date('m', $real_time), $day));
								$day_time = strtotime($day_time);
								$output['occasions'][$day] = array('day' => $day, 'jalali_date' => self::date('Y/m/d', $day_time), 'gregorian_date' => date('Y-m-d', $day_time), 'time' => $day_time, 'occasion' => preg_replace('/[^ ا-ی]/imuxs', '', $occasion_details), 'is_holiday_for_jalali' => $holiday);
							}
						}
						$i++;
					}
					return($output);
				}
			}

			/**
				* Convert persian numbers to their's english format
				* 
				* @param String|Null $number
				* @return String|Null
			*/
			public static function Convert_To_English_Numbers(?String $number = null) : ?String {
				$number = trim($number);
				$number = str_replace(array('۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰'), array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0'), $number);
				settype($number, 'String');
				return($number);
			}

			/**
				* Convert jalali year, month and date to their's gregorian format
				* 
				* @param Int $jalali_year
				* @param Int $jalali_month
				* @param Int $jalali_day
				* @return Array
			*/
			public static function Jalali_To_Gregorian(Int $jalali_year = 0, Int $jalali_month = 0, Int $jalali_day = 0) : Array {
				$gregorian_days_of_months = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
				$jalali_days_of_months = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);   
				$jalali_year = $jalali_year - 979;
				$jalali_month = $jalali_month - 1;
				$jalali_day = $jalali_day - 1;
				$jalali_day_number = $jalali_year * 365;
				$jalali_day_number = $jalali_day_number + (self::Divergence($jalali_year, 33) * 8);
				$jalali_day_number = $jalali_day_number + self::Divergence((($jalali_year % 33) + 3), 4);
				for($i = 0; $i < $jalali_month; $i++){
					$jalali_day_number += $jalali_days_of_months[$i];
				}
				$jalali_day_number += $jalali_day;
				$gregorian_day_number = $jalali_day_number + 79;
				$gregorian_year = 1600;
				$gregorian_year = $gregorian_year + (self::Divergence($gregorian_day_number, 146097) * 400);
				$gregorian_day_number %= 146097;
				$leap = true;
				if($gregorian_day_number >= 36525){
					$gregorian_day_number--;
					$gregorian_year = $gregorian_year + (self::Divergence($gregorian_day_number, 36524) * 100);
					$gregorian_day_number %= 36524;
					if($gregorian_day_number >= 365){
						$gregorian_day_number++;
						$leap = true;
					}else{
						$leap = false;
					}
				}
				$gregorian_year = $gregorian_year + (self::Divergence($gregorian_day_number, 1461) * 4);
				$gregorian_day_number %= 1461;
				if($gregorian_day_number >= 366){
					$leap = false;
					$gregorian_day_number--;
					$gregorian_year += self::Divergence($gregorian_day_number, 365);
					$gregorian_day_number = $gregorian_day_number % 365;
				}
				for ($i = 0; $gregorian_day_number >= $gregorian_days_of_months[$i]; $i++){
					$gregorian_day_number -= $gregorian_days_of_months[$i]+($i == 1 && $leap);
				}
				$gregorian_month = $i+1;
				$gregorian_day = $gregorian_day_number + 1;
				return array($gregorian_year, $gregorian_month, $gregorian_day);
			}

			/**
				* Get full date of your entire timestamp
				* 
				* @param Int $time
				* @return Array
			*/
			public static function Full_Date(Int $time = 0) : Array {
				$time = (empty($time) OR $time == 0) ? time() : $time;
				$output = array('seconds' => self::date('s', $time), 'minutes' => self::date('i', $time), 'hours' => self::date('H', $time), 'day' => self::date('d', $time), 'month' => self::date('m', $time), 'year' => self::date('Y', $time), 'day_of_week' => self::date('w', $time), 'day_of_month' => self::date('j', $time), 'day_of_year' => self::Days_Of_Year(self::date('Y', $time), self::date('m', $time), self::date('d', $time)), 'weekday' => self::date('l', $time), 'month_name' => self::date('F', $time), 'year_kabise' => self::Check_Kabise(date('Y', $time)) ? 'true' : 'false', 'full_date' => self::date('r', $time));
				return($output);
			}

			/**
				* Convert gregorian year, month and date to their's jalali format
				* 
				* @param Int $gregorian_year
				* @param Int $gregorian_month
				* @param Int $gregorian_day
				* @return Array
			*/
			public static function Gregorian_To_Jalali(Int $gregorian_year = 0, Int $gregorian_month = 0, Int $gregorian_day = 0) : Array {
				$gregorian_days_of_months = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
				$jalali_days_of_months = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);   
				$gregorian_year = $gregorian_year - 1600;
				$gregorian_month = $gregorian_month - 1;
				$gregorian_day = $gregorian_day - 1;
				$gregorian_day_number = $gregorian_year * 365;
				$gregorian_day_number = $gregorian_day_number + (self::Divergence(($gregorian_year + 3), 4));
				$gregorian_day_number = $gregorian_day_number - (self::Divergence(($gregorian_year + 99), 100));
				$gregorian_day_number = $gregorian_day_number + (self::Divergence(($gregorian_year + 399), 400));
				for ($i = 0; $i < $gregorian_month; $i++){
					$gregorian_day_number += $gregorian_days_of_months[$i];
				}
				($gregorian_month >= 2 AND ((($gregorian_year % 4) == 0 AND ($gregorian_year % 100) != 0) OR ($gregorian_year % 400 == 0))) ? $gregorian_day_number++ : '';
				$gregorian_day_number += $gregorian_day;
				$jalali_day_number = $gregorian_day_number - 79;
				$jalali_divergence = self::Divergence($jalali_day_number, 12053);
				$jalali_day_number %= 12053;
				$jalali_year = 979;
				$jalali_year = $jalali_year + ($jalali_divergence * 33);
				$jalali_year = $jalali_year + (self::Divergence($jalali_day_number, 1461) * 4);
				$jalali_day_number %= 1461;
				if($jalali_day_number >= 366){
					$jalali_year += self::Divergence(($jalali_day_number -1), 365);
					$jalali_day_number = ($jalali_day_number - 1) % 365;
				}
				for($i = 0; $i <= 11 AND $jalali_day_number >= $jalali_days_of_months[$i]; $i++){
					$jalali_day_number -= $jalali_days_of_months[$i];
				}
				$jalali_month = $i + 1;
				$jalali_day = $jalali_day_number + 1;
				return(array($jalali_year, $jalali_month, $jalali_day));
			}

			/**
				* Get last days of a month by it's date
				* 
				* @param Int $year
				* @param Int $month
				* @param Int $day
				* @return Int
			*/
			public static function Last_Day_Of_Week(Int $year = 0, Int $month = 0, Int $day = 0) : Int {
				$jalali_day_2 = $jalali_date = $jalali_day = '';
				$last_day_gregorian = date('d', mktime(0, 0, 0, ($month + 1), 0, $year));
				$jalali = self::Gregorian_To_Jalali($year, $month, $day);
				$jalali_year = $jalali[0];
				$jalali_day = $last_day = $jalali[2];
				while($jalali_day_2 != '1'){
					if($day < $last_day_gregorian){
						$day++;
						$jalali = self::Gregorian_To_Jalali($year, $month, $day);
						$jalali_year = $jalali[0];
						$jalali_day_2 = $jalali[2];
						if($jalali_day_2 == '1'){
							break;
						}else{
							$last_day++;
							continue;
						}
					}else{
						$day = 0;
						$month++;
						$month = $month == 13 OR $month == '13' ? $month : $month;
						$year++;
						continue;
					}
				}
				$last_day -= 1;
				return($last_day);
			}

			/**
				* Get month short and full name of a month by it's number
				* 
				* @param String|Null $month
				* @param Bool $short
				* @return String|Null
			*/
			public static function Month_Name(?String $month = null, Bool $short = false) : ?String {
				switch($month){
					case(1): case('01'): case('1'): $month = 'فروردین'; break;
					case(2): case('02'): case('2'): $month = 'اردیبهشت'; break;
					case(3): case('03'): case('3'): $month = 'خرداد'; break;
					case(4): case('04'): case('4'): $month = 'تیر'; break;
					case(5): case('05'): case('5'): $month = 'مرداد'; break;
					case(6): case('06'): case('6'): $month = 'شهریور'; break;
					case(7): case('07'): case('7'): $month = 'مهر'; break;
					case(8): case('08'): case('8'): $month = 'آبان'; break;
					case(9): case('09'): case('9'): $month = 'آذر'; break;
					case(10): case('10'): case('10'): $month = 'دی'; break;
					case(11): case('11'): case('11'): $month = 'بهمن'; break;
					case(12): case('12'): case('12'): $month = 'اسفند'; break;
					default: $month = null; break;
				}
				$month = $short ? mb_substr($month, 0, 3, 'utf-8') : $month;
				return($month);
			}

			/**
				* Get short and full name of a week by it's number
				* 
				* @param String|Null $day
				* @param Bool $short
				* @return String|Null
			*/
			public static function Days_Of_Week(?String $day = null, Bool $short = false) : ?String {
				$day = mb_strtolower($day, 'utf-8');
				switch($day){
					case('sat'): case('saturday'): $day = 'شنبه'; break;
					case('sun'): case('sunday'): $day = 'یک شنبه'; break;
					case('mon'): case('monday'): $day = 'دو شنبه'; break;
					case('tue'): case('tuesday'): $day = 'سه شنبه'; break;
					case('wed'): case('wednesday'): $day = 'چهار شنبه'; break;
					case('thu'): case('thursday'): $day = 'پنج شنبه'; break;
					case('friday'): case('friday'): $day = 'جمعه'; break;
					default: $day = null; break;
				}
				$day = $short ? mb_substr($day, 0, 1, 'utf-8') : $day;
				return($day);
			}

			/**
				* Divergence of a number to another one
				* 
				* @param Int $divergence_base
				* @param Int $divergence_to
				* @return Float|Int
			*/
			public static function Divergence(Int $divergence_base = 0, Int $divergence_to = 0) : Float | Int {
				$output = $divergence_base / $divergence_to;
				settype($output, 'Int');
				return($output);
			}

			/**
				* Get days of a year by it's date
				* 
				* @param Int $jalali_year
				* @param Int $jalali_month
				* @param Int $jalali_day
				* @return Int
			*/
			public static function Days_Of_Year(Int $jalali_year = 0, Int $jalali_month = 0, Int $jalali_day = 0) : Int {
				$result = 0;
				if($jalali_month == 1){
					return($jalali_day);
				}else{
					for($i = 1; $i < $jalali_month OR $i == 12; $i++){
						$gregorian_date = self::Jalali_To_Gregorian($jalali_year, $jalali_month, $jalali_day);
						$result += self::Last_Day_Of_Week($gregorian_date[0], $gregorian_date[1], $gregorian_date[2]);
					}
					$output = $result + $jalali_day;
					return($output);
				}
			}

			/**
				* Check a year is kabise or not
				* 
				* @param Mixed $gregorian_year
				* @return Bool
			*/
			public static function Check_Kabise(Mixed $gregorian_year) : Bool {
				return((($gregorian_year % 4) == 0 AND ($gregorian_year % 100) != 0) ? true : false);
			}

			/**
				* Get distance between two gregorian dates
				* 
				* @param String|Null|Int $from_date
				* @param String|Null|Int $to_date
				* @return Bool
			*/
			public static function Check_Distance(String | Null | Int $from_date = null, String | Null | Int $to_date = null) : Array {
				$from_date = is_string($from_date) ? strtotime($from_date) : $from_date;
				$to_date = is_string($to_date) ? strtotime($to_date) : $to_date;
				$date = round($from_date - $to_date, 0);
				$is_reverse = $date < 0 ? true : false;
				$date = abs($date);
				$output = array('is_reverse' => $is_reverse, 'total_seconds' => $date, 'years' => null, 'months' => null, 'days' => null, 'hours' => null, 'minutes' => null, 'seconds' => null);
				do {
					$date -= 60;
					is_null($output['minutes']) ? $output['minutes'] = 0 : '';
					$output['minutes']++;
					if($output['minutes'] >= 60){
						is_null($output['hours']) ? $output['hours'] = 0 : '';
						$output['minutes'] = 0;
						$output['hours']++;
					}
					if($output['hours'] >= 24){
						is_null($output['days']) ? $output['days'] = 0 : '';
						$output['hours'] = 0;
						$output['days']++;
					}
					if($output['days'] >= 31){
						is_null($output['months']) ? $output['months'] = 0 : '';
						$output['days'] = 0;
						$output['months']++;
					}
					if($output['months'] >= 12){
						is_null($output['years']) ? $output['years'] = 0 : '';
						$output['months'] = 0;
						$output['years']++;
					}
				}while($date >= 60);
				$output['seconds'] = $date;
				if($output['years'] === null)unset($output['years']);
				if($output['months'] === null)unset($output['months']);
				if($output['days'] === null)unset($output['days']);
				if($output['hours'] === null)unset($output['hours']);
				if($output['minutes'] === null)unset($output['minutes']);
				return($output);
			}

		}

	}

}

?>
