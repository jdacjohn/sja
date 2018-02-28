<?php $pagetitle = "School Administration Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);



//school_admin_name, school_admin_full, school_admin_img FROM school_admin 
if(isset($_GET['add']))
	{
	$pagetype = 'School Administration Admin &middot; Add Entry';
	echo '<h1><a href="/panel/school-admin">School Administration Admin</a> &middot; Add Entry</h1>';
	if (isset($_POST) && !empty($_POST['school_admin_name']))
		{
		$school_admin_name = htmlentities(($_POST['school_admin_name']), ENT_QUOTES, 'utf-8');
		$school_admin_full = htmlentities(($_POST['school_admin_full']), ENT_QUOTES, 'utf-8');			
		if (!empty($_FILES["school_admin_img"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["school_admin_img"]["tmp_name"];
			$img_size = ($_FILES["school_admin_img"]["size"] / 1024);
			$file_name = basename($_FILES["school_admin_img"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$school_admin_img = $img_md5.'.'.$file_ext;
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$school_admin_img = $img_md5.'.'.$file_ext;
				$school_admin_img_target = "../assets/img/school-admin/".$school_admin_img;
				move_uploaded_file($_FILES["school_admin_img"]["tmp_name"],$school_admin_img_target);
				$resizeObj = new resize('../assets/img/school-admin/'.$school_admin_img); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/school-admin/tn-'.$school_admin_img, 100); // *** 3) Save image
				}
			else
				{
				$school_admin_img = '';
				}
			}
		else
			{
			$school_admin_img = '';
			}
			
		
		if (!empty($_FILES["school_admin_img2"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["school_admin_img2"]["tmp_name"];
			$img_size = ($_FILES["school_admin_img2"]["size"] / 1024);
			$file_name = basename($_FILES["school_admin_img2"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$school_admin_img2 = $img_md5.'.'.$file_ext;
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$school_admin_img2 = $img_md5.'.'.$file_ext;
				$school_admin_img2_target = "../assets/img/school-admin/".$school_admin_img2;
				move_uploaded_file($_FILES["school_admin_img2"]["tmp_name"],$school_admin_img2_target);
				$resizeObj = new resize('../assets/img/school-admin/'.$school_admin_img2); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/school-admin/tn-'.$school_admin_img2, 100); // *** 3) Save image
				}
			else
				{
				$school_admin_img2 = '';
				}
			}
		else
			{
			$school_admin_img2 = '';
			}	
		
			
		$result = mysql_query("INSERT INTO school_admin (school_admin_name, school_admin_full, school_admin_img) VALUES ('$school_admin_name','$school_admin_full','$school_admin_img','$school_admin_img2')") or die(mysql_error());
		
		echo '<hr><p>'.$school_admin_name.' was successfully added! You will be redirected to <a href="/panel/school-admin">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin>';
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">			
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="school_admin_name" value="<?= @$_POST['school_admin_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>Entry:</legend>
		<ul><li><textarea name="school_admin_full" rows="25" class="widgEditor"><?= @$_POST['about_full']?></textarea></li></ul>
	</fieldset>
	<fieldset>
		<legend>Image:</legend>
		<ul><li><input name="school_admin_img" type="file" /></li></ul>
	</fieldset>
	<fieldset>
		<legend>Image 2:</legend>
		<ul><li><input name="school_admin_img2" type="file" /></li>
		<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}
	


	
	
	
	
elseif(isset($_GET['edit']))
	{
	$pagetype = 'School Administration Admin &middot; Edit Entry';
	echo '<h1><a href="/panel/school-admin">School Administration Admin</a> &middot; Edit Entry</h1>';
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM school_admin WHERE school_admin_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_school_admin_name = $row["school_admin_name"];
	$edit_school_admin_full = $row["school_admin_full"];
	$edit_school_admin_img = $row["school_admin_img"];
	$edit_school_admin_img2 = $row["school_admin_img2"];
	
	if (empty($_GET['edit']))
		{
		echo '<hr>Entry must be selected to be edited. You will be redirected to <a href="/panel/school-admin">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['school_admin_name']))
			{
			$school_admin_name = htmlentities(($_POST['school_admin_name']), ENT_QUOTES, 'utf-8');
			$school_admin_full = htmlentities(($_POST['school_admin_full']), ENT_QUOTES, 'utf-8');
			
			if (!empty($_FILES["school_admin_img"]["name"]))
				{
				$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
				$img_tmp = $_FILES["school_admin_img"]["tmp_name"];
				$img_size = ($_FILES["school_admin_img"]["size"] / 1024);
				$file_name = basename($_FILES["school_admin_img"]["name"]);
				$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
				$school_admin_img = $img_md5.'.'.$file_ext;
				$max_file = '2048';
				if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
					{
					$school_admin_img = $img_md5.'.'.$file_ext;
					$school_admin_img_target = "../assets/img/school-admin/".$school_admin_img;
					move_uploaded_file($_FILES["school_admin_img"]["tmp_name"],$school_admin_img_target);
					$resizeObj = new resize('../assets/img/school-admin/'.$school_admin_img); // *** 1) Initialise / load image
					$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> saveImage('../assets/img/school-admin/tn-'.$school_admin_img, 100); // *** 3) Save image
					}
				else
					{
					$school_admin_img = $edit_school_admin_img;
					}
				}
			else
				{
				$school_admin_img = $edit_school_admin_img;
				} // End of Img 
				
				
				
			if (!empty($_FILES["school_admin_img2"]["name"]))
				{
				$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
				$img_tmp = $_FILES["school_admin_img2"]["tmp_name"];
				$img_size = ($_FILES["school_admin_img2"]["size"] / 1024);
				$file_name = basename($_FILES["school_admin_img2"]["name"]);
				$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
				$school_admin_img2 = $img_md5.'.'.$file_ext;
				$max_file = '2048';
				if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
					{
					$school_admin_img2 = $img_md5.'.'.$file_ext;
					$school_admin_img2_target = "../assets/img/school-admin/".$school_admin_img2;
					move_uploaded_file($_FILES["school_admin_img2"]["tmp_name"],$school_admin_img2_target);
					$resizeObj = new resize('../assets/img/school-admin/'.$school_admin_img2); // *** 1) Initialise / load image
					$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> saveImage('../assets/img/school-admin/tn-'.$school_admin_img2, 100); // *** 3) Save image
					}
				else
					{
					$school_admin_img2 = $edit_school_admin_img2;
					}
				}
			else
				{
				$school_admin_img2 = $edit_school_admin_img2;
				} // End of Img 
			
			
				
			
			

			$result = mysql_query("UPDATE school_admin SET school_admin_name='$school_admin_name', school_admin_full='$school_admin_full', school_admin_img='$school_admin_img', school_admin_img2='$school_admin_img2' WHERE school_admin_id='$edit' ");
			
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/school-admin">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin>';
			}
		else
			{ ?>
			<hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" enctype="multipart/form-data">			
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="school_admin_name" value="<?php echo $edit_school_admin_name; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>Entry:</legend>
				<ul><li><textarea name="school_admin_full" rows="25" class="widgEditor"><?php echo $edit_school_admin_full; ?></textarea></li></ul>
			</fieldset>
			<fieldset>
				<legend>Image:</legend>
				<ul><li>
				<?php
				if(!empty($edit_school_admin_img))
					{
					echo '<input type="hidden" name="school_admin_img" value="'.$edit_school_admin_img.'">';
					echo '<img src="/assets/img/school-admin/tn-'.$edit_school_admin_img.'">';
					echo '<br><a href="?del_img='.$edit.'">Delete Image</a>';
					}
				else
					{
					echo '<input name="school_admin_img" type="file" />';
					}
				?>
				</li>
			</fieldset>
			<fieldset>
				<legend>Image 2:</legend>
				<ul><li>
				<?php
				
				if(!empty($edit_school_admin_img2))
					{
					echo '<input type="hidden" name="school_admin_img2" value="'.$edit_school_admin_img2.'">';
					echo '<img src="/assets/img/school-admin/tn-'.$edit_school_admin_img2.'">';
					echo '<br><a href="?del_img2='.$edit.'">Delete Image</a>';
					}
				else
					{
					echo '<input name="school_admin_img2" type="file" />';
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
	$pagetype = 'School Administration Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/school-admin">School Administration Admin</a> &middot; Delete Entry</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/school-admin">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin>';
		}
	else
		{
		$subresult = mysql_query("SELECT school_admin_img FROM school_admin WHERE school_admin_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$school_admin_img=$subrow['school_admin_img'];
			$path= '../assets/img/school-admin/'. $school_admin_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/school-admin/tn-'. $school_admin_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
			
		
		$subresult2 = mysql_query("SELECT school_admin_img2 FROM school_admin WHERE school_admin_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$school_admin_img2=$subrow['school_admin_img2'];
			$path= '../assets/img/school-admin/'. $school_admin_img2 .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/school-admin/tn-'. $school_admin_img2 .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
			
		
				
		$result = mysql_query("DELETE FROM school_admin WHERE school_admin_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/school-admin">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin>';
		}
	}
	
	

elseif(isset($_GET['del_img']))
	{
	$pagetype = 'School Administration Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/school-admin">School Administration Admin</a> &middot; Delete Entry Image</h1>';
	$del_img = $_GET['del_img'];
	if (empty($_GET['del_img']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/school-admin">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin>';
		}
	else
		{	
		$subresult = mysql_query("SELECT school_admin_img FROM school_admin WHERE school_admin_id='$del_img'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$school_admin_img=$subrow['school_admin_img'];
			$path= '../assets/img/school-admin/'. $school_admin_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/school-admin/tn-'. $school_admin_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE school_admin SET school_admin_img='' WHERE school_admin_id='$del_img'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/school-admin">School Administration Admin Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin>';
		
		}
	}
	

elseif(isset($_GET['del_img2']))
	{
	$pagetype = 'School Administration Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/school-admin">School Administration Admin</a> &middot; Delete Entry Image</h1>';
	$del_img2 = $_GET['del_img2'];
	if (empty($_GET['del_img2']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/school-admin">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin>';
		}
	else
		{	
		$subresult2 = mysql_query("SELECT school_admin_img2 FROM school_admin WHERE school_admin_id='$del_img2'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult2))
			{
			$school_admin_img2=$subrow['school_admin_img2'];
			$path= '../assets/img/school-admin/'. $school_admin_img2 .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/school-admin/tn-'. $school_admin_img2 .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE school_admin SET school_admin_img2='' WHERE school_admin_id='$del_img2'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/school-admin">School Administration Admin Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin>';
		
		}
	}

	
	

else
	{
	$pagetype = 'School Administration Admin';
	echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="'.$PHP_SELF.'?edit=1'.'"> Edit Entry</a></h1><div class="clear">&nbsp;</div><p></p>';
	
	//echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="'.$PHP_SELF.'?edit=1'.'"> Edit Entry</a><a href="?add">Add</a></h1><div class="clear">&nbsp;</div><p></p>';
	
	$result = mysql_query("SELECT school_admin_id, school_admin_name, school_admin_full, school_admin_img, school_admin_img2 FROM school_admin ORDER BY school_admin_name DESC") or die(mysql_error());
	
	
	if(mysql_num_rows($result)==0)
		{
		echo '<hr/><p>There are no entries.</p>';
		}
	else
		{
		
		while($row = mysql_fetch_array($result))
			{
			$school_admin_id=$row['school_admin_id'];
			$school_admin_name=$row['school_admin_name'];
			$school_admin_full=strip_tags(html_entity_decode($row['school_admin_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
			$school_admin_img=$row['school_admin_img'];
			$school_admin_img2=$row['school_admin_img2'];
	
				
			echo '<hr>';
			echo '<h3>';
			if(!empty($school_admin_img))
				{
				echo '<img src="/assets/img/icon-photo.gif"> ';
				} else {}
			if(!empty($school_admin_img2))
				{
				echo '<img src="/assets/img/icon-photo.gif"> ';
				} else { echo '<p>Photo did not upload</p>'; }	
			echo '</h3>';
			echo $school_admin_name;
			echo $school_admin_full;
			
			//echo '<small><a href="'.$PHP_SELF.'?edit='.$school_admin_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$school_admin_id.'">Delete</a></small> <br/><br/>';	
				
			
				
			}
		}
		
	}





include '../'.$foot; ?>