<?php
function strToLevel($str)
{
    if($str == 'student')
        return 'นิสิต';
    if($str == 'coop_student')
        return 'นิสิตสหกิจ';
    if($str == 'adviser')
        return 'อาจารย์';
    if($str == 'officer')
        return 'เจ้าหน้าที่';  
    if($str == 'company')
        return 'สถานประกอบการ';         
        
        
    return 'Unknown';
}

function thaiDate($strDate = '', $full_date = false, $show_time = true)
{
	if($strDate != '0000-00-00 00:00:00' && $strDate != ''){


		$timestamp = strtotime($strDate);
		$strYear = date("Y", $timestamp+543);
		$strMonth= date("n", $timestamp);
		$strDay= date("j", $timestamp);
		$strHour= date("H", $timestamp);
		$strMinute= date("i", $timestamp);
		$strSeconds= date("s", $timestamp);

		if(!$full_date) {
			
			$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ษ.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			$strMonthThai=$strMonthCut[$strMonth];
			
			if($show_time) {
				return "$strDay $strMonthThai $strYear $strHour:$strMinute น.";
			} else {
				return "$strDay $strMonthThai $strYear ";
			}
		} else {
			$strDayCut['Sun'] = 'อาทิตย์';
			$strDayCut['Mon'] = 'จันทร์';
			$strDayCut['Tue'] = 'อังคาร';
			$strDayCut['Wed'] = 'พุธ';
			$strDayCut['Thu'] = 'พฤหัส';
			$strDayCut['Fri'] = 'ศุกร์';
			$strDayCut['Sat'] = 'เสาร์';

			$strMonthCut = array('', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤษจิกายน', 'ธันวาคม');
		
			$strMonthThai=$strMonthCut[$strMonth];
			$strDayThai=$strDayCut[date("D",strtotime($strDate))];
			
			if($show_time) {
				return "วัน $strDayThai ที่ $strDay $strMonthThai พ.ศ. $strYear เวลา $strHour:$strMinute น.";
			} else {
				return "วัน $strDayThai ที่ $strDay $strMonthThai พ.ศ. $strYear";			
			}
			
		}
	}
	
	return ' - ';
}




function generateStrongPassword($length = 15, $add_dashes = false, $available_sets = 'luds')
{
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';
	if(strpos($available_sets, 's') !== false)
		$sets[] = '!@#$%&*?';
	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[tweak_array_rand(str_split($set))];
		$all .= $set;
	}
	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[tweak_array_rand($all)];
	$password = str_shuffle($password);
	if(!$add_dashes)
		return $password;
	$dash_len = floor(sqrt($length));
	$dash_str = '';
	while(strlen($password) > $dash_len)
	{
		$dash_str .= substr($password, 0, $dash_len) . '-';
		$password = substr($password, $dash_len);
	}
	$dash_str .= $password;
	return $dash_str;
}

function tweak_array_rand($array){
	if (function_exists('random_int')) {
		return random_int(0, count($array) - 1);
	} elseif(function_exists('mt_rand')) {
		return mt_rand(0, count($array) - 1);
	} else {
		return array_rand($array);
	}
}

function detect_gender_th($gender)
{
	if($gender == "นาย"){
		return "ชาย";
	}
	
	return "หญิง";
}

function detect_prefix_en($gender)
{
	if($gender == "นาง"){
		return "Mrs.";
	}
	if($gender == "นางสาว"){
		return "Ms.";
	}

	return "Mr.";

}

function get_age_from_birthday($birthday)
{
	$data = new Datetime($birthday);
	$now = new DateTime();
	$interval = $now->diff($data);
	return $interval->y;
}

function get_student_level_from_entry_year($Entry_Years) {
	return (date("Y")+543) - $Entry_Years;
}


function isEmptyText($str = null)
{
	if($str == '') {
		return " - ";
	}

	return $str;
}

function form_value_db($field_name, $data)
{
	return set_value($field_name) == false ? $data : set_value($field_name);
}

function replace_null_val($val)
{
	return str_replace("", " - ", $val);
}

function form_array_value($input_name)
{
	return $_POST[$input];
}
