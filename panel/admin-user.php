<?php $pagetitle = "User Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(5);




		
if(isset($_GET['edit_user']))
	{
	$pagetype = "Edit User";
	$edit_user = $_GET['edit_user'];
	$result = mysql_query("SELECT * FROM user WHERE user_id='$edit_user' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_user_login = $row["user_login"];
	$edit_user_name_f = $row["user_name_f"];
	$edit_user_name_l = $row["user_name_l"];
	$edit_user_level = $row["user_level"];
	if (empty($_GET['edit_user']))
		{
		echo '<hr><h1>Edit User</h1><hr>';
		echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>';
		}
	else
		{
		echo '<hr><h1>Edit '.$edit_user_login.'</h1><hr>';
		if ($edit_user_level < 5)
			{
			if (isset($_POST['submit']))
				{
				$user_level = $_POST['user_level'];
				$result = mysql_query("UPDATE user SET user_level='$user_level' WHERE user_id='$edit_user' ");
				echo '<p>Edited successfully! You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>';
				}
			else
				{ ?>
				<form method="post" action="<?php echo $PHP_SELF; ?>?edit_user=<?php echo $edit_user; ?>">			
				<fieldset><legend>User Level:</legend>
				<ul><li><select name="user_level"><?php
				$result = mysql_query("SELECT user_level, user_level_name FROM user_level ORDER BY user_level DESC") or die(mysql_error());
				while($row = mysql_fetch_array($result))
					{
					echo '<option value="' . $row['user_level'] . '"';
					if($row['user_level']==$edit_user_level)
						{ echo ' selected'; }		
					echo '>' . $row['user_level_name'] . '</option>';
					} ?></select></li>
				<li><button type="submit" value="Update" name="submit">Save</button></li></ul></fieldset></form>
<?php			}
			}
		else
			{
			echo '<p>Sorry, you cannot edit this user. You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>';
			}
		}
	}
	
elseif(isset($_GET['del_user']))
	{
	$pagetype = "Delete User";
	$del_user = $_GET['del_user'];
	$result = mysql_query("SELECT * FROM user WHERE user_id='$del_user' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_user_login = $row["user_login"];
	$del_user_name_f = $row["user_name_f"];
	$del_user_name_l = $row["user_name_l"];
	$del_user_level = $row["user_level"];
	if (empty($_GET['del_user']))
		{
		echo '<hr><h1>Delete User</h1><hr>';
		echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>';
		}
	else
		{
		echo '<hr><h1>Delete '.$del_user_login.'</h1><hr>';
		if ($del_user_level < 5)
			{
			$result = mysql_query("DELETE FROM user WHERE '$del_user'=user_id");
			echo '<p>Deleted! You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>';
			}
		else
			{
			echo '<p>Sorry, you cannot delete this user. You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>';
			}
		}
	}	


else
	{
	$pagetype = "User Admin";
	echo '<hr><h1>'.$pagetype.'</h1>';
	$result = mysql_query("SELECT DISTINCT user.user_id, user.user_login, user.user_name_f, user.user_name_l, user.user_level, user_level.user_level_name FROM user, user_level WHERE user.user_level=user_level.user_level ORDER BY user.user_level DESC, user.user_login ASC") or die(mysql_error());
	while($row = mysql_fetch_array($result))
		{ $view_user_id=$row['user_id']; $view_user_login=$row['user_login']; $view_user_level=$row['user_level']; $view_user_name_f=$row['user_name_f']; $view_user_name_l=$row['user_name_l']; $view_user_level_name=$row['user_level_name'];
			echo '<hr><p><a href="/profile/'.$view_user_login.'/">'.$view_user_login.'</a> &middot; <em>'.$view_user_level_name.'</em><br>';
			if(!empty($view_user_name_f) or !empty($view_user_name_l))
				{
				if(!empty($view_user_name_f)) {echo $view_user_name_f;} else {}
				echo ' ';
				if(!empty($view_user_name_l)) {echo $view_user_name_l;} else {}
				echo '<br>';
				} else {}
			if($view_user_level < 5) {echo '<small><em><a href="'.$PHP_SELF.'?edit_user='.$view_user_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del_user='.$view_user_id.'">Delete</a></em></small>';} else {}
			echo '</p>';					
		}
	}





include '../'.$foot; ?>