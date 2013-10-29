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
    <?=form_open('admin/home/add_user');?>
        <fieldset>        
            <label for="company_name">Company Name</label>
            <input type="text" name="company_name" id="company_name" /><br />
            
            <label for="username">Username</label>
            <input type="text" name="username" id="username" /><span class="error"><?=$error;?></span><br />      
            
            <label for="password">Password</label>
            <input type="text" name="password" id="password" /><br /> 

            <label for="Submit">Submit</label>
            <input type="submit" name="submit" id="submit" value="Add user" /><br />            
        </fieldset>
    </form>
</div>

<div id="data">
	<table>
		<tr><th>username</th><th>company name</th><th>folder</th><th>edit</th><th>delete</th></tr>	
        <?php foreach($users->result() as $row):?>
                <tr>
                    <td><?=html_decode($row->username);?></td>
                    <td><?=html_decode($row->company_name);?></td>							
                    <td><?=$row->folder;?></td>	
                    <td><?=anchor('admin/home/edit/'.$row->id, 'edit');?></td>				
                    <td><?=anchor('admin/home/delete/'.$row->id, 'delete', 'onclick="return confirmDel();"');?></td>
                </tr>			
        <?php endforeach;?>
	</table>    
</div>

</body>
</html>
