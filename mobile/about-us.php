<?php include 'core/base.php';





$pagetitle = 'About Us';
include $head;
$result = mysql_query("SELECT * FROM page WHERE page_url='contact'");
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
			}
		else
			{
			echo '<p>This page is coming soon.</p>';
			}
		}
	}
else
	{
	include $head;
	header("Location: /sja/mobile");
	}





include $foot; ?>