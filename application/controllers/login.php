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
 * Login.php
 *
 * This controller provides access to the login functionality and 
 * lets us log users in / out
 *
 * @package		Clear Media
 * @author		Clear Media UK Ltd Dev Team
 * @copyright	Copyright (c) 2009 Clear Media UK.
 * @license		http://clearmediawebsites.co.uk/licence
 * @link		http://clearmediawebsites.co.uk
 * @since		Version 1.0 
 */
class Login extends Controller
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
     * Loads the inital login view page
     *
     * @param void
     * @return void
     */    
	public function index()
	{
		$this->load->view('home');
	}

    //----------------------------------------    
	
    /**
     * Loads the inital view file
     *
     * @param void
     * @return void
     */    
	public function authenticate()
	{
		$username = $this->input->post('username');
		        
        if($this->auth->login($username, $this->input->post('password'), true) == true) {

            redirect($this->config->item('login_route_in'));
            
        } else {
        
            $this->logout();
            
        }
            
	}

    //----------------------------------------    
	
    /**
     * Logs a user out
     *
     * @param void
     * @return void
     */    
	public function logout()
	{
		$this->auth->logout();
		redirect($this->config->item('login_route_out'));
	}    

    //----------------------------------------
    
}