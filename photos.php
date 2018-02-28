<?php $pagetitle = "Photos: View and Buy"; include 'core/base.php'; include $head;





echo '<h1>'.$pagetitle.'</h1>';
if(isset($_GET['view']))
	{
	$view = $_GET['view'];
	$result = mysql_query("SELECT * FROM photo WHERE photo_id='$view' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$view_photo_name = $row["photo_name"];
	$view_photo_url = $row["photo_url"];
	if (empty($_GET['view']))
		{
		}
	else
		{
		$result = mysql_query("SELECT photo_id, photo_name, photo_url FROM photo ORDER BY photo_name ASC") or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			echo '<p>This page is coming soon.</p>';
			}
		else
			{
			echo '<ul>';
			while($row = mysql_fetch_array($result))
				{
				$photo_id=$row['photo_id'];
				$photo_name=$row['photo_name'];
				$photo_url=$row['photo_url'];
				if($view_photo_url==$photo_url)
					{
					echo '<li><strong>'.$photo_name.'</strong></li>';
					}
				else
					{
					echo '<li><a href="/photos/?view='.$photo_id.'">'.$photo_name.'</a></li>';	
					}					
				}
			echo '</ul>';
			}
		echo '<iframe src="'.$view_photo_url.'" name="photo" width="940" height="1000" frameborder="0"></iframe>';
		}
	}


else
	{
	$result = mysql_query("SELECT photo_id, photo_name, photo_url FROM photo ORDER BY photo_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>This page is coming soon.</p>';
		}
	else
		{
		echo '<ul>';
		while($row = mysql_fetch_array($result))
			{
			$photo_id=$row['photo_id'];
			$photo_name=$row['photo_name'];
			echo '<li><a href="/photos/?view='.$photo_id.'">'.$photo_name.'</a></li>';					
			}
		echo '</ul>';
		}
	}





include $foot; ?>