<?php include '../core/base.php'; $div="panel";




		
if(isset($_GET['add']))
	{
	$pagetitle = "Add Image";
	include '../'.$head; check_logged(); check_access(5);
	$page_id = $_GET['add'];
	if (isset($_POST['submit']) && !empty($_FILES["img_name"]["name"]))
		{
		if (!empty($_FILES["img_name"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["img_name"]["tmp_name"];
			$img_size = ($_FILES["img_name"]["size"] / 1024);
			$file_name = basename($_FILES["img_name"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$img_name = $img_md5.'.'.$file_ext;
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$img_name_target = "../assets/img/panel/".$img_name;
				move_uploaded_file($_FILES["img_name"]["tmp_name"],$img_name_target);
				$page_id = htmlentities(($_POST['page_id']), ENT_QUOTES, 'ISO-8859-1');
				$user_id = htmlentities(($_POST['user_id']), ENT_QUOTES, 'ISO-8859-1');
				square_crop('../assets/img/panel/'.$img_name.'', '../assets/img/panel/thumb-'.$img_name.'', 150);
				$result = mysql_query("INSERT INTO img (img_name, img_date, page_id, user_id) VALUES ('$img_name', NOW(), '$page_id', '$user_id')") or die(mysql_error());
				echo '<h1>'.$pagetitle.'</h1><hr><p>Image was added successfully! You will be redirected to the <a href="/panel/image">Images</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/image>';
				}
			else
				{
				echo '<h1>'.$pagetitle.'</h1><hr><p>ONLY images under 2MB are accepted for upload. Please try again. You will be redirected to the <a href="/panel/image">Images</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/image>';
				}
			}
		}
	else
		{ echo '<h1>'.$pagetitle.'</h1><hr>';
		?>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add" enctype="multipart/form-data">
		<input type="hidden" name="user_id" value="<? echo $_SESSION['user_id'];?>">
		
		<fieldset><legend>Image:</legend>
		<ul><li><input name="img_name" type="file" /></li></ul></fieldset>
		
		<fieldset><legend>Page:</legend>
		<ul><li><select name="page_id"><?php
		$result = mysql_query("SELECT page_id, page_name FROM page ORDER BY page_name ASC") or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{
			echo '<option value="' . $row['page_id'] . '"';
			if($row['page_id']==$page_id)
				{ echo ' selected'; }		
			echo '>' . $row['page_name'] . '</option>';
			} ?></select></li>
		<li><button type="submit" name="submit">Save</button></li></ul></fieldset>
		
		</form>
<?php	}
	}


elseif(isset($_GET['remove']))
	{
	$pagetitle = "Remove Image";
	include '../'.$head; check_logged(); check_access(5);
	if (isset($_POST['submit']) && !empty($_POST['page_id']) && !empty($_POST['page_img']))
		{
		$page_id = htmlentities(($_POST['page_id']), ENT_QUOTES, 'utf-8');
		$page_img = htmlentities(($_POST['page_img']), ENT_QUOTES, 'utf-8');
		if($page_img=='page_banner')
			{
			$subresult = mysql_query("SELECT page_banner FROM page WHERE page_id='$page_id'") or die(mysql_error());
			while($subrow = mysql_fetch_array($subresult))
				{
				$file=$subrow['page_banner'];
				$path= '../assets/img/banner/'. $file .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
				}
			$result = mysql_query("UPDATE page SET page_banner='' WHERE page_id='$page_id'");
			echo ' <p>Deleted successfully! You will be redirected to the <a href="/panel/image">Images</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/image>';
			}
		elseif($page_img=='page_img1')
			{
			$subresult = mysql_query("SELECT page_img1 FROM page WHERE page_id='$page_id'") or die(mysql_error());
			while($subrow = mysql_fetch_array($subresult))
				{
				$file=$subrow['page_img1'];
				$path= '../assets/img/sidebar/'. $file .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
				}
			$result = mysql_query("UPDATE page SET page_img1='' WHERE page_id='$page_id'");
			echo ' <p>Deleted successfully! You will be redirected to the <a href="/panel/image">Images</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/image>';
			}
		elseif($page_img=='page_img2')
			{
			$subresult = mysql_query("SELECT page_img2 FROM page WHERE page_id='$page_id'") or die(mysql_error());
			while($subrow = mysql_fetch_array($subresult))
				{
				$file=$subrow['page_img2'];
				$path= '../assets/img/sidebar/'. $file .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
				}
			$result = mysql_query("UPDATE page SET page_img2='' WHERE page_id='$page_id'");
			echo ' <p>Deleted successfully! You will be redirected to the <a href="/panel/image">Images</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/image>';
			}
		else
			{
			echo '<meta http-equiv=Refresh content=0;url=/panel/image>';
			}
		}
	else
		{ echo '<h1>'.$pagetitle.'</h1><hr>';
		?>
		<form method="post" action="<?php echo $PHP_SELF; ?>?remove" enctype="multipart/form-data">
		<input type="hidden" name="user_id" value="<? echo $_SESSION['user_id'];?>">
		
		<fieldset><legend>Page:</legend>
		<ul><li><select name="page_id"><option value=""></option><?php
		$result = mysql_query("SELECT page_id, page_name FROM page ORDER BY page_name ASC") or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{
			echo '<option value="' . $row['page_id'] . '">' . $row['page_name'] . '</option>';
			} ?></select></li></ul></fieldset>
		
		<fieldset><legend>Image:</legend>
		<ul><li><select name="page_img">
		<option value=""></option>
		<option value="page_banner">Banner</option>
		<option value="page_img1">#1</option>
		<option value="page_img2">#2</option>
		</select></li>
		<li><button type="submit" name="submit">Remove</button></li></ul></fieldset>
		
		</form>
<?php	}
	}


elseif(isset($_GET['edit']))
	{
	$pagetitle = "Edit Image";
	include '../'.$head; check_logged(); check_access(5);
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM img WHERE img_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_img_name = $row["img_name"];
	$edit_page_id = $row["page_id"];
	if (empty($_GET['edit']))
		{ echo '<h1>Error</h1>Image entry must be selected to be edited. You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>'; }
	else
		{
		echo '<h1>Edit Image</h1>';
		if (isset($_POST) && !empty($_POST['page_id']))
			{
			$page_id = htmlentities(($_POST['page_id']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE img SET img_date=NOW(), page_id='$page_id', user_id='$user_id' WHERE img_id='$edit' ");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>';
			}
		else
			{ ?>
			<div class="edit"><img src="/assets/img/panel/<?php echo $edit_img_name; ?>"></div>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>">
			<input type="hidden" name="user_id" value="<? echo $_SESSION['user_id'];?>">		
			<fieldset><legend>Page:</legend>
			<ul><li><select name="page_id"><?php
			$result = mysql_query("SELECT page_id, page_name FROM page ORDER BY page_name ASC") or die(mysql_error());
			while($row = mysql_fetch_array($result))
				{
				echo '<option value="' . $row['page_id'] . '"';
				if($row['page_id']==$edit_page_id)
					{ echo ' selected'; }		
				echo '>' . $row['page_name'] . '</option>';
				} ?></select></li>
			<li><button type="submit" name="submit">Save</button></li></ul></fieldset>
			
			</form>
<?php
			}
		}
	}



elseif(isset($_GET['one']))
	{
	$pagetitle = "Save Image as #1";
	include '../'.$head; check_logged(); check_access(5);
	$one = $_GET['one'];
	$result = mysql_query("SELECT img.img_name, img.img_id, page.page_id FROM img, page WHERE page.page_id=img.page_id AND img_id='$one' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$one_img_name = $row["img_name"];
	$one_page_id = $row["page_id"];
	$one_img_name2 = '1-'.$one_img_name;
	if (empty($_GET['one']))
		{ echo '<h1>Error</h1>Image entry must be selected to be edited. You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>'; }
	else
		{
		echo '<h1>Save Image as #1</h1>';
		if (isset($_POST) && !empty($_POST['user_id']))
			{
			$resizeObj = new resize('../assets/img/panel/'.$one_img_name); // *** 1) Initialise / load image
			$resizeObj -> resizeImage(275, 275, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj -> saveImage('../assets/img/sidebar/1-'.$one_img_name, 100); // *** 3) Save image
			
			$result = mysql_query("UPDATE page SET page_img1='$one_img_name2' WHERE page_id='$one_page_id' ") or die(mysql_error());
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>';
			}
		else
			{ ?>
			<div class="edit"><img src="/assets/img/panel/<?php echo $one_img_name; ?>"></div>
			<form method="post" action="<?php echo $PHP_SELF; ?>?one=<?php echo $one; ?>">
			<input type="hidden" name="user_id" value="<? echo $_SESSION['user_id'];?>">
			<input type="hidden" name="page_id" value="<? echo $one_page_id;?>">
			<fieldset>
			<ul><li><button type="submit" name="submit">Save</button></li></ul>
			</fieldset>
			
			</form>
<?php
			}
		}
	}




elseif(isset($_GET['two']))
	{
	$pagetitle = "Save Image as #2";
	include '../'.$head; check_logged(); check_access(5);
	$two = $_GET['two'];
	$result = mysql_query("SELECT img.img_name, img.img_id, page.page_id FROM img, page WHERE page.page_id=img.page_id AND img_id='$two' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$two_img_name = $row["img_name"];
	$two_page_id = $row["page_id"];
	$two_img_name2 = '2-'.$two_img_name;
	if (empty($_GET['two']))
		{ echo '<h1>Error</h1>Image entry must be selected to be edited. You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>'; }
	else
		{
		echo '<h1>Save Image as #2</h1>';
		if (isset($_POST) && !empty($_POST['user_id']))
			{
			$resizeObj = new resize('../assets/img/panel/'.$two_img_name); // *** 1) Initialise / load image
			$resizeObj -> resizeImage(380, 380, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj -> saveImage('../assets/img/sidebar/2-'.$two_img_name, 100); // *** 3) Save image
			
			$result = mysql_query("UPDATE page SET page_img2='$two_img_name2' WHERE page_id='$two_page_id' ") or die(mysql_error());
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>';
			}
		else
			{ ?>
			<div class="edit"><img src="/assets/img/panel/<?php echo $two_img_name; ?>"></div>
			<form method="post" action="<?php echo $PHP_SELF; ?>?two=<?php echo $two; ?>">
			<input type="hidden" name="user_id" value="<? echo $_SESSION['user_id'];?>">
			<input type="hidden" name="page_id" value="<? echo $two_page_id;?>">
			<fieldset>
			<ul><li><button type="submit" name="submit">Save</button></li></ul>
			</fieldset>
			
			</form>
<?php
			}
		}
	}




elseif(isset($_GET['banner']))
	{
	$pagetitle = "Save Image as Banner";
	include '../'.$head; check_logged(); check_access(5);
	$banner = $_GET['banner'];
	$result = mysql_query("SELECT img.img_name, img.img_id, page.page_id FROM img, page WHERE page.page_id=img.page_id AND img_id='$banner' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$banner_img_name = $row["img_name"];
	$banner_page_id = $row["page_id"];
	if (empty($_GET['banner']))
		{ echo '<h1>Error</h1>Image entry must be selected to be edited. You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>'; }
	else
		{
		echo '<h1>Save Image as Banner</h1>';
		if (isset($_POST) && !empty($_POST['user_id']))
			{
			$resizeObj = new resize('../assets/img/panel/'.$banner_img_name); // *** 1) Initialise / load image
			$resizeObj -> resizeImage(820, 173, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj -> saveImage('../assets/img/banner/'.$banner_img_name, 100); // *** 3) Save image
			
			$resizeObj2 = new resize('../assets/img/panel/'.$banner_img_name); // *** 1) Initialise / load image
			$resizeObj2 -> resizeImage(875, 225, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj2 -> saveImage('../assets/img/banner/1-'.$banner_img_name, 100); // *** 3) Save image
			
			$resizeObj3 = new resize('../assets/img/panel/'.$banner_img_name); // *** 1) Initialise / load image
			$resizeObj3 -> resizeImage(750, 158, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj3 -> saveImage('../assets/img/banner/mobile-'.$banner_img_name, 100); // *** 3) Save image
			
			$resizeObj4 = new resize('../assets/img/panel/'.$banner_img_name); // *** 1) Initialise / load image
			$resizeObj4 -> resizeImage(75, 150, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj4 -> saveImage('../assets/img/banner/thumb-'.$banner_img_name, 100); // *** 3) Save image
			
			$result = mysql_query("UPDATE page SET page_banner='$banner_img_name' WHERE page_id='$banner_page_id' ") or die(mysql_error());
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>';
			}
		else
			{ ?>
			<div class="edit"><img src="/assets/img/panel/<?php echo $banner_img_name; ?>"></div>
			<form method="post" action="<?php echo $PHP_SELF; ?>?banner=<?php echo $banner; ?>">
			<input type="hidden" name="user_id" value="<? echo $_SESSION['user_id'];?>">
			<input type="hidden" name="page_id" value="<? echo $one_page_id;?>">
			<fieldset>
			<ul><li><button type="submit" name="submit">Save</button></li></ul>
			</fieldset>
			
			</form>
<?php
			}
		}
	}
	
	
	
	
	
elseif(isset($_GET['del']))
	{
	$pagetype = "Delete Image";
	include '../'.$head; check_logged(); check_access(5);
	$del = $_GET['del'];
	$row = mysql_fetch_assoc($result);
	if (empty($_GET['del']))
		{ echo '<h1>Error</h1><p>Image must be selected to be deleted. You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>';
		}
	else
		{
		$result = mysql_query("SELECT img_id FROM img WHERE img_id='$del' LIMIT 1") or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			echo '<h1>Error</h1><p>Image must be selected to be deleted. You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>';
			}
		else
			{
			$subresult = mysql_query("SELECT img_name FROM img WHERE '$del'=img_id") or die(mysql_error());
			while($subrow = mysql_fetch_array($subresult))
				{
				$img_name=$subrow['img_name'];
				echo '<h1>Delete Image</h1>';
				$path= '../assets/img/panel/'. $img_name .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
				$path2= '../assets/img/panel/thumb-'. $img_name .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
				$result = mysql_query("DELETE FROM img WHERE img_id='$del'");
				echo '<p>Deleted! You will be redirected to <a href="/panel/image">Images</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/image>';
				}
			}
		}
	}


else
	{
	$pagetitle = "Image Admin";
	include '../'.$head; check_logged(); check_access(5);
	echo '<h1 class="l">'.$pagetitle.'</h1><h1 class="r"><a href="?add">Add</a> &middot; <a href="?remove">Remove from Page</a></h1><div class="clear">&nbsp;</div>';
	$result = mysql_query("SELECT * FROM img ORDER BY page_id, img_date DESC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no image entries.</p>';
		}
	else
		{
		echo '<hr><div class="image">';
		while($row = mysql_fetch_array($result))
			{
			$img_id=$row['img_id'];
			$img_name=$row['img_name'];
			$img_date=convert_date($row['img_date']);
			$img_page_id=$row['page_id'];
			$img_user_id=$row['user_id'];
			echo '<p><a href="'.$PHP_SELF.'?edit='.$img_id.'"><img src="/assets/img/panel/thumb-'.$img_name.'"></a><br><a href="'.$PHP_SELF.'?edit='.$img_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$img_id.'">Delete</a><br>';
			
			
			$subresult = mysql_query("SELECT page_url, page_name, page_id FROM page WHERE '$img_page_id'=page_id") or die(mysql_error());
			while($subrow = mysql_fetch_array($subresult))
				{
				$img_page_id=$subrow['page_id'];
				$img_page_name=$subrow['page_name'];
				$img_page_url=$subrow['page_url'];
				echo '<span><strong><a href="/'.$img_page_url.'">'.$img_page_name.'</a><br><a href="'.$PHP_SELF.'?banner='.$img_id.'">Banner</a> &middot; <a href="'.$PHP_SELF.'?one='.$img_id.'">#1</a> &middot; <a href="'.$PHP_SELF.'?two='.$img_id.'">#2</a></strong></span>';
				}
			
			echo '<small>'.$img_date.'<br>Edited by';
			$subresult = mysql_query("SELECT user_login, user_name_f, user_name_l FROM user WHERE '$img_user_id'=user_id") or die(mysql_error());
			while($subrow = mysql_fetch_array($subresult))
				{
				$img_user_login=$subrow['user_login'];
				$img_user_name_f=$subrow['user_name_f'];
				$img_user_name_l=$subrow['user_name_l'];
				echo ' <a href="/profile/'.$img_user_login.'">'.$img_user_name_f.' '.$img_user_name_l.'</a></small></p>';
				}				
			}
		echo '<div class="clear">&nbsp;</div></div>';
		}
	}





include '../'.$foot; ?>