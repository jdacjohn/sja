<?php

$result = mysql_query("SELECT * FROM school_admin_groups, school_admin_cat WHERE school_admin_groups.school_admin_cat_id=school_admin_cat.school_admin_cat_id ORDER BY school_admin_cat.school_admin_cat_name DESC, school_admin_groups.school_admin_groups_name ASC") or die(mysql_error());



//$result = mysql_query("SELECT school_admin_groups_id, school_admin_groups_name, school_admin_groups_full, school_admin_groups_email, school_admin_groups_img, school_admin_groups_cv FROM office ORDER BY school_admin_groups_name ASC") or die(mysql_error());
if(mysql_num_rows($result)==0)
	{
	echo '<hr/><p>There are no cabinet entries.</p>';
	}
else
	{
	$school_admin_cat_id = '';
	while($row = mysql_fetch_array($result))
		{
		$school_admin_groups_id=$row['school_admin_groups_id'];
		$school_admin_groups_name=$row['school_admin_groups_name'];
		$school_admin_groups_full=$row['school_admin_groups_full'];
		$school_admin_groups_email=$row['school_admin_groups_email'];
		$school_admin_groups_img=$row['school_admin_groups_img'];
		$school_admin_groups_cv=$row['school_admin_groups_cv'];
		if($school_admin_cat_id!=$row['school_admin_cat_id'])
			{
			$school_admin_cat_id=$row['school_admin_cat_id'];
			$school_admin_cat_name=$row['school_admin_cat_name'];
			
			
			echo '<hr/><h2 align="center">'.$school_admin_cat_name.'</h2>';
			}
			
			
			
			
		
		
		
		echo '<hr><p class="faculty">';
		
		if(!empty($school_admin_groups_img))
			{
			echo '<img src="/assets/img/school-admin/tn-'.$school_admin_groups_img.'" width="80" height="100">';
			}
		else
			{
			echo '<img src="/assets/img/faculty/user.png" width="80" height="100">';
			}
			
			
			
		echo '<strong>'.$school_admin_groups_name.'</strong>';
		
		if(!empty($school_admin_groups_cv))
			{
			echo ' &middot; <a href="../assets/pdf/school-admin-cv/'.$school_admin_groups_cv.'" target="_blank">Member CV</a>';
			
			}
		else {
			echo '';
		}
		
		if(!empty($school_admin_groups_full))
			{
			echo '<br><em>'.$school_admin_groups_full.'</em>';
			}
		echo '<br><a href="mailto:'.$school_admin_groups_email.'">'.$school_admin_groups_email.'</a></p><div class="clear">&nbsp;</div>';
		
		
		
			
						
		
			
		}
	}

?>