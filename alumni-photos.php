<?php $pagetitle = "Alumni Fun Facts and Photo Sharing"; include 'core/base.php'; include $head;

if(isset($_GET['cat']))
	{
	$cat = $_GET['cat'];
	if (empty($_GET['cat']))
		{
		$pagetitle = 'Alumni Fun Facts and Photo Sharing';
		echo '<h1 class="title"><a href="/alumni-photos">Alumni Photo Sharing</a></h1>';
		echo '<p>This category does not exist. You will be redirected to <a href="/alumni-photos">Alumni Photo Sharing</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/alumni-photos>';
		}
	else
		{
		$result = mysql_query("SELECT alumni_cat_name FROM alumni_cat WHERE alumni_cat.alumni_cat_id='$cat'") or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			$pagetitle = 'Alumni Fun Facts and Photo Sharing';
			echo '<h1 class="title"><a href="/alumni-photos">Alumni Photo Sharing</a></h1>';
			echo '<p>This category does not exist. You will be redirected to <a href="/alumni-photos">Alumni Photo Sharing</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/alumni-photos>';
			}
		else
			{
			while($row = mysql_fetch_array($result))
				{
				$alumni_cat_name = $row["alumni_cat_name"];
				$pagetitle = 'Alumni Fun Facts and Photo Sharing &middot; '.$alumni_cat_name;
				
				echo '<div class="galL" id="gallery">';
				//echo '<h1 class="title"><a href="/alumni-photos">Alumni Photo Sharing</a> &middot; '.$alumni_cat_name.'</h1>'; // CATEGORIES PAGE ORDER
				echo '<h1 class="title"><a href="/alumni-fun-facts">Alumni Fun Facts and Photo Sharing</a> &middot; '.$alumni_cat_name.'</h1>'; // CATEGORIES PAGE ORDER
				echo '<hr/>';
				$result = mysql_query("SELECT alumni.alumni_id, alumni.alumni_date, alumni.alumni_caption, alumni.alumni_img FROM alumni, alumni_cat_list WHERE alumni_cat_list.alumni_cat_id='$cat' AND alumni_cat_list.alumni_id=alumni.alumni_id ORDER BY alumni_date DESC") or die(mysql_error());
				
				
				
				if(mysql_num_rows($result)==0)
					{
					echo '<p>There are no images at this time.<p>';
					}
				else
					{
					
					while($row = mysql_fetch_array($result))
						{
						$alumni_id = $row["alumni_id"];
						$alumni_caption = $row["alumni_caption"];
						$alumni_date=convert_date($row['alumni_date']);
						$alumni_img=$row['alumni_img'];
						if(!empty($alumni_img))
							{
							echo '<p><a href="/assets/img/alumni/'.$alumni_img.'" rel="lightbox['.$alumni_cat_name.']" title=" '.$alumni_caption.' "><img src="/assets/img/alumni/thumb-'.$alumni_img.'"></a><br/></p>';
							//echo '<small> <b>'.$alumni_date.'</small></b>';
							
							}
						else {
							}
						
					
						
						} // close while loop
						
						echo '';
						
					} 
					echo '</div>'; // close galL & gallery div	
					echo '<div class="galR"><div class="categories"><h1 class="title">Categories</h1><ul>';
					$result = mysql_query("SELECT * FROM alumni_cat ORDER BY alumni_cat_name ASC") or die(mysql_error());
					while($row = mysql_fetch_array( $result ))
						{
						$sub_alumni_cat_id=$row['alumni_cat_id'];
						$sub_alumni_cat_name=$row['alumni_cat_name'];
						echo '<li><a href="?cat='.$sub_alumni_cat_id.'">'.$sub_alumni_cat_name.'</a></li>';
						
						}
					echo '</ul></div>'; // close category div
					echo '</div>'; // close galR div
					echo '<div class="clear">&nbsp;</div>'; 	
				}
			}
		}
	}
	
	



else
		{
		$result = mysql_query("SELECT * FROM alumni, alumni_cat, alumni_cat_list WHERE alumni.alumni_id=alumni_cat_list.alumni_id AND alumni_cat.alumni_cat_id=alumni_cat_list.alumni_cat_id ORDER BY alumni_date DESC") or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			echo '<p>This page is coming soon.</p>';
			}
		else
			{
			
			$alumni_id = '';
			while($row = mysql_fetch_array($result))
				{
					if ($alumni_id!=$row['alumni_id'])
					{
					$alumni_cat_id=$row['alumni_cat_id'];
					$alumni_id=$row['alumni_id'];
					$alumni_date=$row['alumni_date'];
					$alumni_caption=$row['alumni_caption'];
					$alumni_img=$row['alumni_img'];
					$alumni_cat_name=$row['alumni_cat_name'];
					
					
					echo '<p><a href="/assets/img/alumni/'.$alumni_img.'" rel="lightbox[photos]" title=" '.$alumni_caption.' "><img src="/assets/img/alumni/thumb-'.$alumni_img.'"></a><br/>';
					echo '<small><b>'.$alumni_cat_name.'</small></b></p> ';
					
					}
				
					else {
						
					}
							
					
				} // close while loop
			
				echo '<div class="categories"><h1 class="title">Categories</h1><ul>';
				$result = mysql_query("SELECT * FROM alumni_cat ORDER BY alumni_cat_name ASC") or die(mysql_error());
				while($row = mysql_fetch_array( $result ))
					{
					$sub_alumni_cat_id=$row['alumni_cat_id'];
					$sub_alumni_cat_name=$row['alumni_cat_name'];
					echo '<li><a href="?cat='.$sub_alumni_cat_id.'">'.$sub_alumni_cat_name.'</a></li>';
					}
				echo '</ul></div>';
				
				
				echo '<div class="clear">&nbsp;</div>'; 			
			
			
			
			
			}
		}
	
	





include $foot; ?>