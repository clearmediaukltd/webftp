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
 * html_decode() exactly the same as html_entity_decode()
 * only it's UTF-8 compliant
 *
 * @param string 
 * @return string
 */
function html_decode($string = '')
{
    return html_entity_decode($string, ENT_QUOTES, 'UTF-8');
}

/**
 * html_encode() exactly the same as htmlentities()
 * only it's UTF-8 compliant
 *
 * @param string 
 * @return string
 */
function html_encode($string = '')
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}