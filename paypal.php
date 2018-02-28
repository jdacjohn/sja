<?php include 'core/base.php'; error_reporting(E_ALL ^ E_NOTICE); $pagetitle = 'Online Giving';

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
	$headers ="From: ${_POST['update_email']}\r\n";
	$headers .="Reply-to: ${_POST['update_email']}\r\n";
	$message = date("l: F d, Y - g:i a") . "\n\n";
	$message .= "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
	$message .= "Name: ${_POST['update_name']}\n\n";
	$message .= "Class: ${_POST['update_class']}\n\n";
	$message .= "Contribution: ${_POST['update_contribution']}\n\n";
	$message .= "Address: ${_POST['update_address']}\n\n";
	$message .= "City: ${_POST['update_city']}\n\n";
	$message .= "State: ${_POST['update_state']}\n\n";
	$message .= "Zip: ${_POST['update_zip']}\n\n";
	$message .= "Phone: ${_POST['update_phone']}\n\n";
	$message .= "Email: ${_POST['update_email']}\n\n";
	$message .= "News to Share: ${_POST['update_note']}\n\n";
	$subject = "St. Joseph - Online Giving";

	$update_name = htmlentities(($_POST['update_name']), ENT_QUOTES, 'ISO-8859-1');
	$update_class = htmlentities(($_POST['update_class']), ENT_QUOTES, 'ISO-8859-1');
	$update_contribution = htmlentities(($_POST['update_contribution']), ENT_QUOTES, 'ISO-8859-1');
	$update_address = htmlentities(($_POST['update_address']), ENT_QUOTES, 'ISO-8859-1');
	$update_phone = htmlentities(($_POST['update_phone']), ENT_QUOTES, 'ISO-8859-1');
	$update_city = htmlentities(($_POST['update_city']), ENT_QUOTES, 'ISO-8859-1');
	$update_state = htmlentities(($_POST['update_state']), ENT_QUOTES, 'ISO-8859-1');
	$update_zip = htmlentities(($_POST['update_zip']), ENT_QUOTES, 'ISO-8859-1');
	$update_email = htmlentities(($_POST['update_email']), ENT_QUOTES, 'ISO-8859-1');
	$update_note = htmlentities(($_POST['update_note']), ENT_QUOTES, 'ISO-8859-1');
	
	@$send=mail("mmartinez@sja.us",$subject,$message,$headers) or die("Your submission did not go through. Please use the Back button to navigate back to the form. Thank you.");
	setcookie('tntcon','');
	}
	
	include $head;
	echo '<hr><h1>'.$pagetitle.'</h1>';

if (!empty($send))
	{
?>
<p>Thank you! Please make your donation:</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="mmartinez@sja.us">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Saint Joseph Academy">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

<?
	}
else
	{ ?>
<p>You may make a gift to St. Joe securely online.  Your gift is tax deductible and you will receive a formal acknowledgement for your contribution. Every gift counts, please consider supporting St. Joe today.</p>

<p><img src="/assets/img/paypal.png"></p>

<form method="post" action="">

<fieldset><legend>Name</legend>
<ul><li><input name="update_name" type="text" value="<?= @$_POST['update_name']?>"></li></ul></fieldset>
<fieldset><legend>Class</legend>
<ul><li><input name="update_class" type="text" value="<?= @$_POST['update_class']?>"></li></ul></fieldset>
<fieldset><legend>Address</legend>
<ul><li><input name="update_address" type="text" value="<?= @$_POST['update_address']?>"></li></ul></fieldset>
<fieldset><legend>City</legend>
<ul><li><input name="update_city" type="text" value="<?= @$_POST['update_city']?>"></li></ul></fieldset>
<fieldset><legend>State</legend>
<ul><li><input name="update_state" type="text" value="<?= @$_POST['update_state']?>"></li></ul></fieldset>
<fieldset><legend>Zip</legend>
<ul><li><input name="update_zip" type="text" value="<?= @$_POST['update_zip']?>"></li></ul></fieldset>
<fieldset><legend>Email</legend>
<ul><li><input name="update_email" type="text" value="<?= @$_POST['update_email']?>"></li></ul></fieldset>
<fieldset><legend>Phone</legend>
<ul><li><input name="update_phone" type="text" value="<?= @$_POST['update_phone']?>"></li></ul></fieldset>
<fieldset><legend>Contribution</legend>
<ul><li><input name="update_contribution" type="text" value="<?= @$_POST['update_contribution']?>"></li></ul></fieldset>
<fieldset><legend>Note</legend>
<ul><li><textarea name="update_note" rows="10"><?= @$_POST['update_note']?></textarea></li></ul></fieldset>
            
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