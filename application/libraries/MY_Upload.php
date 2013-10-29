<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * File Uploading Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Uploads
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/file_uploading.html
 */
class MY_Upload extends CI_Upload 
{

    /**
     * allows me to upload multiple files in one shot
     *
     * @param void
     * @return void
     */
    public function multi_upload($configs, $files)
    {

        if(count($configs) != count($files)) {
        
            return 'array_count_wrong';            
        }

        $errors = $successes = array();

        for($i = 0; $i < count($files); $i++) {
        
            $this->initialize($configs[$i]);

            if( ! $this->do_upload($files[$i])) {
            
                $errors[$files[$i]] = $this->display_errors();
                
            } else {
            
                $successes[$files[$i]] = $this->data();
                
            }
        }

        return array($errors, $successes);
    }
	
	//---------------------------------------    
		
	/**
	 * Verify that the filetype is allowed
	 *
	 * @access	public
	 * @return	bool
	 */	
	public function is_allowed_filetype()
	{
		return true;
	}
	
	//---------------------------------------

	/**
	 * Prep Filename
	 *
	 * Prevents possible script execution from Apache's handling of files multiple extensions
	 * http://httpd.apache.org/docs/1.3/mod/mod_mime.html#multipleext
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	function _prep_filename($filename)
	{
		if (strpos($filename, '.') === FALSE)
		{
			return $filename;
		}

		$parts		= explode('.', $filename);
		$ext		= array_pop($parts);
		$filename	= array_shift($parts);

		foreach ($parts as $part)
		{
			if ($this->mimes_types(strtolower($part)) === FALSE)
			{
				$filename .= '.'.$part.'_';
			}
			else
			{
				$filename .= '.'.$part;
			}
		}

		// file name override, since the exact name is provided, no need to
		// run it through a $this->mimes check.
		if ($this->file_name != '')
		{
			$filename = $this->file_name;
		}
        
        $filename = url_title($filename);

		$filename .= '.'.$ext;
		
		return $filename;
	}

	// --------------------------------------------------------------------    
    
}