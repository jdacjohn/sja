<?php
if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

$db_host = 'internal-db.s139600.gridserver.com';
$db_user = 'db139600';
$db_user_pass = 'Iamj03@cad3my';
$db_database = 'db139600_stjoe';

$link = mysql_connect($db_host,$db_user,$db_user_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link);
?>