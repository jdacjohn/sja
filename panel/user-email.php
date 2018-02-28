<?php $pagetitle = "Edit Name &amp; Email"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged();





		if(isset($_GET['edit']) && (isset($_POST['submit']) && !empty($_POST['user_name_f']) && !empty($_POST['user_name_l']) && (filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL))))
			{
			$user_email = htmlentities(($_POST['user_email']), ENT_QUOTES, 'utf-8');
			$user_name_f = htmlentities(($_POST['user_name_f']), ENT_QUOTES, 'utf-8');
			$user_name_l = htmlentities(($_POST['user_name_l']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE user SET user_email='$user_email', user_name_f='$user_name_f', user_name_l='$user_name_l' WHERE user_id='$user_id'");
			echo '<h1>'.$pagetitle.'</h1><hr><p>Successfully edited! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel>';
			}
		else
			{
			?>
			<hr>
			<h1><?php echo $pagetitle; ?></h1>
			<hr>
			<form method="post" action="?edit">
			<fieldset>
			    <legend>First Name:</legend>
			    <ul><li><input name="user_name_f" value="<?php echo $strip_user_name_f; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Last Name:</legend>
			    <ul><li><input name="user_name_l" value="<?php echo $strip_user_name_l; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>Email Address:</legend>
				<ul><li><input name="user_email" value="<?php echo $strip_user_email; ?>" type="text"></li>
				<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			</fieldset>
			</form>
<?php		}





include '../'.$foot; ?>