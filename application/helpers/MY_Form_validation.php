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
 * MY_Form_validation.php
 *
 * Simply extends the core Form_validation library to add the ability to validate
 * UK postcodes
 *
 * @package		ClearMedia
 * @author		Chris Cook
 * @copyright	Copyright (c) 2008, Chris Cook.
 * @since		Version 1.0
 */
class MY_Form_validation extends CI_Form_validation 
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
        parent::CI_Form_validation();		
    }
	
	/**
	 * Valid UK Postcode
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	    
    function uk_postcode($str)
    {        
        return ( ! ereg("^([A-PR-UWYZ0-9][A-HK-Y0-9][ABCDEFGHJKMNPRSTUWVXY0-9]?[ABEHMNPRVWXY0-9]? {1,2}[0-9][ABD-HJLN-UW-Z]{2}|GIR 0AA)$", $str)) ? FALSE : TRUE;
    }
    
	// --------------------------------------------------------------------    

	/**
	 * Alpha-numeric with underscores and dashes and spaces
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	    
    function alpha_dash_space($str)
    {
        echo 'here';
        return ( ! preg_match("/^([-a-z0-9_-\s])+$/i", $str)) ? FALSE : TRUE;
    }
    
	// --------------------------------------------------------------------    
}
