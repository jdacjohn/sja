<?php $pagetitle = "Directory Listing"; include 'core/base.php'; include $head;





echo '<h1>'.$pagetitle.'</h1>';


$result = mysql_query("SELECT * FROM directory, directory_cat WHERE directory.directory_cat_id=directory_cat.directory_cat_id ORDER BY directory_cat.directory_cat_name DESC, directory.directory_chair DESC, directory.directory_name ASC") or die(mysql_error());

//$subresult = mysql_query("SELECT ") or die(mysql_error());

if(mysql_num_rows($result)==0)
	{
	echo '<p>This page is coming soon.</p>';
	}
else
	{
	
		
		$directory_cat_id = '';
		
		while($row = mysql_fetch_array($result))
			{
			$directory_name=$row['directory_name'];
			$directory_full = strip_tags(html_entity_decode($row['directory_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
			$directory_email=$row['directory_email'];		
			$directory_img=$row['directory_img'];
			$directory_cv=$row['directory_cv'];
			if($directory_cat_id!=$row['directory_cat_id'])
				{
				$directory_cat_id=$row['directory_cat_id'];
				$directory_cat_name=$row['directory_cat_name'];
				
				
				echo '<hr/><h2 align="center">'.$directory_cat_name.'</h2>';
				}
		
			echo '<hr><p class="directory">';
			if(!empty($directory_img))
				{
				echo '<img src="/assets/img/directory/tn-'.$directory_img.'" width="80" height="100">';
				}
			else
				{
				echo '<img src="/assets/img/directory/user.png" width="80" height="100">';
				}
				
				
				
			echo '<strong>'.$directory_name.'</strong>';
			
			if(!empty($directory_cv))
				{
				echo ' &middot; <a href="../assets/pdf/directory-cv/'.$directory_cv.'" target="_blank">directory CV</a>';
				
				}
			else {
				echo '';
			}
			
			if(!empty($directory_full))
				{
				echo '<br><em>'.$directory_full.'</em>';
				}
			//echo '<br><a href="mailto:'.$directory_email.'">'.$directory_email.'</a></p><div class="clear">&nbsp;</div>';	
			echo '<br>'.$directory_email.'</p><div class="clear">&nbsp;</div>';					
			}
	
	}





include $foot; ?>