<?php
if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

function checkEmail($str)
	{
	return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
	}

function send_mail($from,$to,$subject,$body)
	{
	$headers = '';
	$headers .= "From: $from\n";
	$headers .= "Reply-to: $from\n";
	$headers .= "Return-Path: $from\n";
	$headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Date: " . date('r', time()) . "\n";
	mail($to,$subject,$body,$headers);
	}

function get_php_self()
	{
	return isset($_SERVER['PHP_SELF']) ? htmlentities(strip_tags($_SERVER['PHP_SELF'],''), ENT_QUOTES, 'UTF-8') : '';
	}

function check_logged()
	{ 
	global $_SESSION;
	if(!isset($_SESSION['user_id'])){ header("Location: /login"); }
	}
	
function check_access($user_no)
	{
	global $user_level;
	if($user_level < $user_no){ header("Location: /accessdenied"); }
	}
	
function convert_date($data_date)
	{
	$date=strtotime($data_date);
	$final_date=date("F j, Y, g:i a", $date);
	return $final_date;
	}


function remove_http($url = '')
	{
	return(str_replace(array('http://','https://'), '', $url));
	}
/*
$url = 'http://google.com';
echo remove_http($url);
*/
		

function square_crop($src_image, $dest_image, $thumb_size = 100, $jpg_quality = 100)
	{
	// Get dimensions of existing image
	$image = getimagesize($src_image);
	// Check for valid dimensions
	if( $image[0] <= 0 || $image[1] <= 0 ) return false;
	// Determine format from MIME-Type
	$image['format'] = strtolower(preg_replace('/^.*?\//', '', $image['mime']));
	// Import image
	switch( $image['format'] )
		{
		case 'jpg':
		case 'jpeg':
		$image_data = imagecreatefromjpeg($src_image);
		break;
		case 'png':
		$image_data = imagecreatefrompng($src_image);
		break;
		case 'gif':
		$image_data = imagecreatefromgif($src_image);
		break;
		default:
		// Unsupported format
		return false;
		break;
		}
	// Verify import
	if( $image_data == false ) return false;
	// Calculate measurements
	if( $image[0] & $image[1] )
		{
		// For landscape images
		$x_offset = ($image[0] - $image[1]) / 2;
		$y_offset = 0;
		$square_size = $image[0] - ($x_offset * 2);
		}
	else
		{
		// For portrait and square images
		$x_offset = 0;
		$y_offset = ($image[1] - $image[0]) / 2;
		$square_size = $image[1] - ($y_offset * 2);
		}
	// Resize and crop
	$canvas = imagecreatetruecolor($thumb_size, $thumb_size);
	if( imagecopyresampled(
	$canvas,
	$image_data,
	0,
	0,
	$x_offset,
	$y_offset,
	$thumb_size,
	$thumb_size,
	$square_size,
	$square_size
	))
		{
		// Create thumbnail
		switch( strtolower(preg_replace('/^.*\./', '', $dest_image)) )
			{
			case 'jpg':
			case 'jpeg':
			return imagejpeg($canvas, $dest_image, $jpg_quality);
			break;
			case 'png':
			return imagepng($canvas, $dest_image);
			break;
			case 'gif':
			return imagegif($canvas, $dest_image);
			break;
			default:
			// Unsupported format
			return false;
			break;
			}
		}
	else
		{
		return false;
		}
	}
?>