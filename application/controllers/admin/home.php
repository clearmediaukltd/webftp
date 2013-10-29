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
        $this->load->model('users_model');

		//Password protect this controller		
		if($this->admin_auth->check() != 1) {
			redirect('admin/login');
			return;
		}			
	}
	
	//---------------------------------------
	
	/**
	 * index() loads the initial view
	 *
	 * @param void
	 * @return void
	 * @access public
	 */		
	public function index()
	{		
        $data['users'] = $this->users_model->get_all();
        $data['error'] = '';
        
		$this->load->view('admin/home', $data);
	}	

	//---------------------------------------
	
	/**
     * Adds a user
     *
     *
     */
    public function add_user() 
    {
        $user = $this->users_model->get_by_username($this->input->post('username'));
        
        if( ! $user) {
            $this->users_model->create();
            redirect('admin/home');
        } else {
            $data['users'] = $this->users_model->get_all();
            $data['error'] = 'This username already exists!';
        
            $this->load->view('admin/home', $data);            
        }
    }

    //--------------------------------------------   

	/**
     *
     *
     *
     */
    public function delete() 
    {   
        $this->users_model->delete($this->uri->segment(4));
        redirect('admin/home');
    }

    //--------------------------------------------  

	/**
     *
     *
     *
     */
    public function edit() 
    {
        $data['content'] = $this->users_model->get_by_id($this->uri->segment(4));
        $this->load->view('admin/edit_user', $data);
    }

    //--------------------------------------------

	/**
     *
     *
     *
     */
    public function update() 
    {
        $this->users_model->update();
        redirect('admin/home');
    }

    //--------------------------------------------    
}
