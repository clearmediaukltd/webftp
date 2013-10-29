<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Clear Media Administration File
 *
 * PHP 5
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
 * MY_Input.php
 *
 * Simply extends the core Input.php library adding the facility to
 * return the entire POST array
 *
 * @package		ClearMedia
 * @author		Chris Cook
 * @copyright	Copyright (c) 2008, Chris Cook.
 * @since		Version 1.0
 */
class MY_Input extends CI_Input 
{

	/**
	 * Ensures we inherit everything from the 
	 * base Input class
	 *
	 * @param void
	 * @return void
	 */
    public function __construct()
    {
        parent::CI_Input();		
    }
	
	/**
	 * Not sure how safe this is though...
	 *
	 * @param void
	 * @return array $_POST
	 */
	public function get_post_array()
	{
		return $_POST;
	}
}
