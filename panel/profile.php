<?php $pagetitle = "Profile"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(5);





//profile
if(isset($_GET['profile']))
	{
	$profile = $_GET['profile'];
	$profile_user = mysql_escape_string($profile);
	if (!empty($profile_user))
		{
		$result = mysql_query("SELECT * FROM user WHERE user_login='$profile_user'");
		if (mysql_num_rows($result) > 0)
			{
			while($row = mysql_fetch_assoc($result))
				{
				$user_id = $row['user_id'];
				$user_login = $row['user_login'];
				$user_date = $row['user_date'];
				$userlevel_no = $row['user_level'];
				$user_email = $row['user_email'];
				$strip_user_email = strip_tags(html_entity_decode($user_email, ENT_QUOTES, 'utf-8'),$allowed_html);
				$user_name_f = $row['user_name_f'];
				$strip_user_name_f = strip_tags(html_entity_decode($user_name_f, ENT_QUOTES, 'utf-8'),$allowed_html);
				$user_name_l = $row['user_name_l'];
				$strip_user_name_l = strip_tags(html_entity_decode($user_name_l, ENT_QUOTES, 'utf-8'),$allowed_html);
				echo '<p>';
				if(!empty($user_name_f) && !empty($user_name_l)){echo '<strong>'.$strip_user_name_f.' '.$strip_user_name_l.'</strong>';} else{echo $user_login;}
				if(!empty($user_email)){echo '<br>Email: <a href="mailto:'.$strip_user_email.'">'.$strip_user_email.'</a>';} else{}
				echo '</p>';
				}
			}
		}
	}





else
	{
	include $head;
	header("Location: /sja");
	}





include '../'.$foot; ?>