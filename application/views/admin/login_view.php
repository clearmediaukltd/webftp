<?=$this->load->view('admin/components/header');?>

<body>
<div id="logout">
	<?=anchor('login', 'login');?>
</div>
<div id="login_form">
	<?=form_open('admin/login/authenticate');?>
		<fieldset>
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" class="form" style="width:150px;" /><br />
			<label for="password">Password:</label>
			<input type="password" name="password" id="password"  class="form" style="width:150px;"/><br />
			<label for="submit">Submit:</label>
			<input type="submit" name="submit" id="submit" value="Login"  class="form"/><br />
		</fieldset>
	</form>
</div>
</body>
</html>
