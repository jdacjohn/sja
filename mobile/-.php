<?php

if(isset($_GET['404']))
	{
	include 'core/base.php'; include $head;
	echo '<h1>404</h1><p>Sorry, the page you requested was not found.</p>';
	include $foot;
	}
else
	{
	include 'core/base.php'; include $head;
	echo '<h1>Error</h1><p>Sorry, there was an error.</p>';
	include $foot;
	}
	
?>