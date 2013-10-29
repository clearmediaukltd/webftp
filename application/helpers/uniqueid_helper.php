<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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
 * Unique ID Helper
 *
 * This function creates unique ids.
 *
 * @access	public
 * @return	string
 */	
function unique_id() 
{ 
	// explode the IP of the remote client into four parts 
	$ipbits = explode(".", $_SERVER["REMOTE_ADDR"]);
	 
	// Get both seconds and microseconds parts of the time 
	list($usec, $sec) = explode(" ", microtime()); 
	
	// Fudge the time we just got to create two 16 bit words 
	$usec = (integer) ($usec * 65536); 
	$sec = ((integer) $sec) & 0xFFFF; 
	
	// Fun bit - convert the remote client's IP into a 32 bit 
	// hex number then tag on the time. Result of this operation looks like this xxxxxxxx-xxxx-xxxx 
	$uid = sprintf("%08x-%04x-%04x",($ipbits[0] << 24) | ($ipbits[1] << 16) | ($ipbits[2] << 8) | $ipbits[3], $sec, $usec); 
	
	return substr($uid, 9, 9); 
} 

/**
 * a function design to generate random numbers of a given length
 *
 * @param integer $length the length
 * @return integer $random_number 
 */
function rand_number_gen($length = 13)
{
	$random_number = "";
	
	for($k = 0; $k < $length; $k++) {
		$random_number .= chr(mt_rand(48, 57));
	}
	
	return $random_number;
}

/**
 * Creates a random password
 *
 * @access private
 * @return string
 */
function create_pass($length = 8) 
{	
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

    while ($i <= $length - 1) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    
    // Little fix because historically Modernbill didn't like 
    // passwords that started with a number???
    if(is_numeric(substr($pass, 0, 1))) {
        return create_pass();
    }
    
    return $pass;
}