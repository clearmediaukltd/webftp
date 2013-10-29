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
 * User_model.php
 *
 * The model for managing users
 *
 * @package		Clear Media
 * @author		Clear Media UK Ltd Dev Team
 * @copyright	Copyright (c) 2009 Clear Media UK.
 * @license		http://clearmediawebsites.co.uk/licence
 * @link		http://clearmediawebsites.co.uk
 * @since		Version 1.0 
 */
class Users_model extends Model
{    
    protected $table_name = 'users';
    
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
        parent::Model();
        $this->load->library('auth');
        $this->load->helper('uniqueid_helper');
	}
    
    //----------------------------------------
    
	/**
     *  Gets all users from the database
     *
     * @param void
     * @return mixed object or false
     */
    public function get_all($limit = 100) 
    {
        $query = $this->db->get($this->table_name, $limit);
        
        return $query;
    }

    //-------------------------------------------- 

	/**
     * gets a user by id
     *
     * @param int
     * @return mixed object
     */
    public function get_by_id($id = -1) 
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table_name);
        
        return ($query->num_rows > 0) ? $query->row() : false;
    }

    //--------------------------------------------    

	/**
     * gets a user by their username
     *
     * @param string
     * @return mixed object
     */
    public function get_by_username($username = '') 
    {
        $this->db->where('username', $username);
        $query = $this->db->get($this->table_name);
        
        return ($query->num_rows > 0) ? $query->row() : false;
    }

    //--------------------------------------------        
    
	/**
     * Creates a user
     *
     * @param void
     * @return void
     */
    public function create() 
    {
        $folder_name = url_title($this->input->post('username'), 'underscore', true) . '_' . create_pass(13);                
        
        $result = @mkdir('./uploads/' . $folder_name, 0777);
        chmod('./uploads/' . $folder_name, 0777);
        chown('./uploads/' . $folder_name, 'neamtv');
        if( ! $result) {
            die('could not create folder: ./uploads/' . $folder_name);
        }
        
        
        $data = array(
                        'company_name' => $this->input->post('company_name'),
                        'username' => $this->input->post('username'),
                        'password' => md5($this->auth->salt . $this->input->post('password')),
                        'folder' => $folder_name,
                        'created' => date('Y-m-d h:i:s')
                     );
        
        $this->db->insert($this->table_name, $data);  
        
        return;
    }

    //--------------------------------------------    
    
	/**
     *
     *
     *
     */
    public function update() 
    {
        $company = $this->get_by_id($this->input->post('id'));
        $password = $company->password;
        
        if($this->input->post('password') != '******') {
            $password = md5($this->auth->salt . $this->input->post('password'));
        }
    
        $data = array(
                        'company_name' => $this->input->post('company_name'),
                        'username' => $this->input->post('username'),
                        'password' => $password
                     );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update($this->table_name, $data);  
        
        return;        
    }

    //--------------------------------------------    
    
	/**
     * deletes users
     *
     * @param int
     * @return void
     */
    public function delete($item = -1) 
    {
        $user = $this->get_by_id($item);
        $this->unlink_recursive('./uploads/' . $user->folder, true);
        
        
        $this->db->where('id', $item);
        $this->db->delete($this->table_name);
        
        return;
    }

    //--------------------------------------------    

    /**
     * Recursively delete a directory
     *
     * @param string $dir Directory name
     * @param boolean $deleteRootToo Delete specified top-level directory as well
     */
    public function unlink_recursive($dir = 'example', $delete_root = true)
    {
        if( ! $dh = @opendir($dir)) {
            return;
        }
        
        while (false !== ($obj = readdir($dh))) {
        
            if($obj == '.' || $obj == '..') {
                continue;
            }

            if ( ! @unlink($dir . '/' . $obj)) {
                $this->unlink_recursive($dir . '/' . $obj, true);
            }
            
        }

        closedir($dh);
       
        if ($delete_root) {
        
            @rmdir($dir);
            
        }
       
        return;
    } 

    //--------------------------------------------    
}