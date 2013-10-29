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
class Auth 
{

	var $logged;
	var $CI;
	var $user_table = 'users';
	var $user_key = 'logged';
	var $salt = 'h832475hskdfn902j3';
	
	/**
	 * Checks if a user is logged in or not
	 *
	 * @access public
	 * @return true or false
	 */	
 	public function check()
	{
		$this->CI =& get_instance();		
		$this->logged = $this->CI->session->userdata($this->user_key);
		
		//At some stage might be useful to also check the username exists in
		//the database here too.
		
		if(!$this->logged) {
			return false;
		} else {
			return true;
		}
	}
    
    //-----------------------------
	
	/**
	 * Creates the database table for storing username(s) and passwords
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @return void
	 */
	public function create_database($table_name, $username = 'user') 
	{
		$this->CI =& get_instance();			
		
		$password = $this->create_pass();
		$md5_password = md5($this->salt . $password);
			
		$sql = "CREATE TABLE `$table_name` (
				`id` int( 7 ) NOT NULL AUTO_INCREMENT ,
				`username` varchar( 50 ) COLLATE utf8_general_ci NOT NULL default '',
				`password` varchar( 32 ) COLLATE utf8_general_ci NOT NULL default '',
				PRIMARY KEY ( `id` )
				) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT=0;";
		$this->CI->db->query($sql);				
				
		$sql = "INSERT INTO `$table_name` (`id`, `username`, `password`)
							VALUES (NULL , '$username', '$md5_password');";				
		$this->CI->db->query($sql);
		
		//This bit is a bit untidy...
		echo "Username: $username<br />";
		echo "Password: " . $password;
		exit();
	}
    
    //-----------------------------
	
	/**
	 * Logs a user in, also checks if appropriate authentication tables exist
	 * and if they don't creates them
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @param bool
	 * @return void
	 */
	public function login($username, $password, $md5 = false)
	{
		$this->CI =& get_instance();	        
		
		if($this->CI->db->table_exists($this->user_table) == false) {
			$this->create_database($this->user_table);
		}	       

        if($username != '' && $password != '') {
            $this->CI->db->where('username', $username);
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
	
	/**
	 * logs a user out
	 *
	 * @access public
	 * @param void
	 * @return void
	 */
	public function logout()
	{
		$this->CI =& get_instance();
		$this->CI->session->set_userdata($this->user_key, false);
		$this->CI->session->set_userdata(array('username' => ''));
		$this->CI->session->sess_destroy();
	}
    
    //-----------------------------
	
	/**
	 * Creates a random password
	 *
	 * @access private
	 * @return string
	 */
	private function create_pass() 
	{	
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
	
		while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}	
    
    //-----------------------------
    
}
