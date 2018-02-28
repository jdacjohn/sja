<?php
if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

function get_php_self()
	{
	return isset($_SERVER['PHP_SELF']) ? htmlentities(strip_tags($_SERVER['PHP_SELF'],''), ENT_QUOTES, 'UTF-8') : '';
	}
	
function convert_date($data_date)
	{
	$date=strtotime($data_date);
	$final_date=date("F j, Y, g:i a", $date);
	return $final_date;
	}
	
function cleanHTML($html)
	{
	//$html = preg_replace("'&nbsp;'", ' ', $html);
	/* Removes all FONT and SPAN tags, and all Class and Style attributes.
	Designed to get rid of non-standard Microsoft Word HTML tags.
	start by completely removing all unwanted tags
	then run another pass over the html (twice), removing unwanted attributes
	*/
	$html = preg_replace('#(<[a-z ]*)(style=("|\')(.*?)("|\'))([a-z ]*>)#', '\\1\\6', $html);
	return $html;
	}
?>