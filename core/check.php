<?php





if(isset($_GET['reset']))
	{
	include 'base.php';
	$userlost = $_GET['reset'];
	$count = mysql_num_rows(mysql_query("select user_email from user where user_email = '".$userlost."'"));
	
	if($count > 0)
		{
		}
	else
		{
		echo 'That email address cannot be found, please try another one.';
		}
	}
	
elseif(isset($_GET['email']))
	{
	include 'base.php';
	$userlost = $_GET['email'];
	$count = mysql_num_rows(mysql_query("select user_email from user where user_email = '".$userlost."'"));
	
	if($count > 0)
		{
		echo 'That email address is already registered, please try another one.';
		}
	else
		{
		}
	}
	
elseif(isset($_GET['check']))
	{
	include 'base.php';
	$username = $_GET['check'];
	$count = mysql_num_rows(mysql_query("select user_login from user where user_login = '".$username."'"));
	
	if($count > 0)
		{
		echo 'That username already exists, please select another one.';
		}
	else
		{
		}
	}

else
	{
	header("Location: /accessdenied");
	}	




	
?>