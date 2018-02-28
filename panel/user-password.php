<?php $pagetitle = "Edit Password"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged();






		if(isset($_GET['edit']) && isset($_POST['submit']) && !empty($_POST['old_user_pass']) && !empty($_POST['new_user_pass']))
			{
				$old_user_pass = $user_pass;
				if (md5($_POST['old_user_pass']) == $old_user_pass)
					{
					$result = mysql_query("UPDATE user SET `user_pass`='".md5($_POST['new_user_pass'])."' WHERE $user_id=user_id");
					echo '<hr><h1>'.$pagetitle.'</h1><hr>';
					echo ' <p>Your password was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel>';
					}
				else
					{ ?>
					<hr><h1><?php echo $pagetitle; ?></h1><hr>
					<form method="post" action="?edit">
					<h5 class="required">The current password you provided not match your current password. Please try again.</h5>
					<fieldset><legend class="<?= (isset($_POST['old_user_pass']) && empty($_POST['old_user_pass']) ? 'required' : '') ?>">Current Password:</legend>
					<ul><li><input name="old_user_pass" type="password" value="<?= @$_POST['old_user_pass']?>"></li></ul></fieldset>
					
					<fieldset><legend class="<?= (isset($_POST['new_user_pass']) && empty($_POST['new_user_pass']) ? 'required' : '') ?>">New Password:</legend>
					<ul><li><input name="new_user_pass" type="password" value="<?= @$_POST['new_user_pass']?>"></li>
					<li><button type="submit" value="Send" name="submit">Save</button></li></ul></fieldset>
					
					</form>
					<?php
					}
				
			}
		else
			{ ?>
			<hr><h1><?php echo $pagetitle; ?></h1><hr>
			<form method="post" action="?edit">
			<fieldset><legend class="<?= (isset($_POST['old_user_pass']) && empty($_POST['old_user_pass']) ? 'required' : '') ?>">Current Password:</legend>
			<ul><li><input name="old_user_pass" type="password" value="<?= @$_POST['old_user_pass']?>"></li></ul></fieldset>
			
			<fieldset><legend class="<?= (isset($_POST['new_user_pass']) && empty($_POST['new_user_pass']) ? 'required' : '') ?>">New Password:</legend>
			<ul><li><input name="new_user_pass" type="password" value="<?= @$_POST['new_user_pass']?>"></li>
			<li><button type="submit" value="Send" name="submit">Save</button></li></ul></fieldset>
			
			</form>
<?php		}





include '../'.$foot; ?>