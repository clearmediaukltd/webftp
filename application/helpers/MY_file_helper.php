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
 * Get Filenames
 *
 * Reads the specified directory and builds an array containing the filenames.  
 * Any sub-folders contained within the specified path are read as well.
 *
 * @access	public
 * @param	string	path to source
 * @param	bool	whether to include the path as part of the filename
 * @return	array
 */	
function get_filenames($source_dir, $include_path = FALSE)
{
	$_filedata = array(); // amended by chris cook 22-12-07 removed static keyword to prevent all files being listed in multiple calls to this function
	
	if ($fp = @opendir($source_dir))
	{
		while (FALSE !== ($file = readdir($fp)))
		{
			if (@is_dir($source_dir.$file) && substr($file, 0, 1) != '.')
			{
				 get_filenames($source_dir.$file."/", $include_path);
			}
			elseif (substr($file, 0, 1) != ".")
			{
			
				$_filedata[] = ($include_path == TRUE) ? $source_dir.$file : $file;
			}
		}
		return $_filedata;
	}
}
// ------------------------------------------------------------------------

/**
 * Get Filenames
 *
 * Reads the specified directory and builds an array containing the filenames.  
 * Any sub-folders contained within the specified path are read as well.
 *
 * @access	public
 * @param	string	path to source
 * @param	bool	whether to include the path as part of the filename
 * @param 	type	the file type as identified by it's 3 letter ending
 * @return	array
 */	
function get_filenames_by_type($source_dir, $include_path = FALSE, $type)
{
	$_filedata = array(); // amended by chris cook 22-12-07 removed static keyword to prevent all files being listed in multiple calls to this function
	
	if ($fp = @opendir($source_dir))
	{
		while (FALSE !== ($file = readdir($fp)))
		{
			if (@is_dir($source_dir.$file) && substr($file, 0, 1) != '.')
			{
				 get_filenames($source_dir.$file."/", $include_path);
			}
			elseif (substr($file, 0, 1) != ".")
			{
				if(substr($file, -3) == $type) {
					$_filedata[] = ($include_path == TRUE) ? $source_dir.$file : $file;
				}
			}
		}
		return $_filedata;
	}
}

// --------------------------------------------------------------------

/**
 * Get Directory Information
 *
 * Reads the specified directory and builds an array containing the filenames,  
 * filesize, dates, and permissions
 *
 * Any folders contained within the specified path are read as well.
 *
 * @access	public
 * @param	string	path to source
 * @param	bool	whether to include the path as part of the filename
 * @param	bool	internal variable to determine recursion status - do not use in calls
 * @return	array
 */	
