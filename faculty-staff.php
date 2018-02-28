<?php $pagetitle = "Faculty &amp; Staff"; include 'core/base.php'; include $head;





echo '<h1>'.$pagetitle.'</h1>';
echo '<hr><h2><a href="http://intranet.sjafms.org/default.aspx" target="_blank">Faculty Intranet</a></h2><hr><h3><a href="/key-information">Key Information</a></h3>';

$result = mysql_query("SELECT * FROM faculty, faculty_cat WHERE faculty.faculty_cat_id=faculty_cat.faculty_cat_id ORDER BY faculty_cat.faculty_cat_name ASC, faculty.faculty_name ASC") or die(mysql_error());


if(mysql_num_rows($result)==0)
	{
	echo '<p>This page is coming soon.</p>';
	}
else
	{
	$faculty_cat_id = '';
	while($row = mysql_fetch_array($result))
		{
		$faculty_name=$row['faculty_name'];
		$faculty_full = strip_tags(html_entity_decode($row['faculty_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
		$faculty_email=$row['faculty_email'];
		$faculty_img=$row['faculty_img'];
		$faculty_cv=$row['faculty_cv'];
		if($faculty_cat_id!=$row['faculty_cat_id'])
			{
			$faculty_cat_id=$row['faculty_cat_id'];
			$faculty_cat_name=$row['faculty_cat_name'];
			
			
			echo '<hr/><h2 align="center">'.$faculty_cat_name.'</h2>';
			}	
		
		echo '<hr><p class="faculty">';
		if(!empty($faculty_img))
			{
			echo '<img src="/assets/img/faculty/tn-'.$faculty_img.'" width="80" height="100">';
			}
		else
			{
			echo '<img src="/assets/img/faculty/user.png" width="80" height="100">';
			}
			
			
			
		echo '<strong>'.$faculty_name.'</strong>';
		
		if(!empty($faculty_cv))
			{
			echo ' &middot; <a href="../assets/pdf/faculty-cv/'.$faculty_cv.'" target="_blank">Faculty CV</a>';
			
			}
		else {
			echo '';
		}
		
		if(!empty($faculty_full))
			{
			echo '<br><em>'.$faculty_full.'</em>';
			}
		echo '<br><a href="mailto:'.$faculty_email.'">'.$faculty_email.'</a></p><div class="clear">&nbsp;</div>';					
		}
	}





include $foot; ?>