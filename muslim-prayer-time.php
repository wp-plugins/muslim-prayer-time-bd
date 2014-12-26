<?php
/*
Plugin Name: Muslim Prayer Time BD
Plugin URI: http://wordpress.org/plugins/muslim-prayer-time-bd/
Description: "Muslim Prayer Time BD" plugin provides the ability to display prayer (salah) times for BD Muslims with pretty widget.
Author: Iftekhar
Author URI: http://profiles.wordpress.org/moviehour/
Version: 1.2
*/

/*  Copyright 2014  Iftekhar  (email : moviehour@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function bn_prayer_time($number) {
	$number= str_replace("0", "০", $number);
	$number= str_replace("1", "১", $number);
	$number= str_replace("2", "২", $number);
	$number= str_replace("3", "৩", $number);
	$number= str_replace("4", "৪", $number);
	$number= str_replace("5", "৫", $number);
	$number= str_replace("6", "৬", $number);
	$number= str_replace("7", "৭", $number);
	$number= str_replace("8", "৮", $number);
	$number= str_replace("9", "৯", $number);
	return $number;
}
function district_lists(){
	$district_lists = array( 'কক্সবাজার', 'কুমিল্লা', 'কিশোরগঞ্জ', 'কুষ্টিয়া', 'কুড়িগ্রাম', 'খাগড়াছড়ি', 'খুলনা', 'গাইবান্ধা', 'গাজীপুর', 'গোপালগঞ্জ', 'চট্টগ্রাম', 'চাঁদপুর', 'চাঁপাইনবাবগঞ্জ', 'চুয়াডাঙ্গা', 'জামালপুর', 'জয়পুরহাট', 'ঝিনাইদহ', 'ঝালকাঠি', 'টাঙ্গাইল', 'ঠাকুরগাঁও', 'ঢাকা', 'দিনাজপুর', 'নওগাঁ', 'নাটোর', 'নেত্রকোনা', 'নরসিংদী', 'নারায়ণগঞ্জ', 'নীলফামারী', 'নোয়াখালী', 'নড়াইল', 'পটুয়াখালী', 'পঞ্চগড়', 'পাবনা', 'পিরোজপুর', 'ফেনী', 'ফরিদপুর', 'বাগেরহাট', 'বগুড়া', 'বান্দরবান', 'বরগুনা', 'বরিশাল', 'ব্রাহ্মণবাড়িয়া', 'ভোলা', 'মাগুরা', 'মাদারীপুর', 'মানিকগঞ্জ', 'মুন্সিগঞ্জ', 'মৌলভীবাজার', 'ময়মনসিংহ', 'মেহেরপুর', 'যশোর', 'রাঙামাটি', 'রাজবাড়ী', 'রাজশাহী', 'রংপুর', 'লালমনিরহাট', 'লক্ষ্মীপুর', 'শেরপুর', 'শরিয়তপুর', 'সাতক্ষীরা', 'সুনামগঞ্জ', 'সিরাজগঞ্জ', 'সিলেট', 'হবিগঞ্জ' );
	return $district_lists;
}
function prayer_district_time($prayer_name, $mod_time = '') {
	$time = strtotime($prayer_name);
	$prayer_time = date("g:i", strtotime($mod_time, $time));
	return $prayer_time;
}
function mptb_enqueue_scripts(){
	wp_enqueue_style('prayer-time', WP_PLUGIN_URL .'/muslim-prayer-time-bd/css/prayer-time.css?v=1.0');
}
add_action('init', 'mptb_enqueue_scripts');
function mptb_muslim_prayer_time() {
	$t4b = 0;
	$city_states = district_lists();
	$mptb_city = get_option('default_city') != '' ? get_option('default_city') : 'ঢাকা';
	$month = date('m');
	$day_number = date('j');
	$adjust_time = '';
	if($month == 1) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '5:19', 'fajr' => '5:24', 'sunrise' => '6:41', 'duhr' => '12:06', 'asr' => '3:46', 'maghrib' => '5:27', 'isha' => '6:45' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '5:21', 'fajr' => '5:26', 'sunrise' => '6:42', 'duhr' => '12:08', 'asr' => '3:49', 'maghrib' => '5:29', 'isha' => '6:48' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '5:22', 'fajr' => '5:27', 'sunrise' => '6:43', 'duhr' => '12:10', 'asr' => '3:53', 'maghrib' => '5:33', 'isha' => '6:51' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '5:23', 'fajr' => '5:28', 'sunrise' => '6:43', 'duhr' => '12:12', 'asr' => '3:56', 'maghrib' => '5:36', 'isha' => '6:53' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '5:23', 'fajr' => '5:28', 'sunrise' => '6:43', 'duhr' => '12:13', 'asr' => '4:00', 'maghrib' => '5:40', 'isha' => '6:56' );
		} else {
			$time_schedule = array( 'sehri' => '5:22', 'fajr' => '5:27', 'sunrise' => '6:41', 'duhr' => '12:14', 'asr' => '4:03', 'maghrib' => '5:43', 'isha' => '7:00' );
		}
	} elseif($month == 2) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '5:21', 'fajr' => '5:26', 'sunrise' => '6:39', 'duhr' => '12:16', 'asr' => '4:08', 'maghrib' => '5:48', 'isha' => '7:04' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '5:19', 'fajr' => '5:24', 'sunrise' => '6:37', 'duhr' => '12:16', 'asr' => '4:11', 'maghrib' => '5:51', 'isha' => '7:06' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '5:17', 'fajr' => '5:22', 'sunrise' => '6:34', 'duhr' => '12:16', 'asr' => '4:14', 'maghrib' => '5:54', 'isha' => '7:09' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '5:14', 'fajr' => '5:19', 'sunrise' => '6:31', 'duhr' => '12:16', 'asr' => '4:16', 'maghrib' => '5:57', 'isha' => '7:11' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '5:11', 'fajr' => '5:16', 'sunrise' => '6:28', 'duhr' => '12:16', 'asr' => '4:19', 'maghrib' => '6:00', 'isha' => '7:14' );
		} else {
			$time_schedule = array( 'sehri' => '5:07', 'fajr' => '5:12', 'sunrise' => '6:24', 'duhr' => '12:15', 'asr' => '4:21', 'maghrib' => '6:03', 'isha' => '7:17' );
		}
	} elseif($month == 3) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '5:04', 'fajr' => '5:09', 'sunrise' => '6:20', 'duhr' => '12:14', 'asr' => '4:22', 'maghrib' => '6:05', 'isha' => '7:18' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '5:01', 'fajr' => '5:06', 'sunrise' => '6:17', 'duhr' => '12:14', 'asr' => '4:24', 'maghrib' => '6:06', 'isha' => '7:19' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '4:56', 'fajr' => '5:01', 'sunrise' => '6:12', 'duhr' => '12:13', 'asr' => '4:25', 'maghrib' => '6:09', 'isha' => '7:22' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '4:51', 'fajr' => '4:56', 'sunrise' => '6:07', 'duhr' => '12:11', 'asr' => '4:26', 'maghrib' => '6:11', 'isha' => '7:24' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '4:46', 'fajr' => '4:51', 'sunrise' => '6:03', 'duhr' => '12:10', 'asr' => '4:27', 'maghrib' => '6:13', 'isha' => '7:26' );
		} else {
			$time_schedule = array( 'sehri' => '4:41', 'fajr' => '4:46', 'sunrise' => '5:57', 'duhr' => '12:08', 'asr' => '4:28', 'maghrib' => '6:15', 'isha' => '7:28' );
		}
	} elseif($month == 4) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '4:32', 'fajr' => '4:37', 'sunrise' => '5:50', 'duhr' => '12:06', 'asr' => '4:29', 'maghrib' => '6:18', 'isha' => '7:33' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '4:27', 'fajr' => '4:32', 'sunrise' => '5:46', 'duhr' => '12:05', 'asr' => '4:29', 'maghrib' => '6:20', 'isha' => '7:35' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '4:23', 'fajr' => '4:28', 'sunrise' => '5:41', 'duhr' => '12:03', 'asr' => '4:30', 'maghrib' => '6:22', 'isha' => '7:37' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '4:17', 'fajr' => '4:22', 'sunrise' => '5:37', 'duhr' => '12:02', 'asr' => '4:30', 'maghrib' => '6:24', 'isha' => '7:40' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '4:12', 'fajr' => '4:17', 'sunrise' => '5:33', 'duhr' => '12:01', 'asr' => '4:30', 'maghrib' => '6:26', 'isha' => '7:43' );
		} else {
			$time_schedule = array( 'sehri' => '4:08', 'fajr' => '4:13', 'sunrise' => '5:28', 'duhr' => '12:00', 'asr' => '4:31', 'maghrib' => '6:28', 'isha' => '7:47' );
		}
	} elseif($month == 5) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '4:02', 'fajr' => '4:07', 'sunrise' => '5:24', 'duhr' => '11:59', 'asr' => '4:31', 'maghrib' => '6:31', 'isha' => '7:50' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '3:57', 'fajr' => '4:02', 'sunrise' => '5:21', 'duhr' => '11:59', 'asr' => '4:31', 'maghrib' => '6:33', 'isha' => '7:53' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '3:53', 'fajr' => '3:58', 'sunrise' => '5:18', 'duhr' => '11:58', 'asr' => '4:32', 'maghrib' => '6:35', 'isha' => '7:57' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '3:50', 'fajr' => '3:55', 'sunrise' => '5:16', 'duhr' => '11:58', 'asr' => '4:32', 'maghrib' => '6:37', 'isha' => '8:00' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '3:47', 'fajr' => '3:52', 'sunrise' => '5:13', 'duhr' => '11:58', 'asr' => '4:33', 'maghrib' => '6:40', 'isha' => '8:03' );
		} else {
			$time_schedule = array( 'sehri' => '3:45', 'fajr' => '3:50', 'sunrise' => '5:12', 'duhr' => '11:59', 'asr' => '4:34', 'maghrib' => '6:42', 'isha' => '8:06' );
		}
	} elseif($month == 6) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '3:42', 'fajr' => '3:47', 'sunrise' => '5:10', 'duhr' => '12:00', 'asr' => '4:35', 'maghrib' => '6:46', 'isha' => '8:11' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '3:42', 'fajr' => '3:47', 'sunrise' => '5:10', 'duhr' => '12:00', 'asr' => '4:36', 'maghrib' => '6:47', 'isha' => '8:12' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '3:41', 'fajr' => '3:46', 'sunrise' => '5:10', 'duhr' => '12:01', 'asr' => '4:37', 'maghrib' => '6:49', 'isha' => '8:15' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '3:41', 'fajr' => '3:46', 'sunrise' => '5:10', 'duhr' => '12:02', 'asr' => '4:38', 'maghrib' => '6:51', 'isha' => '8:17' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '3:41', 'fajr' => '3:46', 'sunrise' => '5:11', 'duhr' => '12:03', 'asr' => '4:40', 'maghrib' => '6:52', 'isha' => '8:18' );
		} else {
			$time_schedule = array( 'sehri' => '3:42', 'fajr' => '3:47', 'sunrise' => '5:12', 'duhr' => '12:04', 'asr' => '4:41', 'maghrib' => '6:53', 'isha' => '8:20' );
		}
	} elseif($month == 7) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '3:45', 'fajr' => '3:50', 'sunrise' => '5:14', 'duhr' => '12:06', 'asr' => '4:42', 'maghrib' => '6:54', 'isha' => '8:20' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '3:47', 'fajr' => '3:52', 'sunrise' => '5:15', 'duhr' => '12:07', 'asr' => '4:42', 'maghrib' => '6:54', 'isha' => '8:20' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '3:49', 'fajr' => '3:54', 'sunrise' => '5:18', 'duhr' => '12:07', 'asr' => '4:43', 'maghrib' => '6:53', 'isha' => '8:18' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '3:52', 'fajr' => '3:57', 'sunrise' => '5:19', 'duhr' => '12:08', 'asr' => '4:43', 'maghrib' => '6:53', 'isha' => '8:17' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '3:55', 'fajr' => '4:00', 'sunrise' => '5:22', 'duhr' => '12:08', 'asr' => '4:43', 'maghrib' => '6:51', 'isha' => '8:14' );
		} else {
			$time_schedule = array( 'sehri' => '3:59', 'fajr' => '4:04', 'sunrise' => '5:24', 'duhr' => '12:08', 'asr' => '4:43', 'maghrib' => '6:49', 'isha' => '8:11' );
		}
	} elseif($month == 8) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '4:03', 'fajr' => '4:08', 'sunrise' => '5:27', 'duhr' => '12:08', 'asr' => '4:42', 'maghrib' => '6:45', 'isha' => '8:05' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '4:06', 'fajr' => '4:11', 'sunrise' => '5:29', 'duhr' => '12:08', 'asr' => '4:41', 'maghrib' => '6:42', 'isha' => '8:02' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '4:09', 'fajr' => '4:14', 'sunrise' => '5:31', 'duhr' => '12:07', 'asr' => '4:40', 'maghrib' => '6:39', 'isha' => '7:58' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '4:12', 'fajr' => '4:17', 'sunrise' => '5:33', 'duhr' => '12:06', 'asr' => '4:38', 'maghrib' => '6:35', 'isha' => '7:53' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '4:15', 'fajr' => '4:20', 'sunrise' => '5:35', 'duhr' => '12:05', 'asr' => '4:36', 'maghrib' => '6:31', 'isha' => '7:48' );
		} else {
			$time_schedule = array( 'sehri' => '4:18', 'fajr' => '4:23', 'sunrise' => '5:37', 'duhr' => '12:04', 'asr' => '4:33', 'maghrib' => '6:27', 'isha' => '7:43' );
		}
	} elseif($month == 9) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '4:21', 'fajr' => '4:26', 'sunrise' => '5:39', 'duhr' => '12:02', 'asr' => '4:29', 'maghrib' => '6:20', 'isha' => '7:35' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '4:23', 'fajr' => '4:28', 'sunrise' => '5:41', 'duhr' => '12:00', 'asr' => '4:26', 'maghrib' => '6:16', 'isha' => '7:31' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '4:25', 'fajr' => '4:30', 'sunrise' => '5:42', 'duhr' => '11:59', 'asr' => '4:23', 'maghrib' => '6:11', 'isha' => '7:25' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '4:27', 'fajr' => '4:32', 'sunrise' => '5:44', 'duhr' => '11:57', 'asr' => '4:19', 'maghrib' => '6:06', 'isha' => '7:20' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '4:30', 'fajr' => '4:35', 'sunrise' => '5:46', 'duhr' => '11:55', 'asr' => '4:15', 'maghrib' => '6:00', 'isha' => '7:14' );
		} else {
			$time_schedule = array( 'sehri' => '4:31', 'fajr' => '4:36', 'sunrise' => '5:47', 'duhr' => '11:53', 'asr' => '4:11', 'maghrib' => '5:56', 'isha' => '7:09' );
		}
	} elseif($month == 10) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '4:34', 'fajr' => '4:39', 'sunrise' => '5:49', 'duhr' => '11:51', 'asr' => '4:06', 'maghrib' => '5:49', 'isha' => '7:02' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '4:35', 'fajr' => '4:40', 'sunrise' => '5:51', 'duhr' => '11:50', 'asr' => '4:03', 'maghrib' => '5:45', 'isha' => '6:58' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '4:42', 'fajr' => '4:42', 'sunrise' => '5:53', 'duhr' => '11:49', 'asr' => '3:59', 'maghrib' => '5:41', 'isha' => '6:54' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '4:39', 'fajr' => '4:44', 'sunrise' => '5:56', 'duhr' => '11:48', 'asr' => '3:55', 'maghrib' => '5:36', 'isha' => '6:50' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '4:41', 'fajr' => '4:46', 'sunrise' => '5:58', 'duhr' => '11:47', 'asr' => '3:51', 'maghrib' => '5:32', 'isha' => '6:46' );
		} else {
			$time_schedule = array( 'sehri' => '4:43', 'fajr' => '4:48', 'sunrise' => '6:00', 'duhr' => '11:46', 'asr' => '3:48', 'maghrib' => '5:28', 'isha' => '6:42' );
		}
	} elseif($month == 11) {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '4:46', 'fajr' => '4:51', 'sunrise' => '6:04', 'duhr' => '11:45', 'asr' => '3:43', 'maghrib' => '5:23', 'isha' => '6:38' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '4:48', 'fajr' => '4:53', 'sunrise' => '6:06', 'duhr' => '11:45', 'asr' => '3:41', 'maghrib' => '5:21', 'isha' => '6:36' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '4:51', 'fajr' => '4:56', 'sunrise' => '6:10', 'duhr' => '11:46', 'asr' => '3:39', 'maghrib' => '5:18', 'isha' => '6:34' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '4:54', 'fajr' => '4:59', 'sunrise' => '6:13', 'duhr' => '11:47', 'asr' => '3:37', 'maghrib' => '5:16', 'isha' => '6:32' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '4:57', 'fajr' => '5:02', 'sunrise' => '6:16', 'duhr' => '11:47', 'asr' => '3:36', 'maghrib' => '5:15', 'isha' => '6:31' );
		} else {
			$time_schedule = array( 'sehri' => '5:00', 'fajr' => '5:05', 'sunrise' => '6:20', 'duhr' => '11:49', 'asr' => '3:35', 'maghrib' => '5:14', 'isha' => '6:31' );
		}
	} else {
		if($day_number < 5) {
			$time_schedule = array( 'sehri' => '5:03', 'fajr' => '5:10', 'sunrise' => '6:24', 'duhr' => '11:51', 'asr' => '3:35', 'maghrib' => '5:14', 'isha' => '6:32' );
		} elseif($day_number > 4 && $day_number < 10) {
			$time_schedule = array( 'sehri' => '5:06', 'fajr' => '5:10', 'sunrise' => '6:27', 'duhr' => '11:53', 'asr' => '3:35', 'maghrib' => '5:14', 'isha' => '6:33' );
		} elseif($day_number > 9 && $day_number < 15) {
			$time_schedule = array( 'sehri' => '5:09', 'fajr' => '5:10', 'sunrise' => '6:30', 'duhr' => '11:55', 'asr' => '3:36', 'maghrib' => '5:15', 'isha' => '6:34' );
		} elseif($day_number > 14 && $day_number < 20) {
			$time_schedule = array( 'sehri' => '5:12', 'fajr' => '5:10', 'sunrise' => '6:33', 'duhr' => '11:57', 'asr' => '3:38', 'maghrib' => '5:17', 'isha' => '6:36' );
		} elseif($day_number > 19 && $day_number < 25) {
			$time_schedule = array( 'sehri' => '5:14', 'fajr' => '5:11', 'sunrise' => '6:36', 'duhr' => '11:59', 'asr' => '3:40', 'maghrib' => '5:19', 'isha' => '6:38' );
		} else {
			$time_schedule = array( 'sehri' => '5:17', 'fajr' => '5:12', 'sunrise' => '6:38', 'duhr' => '12:02', 'asr' => '3:42', 'maghrib' => '5:22', 'isha' => '6:41' );
		}
	}
?>
<?php
	if($mptb_city == 'নেত্রকোনা' || $mptb_city == 'নরসিংদী' || $mptb_city == 'চাঁদপুর' || $mptb_city == 'ভোলা' || $mptb_city == 'কিশোরগঞ্জ') {$adjust_time = '-1 minutes';}
	elseif($mptb_city == 'লক্ষ্মীপুর') {$adjust_time = '-2 minutes';}
	elseif($mptb_city == 'ব্রাহ্মণবাড়িয়া' || $mptb_city == 'কুমিল্লা' || $mptb_city == 'নোয়াখালী') {$adjust_time = '-3 minutes';}
	elseif($mptb_city == 'সুনামগঞ্জ' || $mptb_city == 'হবিগঞ্জ' || $mptb_city == 'ফেনী') {$adjust_time = '-4 minutes';}
	elseif($mptb_city == 'মৌলভীবাজার' || $mptb_city == 'চট্টগ্রাম') {$adjust_time = '-5 minutes';}
	elseif($mptb_city == 'সিলেট' || $mptb_city == 'খাগড়াছড়ি' || $mptb_city == 'কক্সবাজার') {$adjust_time = '-6 minutes';}
	elseif($mptb_city == 'রাঙামাটি' || $mptb_city == 'বান্দরবান') {$adjust_time = '-7 minutes';}
	elseif($mptb_city == 'মাদারীপুর' || $mptb_city == 'ঝালকাঠি' || $mptb_city == 'বরগুনা') {$adjust_time = '+1 minutes';}
	elseif($mptb_city == 'শেরপুর' || $mptb_city == 'জামালপুর' || $mptb_city == 'টাঙ্গাইল' || $mptb_city == 'মানিকগঞ্জ' || $mptb_city == 'ফরিদপুর' || $mptb_city == 'গোপালগঞ্জ' || $mptb_city == 'পিরোজপুর') {$adjust_time = '+2 minutes';}
	elseif($mptb_city == 'কুড়িগ্রাম' || $mptb_city == 'সিরাজগঞ্জ' || $mptb_city == 'বাগেরহাট' || $mptb_city == 'রাজবাড়ী') {$adjust_time = '+3 minutes';}
	elseif($mptb_city == 'লালমনিরহাট' || $mptb_city == 'গাইবান্ধা' || $mptb_city == 'বগুড়া' || $mptb_city == 'মাগুরা' || $mptb_city == 'নড়াইল' || $mptb_city == 'খুলনা') {$adjust_time = '+4 minutes';}
	elseif($mptb_city == 'রংপুর' || $mptb_city == 'পাবনা' || $mptb_city == 'কুষ্টিয়া' || $mptb_city == 'ঝিনাইদহ' || $mptb_city == 'যশোর' || $mptb_city == 'সাতক্ষীরা') {$adjust_time = '+5 minutes';}
	elseif($mptb_city == 'নীলফামারী' || $mptb_city == 'জয়পুরহাট' || $mptb_city == 'নওগাঁ' || $mptb_city == 'নাটোর' || $mptb_city == 'চুয়াডাঙ্গা') {$adjust_time = '+6 minutes';}
	elseif($mptb_city == 'রাজশাহী' || $mptb_city == 'দিনাজপুর' || $mptb_city == 'মেহেরপুর' || $mptb_city == 'পঞ্চগড়') {$adjust_time = '+7 minutes';}
	elseif($mptb_city == 'ঠাকুরগাঁও' || $mptb_city == 'চাঁপাইনবাবগঞ্জ') {$adjust_time = '+8 minutes';}
	else {$adjust_time = '';}
?>
<div class="prayer-html-box" id="prayerDis">
	<script type="text/javascript">
		function prayerOnChange() {
			jQuery("#city_time").submit();
		}
	</script>
	<table width="100%" cellspacing="1" cellpadding="1">
		<tr>
			<td colspan="2"><form id="city_time" action="#prayerDis" method="post" name="city_time">
				<select id="cityname" name="cityname" class="district-box" onChange="prayerOnChange();">
					<option value="" selected="selected">
						<?php if($_POST['cityname']) { echo $_POST['cityname']; } else { echo $mptb_city; } ?>
					</option>
					<?php foreach($city_states as $city) { echo '<option value="'.$city.'">' . $city . '</option>'; } ?>
				</select>
				<input type="hidden" name="submit_city" value="Submit" />
			</form></td>
		</tr>
		<?php
			for($t4b = 0; $t4b < 7; $t4b++) {
				if($t4b == 0 && get_option('mptb_option') == Enabled) {
		?>
		<tr>
			<td colspan="2">
				<span class="prayer-name">
				<?php if($_POST['submit_city']) {
					if($_POST['cityname'] == 'নেত্রকোনা' || $_POST['cityname'] == 'নরসিংদী' || $_POST['cityname'] == 'চাঁদপুর' || $_POST['cityname'] == 'ভোলা' || $_POST['cityname'] == 'কিশোরগঞ্জ') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '-1 minutes'));
					} elseif($_POST['cityname'] == 'লক্ষ্মীপুর') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '-2 minutes'));
					} elseif($_POST['cityname'] == 'ব্রাহ্মণবাড়িয়া' || $_POST['cityname'] == 'কুমিল্লা' || $_POST['cityname'] == 'নোয়াখালী') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '-3 minutes'));
					} elseif($_POST['cityname'] == 'সুনামগঞ্জ' || $_POST['cityname'] == 'হবিগঞ্জ' || $_POST['cityname'] == 'ফেনী') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '-4 minutes'));
					} elseif($_POST['cityname'] == 'মৌলভীবাজার' || $_POST['cityname'] == 'চট্টগ্রাম') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '-5 minutes'));
					} elseif($_POST['cityname'] == 'সিলেট' || $_POST['cityname'] == 'খাগড়াছড়ি' || $_POST['cityname'] == 'কক্সবাজার') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '-6 minutes'));
					} elseif($_POST['cityname'] == 'রাঙামাটি' || $_POST['cityname'] == 'বান্দরবান') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '-7 minutes'));
					} elseif($_POST['cityname'] == 'মাদারীপুর' || $_POST['cityname'] == 'ঝালকাঠি' || $_POST['cityname'] == 'বরগুনা') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '+1 minutes'));
					} elseif($_POST['cityname'] == 'শেরপুর' || $_POST['cityname'] == 'জামালপুর' || $_POST['cityname'] == 'টাঙ্গাইল' || $_POST['cityname'] == 'মানিকগঞ্জ' || $_POST['cityname'] == 'ফরিদপুর' || $_POST['cityname'] == 'গোপালগঞ্জ' || $_POST['cityname'] == 'পিরোজপুর') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '+2 minutes'));
					} elseif($_POST['cityname'] == 'কুড়িগ্রাম' || $_POST['cityname'] == 'সিরাজগঞ্জ' || $_POST['cityname'] == 'বাগেরহাট' || $_POST['cityname'] == 'রাজবাড়ী') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '+3 minutes'));
					} elseif($_POST['cityname'] == 'লালমনিরহাট' || $_POST['cityname'] == 'গাইবান্ধা' || $_POST['cityname'] == 'বগুড়া' || $_POST['cityname'] == 'মাগুরা' || $_POST['cityname'] == 'নড়াইল' || $_POST['cityname'] == 'খুলনা') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '+4 minutes'));
					} elseif($_POST['cityname'] == 'রংপুর' || $_POST['cityname'] == 'পাবনা' || $_POST['cityname'] == 'কুষ্টিয়া' || $_POST['cityname'] == 'ঝিনাইদহ' || $_POST['cityname'] == 'যশোর' || $_POST['cityname'] == 'সাতক্ষীরা') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '+5 minutes'));
					} elseif($_POST['cityname'] == 'নীলফামারী' || $_POST['cityname'] == 'জয়পুরহাট' || $_POST['cityname'] == 'নওগাঁ' || $_POST['cityname'] == 'নাটোর' || $_POST['cityname'] == 'চুয়াডাঙ্গা') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '+6 minutes'));
					} elseif($_POST['cityname'] == 'রাজশাহী' || $_POST['cityname'] == 'দিনাজপুর' || $_POST['cityname'] == 'মেহেরপুর' || $_POST['cityname'] == 'পঞ্চগড়') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '+7 minutes'));
					} elseif($_POST['cityname'] == 'ঠাকুরগাঁও' || $_POST['cityname'] == 'চাঁপাইনবাবগঞ্জ') {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], '+8 minutes'));
					} else {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time($time_schedule['sehri']);
					}
				} else {
					if($adjust_time != ''){
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sehri'], $adjust_time));
					} else {
						echo 'সেহরীর শেষ সময় - ভোর ' . bn_prayer_time($time_schedule['sehri']);
					}
				}
				?>
				</span>
			</td>
		</tr>
		<?php } if($t4b != 0) { ?>
		<tr>
			<td><span class="prayer-name"><?php if($t4b == 1) { echo 'ফজর'; } ?><?php if($t4b == 2) { echo 'যোহর'; } ?><?php if($t4b == 3) { echo 'আছর'; } ?><?php if($t4b == 4) { echo 'মাগরিব'; } ?><?php if($t4b == 5) { echo 'এশা'; } ?><?php if($t4b == 6) { echo 'সূর্যোদয়'; } ?></span></td>
			<td><span class="prayer-time">
				<?php
				if($_POST['submit_city']) {
					if($_POST['cityname'] == 'নেত্রকোনা' || $_POST['cityname'] == 'নরসিংদী' || $_POST['cityname'] == 'চাঁদপুর' || $_POST['cityname'] == 'ভোলা' || $_POST['cityname'] == 'কিশোরগঞ্জ') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '-1 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '-1 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '-1 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '-1 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '-1 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '-1 minutes')); }
					} elseif($_POST['cityname'] == 'লক্ষ্মীপুর') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '-2 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '-2 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '-2 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '-2 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '-2 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '-2 minutes')); }
					} elseif($_POST['cityname'] == 'ব্রাহ্মণবাড়িয়া' || $_POST['cityname'] == 'কুমিল্লা' || $_POST['cityname'] == 'নোয়াখালী') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '-3 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '-3 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '-3 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '-3 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '-3 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '-3 minutes')); }
					} elseif($_POST['cityname'] == 'সুনামগঞ্জ' || $_POST['cityname'] == 'হবিগঞ্জ' || $_POST['cityname'] == 'ফেনী') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '-4 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '-4 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '-4 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '-4 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '-4 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '-4 minutes')); }
					} elseif($_POST['cityname'] == 'মৌলভীবাজার' || $_POST['cityname'] == 'চট্টগ্রাম') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '-5 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '-5 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '-5 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '-5 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '-5 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '-5 minutes')); }
					} elseif($_POST['cityname'] == 'সিলেট' || $_POST['cityname'] == 'খাগড়াছড়ি' || $_POST['cityname'] == 'কক্সবাজার') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '-6 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '-6 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '-6 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '-6 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '-6 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '-6 minutes')); }
					} elseif($_POST['cityname'] == 'রাঙামাটি' || $_POST['cityname'] == 'বান্দরবান') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '-7 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '-7 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '-7 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '-7 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '-7 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '-7 minutes')); }
					} elseif($_POST['cityname'] == 'মাদারীপুর' || $_POST['cityname'] == 'ঝালকাঠি' || $_POST['cityname'] == 'বরগুনা') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '+1 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '+1 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '+1 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '+1 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '+1 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '+1 minutes')); }
					} elseif($_POST['cityname'] == 'শেরপুর' || $_POST['cityname'] == 'জামালপুর' || $_POST['cityname'] == 'টাঙ্গাইল' || $_POST['cityname'] == 'মানিকগঞ্জ' || $_POST['cityname'] == 'ফরিদপুর' || $_POST['cityname'] == 'গোপালগঞ্জ' || $_POST['cityname'] == 'পিরোজপুর') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '+2 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '+2 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '+2 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '+2 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '+2 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '+2 minutes')); }
					} elseif($_POST['cityname'] == 'কুড়িগ্রাম' || $_POST['cityname'] == 'সিরাজগঞ্জ' || $_POST['cityname'] == 'বাগেরহাট' || $_POST['cityname'] == 'রাজবাড়ী') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '+3 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '+3 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '+3 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '+3 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '+3 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '+3 minutes')); }
					} elseif($_POST['cityname'] == 'লালমনিরহাট' || $_POST['cityname'] == 'গাইবান্ধা' || $_POST['cityname'] == 'বগুড়া' || $_POST['cityname'] == 'মাগুরা' || $_POST['cityname'] == 'নড়াইল' || $_POST['cityname'] == 'খুলনা') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '+4 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '+4 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '+4 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '+4 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '+4 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '+4 minutes')); }
					} elseif($_POST['cityname'] == 'রংপুর' || $_POST['cityname'] == 'পাবনা' || $_POST['cityname'] == 'কুষ্টিয়া' || $_POST['cityname'] == 'ঝিনাইদহ' || $_POST['cityname'] == 'যশোর' || $_POST['cityname'] == 'সাতক্ষীরা') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '+5 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '+5 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '+5 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '+5 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '+5 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '+5 minutes')); }
					} elseif($_POST['cityname'] == 'নীলফামারী' || $_POST['cityname'] == 'জয়পুরহাট' || $_POST['cityname'] == 'নওগাঁ' || $_POST['cityname'] == 'নাটোর' || $_POST['cityname'] == 'চুয়াডাঙ্গা') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '+6 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '+6 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '+6 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '+6 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '+6 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '+6 minutes')); }
					} elseif($_POST['cityname'] == 'রাজশাহী' || $_POST['cityname'] == 'দিনাজপুর' || $_POST['cityname'] == 'মেহেরপুর' || $_POST['cityname'] == 'পঞ্চগড়') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '+7 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '+7 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '+7 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '+7 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '+7 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '+7 minutes')); }
					} elseif($_POST['cityname'] == 'ঠাকুরগাঁও' || $_POST['cityname'] == 'চাঁপাইনবাবগঞ্জ') {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], '+8 minutes')); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], '+8 minutes')); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], '+8 minutes')); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], '+8 minutes')); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], '+8 minutes')); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], '+8 minutes')); }
					} else {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time($time_schedule['fajr']); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time($time_schedule['duhr']); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time($time_schedule['asr']); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time($time_schedule['maghrib']); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time($time_schedule['isha']); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time($time_schedule['sunrise']); }
					}
				} else {
					if($adjust_time != ''){
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['fajr'], $adjust_time)); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time(prayer_district_time($time_schedule['duhr'], $adjust_time)); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time(prayer_district_time($time_schedule['asr'], $adjust_time)); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time(prayer_district_time($time_schedule['maghrib'], $adjust_time)); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time(prayer_district_time($time_schedule['isha'], $adjust_time)); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time(prayer_district_time($time_schedule['sunrise'], $adjust_time)); }
					}
					else {
						if($t4b == 1) { echo 'ভোর ' . bn_prayer_time($time_schedule['fajr']); }
						if($t4b == 2) { echo 'দুপুর ' . bn_prayer_time($time_schedule['duhr']); }
						if($t4b == 3) { echo 'বিকাল ' . bn_prayer_time($time_schedule['asr']); }
						if($t4b == 4) { echo 'সন্ধ্যা ' . bn_prayer_time($time_schedule['maghrib']); }
						if($t4b == 5) { echo 'রাত ' . bn_prayer_time($time_schedule['isha']); }
						if($t4b == 6) { echo 'ভোর ' . bn_prayer_time($time_schedule['sunrise']); }
					}
				}
				?>
			</span></td>
		</tr>
		<?php } } ?>
	</table>
</div>
<?php
}

function widget_muslim_prayer_time($args) {
extract($args);
?>
<?php echo $before_widget; ?>
<?php echo $before_title . 'নামাযের সময়সূচী' . $after_title; ?>
<ul>
	<li><?php echo do_shortcode('[prayer_time]'); ?></li>
</ul>
<?php echo $after_widget; ?>
<?php
}

if(is_admin())
	include 'admin-settings.php';

wp_register_sidebar_widget('T4BMPT', 'T4B Muslim Prayer Time', 'widget_muslim_prayer_time');

add_shortcode('prayer_time', 'mptb_muslim_prayer_time');
?>