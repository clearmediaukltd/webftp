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
class Admin_auth extends Auth
{

	var $user_table = 'admin_users';
	
	/**
	 * This is the name of the session variable used for the separate login systems
	 * it allows you to split the logins between admins and normal users
	 */
	var $user_key = 'admin_logged'; 

	/**
	 * Have to override from Auth.php to allow administrators to have different login functionality
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @param bool
	 * @return true
	 */
	public function login($username, $password, $md5 = false)
	{
		$this->CI =& get_instance();

		if($this->CI->db->table_exists($this->user_table) == false) {
			$this->create_database($this->user_table, 'admin');
		}			

        if($username != '' && $password != '') {
            $this->CI->db->where('email', $username);
            if($md5 == true) {
                $this->CI->db->where('password', md5($this->salt . $password));	
            } else {
                $this->CI->db->where('password', $password);	
            }
            $query = $this->CI->db->getwhere($this->user_table);
            
            if($query->num_rows() > 0) {		
                $this->CI->session->set_userdata($this->user_key, true);
                $this->CI->session->set_userdata(array('username' => $username));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
	}		
    
    //-----------------------------
    
}
