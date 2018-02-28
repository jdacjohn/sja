<?php $pagetitle = "Emergency Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(4);




		
if(isset($_GET['add']))
	{
	if (isset($_POST) && !empty($_POST['emergency_name']))
		{
		$emergency_name = htmlentities(($_POST['emergency_name']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO emergency (emergency_name, emergency_date) VALUES ('$emergency_name',NOW())");
		echo '<h1>'.$pagetitle.'</h1><hr><p>'.$emergency_name.' was successfully added! You will be redirected to <a href="/panel/emergency">Emergency Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/emergency>';
		}
	else
		{
	?>
	<h1>Add Emergency Entry</h1>
	<form method="post" action="?add">
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="emergency_name" value="<?= @$_POST['emergency_name']?>" type="text"></li>
	    <li><button type="submit" value="Send" name="submit">Save</button></li></ul></ul>
	</fieldset>
	</form>
<?php
		}
	}


elseif(isset($_GET['edit']))
	{
	$pagetype = "Edit Emergency Entry";
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM emergency WHERE emergency_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_emergency_name = $row["emergency_name"];
	$edit_emergency_date = $row["emergency_date"];
	if (empty($_GET['edit']))
		{ echo '<h1>Error</h1>emergency entry must be selected to be edited. You will be redirected to <a href="/panel/emergency">Emergency Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/emergency>'; }
	else
		{
		echo '<h1>'.$pagetype.'</h1>';
		if (isset($_POST) && !empty($_POST['emergency_name']))
			{
			$emergency_name = htmlentities(($_POST['emergency_name']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE emergency SET emergency_name='$emergency_name', emergency_date=NOW() WHERE emergency_id='$edit' ");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/emergency">Emergency Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/emergency>';
			}
		else
			{ ?>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>">			
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="emergency_name" value="<?php echo $edit_emergency_name; ?>" type="text"></li>
			    <li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			</fieldset>
			</form>
<?php
			}
			
		}
	}

	
elseif(isset($_GET['del']))
	{
	$pagetype = "Delete Emergency Entry";
	$del = $_GET['del'];
	$result = mysql_query("SELECT * FROM emergency WHERE emergency_id='$del' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_emergency_name = $row["emergency_name"];
	$del_emergency_date = $row["emergency_date"];
	if (empty($_GET['del']))
		{ echo '<h1>Error</h1>emergency entry must be selected to be deleted. You will be redirected to <a href="/panel/emergency">Emergency Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/emergency>';
		}
	else
		{
		echo '<h1>Delete '.$del_emergency_name.'</h1>';
		$result = mysql_query("DELETE FROM emergency WHERE emergency_id='$del'");
		echo '<p>Deleted! You will be redirected to <a href="/panel/emergency">Emergency Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/emergency>';
		}
	}	


else
	{
	$pagetype = "Emergency Admin";
	echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="?add">Add</a></h1><div class="clear">&nbsp;</div>';
	$result = mysql_query("SELECT emergency_id, emergency_name, emergency_full, emergency_date FROM emergency ORDER BY emergency_date DESC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no emergency entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{ $emergency_id=$row['emergency_id']; $emergency_name=$row['emergency_name']; $emergency_date=convert_date($row['emergency_date']);
				echo '<hr><p><strong>'.$emergency_name.'</strong> &middot; <em>'.$emergency_date.'</em><br>';
				echo '<small><em><a href="'.$PHP_SELF.'?edit='.$emergency_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$emergency_id.'">Delete</a></em></small>';
				echo '</p>';					
			}
		}
	}





include '../'.$foot; ?>