<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Clear Media Administration File
 *
 *  
 *
 * @package		ClearMedia
 * @author		Clear Media UK Ltd Dev Team
 * @copyright	Copyright (c) 2008 Clear Media UK Ltd.
 * @license		
 * @link		http://clearmediawebsites.co.uk
 * @since		Version 1.0
 * @filesource
 */
 
/**
 * get_week_start_date()
 *
 * returns the date of the start of the week
 *
 * @param string [$year] Which year
 * @param string [$week] Which week
 * @return string the start date of the week
 */
function get_week_start_date($year, $week)
{
	return date("Y-m-d", strtotime($year . 'W' . $week));
}

/**
 * get_week_end_date()
 *
 * returns the date of the end of the week
 *
 * @param string [$year] Which year
 * @param string [$week] Which week
 * @return string the end date of the week
 */
function get_week_end_date($year, $week)
{
	return date("Y-m-d", strtotime($year . 'W' . $week . "7"));
}

/**
 * get_week_num()
 *
 * @return string the current week number
 */
function get_week_num()
{
	return date("W");
}

/**
 * get_year()
 *
 * @return string the current year
 */
function get_year()
{
	return date("Y");
}

/**
 * date_diff()
 *
 * expects date params to be presented Y-m-d (e.g. 2008-08-31)
 *
 * @param string [$start_date] the date to start from
 * @param string [$end_date] the final date
 * @return string difference between two dates in days
 */
function date_diff($start_date, $end_date, $token = '-')
{
	$date_parts1 = explode($token, $start_date);
	$date_parts2 = explode($token, $end_date);
	
	if(function_exists('gregoriantojd')) {
		// gregoriantojd(m, d, y) = american style
		$start_date = gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
		$end_date = gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
		
		return $start_date - $end_date;
		
	} else {
		$start_date = mktime(0, 0, 0, $date_parts1[1], $date_parts1[2], $date_parts1[0]);
		$end_date = mktime(0, 0, 0, $date_parts2[1], $date_parts2[2], $date_parts2[0]);
		
		$difference = $start_date - $end_date;
		
		return floor($difference/(60*60*24));
	}
}

/**
 * time_diff()
 *
 * returns the time in seconds of the difference between the two times
 *
 * @param string [first_time] the time to start from
 * @param string [$last_time] the time to end with
 * @return int difference between two times in seconds
 */
function time_diff($first_time, $last_time)
{
	// convert to unix timestamps
	$first_time = strtotime($first_time);
	$last_time  = strtotime($last_time);

	// perform subtraction to get the difference (in seconds) between times
	$time_diff = $last_time - $first_time;

	// return the difference
	return $time_diff;
}

/**
 * add_subtract_days($date, $days)
 *
 * adds or subtracts days to or from a given date
 *
 * @param string [$date] the date to add or subtract from
 * @param int [$days] -ve / +ve integer of days
 * @return string [$new_date] the new calculated date
 */
function add_subtract_days($date, $days)
{
	// calculate hours
	$hours = $days * 24;
	
	$d = date('d', strtotime($date)); 
	$m = date('m', strtotime($date)); 
	$y = date('y', strtotime($date)); 
	
	// calculate the new date
	$new_date = date("Y-m-d", mktime($hours, 0, 0, $m, $d, $y));

	return $new_date;
}
