<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB" lang="en-GB">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$this->config->item('site_title');?></title>
<meta name="author" content="Clear Media UK Ltd" />
<link href="<?=base_url();?>assets/css/admin/screen.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
<link href="<?=base_url();?>assets/css/admin/screen_ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 6]>
<link href="<?=base_url();?>assets/css/admin/screen_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script type="text/javascript" src="<?=base_url();?>assets/js/helpers.js"></script>
<?=$this->load->view('admin/components/tiny_mce');?>
</head>