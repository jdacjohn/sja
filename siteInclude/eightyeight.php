<?php
	//echo '<div style="background-color:#000; width:200px; height:200px;"> </div>';
	
	$result = mysql_query("SELECT * FROM office_cabinet, office_cat WHERE office_cabinet.office_cat_id=office_cat.office_cat_id ORDER BY office_cat.office_cat_name ASC, office_cabinet.office_cabinet_name ASC") or die(mysql_error());
	
	
	
	//$result = mysql_query("SELECT office_cabinet_id, office_cabinet_name, office_cabinet_full, office_cabinet_email, office_cabinet_img, office_cabinet_cv FROM office ORDER BY office_cabinet_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<hr/><p>There are no cabinet entries.</p>';
		}
	else
		{
		$office_cat_id = '';
		while($row = mysql_fetch_array($result))
			{
			$office_cabinet_id=$row['office_cabinet_id'];
			$office_cabinet_name=$row['office_cabinet_name'];
			$office_cabinet_full=$row['office_cabinet_full'];
			$office_cabinet_email=$row['office_cabinet_email'];
			$office_cabinet_img=$row['office_cabinet_img'];
			$office_cabinet_cv=$row['office_cabinet_cv'];
			if($office_cat_id!=$row['office_cat_id'])
				{
				$office_cat_id=$row['office_cat_id'];
				$office_cat_name=$row['office_cat_name'];
				
				
				echo '<hr/><h2 align="center">'.$office_cat_name.'</h2>';
				}
				
				
				
				
			
			
			
			echo '<hr><p class="faculty">';
			if(!empty($office_cabinet_img))
				{
				echo '<img src="/assets/img/office/tn-'.$office_cabinet_img.'" width="80" height="100">';
				}
			else
				{
				echo '<img src="/assets/img/faculty/user.png" width="80" height="100">';
				}
				
				
				
			echo '<strong>'.$office_cabinet_name.'</strong>';
			
			if(!empty($office_cabinet_cv))
				{
				echo ' &middot; <a href="../assets/pdf/office-cv/'.$office_cabinet_cv.'" target="_blank">Cabinet Member CV</a>';
				
				}
			else {
				echo '';
			}
			
			if(!empty($office_cabinet_full))
				{
				echo '<br><em>'.$office_cabinet_full.'</em>';
				}
			echo '<br><a href="mailto:'.$office_cabinet_email.'">'.$office_cabinet_email.'</a></p><div class="clear">&nbsp;</div>';
			
			
			
				
							
			
				
			}
		}
	
	
?>