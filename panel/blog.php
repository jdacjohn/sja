<?php $pagetitle = "Blog Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(5);




		
if(isset($_GET['add']))
	{
	if (isset($_POST) && !empty($_POST['blog_name']) && !empty($_POST['blog_full']))
		{
		$blog_name = htmlentities(($_POST['blog_name']), ENT_QUOTES, 'utf-8');
		$blog_full = htmlentities(($_POST['blog_full']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO blog (blog_name, blog_full, blog_date) VALUES ('$blog_name','$blog_full',NOW())");
		echo '<h1>'.$pagetitle.'</h1><hr><p>'.$blog_name.' was successfully added! You will be redirected to <a href="/panel/blog">Blog Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/blog>';
		}
	else
		{
	?>
	<h1>Add Blog Entry</h1>
	<form method="post" action="?add">
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="blog_name" value="<?= @$_POST['blog_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>Entry:</legend>
		<ul><li><textarea name="blog_full" rows="15" class="widgEditor"><?= @$_POST['blog_full']?></textarea></li>
		<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}


elseif(isset($_GET['edit']))
	{
	$pagetype = "Edit Blog Entry";
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM blog WHERE blog_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_blog_name = $row["blog_name"];
	$edit_blog_full = $row["blog_full"];
	$edit_blog_date = $row["blog_date"];
	if (empty($_GET['edit']))
		{ echo '<h1>Error</h1>Blog entry must be selected to be edited. You will be redirected to <a href="/panel/blog">Blog Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/blog>'; }
	else
		{
		echo '<h1>'.$pagetype.'</h1>';
		if (isset($_POST) && !empty($_POST['blog_name']) && !empty($_POST['blog_full']))
			{
			$blog_name = htmlentities(($_POST['blog_name']), ENT_QUOTES, 'utf-8');
			$blog_full = htmlentities(($_POST['blog_full']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE blog SET blog_name='$blog_name', blog_full='$blog_full', blog_date=NOW() WHERE blog_id='$edit' ");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/blog">Blog Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/blog>';
			}
		else
			{ ?>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>">			
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="blog_name" value="<?php echo $edit_blog_name; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>Entry:</legend>
				<ul><li><textarea name="blog_full" rows="15" class="widgEditor"><?php echo $edit_blog_full; ?></textarea></li>
				<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			</fieldset>
			</form>
<?php
			}
			
		}
	}

	
elseif(isset($_GET['del']))
	{
	$pagetype = "Delete Blog Entry";
	$del = $_GET['del'];
	$result = mysql_query("SELECT * FROM blog WHERE blog_id='$del' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_blog_name = $row["blog_name"];
	$del_blog_full = $row["blog_full"];
	$del_blog_date = $row["blog_date"];
	if (empty($_GET['del']))
		{ echo '<h1>Error</h1>Blog entry must be selected to be deleted. You will be redirected to <a href="/panel/blog">Blog Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/blog>';
		}
	else
		{
		echo '<h1>Delete '.$del_blog_name.'</h1>';
		$result = mysql_query("DELETE FROM blog WHERE blog_id='$del'");
		echo '<p>Deleted! You will be redirected to <a href="/panel/blog">Blog Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/blog>';
		}
	}	


else
	{
	$pagetype = "Blog Admin";
	echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="?add">Add</a></h1><div class="clear">&nbsp;</div>';
	$result = mysql_query("SELECT blog_id, blog_name, blog_full, blog_date FROM blog ORDER BY blog_date DESC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no blog entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{ $blog_id=$row['blog_id']; $blog_name=$row['blog_name']; $blog_full=$row['blog_full']; $blog_date=convert_date($row['blog_date']);
				echo '<hr><p><strong>'.$blog_name.'</strong> &middot; <em>'.$blog_date.'</em><br>';
				echo '<small><em><a href="'.$PHP_SELF.'?edit='.$blog_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$blog_id.'">Delete</a></em></small>';
				echo '</p>';					
			}
		}
	}





include '../'.$foot; ?>