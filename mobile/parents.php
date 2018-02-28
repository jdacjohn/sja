<?php include 'core/base.php';





$pagetitle = 'Parents';
include $head;
echo '<h1><a href="https://www.edline.net/Index.page" target="_blank">Edline</a></h1><hr><h1>Faculty and Staff Directory</h1>';
$result = mysql_query("SELECT faculty_id, faculty_name, faculty_full, faculty_email FROM faculty ORDER BY faculty_name ASC") or die(mysql_error());
if(mysql_num_rows($result)==0)
	{
	echo '<p>This page is coming soon.</p>';
	}
else
	{
	while($row = mysql_fetch_array($result))
		{
		$faculty_name=$row['faculty_name'];
		$faculty_full = strip_tags(html_entity_decode($row['faculty_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
		$faculty_email=$row['faculty_email'];
		echo '<hr><p><strong>'.$faculty_name.'</strong>';
		if(!empty($faculty_full))
			{
			echo '<br><em>'.$faculty_full.'</em>';
			} else {}
		echo '<br><a href="mailto:'.$faculty_email.'">'.$faculty_email.'</a></p>';					
		}
	}





include $foot; ?>