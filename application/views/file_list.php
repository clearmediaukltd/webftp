<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB" lang="en-GB">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NetFTP</title>
<meta name="author" content="Clear Media UK Ltd http://clearmediawebsites.co.uk/" />
<link href="<?=base_url();?>assets/css/master.css" rel="stylesheet" type="text/css" media="screen" title="screen" />
<link href="<?=base_url();?>assets/css/library/print.css" rel="stylesheet" type="text/css" media="print" title="print" />
<link href="<?=base_url();?>assets/css/library/accessible.css" rel="alternate stylesheet" type="text/css" media="screen" title="accessible" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/library/jquery.fancybox.css" type="text/css" media="screen">
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
<script type="text/javascript" src="<?=base_url();?>assets/js/helpers.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-1.3.2.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.fancybox-1.2.1.pack.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
<!--
    $(document).ready(function() { 
        $("a.lightbox").fancybox({ 'zoomSpeedIn': 300, 'zoomSpeedOut': 300, 'overlayShow': true });     
    }); 
    
    /**
     * filters a string for characters we don't want
     *
     * @param void
     * @return void
     */
    function string_filter(input) {
        var filtered_values = "&£$%^*()!,./;:'#[]\\/=+@#<>?{}|`¬\"~";     // Characters stripped out        
        var return_string = "";
        
        for (var i = 0; i < input.length; i++) {  // Search through string and append to unfiltered values to returnString.
        
            var c = input.charAt(i);
            
            if (filtered_values.indexOf(c) == -1) {
                return_string += c;
            }
            
        }
        
        return return_string;
    }
    
    // -------------------------

    /**
     * Converts a string to a url safe string
     *
     * @param string
     * @return string
     */    
    function urlize(string) {
    
        // string = string.split(' ').join('');
        string = ltrim(string);
        // string = string.toLowerCase();
        string = string_filter(string);
        // string = escape(string); 
        
        return string;
    } 
      
-->
</script>
</head>

<body>
<div id="header">
    <img src="<?=base_url();?>assets/images/clear_media_logo.png" width="151px" height="35px" class="logo" />
    <strong>Logged in as: <?=$this->session->userdata('username');?>&nbsp;|&nbsp;<?=anchor('login/logout', 'Log Out');?></strong>
</div>
<div id="bottom_header"></div>
   
