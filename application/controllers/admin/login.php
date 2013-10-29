<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
 * Login
 *
 * This controller provides some basic functionality for the
 * Clear Media Administration systems
 *
 * @package		ClearMedia
 * @category	front-controller
 * @author		Clear Media UK Ltd Dev Team
 * @link		http://clearmediawebsites.co.uk
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

	//---------------------------------------	
	
	/**
	 * Simply loads the login view
	 *
	 * @access public
	 * @return void
	 */	
	public function index()
	{
		$data = array();
		
		if($this->config->item('site_title')) {
			$data['title'] = $this->config->item('site_title');
		}
		
		$this->load->view('admin/login_view', $data);
	}

	//---------------------------------------	
	
	/**
	 * authentication function, also if a user is authenticated
	 * it redirects them to the location specified in our custom_settings
	 * config file
	 *
	 * @access public
	 * @return void
	 */
	public function authenticate()
	{
		if($this->admin_auth->login($this->input->post('username'), $this->input->post('password'), true) == true) {
			$re_route = $this->config->item('admin_login_route_in');
			redirect($re_route);
		} else {
			$this->logout();	
		}
	}

	//---------------------------------------	
	
	/** 
	 * logout function, allows us to log users out
	 * by interfacing directly with the Auth.php Auth library
	 *
	 * @access public
	 * @return void
	 */
	public function logout()
	{
		$this->admin_auth->logout();
		
		$re_route = $this->config->item('admin_login_route_out');
		redirect($re_route);
	}

	//---------------------------------------	
}
