<?php
error_reporting(E_ALL);
define('INCLUDE_CHECK',true);
require 'connect.php';
require 'classes.php';
require 'functions.php';
require 'session.php';

/*mobile*/
require_once('lib/mobile.php');
mobile_device_detect(true,false,true,true,true,true,true,'http://sja.us/mobile',false);

/*includes*/
$head = 'core/template/head.php';
$head2 = 'core/template/head2.php';
$side = 'core/template/side.php';
$foot = 'core/template/foot.php';

/*constants*/
date_default_timezone_set('America/Chicago');
$subnav = 'on';
$sidebar = 'off';
$div = '';
$pageid = '';
$clear = '<div class="clear">&nbsp;</div>';
$allowed_html = "<a>,<b>,<strong>,<i>,<em>,<p>,<br>,<ul>,<ol>,<li>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<hr>,<img>,<object>,<script>,<div>";
$allowed_html2 = "<a>,<b>,<strong>,<i>,<em>,<br>,<ul>,<ol>,<li>,<object>,<script><div>";
$allowed_html3 = "<a>,<b>,<strong>,<i>,<em>,<ul>,<ol>,<li>";

/*php self*/
$PHP_SELF = get_php_self();

/*user info*/
if(isset($_SESSION['user_id']))
	{
	$result = mysql_query("SELECT * FROM user WHERE user_id='".$_SESSION['user_id']."'") or die(mysql_error()); $row = mysql_fetch_array($result);
	$user_log = '1';
	/*user basics */
	$user_id = $row['user_id'];
	$user_login = $row['user_login'];
	$user_pass = $row['user_pass'];
	$user_ip = $row['user_ip'];
	$user_date = $row['user_date'];
	$user_level = $row['user_level'];
	$user_email = $row['user_email'];
	$strip_user_email = strip_tags(html_entity_decode($user_email, ENT_QUOTES, 'utf-8'),$allowed_html);
	$user_name_f = $row['user_name_f'];
	$strip_user_name_f = strip_tags(html_entity_decode($user_name_f, ENT_QUOTES, 'utf-8'),$allowed_html);
	$user_name_l = $row['user_name_l'];
	$strip_user_name_l = strip_tags(html_entity_decode($user_name_l, ENT_QUOTES, 'utf-8'),$allowed_html);
	}
else
	{
	$user_level = '0'; $user_login = ''; $user_name_f = 'Guest'; $user_log = '0';
	}
?>