if ( ! function_exists('get_dir_info'))
{
	function get_dir_info($source_dir, $include_path = FALSE, $_recursion = FALSE)
	{
		$_filedata = array();
		$relative_path = $source_dir;

		if ($fp = @opendir($source_dir))
		{
			// reset the array and make sure $source_dir has a trailing slash on the initial call
			if ($_recursion === FALSE)
			{
				$_filedata = array();
				$source_dir = rtrim(realpath($source_dir), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
			}

			while (FALSE !== ($file = readdir($fp)))
			{
                if ($file != "." && $file != "..") {
					$_filedata[$file] = get_file_info($source_dir.$file);
					$_filedata[$file]['relative_path'] = $relative_path;
                }            
			}
			return $_filedata;
		}
		else
		{
			return FALSE;
		}
	}
}

// --------------------------------------------------------------------

/**
 * Gets file icons
 *
 * Given a file extn, this function does a simple lookup and returns
 * a file name.
 *
 * @access	public
 * @param	string	file extn
 * @return	string
 */	
function get_file_icon($ext = '')
{   
    $icon = '';
    $ext = strtolower($ext);
    
    if( ! is_string($ext)) {
        $ext = 'default';
    }   
    
    $icons = array
                    (
                        'doc' => 'page_word.png',
                        'pdf' => 'page_white_acrobat.png',
                        'xls' => 'page_excel.png',
                        'odt' => 'doc.png',
                        'xslx' => 'page_excel.png',
                        'docx' => 'page_word.png',
                        'doc' => 'page_word.png',
                        'rtf' => 'page_word.png',
                        'exe' => 'application_xp.png',
                        'folder' => 'folder.png',
                        'default' => 'page_white.png',
                        'zip' => 'page_white_compressed.png',
                        'ini' => 'page_white_edit.png',
                        'jpg' => 'images.png',
                        'jpeg' => 'images.png',
                        'gif' => 'images.png',
                        'png' => 'images.png',
                        'bmp' => 'images.png',
                        'mp3' => 'ipod.png',
                        'avi' => 'film.png',
                        'mpg' => 'film.png',
                        'mpeg' => 'film.png',
                        'mov' => 'film.png',
                        'wmv' => 'film.png',
                        'psd' => 'adobe_photoshop.png',
                        'ai' => 'adobe_illustrator.png',
                        'fla' => 'adobe_flash.png',
                        'swf' => 'adobe_flash.png',
                        'php' => 'adobe_dreamweaver.png',
                        'html' => 'adobe_dreamweaver.png',
                        'htm' => 'adobe_dreamweaver.png',
                        'js' => 'adobe_dreamweaver.png', 
                        'indd' => 'adobe_indesign.png',                        
                    );

    if(array_key_exists($ext, $icons)) {
        $icon = $icons[$ext];
    } else {
        $icon = $icons['default'];
    }
    

    return $icon;
}

// --------------------------------------------------------------------

/**
 * Gets file icons
 *
 * Given a file extn, this function does a simple lookup and returns
 * a file name.
 *
 * @access	public
 * @param	string	file extn
 * @return	string
 */	
function get_file_extension($filename = '')
{
    $file_details = pathinfo(strtolower($filename));       
    return (isset($file_details['extension'])) ? $file_details['extension'] : false;
}

// --------------------------------------------------------------------

/**
* Get File Info
*
* Given a file and path, returns the name, path, size, date modified
* Second parameter allows you to explicitly declare what information you want returned
* Options are: name, server_path, size, date, readable, writable, executable, fileperms
* Returns FALSE if the file cannot be found.
*
* @access	public
* @param	string	path to file
* @param	mixed	array or comma separated string of information returned
* @return	array
*/
function get_file_info($file, $returned_values = array('name', 'server_path', 'size', 'date', 'extension'))
{

    if ( ! file_exists($file))
    {
        return FALSE;
    }

    if (is_string($returned_values))
    {
        $returned_values = explode(',', $returned_values);
    }

    foreach ($returned_values as $key)
    {
        switch ($key)
        {
            case 'name':
                $fileinfo['name'] = substr(strrchr($file, DIRECTORY_SEPARATOR), 1);
                break;
            case 'server_path':
                $fileinfo['server_path'] = $file;
                break;
            case 'size':
                $fileinfo['size'] = filesize($file);
                break;
            case 'date':
                $fileinfo['date'] = filectime($file);
                break;
            case 'readable':
                $fileinfo['readable'] = is_readable($file);
                break;
            case 'writable':
                // There are known problems using is_weritable on IIS.  It may not be reliable - consider fileperms()
                $fileinfo['writable'] = is_writable($file);
                break;
            case 'executable':
                $fileinfo['executable'] = is_executable($file);
                break;
            case 'fileperms':
                $fileinfo['fileperms'] = fileperms($file);
                break;
            case 'extension':
                $fileinfo['extension'] = get_file_extension($file);
                break;
        }
    }

    return $fileinfo;
}

// --------------------------------------------------------------------

/**
 * Return human readable sizes
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.3.0
 * @link        http://aidanlister.com/repos/v/function.size_readable.php
 * @param       int     $size        size in bytes
 * @param       string  $max         maximum unit
 * @param       string  $system      'si' for SI, 'bi' for binary prefixes
 * @param       string  $retstring   return string format
 */
function size_readable($size, $max = null, $system = 'si', $retstring = '%01.2f %s')
{
    // Pick units
    $systems['si']['prefix'] = array('B', 'K', 'MB', 'GB', 'TB', 'PB');
    $systems['si']['size']   = 1000;
    $systems['bi']['prefix'] = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
    $systems['bi']['size']   = 1024;
    $sys = isset($systems[$system]) ? $systems[$system] : $systems['si'];

    // Max unit to display
    $depth = count($sys['prefix']) - 1;
    if ($max && false !== $d = array_search($max, $sys['prefix'])) {
        $depth = $d;
    }

    // Loop
    $i = 0;
    while ($size >= $sys['size'] && $i < $depth) {
        $size /= $sys['size'];
        $i++;
    }

    return sprintf($retstring, $size, $sys['prefix'][$i]);
}