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
class Serve extends Controller
{    
    private $user;   // Stores the user details
    static private $user_folder;   // Stores the folder we are currently viewing
    private $current_folder;
    private $error;
    
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
        $this->load->library('upload');
        $this->load->helper('file');
        $this->load->helper('array');
        $this->load->helper('image');
        $this->load->library('form_validation');
        
        $this->user = $this->users_model->get_by_username($this->session->userdata('username'));
        $this->user_folder = $this->user->folder;
        
        $this->current_folder = $this->user_folder . $this->session->userdata('current_folder');
        
        if($this->auth->check() != 1) {
			redirect('login');
			return;            
        }
	}
    
    // ----------------------------------------
    
	/**
     * Loads the main file list window
     *
     * @param void
     * @return void
     */
    public function index() 
    {
        $display_folder = str_replace($this->user_folder, '', $this->current_folder);
        
        if($display_folder == '') {
            $display_folder = '/';
        }
        $data['display_folder'] = $display_folder;        
        
        $data['error'] = $this->error;
        $data['user_folder'] = $this->current_folder;
        $data['files'] = get_dir_info('./uploads/' . $this->current_folder . '/');
        $data['current_folder'] = $this->current_folder;
        
        $this->load->view('file_list', $data);
    }

    // --------------------------------------------

	/**
     * Uploads files
     *
     * @return void
     * @param void
     */
    public function upload() 
    {        
        $data['error'] = '';      
        
		$config['upload_path']      = './uploads/' . $this->current_folder . '/';
		$config['max_size']	        = '0';
		$config['max_width']        = '0';
		$config['max_height']       = '0';
        $this->upload->initialize($config);
	
		if ( ! $this->upload->do_upload())
		{
			$data['error'] = array('error' => $this->upload->display_errors());
            
            $this->error = $data['error'];
            redirect('serve');
		}	
		else
		{
			redirect('serve');
		}
    }

    // --------------------------------------------

	/**
     *
     *
     *
     */
    public function delete() 
    {
        $filename = '';
        $files = get_dir_info('./uploads/' . $this->current_folder . '/');
        
        foreach($files as $file) {
            if(url_title($file['name']) == $this->uri->segment(3)) {
                $filename = $file['name'];
            }
        }
        
        if( ! is_dir('./uploads/' . $this->current_folder . '/' . $filename)) {
            @unlink('./uploads/' . $this->current_folder . '/' . $filename);
        } else {
            delete_files('./uploads/' . $this->current_folder . '/' . $filename, true, 1);
        }
        
        redirect('serve');
    }

    // --------------------------------------------    
    
	/**
     * Creates sub-folders on the server
     *
     * @param void
     * @return void
     */
    public function create_folder() 
    {    
        $folder_name = 'new_folder';
        
        if($this->input->post('folder') != '') {
            $folder_name = trim($this->input->post('folder'));
        }        
        
        $this->form_validation->set_rules('folder', 'Folder', 'required|alpha_dash_space');
        
		if ($this->form_validation->run() == FALSE)
		{
            $data['error'] = 'Oops, you are only allowed to use alpha-numeric names with dashes or underscores for folder names!';
            $data['user_folder'] = $this->current_folder;
            $data['files'] = get_dir_info('./uploads/' . $this->current_folder . '/');
            $display_folder = str_replace($this->user_folder, '', $this->current_folder);
            
            if($display_folder == '') {
                $display_folder = '/';
            }
            $data['display_folder'] = $display_folder;              
            
            $this->load->view('file_list', $data);
            return;
		}             
        
        if( ! is_dir('./uploads/' . $this->current_folder . '/' . $folder_name)) {
            @mkdir('./uploads/' . $this->current_folder . '/' . $folder_name);
            chmod('./uploads/'. $this->current_folder . '/' .  $folder_name, 0777);
        }
        
        redirect('serve');
    }

    // --------------------------------------------   

	/**
     * Allows us to navigate up a directory tree toward the leaves
     *
     * @param void
     * @return void
     */
    public function select_child() 
    {        
        $new_folder = $this->session->userdata('current_folder') . '/' . $this->uri->segment(3);
        $this->session->set_userdata('current_folder', $new_folder);  
        redirect('serve');        
    }

    // -------------------------------------------- 

	/**
     * Allows us to navigate back down the directory tree towards the root
     *
     * @param void
     * @return void
     */
    public function select_parent() 
    {
        // Get the current folder
        $uri_array = explode('/', $this->session->userdata('current_folder'));
        
        // Remove any empty elements
        $uri_array = array_filter($uri_array);
        
        // Reduce the size of the array by one element
        array_pop($uri_array);
        
        // Create a URI string
        $uri_string = implode('/', $uri_array);        
        
        if(sizeof($uri_array) > 0) {
            if(substr($uri_string, 0, 1) != '/') {
                $uri_string = '/' . $uri_string;
            }
        }
        
        // Set the new URI
        $this->session->set_userdata('current_folder', $uri_string);  
        
        redirect('serve');
    }

    // -------------------------------------------- 

    /**
     * Gets files and forces downloads rather than views
     *
     * @param void
     * @return void
     */    
    public function get() 
    {
        $filename = '';
        $files = get_dir_info('./uploads/' . $this->current_folder . '/');
        
        foreach($files as $file) {
            if(url_title($file['name']) == $this->uri->segment(3)) {
                $filename = $file['name'];
            }
        }
        
        $file = './uploads/' . $this->current_folder . '/' . $filename;    
        header("Cache-Control: public, must-revalidate");
        header("Pragma: hack");
        header("Content-Type: application/octet-stream");
        header("Content-Length: " . (string)(filesize($file)) );
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header("Content-Transfer-Encoding: binary\n");

        $fp = fopen($file, 'rb');        
                      
        while(!feof($fp)){
            //reset time limit for big files
            set_time_limit(0);
            print(fread($fp,1024*8));
        }
        fclose($fp);      
    }    
    
    // --------------------------------------------   
    
}