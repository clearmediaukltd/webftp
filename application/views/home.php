<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB" lang="en-GB">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NetFTP</title>
<meta name="author" content="Clear Media UK Ltd http://clearmediawebsites.co.uk/" />
<link href="<?=base_url();?>assets/css/master.css" rel="stylesheet" type="text/css" media="screen" title="screen" />
<link href="<?=base_url();?>assets/css/library/print.css" rel="stylesheet" type="text/css" media="print" title="print" />
<link href="<?=base_url();?>assets/css/library/accessible.css" rel="alternate stylesheet" type="text/css" media="screen" title="accessible" />
<!--[if IE 7]>
<link href="<?=base_url();?>assets/css/custom/ie7.css" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 6]>
<link href="<?=base_url();?>assets/css/custom/ie6.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?=base_url();?>assets/js/supersleight.js"></script>
<![endif]-->
<link rel="shortcut icon" href="<?=base_url();?>favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="icon" href="<?=base_url();?>favicon.ico" type="image/vnd.microsoft.icon" />
<base href="<?=base_url();?>" />
</head>

<body>
<div id="content">    
    <div id="login_form">
        <div id="inner_forms"> 
            <img src="<?=base_url();?>assets/images/clear_media_logo.png" width="151px" height="35px" /><br /><br />
            <?=form_open('login/authenticate');?>
                <fieldset>
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" /><br />
                    
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" /><br />
                    
                    <label for="submit">Submit</label>
                    <input type="submit" name="submit" id="submit" value="login" /><br />   
                </fieldset>
            </form>
        </div>
    </div>
</div>
</body>
</html>