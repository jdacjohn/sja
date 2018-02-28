<?php $pagetitle = "Announcement Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(4);




		
if(isset($_GET['add']))
	{
	if (isset($_POST) && !empty($_POST['announce_name']) && !empty($_POST['announce_full']))
		{
		$announce_name = htmlentities(($_POST['announce_name']), ENT_QUOTES, 'utf-8');
		$announce_short = htmlentities(($_POST['announce_short']), ENT_QUOTES, 'utf-8');
		$announce_full = htmlentities(($_POST['announce_full']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO announce (announce_name, announce_short, announce_full, announce_date) VALUES ('$announce_name','$announce_short','$announce_full',NOW())");
		echo '<h1>'.$pagetitle.'</h1><hr><p>'.$announce_name.' was successfully added! You will be redirected to <a href="/panel/announce">Announcement Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/announce>';
		}
	else
		{
	?>
	<h1>Add Announcement Entry</h1>
	<form method="post" action="?add">
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="announce_name" value="<?= @$_POST['announce_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>Short Text:</legend>
		<ul><li><textarea name="announce_short" rows="15" class="widgEditor"><?= @$_POST['announce_short']?></textarea></li></ul>
	</fieldset>
	<fieldset>
		<legend>Full Text:</legend>
		<ul><li><textarea name="announce_full" rows="15" class="widgEditor"><?= @$_POST['announce_full']?></textarea></li>
		<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}


elseif(isset($_GET['edit']))
	{
	$pagetype = "Edit Announcement Entry";
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM announce WHERE announce_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_announce_name = $row["announce_name"];
	$edit_announce_short = $row["announce_short"];
	$edit_announce_full = $row["announce_full"];
	$edit_announce_date = $row["announce_date"];
	if (empty($_GET['edit']))
		{ echo '<h1>Error</h1>announce entry must be selected to be edited. You will be redirected to <a href="/panel/announce">Announcement Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/announce>'; }
	else
		{
		echo '<h1>'.$pagetype.'</h1>';
		if (isset($_POST) && !empty($_POST['announce_name']))
			{
			$announce_name = htmlentities(($_POST['announce_name']), ENT_QUOTES, 'utf-8');
			$announce_short = htmlentities(($_POST['announce_short']), ENT_QUOTES, 'utf-8');
			$announce_full = htmlentities(($_POST['announce_full']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE announce SET announce_name='$announce_name', announce_short='$announce_short', announce_full='$announce_full', announce_date=NOW() WHERE announce_id='$edit' ");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/announce">Announcement Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/announce>';
			}
		else
			{ ?>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>">			
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="announce_name" value="<?php echo $edit_announce_name; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>Short Text:</legend>
				<ul><li><textarea name="announce_short" rows="15" class="widgEditor"><?php echo $edit_announce_short; ?></textarea></li></ul>
			</fieldset>
			<fieldset>
				<legend>Full Text:</legend>
				<ul><li><textarea name="announce_full" rows="15" class="widgEditor"><?php echo $edit_announce_full; ?></textarea></li>
				<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			</fieldset>
			</form>
<?php
			}
			
		}
	}

	
elseif(isset($_GET['del']))
	{
	$pagetype = "Delete Announcement Entry";
	$del = $_GET['del'];
	$result = mysql_query("SELECT * FROM announce WHERE announce_id='$del' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_announce_name = $row["announce_name"];
	$del_announce_full = $row["announce_full"];
	$del_announce_date = $row["announce_date"];
	if (empty($_GET['del']))
		{ echo '<h1>Error</h1>announce entry must be selected to be deleted. You will be redirected to <a href="/panel/announce">Announcement Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/announce>';
		}
	else
		{
		echo '<h1>Delete '.$del_announce_name.'</h1>';
		$result = mysql_query("DELETE FROM announce WHERE announce_id='$del'");
		echo '<p>Deleted! You will be redirected to <a href="/panel/announce">Announcement Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/announce>';
		}
	}	


else
	{
	$pagetype = "Announcement Admin";
	echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="?add">Add</a></h1><div class="clear">&nbsp;</div>';
	$result = mysql_query("SELECT announce_id, announce_name, announce_full, announce_date FROM announce ORDER BY announce_date DESC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no announce entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{ $announce_id=$row['announce_id']; $announce_name=$row['announce_name']; $announce_full=$row['announce_full']; $announce_date=convert_date($row['announce_date']);
				echo '<hr><p><strong>'.$announce_name.'</strong> &middot; <em>'.$announce_date.'</em><br>';
				echo '<small><em><a href="'.$PHP_SELF.'?edit='.$announce_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$announce_id.'">Delete</a></em></small>';
				echo '</p>';					
			}
		}
	}





include '../'.$foot; ?>