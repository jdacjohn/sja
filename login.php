<?php $pagetitle = "Log In"; include 'core/base.php'; $div="login"; include $head;

if(isset($_SESSION['user_id']) && !isset($_COOKIE['remember']) && !$_SESSION['rememberMe'])
{
	// If you are logged in, but you don't have the remember cookie (browser restart)
	// and you have not checked the rememberMe checkbox:

	$_SESSION = array();
	session_destroy();
	
	// Destroy the session
}


if(isset($_GET['logout']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: /");
	exit;
}

if(isset($_POST['submit']))
{
	// Checking whether the Login form has been submitted
	
	$error = array();
	// Will hold our errors
	
	
	if(!$_POST['user_login'] || !$_POST['user_pass'])
		$error[] = 'All the fields must be filled in!';
	
	if(!count($error))
	{
		$_POST['user_login'] = mysql_real_escape_string($_POST['user_login']);
		$_POST['user_pass'] = mysql_real_escape_string($_POST['user_pass']);
		$_POST['rememberMe'] = (int)$_POST['rememberMe'];
		
		// Escaping all input data

		$row = mysql_fetch_assoc(mysql_query("SELECT user_id,user_login FROM user WHERE user_login='{$_POST['user_login']}' AND user_pass='".md5($_POST['user_pass'])."'"));

		if($row['user_login'])
		{
			// If everything is OK login
			
			$_SESSION['user_login']=$row['user_login'];
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];
			
			// Store some data in the session
			
			setcookie('remember',$_POST['rememberMe']);
		}
		else $error[]='Wrong login and/or password!';
	}
	
	if($error)
	$_SESSION['msg']['login-error'] = implode('<br >',$error);
	// Save the error messages in the session

	header("Location: /login");
	exit;
}

/*
$script = '';
if($_SESSION['msg'])
{
	// The script below shows the sliding panel on page load
	$script = '';	
}
*/

if(!isset($_SESSION['user_id']))
{
?>
<!-- Login Form -->
<hr>
<h1>Log In</h1>
<form action="<?php echo $PHP_SELF; ?>" method="post">
<?php
if(isset($_SESSION['msg']['login-error']))
	{
	echo '<div class="error">'.$_SESSION['msg']['login-error'].'</div>';
	unset($_SESSION['msg']['login-error']);
	}
?>
<fieldset>
    <legend>username:</legend>
	<ul><li><input type="text" name="user_login"></li></ul>
</fieldset>

<fieldset>
    <legend>password:</legend>
	<ul><li><input type="password" name="user_pass"></li>
	<li><input name="rememberMe" type="checkbox" checked="checked" value="1" class="styled">Remember Me</li>
	<li><input type="submit" name="submit" value="Login"></li></ul>
</fieldset>
</form>
<p><a href="/lost-password">Lost Your Password?</a> &middot; <a href="/register">Register Today!</a></p>
<?php
}
else
{
	header("Location: /panel");
	exit;
}





include $foot; ?>