<?php include 'core/base.php';





$result = mysql_query("SELECT * FROM page WHERE page_url='library'");
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
	$pagetitle=$page_name;
	include $head;
	echo '<hr><h1>'.$page_name.'</h1>';
	?>
	<!--
	<hr><h3>Check out these great YA reads in the St. Joe library!</h3>
	<div id="ShelfariWidget115994"><a href='http://www.shelfari.com/o1514610111?WidgetId=115994' target="_blank">Shelfari: Book reviews on your book blog</a><script src="http://www.shelfari.com/ws/115994/widget.js?r=67987" type="text/javascript" language="javascript"></script></div><noscript><ul></ul></noscript>-->
	<hr> 
	<script type="text/javascript" src="http://widgets1.renlearn.com/content/widgets/reading activity/readingactivitywidget.js"></script><script>if (READINGACTIVITYWIDGET) READINGACTIVITYWIDGET.renderWidget('http://widgets1.renlearn.com/', 'SJAX2RG');</script><noscript>Enable Javascript in your browser to view this content.</noscript>
	<hr>
	<?php
	if(!empty($page_full))
		{
		echo $page_full;
		}
	else
		{
		echo '<p>This page is coming soon.</p>';
		}
	}





include $foot; ?>