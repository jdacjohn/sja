<?php $pagetitle = "Photos: View and Buy Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);



//photo_name, photo_url, photo_email, photo_img FROM photo 
if(isset($_GET['add']))
	{
	$pagetype = 'Photos: View and Buy Admin &middot; Add Entry';
	echo '<h1><a href="/panel/photo">Photos: View and Buy Admin</a> &middot; Add Entry</h1>';
	if (isset($_POST) && !empty($_POST['photo_name']))
		{
		$photo_name = htmlentities(($_POST['photo_name']), ENT_QUOTES, 'utf-8');
		$photo_url = htmlentities(($_POST['photo_url']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO photo (photo_name, photo_url) VALUES ('$photo_name','$photo_url')");
		echo '<hr><p>'.$photo_name.' was successfully added! You will be redirected to <a href="/panel/photo">Photos: View and Buy Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/photo>';
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">
	<fieldset>
	    <legend>Name:</legend>
	    <ul><li><input name="photo_name" value="<?= @$_POST['photo_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>URL:</legend>
	    <ul><li><input name="photo_url" value="http://<?= @$_POST['photo_url']?>" type="text"></li>
	    <li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}
	
	
elseif(isset($_GET['edit']))
	{
	$pagetype = 'Photos: View and Buy Admin &middot; Edit Entry';
	echo '<h1><a href="/panel/photo">Photos: View and Buy Admin</a> &middot; Edit Entry</h1>';
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM photo WHERE photo_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_photo_name = $row["photo_name"];
	$edit_photo_url = $row["photo_url"];
	if (empty($_GET['edit']))
		{
		echo '<hr>Entry must be selected to be edited. You will be redirected to <a href="/panel/photo">Photos: View and Buy Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/photo>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['photo_name']))
			{
			$photo_name = htmlentities(($_POST['photo_name']), ENT_QUOTES, 'utf-8');
			$photo_url = htmlentities(($_POST['photo_url']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE photo SET photo_name='$photo_name', photo_url='$photo_url' WHERE photo_id='$edit'");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/photo">Photos: View and Buy Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/photo>';
			}
		else
			{ ?>
			<hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" enctype="multipart/form-data">			
			<fieldset>
			    <legend>Name:</legend>
			    <ul><li><input name="photo_name" value="<?php echo $edit_photo_name; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>URL:</legend>
			    <ul><li><input name="photo_url" value="<?php echo $edit_photo_url; ?>" type="text"></li>
			    <li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			</fieldset>
			
			</form>
<?php
			}
		}
	}


elseif(isset($_GET['del']))
	{
	$pagetype = 'Photos: View and Buy Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/photo">Photos: View and Buy Admin</a> &middot; Delete Entry</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/photo">Photos: View and Buy Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/photo>';
		}
	else
		{	
		$result = mysql_query("DELETE FROM photo WHERE photo_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/photo">Photos: View and Buy Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/photo>';
		}
	}
	
	
else
	{
	$pagetype = 'Photos: View and Buy Admin';
	echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="?add">Add Entry</a></h1><div class="clear">&nbsp;</div>';
	$result = mysql_query("SELECT photo_id, photo_name, photo_url FROM photo ORDER BY photo_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$photo_id=$row['photo_id'];
			$photo_name=$row['photo_name'];
			$photo_url=$row['photo_url'];
			echo '<hr><h3>'.$photo_name.'</h3><p><small><em><a href="'.$PHP_SELF.'?edit='.$photo_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$photo_id.'">Delete</a></em></small></p>';	
			}
		}
	}





include '../'.$foot; ?>