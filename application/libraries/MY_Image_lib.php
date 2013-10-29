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
 * MY_image_lib.php
 *
 * Trims an image then optionally adds padding around it.
 * $im  = Image link resource
 * $bg  = The background color to trim from the image
 * $pad = Amount of padding to add to the trimmed image
 *        (acts simlar to the "padding" CSS property: "top [right [bottom [left]]]")
 *
 * @package		ClearMedia
 * @author		Chris Cook
 * @copyright	Copyright (c) 2008, Chris Cook.
 * @since		Version 1.0
 */
class MY_Image_lib extends CI_Image_lib 
{

    public function __construct()
    {
        parent::CI_Image_lib();
    }

	//---------------------------------------    
 
 	/**
	 * Adds the correct amount of padding to the image
	 *
	 * use image_add_padding('image you want to pad', background colour (HEX CODE), dimensions each side should be padded by (string));
	 * 
	 * @access public
	 * @param string
	 * @param string
	 * @param string
	 */	
	public function image_add_padding($image, $bg, $pad=null)
	{
		//Create an image resource
		$image = imagecreatefromjpeg($image);
		
		// Calculate padding for each side.
		$pp = explode(' ', $pad);
		$p = array((int) $pp[0], (int) $pp[1], (int) $pp[2], (int) $pp[3]);
	
		//$imw = $this->getImageWidth($im);
		//$imh = $this->getImageHeight($im);
		// Get the image width and height.
		$image_width = imagesx($image);
		$image_height = imagesy($image);
	
		$new_image_width = $image_width + $p[1] + $p[3];
		$new_image_height = $image_height + $p[0] + $p[2];
	
		//This is needed to center the image in the new image
		$x_start_point = (($new_image_width - $image_width) / 2);
		$y_start_point = (($new_image_height - $image_height) / 2);
	
		// Make another image to place the trimmed version in.
		if (function_exists('imagecreatetruecolor')) {
 			$im2 = imagecreatetruecolor($new_image_width, $new_image_height);
		} else {
			$im2 = imagecreate($new_image_width, $new_image_height);		
		}
		
		$rgb_values = $this->hex_to_rgb($bg);	
		// Make the background of the new image the same as the background of the old one.
		$bg2 = imagecolorallocate($im2, $rgb_values['red'], $rgb_values['green'], $rgb_values['blue']);
		imagefill($im2, 0, 0, $bg2);
	
		// Copy it over to the new image.
		//imagecopy($im2, $image, $x_start_point, $y_start_point, 0, 0, $image_width, $image_height);
		imagecopyresampled($im2, $image, $x_start_point, $y_start_point, 0, 0, $image_width, $image_height, $image_width, $image_height);
	
		// To finish up, we replace the old image which is referenced.
		$image = $im2;
		return $image;
	}	

	//---------------------------------------    
	

	/**
	 * Converts a hex string to rgb colour code
	 * 
	 * @access public
	 * @param  string hex code
	 * @return array rgb colour codes
	 */	
	public function hex_to_rgb($hexstr) 
	{
    	$int = hexdec($hexstr);
    	return array("red" => 0xFF & ($int >> 0x10), "green" => 0xFF & ($int >> 0x8), "blue" => 0xFF & $int);
	}

	//---------------------------------------    

	/**
	 * Get image's pixel width
	 * 
	 * @access private
	 * @param  string $upload_file path and name to file
	 * @return mixed int number of pixels, if image; empty string, if not
	 */
	private function get_image_width($image) 
	{
		$image_properties = @getimagesize($image);
		return $image_properties[0];
	}

	//---------------------------------------    
	
	/**
	 * Get image's pixel width
	 * 
	 * @access private
	 * @param  string $upload_file path and name to file
	 * @return mixed int number of pixels, if image; empty string, if not
	 */
	private function get_image_height($image) 
	{
		$image_properties = @getimagesize($image);
		return $image_properties[1];
	}

	//---------------------------------------    
	
	/**
	 * Works out how much padding is required
	 * to make an image to the desired size
	 *
	 * @access public
	 * @param string
	 * @param int
	 * @param int
	 * @return string
	 */	
	public function get_required_padding($file, $desired_width, $desired_height)
	{
		//get the original sizes
		$orig_width = $this->get_image_width($file);
		$orig_height = $this->get_image_height($file);
		
		//Work out the difference between the desired size
		//and the actual size
		$padding_horizontal = $desired_width - $orig_width;
		$padding_vertical = $desired_height - $orig_height;
		
		//divide by two to get centered padding
		$top = $padding_vertical / 2;
		$right = $padding_horizontal / 2;
		$bottom = $padding_vertical /2;
		$left = $padding_horizontal / 2;
		
		//concatenate the string
		$padding_string = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
		return $padding_string;
	}

	//---------------------------------------

    /**
     * allows me to resize multiple files in one shot, you need to use the
     * "data" array returned by the upload library for $files, this is best
     * used in conjunction with the MY_upload class using the multi_upload() function
     *
     * @param array $files
     * @param int $width
     * @param int $height
     * @param string $prefix     
     * @return void
     */
    public function multi_resize($files = array(), $width = 0, $height = 0, $prefix = '')
    {
        $allowed_types = array('image/jpeg', 'image/gif', 'image/png');
        
        $config['image_library'] 	= 'gd2';
        $config['quality'] 			= 100;
        $config['master_dim'] 		= 'auto';
        $config['width']            = $width;
        $config['height']           = $height;
        $config['maintain_ratio'] 	= TRUE;

        $files = array_values($files);        

        for($i = 0; $i < count($files); $i++) {
        
            if(in_array($files[$i]['file_type'], $allowed_types)) {
                $config['source_image'] 	= './uploads/' . $files[$i]['file_name'];
                $config['new_image'] 		= './uploads/' . $prefix . $files[$i]['file_name'];    
                $this->initialize($config);
                $this->resize();
            } else {
                echo 'Not an allowed image type';
            }
        }
    }
	
	//---------------------------------------       
    

}
