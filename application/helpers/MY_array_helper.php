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
 * array_to_object() does exactly what it says on the tin
 *
 * @param array 
 * @return object
 */
function array_to_object($array = array()) {

    if (!empty($array)) {
        $data = false;

        foreach ($array as $key => $val) {
            $data->{$key} = $val;
        }

        return $data;
    }

    return false;
}

/**
 * removes empty elements from an array
 * probably better to use array_filter() instead
 *
 * @param array 
 * @return array
 */
function array_trim($array) {

    foreach($array as $key) {
    
        if(empty($array[$key])) {
        
            unset($array[$key]);
            
        }
    }
    
    return $array;
}