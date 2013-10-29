<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

/**
 * load the pear hook class, sets the include path to our
 * local copy of PEAR
 */
/*$hook['pre_controller'][] = array(
								  'class' => 'Pear_hook',
								  'function' => 'index',
								  'filename' => 'pear_hook.php',
								  'filepath' => 'hooks'
								  );*/ 
/**
 * Load our cookie detect hook, if cookies are not enabled we can't take payments
 */
/*$hook['post_controller_constructor'][] = array(
								  'class' => 'Location_manager',
								  'function' => 'set_location',
								  'filename' => 'location_manager.php',
								  'filepath' => 'hooks'
								  );*/