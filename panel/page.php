<?php include '../core/base.php'; $div="panel";




		
if(isset($_GET['add']))
	{
	$pagetitle = 'Add Page';
	include '../'.$head; check_logged(); check_access(5);
	if (isset($_POST) && !empty($_POST['page_name']))
		{
		$page_name = htmlentities(($_POST['page_name']), ENT_QUOTES, 'utf-8');
		$page_full = htmlentities(($_POST['page_full']), ENT_QUOTES, 'utf-8');
		$page_url = htmlentities(($_POST['page_url']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO page (page_name, page_full, page_url, page_date, user_id) VALUES ('$page_name','$page_full','$page_url',NOW(),'$user_id')");
		echo '<h1>'.$pagetitle.'</h1><hr><p>'.$page_name.' was successfully added! You will be redirected to <a href="/panel/page">Page Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/page>';
		}
	else
		{
	?>
	<h1>Add Page Entry</h1>
	<form method="post" action="?add">
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="page_name" value="<?= @$_POST['page_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>URL:</legend>
	    <ul><li><input name="page_url" value="<?= @$_POST['page_url']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>Entry:</legend>
		<ul><li><textarea name="page_full" rows="25" class="widgEditor"><?= @$_POST['page_full']?></textarea></li>
		<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}


elseif(isset($_GET['edit']))
	{
	$edit = $_GET['edit'];

	$result = mysql_query("SELECT * FROM page WHERE page_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	if($edit == 100){
		$page_embeds = $row['page_embed'];
	}
	$edit_page_name = $row["page_name"];
	$edit_page_full = $row["page_full"];
	$edit_page_url = $row["page_url"];
	$edit_page_date = $row["page_date"];
	$pagetitle = 'Edit '.$edit_page_name;
	include '../'.$head; check_logged(); check_access(4);
	if (empty($_GET['edit']))
		{ echo '<h1>Error</h1>page entry must be selected to be edited. You will be redirected to <a href="/panel/page">Page Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=panel/page>'; }
	else
		{
		echo '<h1>Edit <a href="/'.$edit_page_url.'">'.$edit_page_name.'</a></h1>';
		if (isset($_POST) && !empty($_POST['page_name']))
			{
			$page_name = htmlentities(($_POST['page_name']), ENT_QUOTES, 'utf-8');
			$page_full = htmlentities(($_POST['page_full']), ENT_QUOTES, 'utf-8');
			if($edit == 100){
				$page_embed = $_POST['page_embed'];
			}
			if($edit == 100){
				$result = mysql_query("UPDATE page SET page_name='$page_name', page_full='$page_full', page_date=NOW(), user_id='$user_id',page_embed = '$page_embed' WHERE page_id='$edit' ");			
			}else{
				$result = mysql_query("UPDATE page SET page_name='$page_name', page_full='$page_full', page_date=NOW(), user_id='$user_id' WHERE page_id='$edit' ");
			}
			echo '<p>Edited successfully! You will be redirected to <a href="/panel">Control Panel</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel>';
			}
		else
			{ ?>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>">			
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="page_name" value="<?php echo $edit_page_name; ?>" type="text"></li></ul>
			</fieldset>
			<?php
			if($edit == 100){?>
			<div align="center"><?php echo $page_embeds; ?></div>
				<ul><li><textarea name="page_embed" rows="5" ><?php echo $page_embeds; ?></textarea></li>
			<?php } ?>
			<fieldset>
				<legend>Entry:</legend>
				<ul><li><textarea name="page_full" rows="25" class="widgEditor"><?php echo $edit_page_full; ?></textarea></li>
				<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			</fieldset>
			</form>
<?php
			}
			
		}
	}	


else
	{
	$pagetitle = 'Page Admin';
	include '../'.$head; check_logged(); check_access(5);
	echo '<h1 class="l">'.$pagetitle.'</h1><h1 class="r"><a href="?add">Add</a></h1><div class="clear">&nbsp;</div>';
	$result = mysql_query("SELECT * FROM page ORDER BY page_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no page entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$page_id=$row['page_id'];
			$page_name=$row['page_name'];
			$page_full=$row['page_full'];
			$page_url=$row['page_url'];
			$page_date=convert_date($row['page_date']);
			$page_user_id=$row['user_id'];
			$page_img1=$row['page_img1'];
			$page_img2=$row['page_img2'];
			$page_img3=$row['page_img2'];
			$page_banner=$row['page_banner'];
			echo '<hr><p>';
			
			if(!empty($page_banner) or !empty($page_img1) or !empty($page_img2) or !empty($page_img3))
				{
				echo '<img src="/assets/img/icon-photo.gif"> ';
				} else {}
			
			if(!empty($page_full))
				{
				echo '*';
				} else {}
			
			echo '<strong><a href="/'.$page_url.'">'.$page_name.'</a></strong> &middot; <a href="'.$PHP_SELF.'?edit='.$page_id.'">Edit</a><br>';
			echo '<small>Last Edited on '.$page_date.' by';
			$subresult = mysql_query("SELECT user_login, user_name_f, user_name_l FROM user WHERE '$page_user_id'=user_id") or die(mysql_error());
			while($subrow = mysql_fetch_array($subresult))
				{
				$page_user_login=$subrow['user_login'];
				$page_user_name_f=$subrow['user_name_f'];
				$page_user_name_l=$subrow['user_name_l'];
				echo ' <a href="/profile/'.$page_user_login.'">'.$page_user_name_f.' '.$page_user_name_l.'</a></small></p>';
				}				
			}
		}
	}





include '../'.$foot; ?>