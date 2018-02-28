<?php include 'core/base.php'; error_reporting(E_ALL ^ E_NOTICE); $pagetitle = 'Emergency Registry';


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
	$headers ="From: ${_POST['parent_email']}\r\n";
	$headers .="Reply-to: ${_POST['parent_email']}\r\n";
	$message = date("l: F d, Y - g:i a") . "\n\n";
	$message .= "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
	$message .= "Name: ${_POST['parent_name_f']} ${_POST['parent_name_l']}\n\n";
	$message .= "Email: ${_POST['parent_email']}\n\n";
	$message .= "Phone: ${_POST['parent_phone']}\n\n";
	$subject = "St. Joseph - Parent Registration";
	$parent_name_f = htmlentities(($_POST['parent_name_f']), ENT_QUOTES, 'ISO-8859-1');
	$parent_name_l = htmlentities(($_POST['parent_name_l']), ENT_QUOTES, 'ISO-8859-1');
	$parent_email = htmlentities(($_POST['parent_email']), ENT_QUOTES, 'ISO-8859-1');
	$parent_phone = htmlentities(($_POST['parent_phone']), ENT_QUOTES, 'ISO-8859-1');
	$query = mysql_query("INSERT INTO parent (parent_name_f, parent_name_l, parent_email, parent_phone)  VALUES ('$parent_name_f', '$parent_name_l', '$parent_email', '$parent_phone')")or die('Error : ' . mysql_error());
	@$send=mail("jwilliams@sja.us,ekinkopf@sja.us,bthompson@sja.us",$subject,$message,$headers) or die("Your submission did not go through. Please use the Back button to navigate back to the form. Thank you.");
	setcookie('tntcon','');
	}
	
	include $head;

if (!empty($send))
	{
?>
<p>Thank you! You are now registered.</p>
<?
	}
else
	{ ?>

<hr>
<h1>Emergency Registry</h1>
<p>Fill out this form to be on the text message list, in case of emergencies</p>

<form method="post" action="">

<fieldset><legend>First Name:</legend>
<ul><li><input name="parent_name_f" type="text" id="parent_name_f" value="<?= @$_POST['parent_name']?>"></li></ul></fieldset>

<fieldset><legend>Last Name:</legend>
<ul><li><input name="parent_name_l" type="text" id="parent_name_l" value="<?= @$_POST['parent_name']?>"></li></ul></fieldset>
        
<fieldset><legend>Email:</legend>
<ul><li><input name="parent_email" type="text" id="parent_email" value="<?= @$_POST['parent_email']?>"></li></ul></fieldset>

<fieldset><legend>Phone:</legend>
<ul><li><input name="parent_phone" type="text" id="parent_phone" value="<?= @$_POST['parent_phone']?>"></li></ul></fieldset>
            
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