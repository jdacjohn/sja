<?php $pagetitle = "Register"; include 'core/base.php'; $div="register"; include $head;





echo '<hr><h1>'.$pagetitle.'</h1>';


if(!isset($_SESSION['user_id']))
{
//form processing
if (isset($_POST) && !empty($_POST['new_user_name_f']) && !empty($_POST['new_user_name_l']) && !empty($_POST['new_user_login']) && (strlen($_POST['new_user_login'])>4 || strlen($_POST['new_user_login'])<32) && !(preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['new_user_login'])) && (filter_var($_POST['new_user_email'], FILTER_VALIDATE_EMAIL)))
	{
	$new_user_login = mysql_real_escape_string($_POST['new_user_login']);
	$new_user_pass = substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
	$new_user_email = mysql_real_escape_string($_POST['new_user_email']);
	$new_user_name_f = mysql_real_escape_string($_POST['new_user_name_f']);
	$new_user_name_l = mysql_real_escape_string($_POST['new_user_name_l']);
	$new_user_email = mysql_real_escape_string($_POST['new_user_email']);
	$hash_new_user_pass = md5($new_user_pass);
	$query = mysql_query("INSERT INTO user (user_login, user_pass, user_email, user_ip, user_date, user_level, user_name_f, user_name_l)
	VALUES ('$new_user_login', '$hash_new_user_pass', '$new_user_email', '$_SERVER[REMOTE_ADDR]', NOW(), '1', '$new_user_name_f', '$new_user_name_l')");
	if(mysql_affected_rows($link)==1)
		{
		send_mail('admin@sja.us', $_POST['new_user_email'], 'St. Joseph Academy - Your New Password', 'Your username is: '.$new_user_login.' and your password is: '.$new_user_pass);
		echo '<p>Thank You. We sent you an email with your new password!</p>';
		}
	else
		{
		echo '<p>There was an error. <a href="/register">Please try again</a>.</p>';
		}
	}
else
	{
	?>
	<form method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data">
	
	<fieldset>
	    <legend<?= (isset($_POST['new_user_name_f']) && empty($_POST['new_user_name_f']) ? ' class="error"' : '') ?>>First Name:</legend>
		<ul><li><input type="text" name="new_user_name_f" value="<?php if(isset($_POST['new_user_name_f']) != ''){ echo $_POST['new_user_name_f']; } else {} ?>"></li></ul>
	</fieldset>
	
	<fieldset>
	    <legend<?= (isset($_POST['new_user_name_l']) && empty($_POST['new_user_name_l']) ? ' class="error"' : '') ?>>Last Name:</legend>
		<ul><li><input type="text" name="new_user_name_l" value="<?php if(isset($_POST['new_user_name_l']) != ''){ echo $_POST['new_user_name_l']; } else {} ?>"></li></ul>
	</fieldset>
	<fieldset>
	    <legend<?= (isset($_POST['new_user_login']) && (empty($_POST['new_user_login']) or (strlen($_POST['new_user_login'])<4 || strlen($_POST['new_user_login'])>32) or (preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['new_user_login']))) ? ' class="error"' : '') ?>>Create a Username:</legend>
		<ul><li><input type="text" name="new_user_login" id="new_user_login" onMouseOver="return check_user()" value="<?php if(isset($_POST['new_user_login']) != ''){ echo $_POST['new_user_login']; } else {} ?>"><div id="checkhint"></div></li>
		<?= (isset($_POST['new_user_login']) && (strlen($_POST['new_user_login'])<4 || strlen($_POST['new_user_login'])>32) ? '<li>Your username must be between 3 and 32 characters!</li>' : '') ?>
		<?= (isset($_POST['new_user_login']) && (preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['new_user_login'])) ? '<li>Your username contains invalid characters!</li>' : '') ?>
		</ul>
	</fieldset>
	<fieldset>
	    <legend<?= (isset($_POST['new_user_email']) && (!filter_var($_POST['new_user_email'], FILTER_VALIDATE_EMAIL)) ? ' class="error"' : '') ?>>Email Address:</legend>
		<ul><li><input type="text" name="new_user_email" id="new_user_email" onMouseOver="return check_email()" value="<?php if(isset($_POST['new_user_email']) != ''){ echo $_POST['new_user_email']; } else {} ?>"><div id="emailhint"></div></li>
		</ul>
	</fieldset>
	<fieldset>
		<legend></legend>
		<ul><li>&nbsp;</li><li><button type="submit" value="Send" name="submit">Register</button></li></ul>
	</fieldset>
					
	</form>
	<?php
	}
}

else
{
echo '<p>If you are not '; if($user_name_f!=''){echo $user_name_f;} else {echo $user_login;} echo '... Please <a href="/login/?logout">Log Out</a> before registering.</p>';
}





include $foot; ?>