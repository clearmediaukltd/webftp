<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Systemwide Email addresses 
 */
 $config['admin_email'] = 'chris@leadingedgehosting.co.uk';
 $config['support_email'] = 'chris@leadingedgehosting.co.uk';
 
/**
 * Login re-route
 * The controller that should be loaded after a successful login 
 */
$config['login_route_in'] = 'serve';
$config['login_route_out'] = 'login';
$config['admin_login_route_in'] = 'admin/home';
$config['admin_login_route_out'] = 'admin/login';

/**
 * Site Title
 * The controller that should be loaded after a successful login 
 */
$config['site_title'] = "NetFTP";

/**
 * Worldpay settings
 * Worldpay payments require an installation id / testmode
 */
$config['worldpay_installation'] = "";
$config['worldpay_mode'] = "100";
