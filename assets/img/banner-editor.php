<?php $pagetitle = "Edit Banner"; include '../../core/base.php'; include '../../'.$head; check_logged(); check_access(4);





if(isset($_GET['edit']))
	{
	$page_id = $_GET['edit'];
	$result = mysql_query("SELECT * FROM page WHERE page_id='$page_id' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$page_banner = $row["page_banner"];
	
	if (empty($_GET['edit']))
		{
		echo '<h1>'.$pagetitle.'</h1><hr><p>Page must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
		}
	else
		{
		if (isset($_POST['submit']))
			{
			$page_banner = htmlentities(($_POST['page_banner']), ENT_QUOTES, 'ISO-8859-1');
			$result = mysql_query("UPDATE page SET page_banner='$page_banner', user_id='$user_id' WHERE page_id='$page_id' ");
			echo '<h1>'.$pagetype.'</h1><hr><p>Banner was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
			}
		else
			{
?>
			<div id="cropper">
			<div id="background" class="background">
			<img id="obj_0" width="820" height="173" src="banner-base.jpg"></img>
			</div>
			<div id="tools">
			</div>
			<div id="objects">
			<?php
			$result = mysql_query("SELECT * FROM img WHERE '$page_id'=page_id ORDER BY img_date DESC") or die(mysql_error());
			if(mysql_num_rows($result)==0){}
			else
				{
				$i=1;
				while($row = mysql_fetch_array($result))
					{
					$img_id=$row['img_id'];
					$img_name=$row['img_name'];
					echo '<div class="obj_item"><img id="obj_'.$i.'" width="85" class="ui-widget-content" src="panel/'.$img_name.'" width="85"></div>';
					$i++;
					}
				}
			?>
			</div>
			<a id="submit"><span>Save</span></a>
			<form id="jsonform" action="banner-merge.php?edit=<?php echo $page_id;?>" method="POST">
			<input id="jsondata" name="jsondata" type="hidden" value="" autocomplete="off"></input>
			</form>
			</div>
<?php
			}
		}
	}

else
	{
	echo '<h1>'.$pagetitle.'</h1><hr><p>Image must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
	}





include '../../'.$foot; ?>