<?php $pagetitle = "Fun Facts and Photo Sharing"; include 'core/base.php'; include $head; check_logged(); check_access(2);

if(isset($_GET['cat']))
	{
	$cat = $_GET['cat'];
	if (empty($_GET['cat']))
		{
		$pagetitle = 'Fun Facts and Photo Sharing';
		echo '<h1 class="title"><a href="/fun-facts">Fun Facts and Photo Sharing</a></h1>';
		echo '<p>This category does not exist. You will be redirected to <a href="/fun-facts">Fun Facts and Photo Sharing</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/fun-facts>';
		}
	else
		{
		$result = mysql_query("SELECT fun_cat_name FROM fun_cat WHERE fun_cat.fun_cat_id='$cat'") or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			$pagetitle = 'Fun Facts and Photo Sharing';
			echo '<h1 class="title"><a href="/fun-facts">Fun Facts and Photo Sharing</a></h1>';
			echo '<p>This category does not exist. You will be redirected to <a href="/fun-facts">Fun Facts and Photo Sharing</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/fun-facts>';
			}
		else
			{
			while($row = mysql_fetch_array($result))
				{
				$fun_cat_name = $row["fun_cat_name"];
				$pagetitle = 'Fun Facts and Photo Sharing &middot; '.$fun_cat_name;
				
				echo '<div class="galL" id="gallery">';
				//echo '<h1 class="title"><a href="/fun-photos">fun Photo Sharing</a> &middot; '.$fun_cat_name.'</h1>'; // CATEGORIES PAGE ORDER
				echo '<h1 class="title">Fun Facts and Photo Sharing &middot; '.$fun_cat_name.'</h1>'; // CATEGORIES PAGE ORDER
				echo '<hr/>';
				$result = mysql_query("SELECT fun.fun_id, fun.fun_date, fun.fun_caption, fun.fun_img FROM fun, fun_cat_list WHERE fun_cat_list.fun_cat_id='$cat' AND fun_cat_list.fun_id=fun.fun_id ORDER BY fun_date DESC") or die(mysql_error());
				
				
				
				if(mysql_num_rows($result)==0)
					{
					echo '<p>There are no images at this time.<p>';
					}
				else
					{
					
					while($row = mysql_fetch_array($result))
						{
						$fun_id = $row["fun_id"];
						$fun_caption = $row["fun_caption"];
						$fun_date=convert_date($row['fun_date']);
						$fun_img=$row['fun_img'];
						if(!empty($fun_img))
							{
							echo '<p><a href="/assets/img/fun/'.$fun_img.'" rel="lightbox['.$fun_cat_name.']" title=" '.$fun_caption.' "><img src="/assets/img/fun/thumb-'.$fun_img.'"></a><br/></p>';
							//echo '<small> <b>'.$fun_date.'</small></b>';
							
							}
						else {
							}
						
					
						
						} // close while loop
						
						echo '';
						
					} 
					echo '</div>'; // close galL & gallery div	
					echo '<div class="galR"><div class="categories"><h1 class="title">Categories</h1><ul>';
					$result = mysql_query("SELECT * FROM fun_cat ORDER BY fun_cat_name ASC") or die(mysql_error());
					while($row = mysql_fetch_array( $result ))
						{
						$sub_fun_cat_id=$row['fun_cat_id'];
						$sub_fun_cat_name=$row['fun_cat_name'];
						echo '<li><a href="?cat='.$sub_fun_cat_id.'">'.$sub_fun_cat_name.'</a></li>';
						
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
		$result = mysql_query("SELECT * FROM fun, fun_cat, fun_cat_list WHERE fun.fun_id=fun_cat_list.fun_id AND fun_cat.fun_cat_id=fun_cat_list.fun_cat_id ORDER BY fun_date DESC") or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			echo '<p>This page is coming soon.</p>';
			}
		else
			{
			
			$fun_id = '';
			while($row = mysql_fetch_array($result))
				{
					if ($fun_id!=$row['fun_id'])
					{
					$fun_cat_id=$row['fun_cat_id'];
					$fun_id=$row['fun_id'];
					$fun_date=$row['fun_date'];
					$fun_caption=$row['fun_caption'];
					$fun_img=$row['fun_img'];
					$fun_cat_name=$row['fun_cat_name'];
					
					
					echo '<p><a href="/assets/img/fun/'.$fun_img.'" rel="lightbox[photos]" title=" '.$fun_caption.' "><img src="/assets/img/fun/thumb-'.$fun_img.'"></a><br/>';
					echo '<small><b>'.$fun_cat_name.'</small></b></p> ';
					
					}
				
					else {
						
					}
							
					
				} // close while loop
			
				echo '<div class="categories"><h1 class="title">Categories</h1><ul>';
				$result = mysql_query("SELECT * FROM fun_cat ORDER BY fun_cat_name ASC") or die(mysql_error());
				while($row = mysql_fetch_array( $result ))
					{
					$sub_fun_cat_id=$row['fun_cat_id'];
					$sub_fun_cat_name=$row['fun_cat_name'];
					echo '<li><a href="?cat='.$sub_fun_cat_id.'">'.$sub_fun_cat_name.'</a></li>';
					}
				echo '</ul></div>';
				
				
				echo '<div class="clear">&nbsp;</div>'; 			
			
			
			
			
			}
		}
	
	





include $foot; ?>