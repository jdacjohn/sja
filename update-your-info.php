<?php include 'core/base.php'; error_reporting(E_ALL ^ E_NOTICE); $pagetitle = 'Update Your Info';

if (isset($_POST['verif_box']))
	{
	$verif_box = $_REQUEST["verif_box"];
	}
else
	{ 
	$verif_box = '';
	}

if ((md5($verif_box).'a4xn' == $_COOKIE['tntcon']) && !empty($_POST['verif_box']))
	{
	$headers ="From: jacqi@uppercasedesigngroup.com\r\n";
	$headers .="Reply-to: ${_POST['update_email']}\r\n";
	$message = date("l: F d, Y - g:i a") . "\n\n";
	$message .= "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
	$message .= "Name: ${_POST['update_name']}\n\n";
	$message .= "Class: ${_POST['update_class']}\n\n";
	$message .= "Parent: ${_POST['update_parent']}\n\n";
	$message .= "Friend: ${_POST['update_friend']}\n\n";
	$message .= "Employer: ${_POST['update_employer']}\n\n";
	$message .= "Position: ${_POST['update_position']}\n\n";
	$message .= "Spouse: ${_POST['update_spouse']}\n\n";
	$message .= "Spouse's Class: ${_POST['update_spouse_class']}\n\n";
	$message .= "Spouse's Employer: ${_POST['update_spouse_employer']}\n\n";
	$message .= "Spouse's Position: ${_POST['update_spouse_position']}\n\n";
	$message .= "Home Address: ${_POST['update_address']}\n\n";
	$message .= "Phone: ${_POST['update_phone']}\n\n";
	$message .= "City: ${_POST['update_city']}\n\n";
	$message .= "State: ${_POST['update_state']}\n\n";
	$message .= "Zip: ${_POST['update_zip']}\n\n";
	$message .= "Email: ${_POST['update_email']}\n\n";
	$message .= "Fax: ${_POST['update_fax']}\n\n";
	$message .= "News to Share: ${_POST['update_news']}\n\n";
	$subject = "St. Joseph - Alumni Information Update";
	/*
	$update_name = htmlentities(($_POST['update_name']), ENT_QUOTES, 'ISO-8859-1');
	$update_class = htmlentities(($_POST['update_class']), ENT_QUOTES, 'ISO-8859-1');
	$update_parent = htmlentities(($_POST['update_parent']), ENT_QUOTES, 'ISO-8859-1');
	$update_friend = htmlentities(($_POST['update_friend']), ENT_QUOTES, 'ISO-8859-1');
	$update_employer = htmlentities(($_POST['update_employer']), ENT_QUOTES, 'ISO-8859-1');
	$update_position = htmlentities(($_POST['update_position']), ENT_QUOTES, 'ISO-8859-1');
	$update_spouse = htmlentities(($_POST['update_spouse']), ENT_QUOTES, 'ISO-8859-1');
	$update_spouse_class = htmlentities(($_POST['update_spouse_class']), ENT_QUOTES, 'ISO-8859-1');
	$update_spouse_employer = htmlentities(($_POST['update_spouse_employer']), ENT_QUOTES, 'ISO-8859-1');
	$update_spouse_position = htmlentities(($_POST['update_spouse_position']), ENT_QUOTES, 'ISO-8859-1');
	$update_address = htmlentities(($_POST['update_address']), ENT_QUOTES, 'ISO-8859-1');
	$update_phone = htmlentities(($_POST['update_phone']), ENT_QUOTES, 'ISO-8859-1');
	$update_city = htmlentities(($_POST['update_city']), ENT_QUOTES, 'ISO-8859-1');
	$update_state = htmlentities(($_POST['update_state']), ENT_QUOTES, 'ISO-8859-1');
	$update_zip = htmlentities(($_POST['update_zip']), ENT_QUOTES, 'ISO-8859-1');
	$update_email = htmlentities(($_POST['update_email']), ENT_QUOTES, 'ISO-8859-1');
	$update_fax = htmlentities(($_POST['update_fax']), ENT_QUOTES, 'ISO-8859-1');
	$update_news = htmlentities(($_POST['update_news']), ENT_QUOTES, 'ISO-8859-1');
	$query = mysql_query("INSERT INTO update (update_name, update_class, update_parent, update_friend, update_employer, update_position, update_spouse, update_spouce_class, update_spouse_employer, update_spouse_position, update_address, update_phone, update_city, update_state, update_zip, update_email, update_fax, update_news) VALUES ('$update_name', '$update_class', '$update_parent', '$update_friend', '$update_employer', '$update_position', '$update_spouse', '$update_spouce_class', '$update_spouse_employer', '$update_spouse_position', '$update_address', '$update_phone', '$update_city', '$update_state', '$update_zip', '$update_email', '$update_fax', '$update_news')")or die('Error : ' . mysql_error());
	*/
	@$send=mail("sjaalumniupdate@gmail.com",$subject,$message,$headers) or die("Your submission did not go through. Please use the Back button to navigate back to the form. Thank you.");
	setcookie('tntcon','');
	}
	
	include $head;

