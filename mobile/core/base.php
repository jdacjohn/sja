<?php
error_reporting(E_ALL);
define('INCLUDE_CHECK',true);
require 'connect.php';
require 'functions.php';

/*includes*/
$head = 'core/template/head.php';
$foot = 'core/template/foot.php';

/*constants*/
date_default_timezone_set('America/Chicago');
$allowed_html = "<a>,<b>,<strong>,<i>,<em>,<p>,<br>,<ul>,<ol>,<li>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<hr>,<div><script><noscript><iframe><div><img>";
$allowed_html2 = "<a>,<b>,<strong>,<i>,<em>,<br>,<ul>,<ol>,<li>";

/*php self*/
$PHP_SELF = get_php_self();
?>