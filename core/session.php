<?php
if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

session_name('login');
session_set_cookie_params(2*7*24*60*60);
session_start();
ini_set('session.save_path', 'temp'); 
?>