if (!empty($send))
	{
?>
<p>Thank you! Your information has been sent.</p>
<?
	}
else
	{ ?>
<hr>
<h1>Update Your Information</h1>
<p>Please bring us up to date.</p>

<form method="post" action="">

<fieldset><legend>Name</legend>
<ul><li><input name="update_name" type="text" id="update_name" value="<?= @$_POST['update_name']?>"></li></ul></fieldset>
<fieldset><legend>Class</legend>
<ul><li><input name="update_class" type="text" id="update_name" value="<?= @$_POST['update_class']?>"></li></ul></fieldset>
<fieldset><legend>Parent</legend>
<ul><li><input name="update_parent" type="text" id="update_name" value="<?= @$_POST['update_parent']?>"></li></ul></fieldset>
<fieldset><legend>Friend</legend>
<ul><li><input name="update_friend" type="text" id="update_name" value="<?= @$_POST['update_friend']?>"></li></ul></fieldset>
<fieldset><legend>Employer</legend>
<ul><li><input name="update_employer" type="text" id="update_name" value="<?= @$_POST['update_employer']?>"></li></ul></fieldset>
<fieldset><legend>Position</legend>
<ul><li><input name="update_position" type="text" id="update_name" value="<?= @$_POST['update_position']?>"></li></ul></fieldset>
<fieldset><legend>Spouse</legend>
<ul><li><input name="update_spouse" type="text" id="update_name" value="<?= @$_POST['update_spouse']?>"></li></ul></fieldset>
<fieldset><legend>Spouse's Class</legend>
<ul><li><input name="update_spouse_class" type="text" id="update_name" value="<?= @$_POST['update_spouse_class']?>"></li></ul></fieldset>
<fieldset><legend>Spouse's Employer</legend>
<ul><li><input name="update_spouse_employer" type="text" id="update_name" value="<?= @$_POST['update_spouse_employer']?>"></li></ul></fieldset>
<fieldset><legend>Spouse's Position</legend>
<ul><li><input name="update_spouse_position" type="text" id="update_name" value="<?= @$_POST['update_spouse_position']?>"></li></ul></fieldset>
<fieldset><legend>Home Address</legend>
<ul><li><input name="update_address" type="text" id="update_name" value="<?= @$_POST['update_address']?>"></li></ul></fieldset>
<fieldset><legend>Phone</legend>
<ul><li><input name="update_phone" type="text" id="update_name" value="<?= @$_POST['update_phone']?>"></li></ul></fieldset>
<fieldset><legend>City</legend>
<ul><li><input name="update_city" type="text" id="update_name" value="<?= @$_POST['update_city']?>"></li></ul></fieldset>
<fieldset><legend>State</legend>
<ul><li><input name="update_state" type="text" id="update_name" value="<?= @$_POST['update_state']?>"></li></ul></fieldset>
<fieldset><legend>Zip</legend>
<ul><li><input name="update_zip" type="text" id="update_name" value="<?= @$_POST['update_zip']?>"></li></ul></fieldset>
<fieldset><legend>Email</legend>
<ul><li><input name="update_email" type="text" id="update_name" value="<?= @$_POST['update_email']?>"></li></ul></fieldset>
<fieldset><legend>Fax</legend>
<ul><li><input name="update_fax" type="text" id="update_name" value="<?= @$_POST['update_fax']?>"></li></ul></fieldset>
<fieldset><legend>News to Share</legend>
<ul><li><textarea name="update_news" rows="10"><?= @$_POST['update_news']?></textarea></li></ul></fieldset>
            
<fieldset><legend <?= (isset($_POST['verif_box']) && (md5($verif_box).'a4xn' != $_COOKIE['tntcon']) ? '' : '') ?> id="verf">Verification #: <img src="/verificationimage.php?<?php echo rand(0,9999);?>">
<p><strong>* Type the Verification # in the field below to submit this form successfully.</strong></p>
</legend>

<ul><li><input name="verif_box" type="text" id="verif_box" <?= (isset($_POST['verif_box']) && (md5($verif_box).'a4xn' != $_COOKIE['tntcon']) ? 'class="invalid"' : '') ?>></li></ul></fieldset>

<fieldset><legend></legend>
<ul><li><input type="submit" name="send" id="send" value="Send"></li></ul>
</fieldset>
<div class="clear">&nbsp;</div>
</form>
<?
	} ?>

<?php
include $foot; ?>