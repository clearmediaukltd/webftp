<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
/**
 * CodeIgniter Unique ID Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Chris Cook
 * @link		http://www.codeigniter.com/user_guide/helpers/url_helper.html
 */
/**
 * Get image's pixel width
 * 
 * @access private
 * @param  string $upload_file path and name to file
 * @return mixed int number of pixels, if image; empty string, if not
 */
function get_image_width($image) 
{
    if(function_exists('getimagesize') && file_exists($image)) {
    
        $image_properties = @getimagesize($image);
        return $image_properties[0];
        
    } else {
    
        return 0;
        
    }
}

/**
 * Get image's pixel width
 * 
 * @access private
 * @param  string $upload_file path and name to file
 * @return mixed int number of pixels, if image; empty string, if not
 */
function get_image_height($image) 
{
    if(function_exists('getimagesize') && file_exists($image)) {
    
        $image_properties = @getimagesize($image); 
        return $image_properties[1];
        
    } else {
    
        return 0;
        
    }
}

/**
 * Validate the image
 *
 * @access	public
 * @return	bool
 */	
function check_is_image($filename)
{
    return in_array(pathinfo($filename, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif'));
}

// --------------------------------------------------------------------