<?php ob_start();

/*title*/
$site_name = 'Saint Joseph Academy';
$site_tagline = 'Today, tomorrow, Forever St. Joe';
if(!empty($pagetitle))
	{
	if(!empty($pagetype))
		{
		$title = $pagetype.' '.$pagetitle.' &middot; '.$site_name;
		}
	else
		{
		$title = $pagetitle.' &middot; '.$site_name;
		}
	}
else
	{
	$title = $site_name;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<title><?php echo $title; ?></title>
<link type="text/css" href="/mobile/assets/css/style.css" rel="stylesheet" media="screen">
<link rel="apple-touch-icon" href="57.png">
<link rel="apple-touch-icon" sizes="72x72" href="72.png">
<link rel="apple-touch-icon" sizes="114x114" href="114.png">
<link rel="apple-touch-startup-image" href="startup.png">
</head>
<body>
<div id="container">
<div id="head">
<a href="/mobile">Saint Joseph Academy</a>
<?php
$result = mysql_query("SELECT slideshow_name FROM slideshow ORDER BY RAND() LIMIT 1") or die(mysql_error());
if(mysql_num_rows($result)==0)
	{
	}
else
	{
	while($row = mysql_fetch_array($result))
		{
		$slideshow_name=$row['slideshow_name'];
		echo '<div id="banner" style="background:url(/assets/img/banner/mobile-'.$slideshow_name.');">';
		}
	}
$result = mysql_query("SELECT emergency_id, emergency_name, emergency_date FROM emergency ORDER BY emergency_date DESC LIMIT 1") or die(mysql_error());
if(mysql_num_rows($result)==0)
	{
	}
else
	{
	while($row = mysql_fetch_array($result))
		{ $emergency_id=$row['emergency_id']; $emergency_name=$row['emergency_name']; $emergency_date=convert_date($row['emergency_date']);
			echo '<marquee scrollamount="2">'.$emergency_name.'</marquee>';					
		}
	}
echo '&nbsp;</div>';
?>
</div>
<div id="content">