<div id="content">
    <?=$error;?>
    
    <div id="forms">
        <div id="inner_forms">
            <?=form_open_multipart('serve/upload', array('id' => 'uploader'));?>
                <label for="file">Upload File:<br />1.5GB Max&nbsp;</label>
                <input type="file" name="userfile" id="file" /><br />
                
                <label for="submit"></label>
                <input type="submit" name="submit" id="submit" value="Upload" onclick="document.getElementById('indicator').style.display = 'inline'" /><img src="<?=base_url();?>assets/images/ajax-loader-bar.gif" width="220px" height="19px" style="display:none;" id="indicator" /><br />                      
            </form>
            
            <?=form_open('serve/create_folder');?>
                <label for="folder">Create Folder:</label>
                <input type="text" name="folder" id="folder" onkeyup="this.value = urlize(this.value);" /><br />
                
                <label for="submit"></label>
                <input type="submit" name="submit" id="submit" value="Create Folder" /><br />
            </form>
        </div>
    </div>
    
    <table border="0" cellspacing="0" cellpadding="0" style="width:100%;" class="tableBorder">
        <tr>
            <td class="tableHeading">&nbsp;</td>
            <td class="tableHeading">&nbsp;</td>
            <td class="tableHeading">File Name (click to download)</td>
            <td class="tableHeading">File Size</td>
            <td class="tableHeading">Date Uploaded</td>
            <td class="tableHeading">Delete</td>
        </tr>
        <tr>
            <td colspan="6" class="tableCellTwo">Current Folder: <?=$display_folder;?></td>
        </tr>        
        <tr>
            <td class="tableCellOne">&nbsp;</td>
            <td class="tableCellOne"><img src="<?=base_url();?>assets/images/icons/arrow_rotate_clockwise.png"> </td>                                      
            <td class="tableCellOne"><?=anchor('serve/select_parent/', '..');?></td>
            <td class="tableCellOne"></td>
            <td class="tableCellOne"></td>
            <td class="tableCellOne"></td>                
        </tr>
        <?php $count = 1;?>
        <?php foreach($files as $individual_file):?>
            <?php if($count%2 == 0):?>
                <tr>                            
                    <td class="tableCellOne"><?=$count;?></td>
                    <td class="tableCellOne">
                        <?php if( ! is_dir('./uploads/' . $user_folder . '/' . $individual_file['name'])):?>
                            <img src="<?=base_url();?>assets/images/icons/<?=get_file_icon($individual_file['extension']);?>">
                            <td class="tableCellOne">
                                <?=anchor('serve/get/' . url_title($individual_file['name']), $individual_file['name']);?>
                                <?php if(check_is_image('./uploads/' . $current_folder . '/' . $individual_file['name'])):?>
                                    <?=anchor('serve/get/' . url_title($individual_file['name']), '(view)', array('class' => 'lightbox'));?>
                                <?php endif;?>                                
                            </td>
                        <?php else:?>                                
                            <?php if($individual_file['name'] == '..'):?>
                                <img src="<?=base_url();?>assets/images/icons/<?=get_file_icon('folder');?>">
                                <td class="tableCellOne"><?=anchor('serve/select_parent/', $individual_file['name']);?></td>                                        
                            <?php else:?>
                                <img src="<?=base_url();?>assets/images/icons/<?=get_file_icon('folder');?>">
                                <td class="tableCellOne"><?=anchor('serve/select_child/' . $individual_file['name'], $individual_file['name']);?></td>
                            <?php endif;?>
                        <?php endif;?>
                    </td>                            
                    <td class="tableCellOne"><?=size_readable($individual_file['size'])?></td>
                    <td class="tableCellOne"><?=date('d-m-Y H:i:s', $individual_file['date']);?></td>
                    <td class="tableCellOne"><?=anchor('serve/delete/' . url_title($individual_file['name']), 'delete', array('onclick' => 'return confirm_del();'));?></td>
                </tr>
            <?php else:?>
                <tr>
                    <td class="tableCellTwo"><?=$count;?></td>
                    <td class="tableCellTwo">
                        <?php if( ! is_dir('./uploads/' . $user_folder . '/' . $individual_file['name'])):?>
                            <img src="<?=base_url();?>assets/images/icons/<?=get_file_icon($individual_file['extension']);?>">
                            <td class="tableCellTwo">
                                <?=anchor('serve/get/' . url_title($individual_file['name']), $individual_file['name']);?>&nbsp;
                                <?php if(check_is_image('./uploads/' . $current_folder . '/' . $individual_file['name'])):?>
                                    <?=anchor('serve/get/' . url_title($individual_file['name']), '(view)', array('class' => 'lightbox'));?>
                                <?php endif;?>
                            </td>
                        <?php else:?>
                            <?php if($individual_file['name'] == '..'):?>
                                <img src="<?=base_url();?>assets/images/icons/<?=get_file_icon('folder');?>">
                                <td class="tableCellTwo"><?=anchor('serve/select_parent/', $individual_file['name']);?></td>                                        
                            <?php else:?>
                                <img src="<?=base_url();?>assets/images/icons/<?=get_file_icon('folder');?>">
                                <td class="tableCellTwo"><?=anchor('serve/select_child/' . $individual_file['name'], $individual_file['name']);?></td>
                            <?php endif;?>
                        <?php endif;?>
                    </td> 
                    <td class="tableCellTwo"><?=size_readable($individual_file['size'])?></td>
                    <td class="tableCellTwo"><?=date('d-m-Y H:i:s', $individual_file['date']);?></td>
                    <td class="tableCellTwo"><?=anchor('serve/delete/' . url_title($individual_file['name']), 'delete', array('onclick' => 'return confirm_del();'));?></td>
                </tr>                    
            <?php endif;?>
            <?php $count++;?>
        <?php endforeach;?>            
    </table>
</div>
</body>
</html>