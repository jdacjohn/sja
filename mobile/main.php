<?php include 'core/base.php'; include $head;





//Daily Announcements
$result = mysql_query("SELECT announce_id, announce_name, announce_short, announce_date FROM announce ORDER BY announce_date DESC LIMIT 1") or die(mysql_error());
if(mysql_num_rows($result)==0)
	{
	echo '<h2>Daily Announcements</h2><p>There are no entries.</p>';
	}
else
	{
	echo '<h2>Daily Announcements</h2>';
	while($row = mysql_fetch_array($result))
		{
		$announce_id=$row['announce_id'];
		$announce_name=$row['announce_name'];
		$announce_date=convert_date($row['announce_date']);
		$announce_short = strip_tags(html_entity_decode($row['announce_short'], ENT_QUOTES, 'utf-8'),$allowed_html);
		echo $announce_short;
		echo '<p class="readmore"><a href="/mobile/announcements">Read More</a></p>';				
		}
	}




//Calender
?>
<hr><h2><a href="/mobile/calendar/">Click for Calendar</a></h2><hr>
<?php





// Mission Statement
$result = mysql_query("SELECT * FROM page WHERE page_url='mission-statement'");
if (mysql_num_rows($result) > 0)
	{
	while($row = mysql_fetch_assoc($result))
		{
		$page_id=$row['page_id'];
		$page_name=$row['page_name'];
		$page_full=strip_tags(html_entity_decode($row['page_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
		$page_url=$row['page_url'];
		$page_date=convert_date($row['page_date']);
		$page_banner=$row['page_banner'];
		$page_img1=$row['page_img1'];
		$page_img2=$row['page_img2'];
		echo '<h1>'.$page_name.'</h1>';
		if(!empty($page_full))
			{
			echo $page_full;
			echo '<hr>';
			} else {}
		}
	} else {}





// Welcome
$result = mysql_query("SELECT * FROM page WHERE page_url='welcome'");
if (mysql_num_rows($result) > 0)
	{
	while($row = mysql_fetch_assoc($result))
		{
		$page_id=$row['page_id'];
		$page_name=$row['page_name'];
		$page_full=strip_tags(html_entity_decode($row['page_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
		$page_url=$row['page_url'];
		$page_date=convert_date($row['page_date']);
		$page_banner=$row['page_banner'];
		$page_img1=$row['page_img1'];
		$page_img2=$row['page_img2'];
		echo '<h1>'.$page_name.'</h1>';
		if(!empty($page_full))
			{
			echo $page_full;
			} else {}
		}
	} else {}





?>
<hr>
<h2>Add the SJA Mobile Web App to your iPhone or iPad</h2>
<p>It's easy to keep Saint Joseph Academy right at your fingertips:</p>
<p><strong>1.</strong> Click the bookmark button in the bottom toolbar.<br><img src="/mobile/assets/img/bookmark1.jpg"></p>
<p><strong>2.</strong> Click "Add to Home Screen"<br><img src="/mobile/assets/img/bookmark2.jpg"></p>
<p><strong>3.</strong> Click "Add"</strong><br><img src="/mobile/assets/img/bookmark3.jpg"></p>
<?php




include $foot; ?>