<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Web based FTP software
 *
 *
 * PHP versions 5
 *
 * @package		Clear Media
 * @author		Clear Media UK Ltd Dev Team
 * @copyright	Copyright (c) 2009 Clear Media UK.
 * @license		http://clearmediawebsites.co.uk/licence
 * @link		http://clearmediawebsites.co.uk
 * @since		Version 1.0
 * @filesource
 */
/**
 * Home.php
 *
 * The controller for the front end home page
 *
 * @package		Clear Media
 * @author		Clear Media UK Ltd Dev Team
 * @copyright	Copyright (c) 2009 Clear Media UK.
 * @license		http://clearmediawebsites.co.uk/licence
 * @link		http://clearmediawebsites.co.uk
 * @since		Version 1.0 
 */
class Home extends Controller
{    
	/**
	 * Constructor, ensures we inherit from
	 * base Controller object
	 *
	 * @param void
	 * @return void
	 * @access public
	 */	
	public function __construct()
	{
        parent::Controller();
	}
    
    //----------------------------------------
    
	/**
     *
     *
     *
     */
    public function index() 
    {
        $this->load->view('home');
    }

    //--------------------------------------------    
    
}