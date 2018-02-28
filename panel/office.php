<?php $pagetitle = "Office of the President Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);



//office_name, office_full FROM office 
if(isset($_GET['add']))
	{
	$pagetype = 'Office of the President Admin &middot; Add Entry';
	echo '<h1><a href="/panel/office">Office of the President Admin</a> &middot; Add Entry</h1>';
	if (isset($_POST) && !empty($_POST['office_name']))
		{
		$office_name = htmlentities(($_POST['office_name']), ENT_QUOTES, 'utf-8');
		$office_full = htmlentities(($_POST['office_full']), ENT_QUOTES, 'utf-8');			
		if (!empty($_FILES["office_img"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["office_img"]["tmp_name"];
			$img_size = ($_FILES["office_img"]["size"] / 1024);
			$file_name = basename($_FILES["office_img"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$office_img = $img_md5.'.'.$file_ext;
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$office_img = $img_md5.'.'.$file_ext;
				$office_img_target = "../assets/img/office/".$office_img;
				move_uploaded_file($_FILES["office_img"]["tmp_name"],$office_img_target);
				$resizeObj = new resize('../assets/img/office/'.$office_img); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/office/tn-'.$office_img, 100); // *** 3) Save image
				}
			else
				{
				$office_img = '';
				}
			}
		else
			{
			$office_img = '';
			}
		
			
		$result = mysql_query("INSERT INTO office (office_name, office_full, office_img) VALUES ('$office_name','$office_full','$office_img')") or die(mysql_error());
		
		echo '<hr><p>'.$office_name.' was successfully added! You will be redirected to <a href="/panel/office">Office of the President Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office>';
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">			
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="office_name" value="<?= @$_POST['office_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>Entry:</legend>
		<ul><li><textarea name="office_full" rows="25" class="widgEditor"><?= @$_POST['about_full']?></textarea></li></ul>
	</fieldset>
	<fieldset>
		<legend>Image:</legend>
		<ul><li><input name="office_img" type="file" /></li>
		<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}
	


	
	
	
	
elseif(isset($_GET['edit']))
	{
	$pagetype = 'Office of the President Admin &middot; Edit Entry';
	echo '<h1><a href="/panel/office">Office of the President Admin</a> &middot; Edit Entry</h1>';
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM office WHERE office_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_office_name = $row["office_name"];
	$edit_office_full = $row["office_full"];
	$edit_office_img = $row["office_img"];
	if (empty($_GET['edit']))
		{
		echo '<hr>Entry must be selected to be edited. You will be redirected to <a href="/panel/office">Office of the President Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['office_name']))
			{
			$office_name = htmlentities(($_POST['office_name']), ENT_QUOTES, 'utf-8');
			$office_full = htmlentities(($_POST['office_full']), ENT_QUOTES, 'utf-8');
			if (!empty($_FILES["office_img"]["name"]))
				{
				$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
				$img_tmp = $_FILES["office_img"]["tmp_name"];
				$img_size = ($_FILES["office_img"]["size"] / 1024);
				$file_name = basename($_FILES["office_img"]["name"]);
				$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
				$office_img = $img_md5.'.'.$file_ext;
				$max_file = '2048';
				if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
					{
					$office_img = $img_md5.'.'.$file_ext;
					$office_img_target = "../assets/img/office/".$office_img;
					move_uploaded_file($_FILES["office_img"]["tmp_name"],$office_img_target);
					$resizeObj = new resize('../assets/img/office/'.$office_img); // *** 1) Initialise / load image
					$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> saveImage('../assets/img/office/tn-'.$office_img, 100); // *** 3) Save image
					}
				else
					{
					$office_img = $edit_office_img;
					}
				}
			else
				{
				$office_img = $edit_office_img;
				} // End of Img 
			
			

			$result = mysql_query("UPDATE office SET office_name='$office_name', office_full='$office_full', office_img='$office_img' WHERE office_id='$edit' ");
			
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/office">Office of the President Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office>';
			}
		else
			{ ?>
			<hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" enctype="multipart/form-data">			
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="office_name" value="<?php echo $edit_office_name; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>Entry:</legend>
				<ul><li><textarea name="office_full" rows="25" class="widgEditor"><?php echo $edit_office_full; ?></textarea></li></ul>
			</fieldset>
			<fieldset>
				<legend>Image:</legend>
				<ul><li>
				<?php
				if(!empty($edit_office_img))
					{
					echo '<input type="hidden" name="office_img" value="'.$edit_office_img.'">';
					echo '<img src="/assets/img/office/tn-'.$edit_office_img.'">';
					echo '<br><a href="?del_img='.$edit.'">Delete Image</a>';
					}
				else
					{
					echo '<input name="office_img" type="file" />';
					}
				?>
				</li>
				
				
				
				<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			<fieldset>
			</form>
			
			
<?php
			}
		}
	}
	
	


elseif(isset($_GET['del']))
	{
	$pagetype = 'Office of the President Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/office">Office of the President Admin</a> &middot; Delete Entry</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/office">Office of the President Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office>';
		}
	else
		{
		$subresult = mysql_query("SELECT office_img FROM office WHERE office_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$office_img=$subrow['office_img'];
			$path= '../assets/img/office/'. $office_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/office/tn-'. $office_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		
				
		$result = mysql_query("DELETE FROM office WHERE office_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/office">Office of the President Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office>';
		}
	}
	
	

elseif(isset($_GET['del_img']))
	{
	$pagetype = 'Office of the President Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/office">Office of the President Admin</a> &middot; Delete Entry Image</h1>';
	$del_img = $_GET['del_img'];
	if (empty($_GET['del_img']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/office">Office of the President Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office>';
		}
	else
		{	
		$subresult = mysql_query("SELECT office_img FROM office WHERE office_id='$del_img'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$office_img=$subrow['office_img'];
			$path= '../assets/img/office/'. $office_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/office/tn-'. $office_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE office SET office_img='' WHERE office_id='$del_img'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/office">Office of the President Admin Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office>';
		
		}
	}

	
	

else
	{
	$pagetype = 'Office of the President Admin';
	echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="'.$PHP_SELF.'?edit=4'.'"> Edit Entry</a></h1><div class="clear">&nbsp;</div><p></p>';
	
	//echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="'.$PHP_SELF.'?edit=3'.'"> Edit Entry</a><a href="?add">Add</a></h1><div class="clear">&nbsp;</div><p></p>';
	
	$result = mysql_query("SELECT office_id, office_name, office_full, office_img FROM office ORDER BY office_name DESC") or die(mysql_error());
	
	
	if(mysql_num_rows($result)==0)
		{
		echo '<hr/><p>There are no office entries.</p>';
		}
	else
		{
		
		while($row = mysql_fetch_array($result))
			{
			$office_id=$row['office_id'];
			$office_name=$row['office_name'];
			$office_full=strip_tags(html_entity_decode($row['office_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
			$office_img=$row['office_img'];
	
				
			echo '<hr>';
			echo '<h3>';
			if(!empty($office_img))
				{
				echo '<img src="/assets/img/icon-photo.gif"> ';
				} else {}
			echo '</h3>';
			echo $office_name;
			echo $office_full;
			
			//echo '<small><a href="'.$PHP_SELF.'?edit='.$office_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$office_id.'">Delete</a></small> <br/><br/>';	
				
			
				
			}
		}
		
	}





include '../'.$foot; ?>