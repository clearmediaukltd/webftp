<?=$this->load->view('admin/components/header');?>

<body>
<div id="logout">
	<?=anchor('admin/login/logout/', 'logout');?>
</div>

<h1>Manage Users</h1>

<div id="links">
	<?=$this->load->view('admin/components/main_nav'); ?>
</div>

<div id="form_controls">
    <?=form_open('admin/home/update');?>
        <fieldset>
            <input type="hidden" name="id" id="id" value="<?=$content->id;?>" />
            <label for="company_name">Company Name</label>
            <input type="text" name="company_name" id="company_name" value="<?=$content->company_name;?>" /><br />
            
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?=$content->username;?>" /><br />      
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="******" /><br /> 

            <label for="Submit">Submit</label>
            <input type="submit" name="submit" id="submit" value="Update user" /><br />            
        </fieldset>
    </form>
</div>

</body>
</html>
