<?php $pagetitle = "Edit Username"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged();






		if(isset($_GET['edit']) && isset($_POST['submit']) && !empty($_POST['old_user_pass']) && !empty($_POST['new_user_login']))
			{
				$old_user_pass = $user_pass;
				if (md5($_POST['old_user_pass']) == $old_user_pass)
					{
					$new_user_login = $_POST['new_user_login'];
					$result = mysql_query("UPDATE user SET `user_login`='".$_POST['new_user_login']."' WHERE $user_id=user_id");
					if(mysql_affected_rows($link)==1)
						{
						echo '<hr><h1>'.$pagetitle.'</h1><hr>';
						echo '<p>Your username was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel>';
						}
					else
						{ ?>
						<h1><?php echo $pagetitle; ?></h1>
						<form method="post" action="?edit">
						<fieldset><legend class="<?= (isset($_POST['old_user_pass']) && empty($_POST['old_user_pass']) ? 'required' : '') ?>">Current Password:</legend>
						<ul><li><input name="old_user_pass" type="password" value="<?= @$_POST['old_user_pass']?>"></li></ul></fieldset>
						
						<h5 class="required">This username is already taken!.</h5>
						<fieldset><legend class="<?= (isset($_POST['new_user_login']) && empty($_POST['new_user_login']) ? 'required' : '') ?>">New Username:</legend>
						<ul><li><input name="new_user_login" type="text" value="<?= @$_POST['new_user_login']?>"></li>
						<li><button type="submit" value="Send" name="submit">Save</button></li></ul></fieldset>
						
						</form>
						<?php
						}
					}
				else
					{ ?>
					<hr>
					<h1><?php echo $pagetitle; ?></h1>
					<hr>
					<form method="post" action="?edit">
					<h5 class="required">The current password you provided not match your current password. Please try again.</h5>
					<fieldset><legend class="<?= (isset($_POST['old_user_pass']) && empty($_POST['old_user_pass']) ? 'required' : '') ?>">Current Password:</legend>
					<ul><li><input name="old_user_pass" type="password" value="<?= @$_POST['old_user_pass']?>"></li></ul></fieldset>
					
					<fieldset><legend class="<?= (isset($_POST['new_user_login']) && empty($_POST['new_user_login']) ? 'required' : '') ?>">New Username:</legend>
					<ul><li><input name="new_user_login" type="text" value="<?= @$_POST['new_user_login']?>"></li>
					<li><button type="submit" value="Send" name="submit">Save</button></li></ul></fieldset>
					
					</form>
					<?php
					}
				
			}
		else
			{ ?>
			<hr>
			<h1><?php echo $pagetitle; ?></h1>
			<hr>
			<form method="post" action="?edit">
			<fieldset><legend class="<?= (isset($_POST['old_user_pass']) && empty($_POST['old_user_pass']) ? 'required' : '') ?>">Current Password:</legend>
			<ul><li><input name="old_user_pass" type="password" value="<?= @$_POST['old_user_pass']?>"></li></ul></fieldset>
			
			<fieldset><legend class="<?= (isset($_POST['new_user_login']) && empty($_POST['new_user_login']) ? 'required' : '') ?>">New Username:</legend>
			<ul><li><input name="new_user_login" type="text" value="<?= @$_POST['new_user_login']?>"></li>
			<li><button type="submit" value="Send" name="submit">Save</button></li></ul></fieldset>
			
			</form>
<?php		}





include '../'.$foot; ?>