<?php $pagetitle = "Directory Listing Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);



//directory_name, directory_full, directory_email, directory_img FROM directory 
if(isset($_GET['add']))
	{
	$pagetype = 'Directory Listing Admin &middot; Add Entry';
	echo '<h1><a href="/panel/directory">Directory Listing Admin</a> &middot; Add Entry</h1>';
	if (isset($_POST) && !empty($_POST['directory_name']))
		{
		if (!empty($_FILES["directory_img"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["directory_img"]["tmp_name"];
			$img_size = ($_FILES["directory_img"]["size"] / 1024);
			$file_name = basename($_FILES["directory_img"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$directory_img = $img_md5.'.'.$file_ext;
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$directory_img = $img_md5.'.'.$file_ext;
				$directory_img_target = "../assets/img/directory/".$directory_img;
				move_uploaded_file($_FILES["directory_img"]["tmp_name"],$directory_img_target);
				$resizeObj = new resize('../assets/img/directory/'.$directory_img); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/directory/tn-'.$directory_img, 100); // *** 3) Save image
				}
			else
				{
				$directory_img = '';
				}
			}
		else
			{
			$directory_img = '';
			}
		$directory_name = htmlentities(($_POST['directory_name']), ENT_QUOTES, 'utf-8');
		$directory_full = htmlentities(($_POST['directory_full']), ENT_QUOTES, 'utf-8');
		$directory_email = htmlentities(($_POST['directory_email']), ENT_QUOTES, 'utf-8');
		$directory_chair = htmlentities(($_POST['directory_chair']), ENT_QUOTES, 'utf-8');
		$directory_cat_id = htmlentities(($_POST['directory_cat_id']), ENT_QUOTES, 'utf-8');
		if(!empty($_FILES['directory_cv']['name']))
			{
			$directory_cv = date("mdy")."-".preg_replace("([^a-z0-9._-])",'',strtolower(str_replace(' ', '', $_FILES["directory_cv"]["name"])));
			$directory_cv_target = "../assets/pdf/directory-cv/".$directory_cv;
			move_uploaded_file($_FILES["directory_cv"]["tmp_name"],$directory_cv_target);
			}
		else
			{
			$directory_cv='';
			}
			
			
		
		$result = mysql_query("INSERT INTO directory (directory_name, directory_full, directory_email, directory_chair, directory_img, directory_cv, directory_cat_id) VALUES ('$directory_name','$directory_full','$directory_email', '$directory_chair','$directory_img','$directory_cv','$directory_cat_id')") or die(mysql_error());
		
		echo '<hr><p>'.$directory_name.' was successfully added! You will be redirected to <a href="/panel/directory">Directory Listing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory>';
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">
	<fieldset>
	    <legend>Name:</legend>
	    <ul><li><input name="directory_name" value="<?= @$_POST['directory_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="directory_full" value="<?= @$_POST['directory_full']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Email:</legend>
	    <ul><li><input name="directory_email" value="<?= @$_POST['directory_email']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>Category:</legend>
		<ul><li><select name="directory_cat_id">
		<option value="Choose a Category">Choose a Category</option>
		<?php
		$result = mysql_query("SELECT * FROM directory_cat ORDER BY directory_cat_name ASC") or die(mysql_error());
		while($row = mysql_fetch_array( $result ))
			{
			$directory_cat_id=$row['directory_cat_id'];
			$directory_cat_name=$row['directory_cat_name'];
			echo '<option value="'.$directory_cat_id.'">'.$directory_cat_name.'</option>';
			}
		?></select></li>
		</ul>
	</fieldset>
	<fieldset>
		<legend>Chair Member:</legend>
		<ul><li><select name="directory_chair">
		<option value="Choose One">Choose One</option>
		<option value="1">Yes</option>
		<option value="0">No</option>
		</select></li>
		</ul>
	</fieldset>
	<fieldset>
		<legend>Image:</legend>
		<ul><li><input name="directory_img" type="file" /></li></ul>
	</fieldset>
	<fieldset>
		<legend>CV:</legend>
		<ul><li><input name="directory_cv" type="file" /></li>
	    <li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}
	
	
	


// Add Category
	
elseif(isset($_GET['add_cat']))
	{
	$pagetype = 'Directory Listing Admin &middot; Add Category';
	echo '<h1><a href="/panel/directory?cat">Categories</a> &middot; Add Category</h1>';
	
	if (isset($_POST) && !empty($_POST['directory_cat_name']))
		{
		$directory_cat_name = htmlentities(($_POST['directory_cat_name']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO directory_cat (directory_cat_name) VALUES ('$directory_cat_name')");
		echo '<p>'.$directory_cat_name.' was successfully added! You will be redirected to <a href="/panel/directory/?cat">directory Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory/?cat>';
		}
	else
		{
	?><hr/>
	<div class="main">
	<form method="post" action="?add_cat">
	<fieldset>
		<legend>Category Name:</legend>
		<ul><li><input name="directory_cat_name" value="<?= @$_POST['directory_cat_name']?>" type="text"></li></ul>	
	</fieldset>
	<fieldset>
		<ul><li class="login"><input type="submit" value="Save" name="submit"/></li></ul>
	</fieldset>
	</form>
	</div> <!-- Close Main div -->
<?php
		}
	}	




	
	
	
	
elseif(isset($_GET['edit']))
	{
	$pagetype = 'Directory Listing Admin &middot; Edit Entry';
	echo '<h1><a href="/panel/directory">Directory Listing Admin</a> &middot; Edit Entry</h1>';
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM directory WHERE directory_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_directory_name = $row["directory_name"];
	$edit_directory_full = $row["directory_full"];
	$edit_directory_email = $row["directory_email"];
	$edit_directory_chair = $row["directory_chair"];
	$edit_directory_img = $row["directory_img"];
	$edit_directory_cv = $row["directory_cv"];
	$edit_directory_cat_id = $row["directory_cat_id"];
	if (empty($_GET['edit']))
		{
		echo '<hr>Entry must be selected to be edited. You will be redirected to <a href="/panel/directory">Directory Listing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['directory_name']))
			{
			$directory_name = htmlentities(($_POST['directory_name']), ENT_QUOTES, 'utf-8');
			$directory_full = htmlentities(($_POST['directory_full']), ENT_QUOTES, 'utf-8');
			$directory_email = htmlentities(($_POST['directory_email']), ENT_QUOTES, 'utf-8');
			$directory_chair = htmlentities(($_POST['directory_chair']), ENT_QUOTES, 'utf-8');
			$directory_cat_id = htmlentities(($_POST['directory_cat_id']), ENT_QUOTES, 'utf-8');
			if (!empty($_FILES["directory_img"]["name"]))
				{
				$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
				$img_tmp = $_FILES["directory_img"]["tmp_name"];
				$img_size = ($_FILES["directory_img"]["size"] / 1024);
				$file_name = basename($_FILES["directory_img"]["name"]);
				$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
				$directory_img = $img_md5.'.'.$file_ext;
				$max_file = '2048';
				if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
					{
					$directory_img = $img_md5.'.'.$file_ext;
					$directory_img_target = "../assets/img/directory/".$directory_img;
					move_uploaded_file($_FILES["directory_img"]["tmp_name"],$directory_img_target);
					$resizeObj = new resize('../assets/img/directory/'.$directory_img); // *** 1) Initialise / load image
					$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> saveImage('../assets/img/directory/tn-'.$directory_img, 100); // *** 3) Save image
					}
				else
					{
					$directory_img = $edit_directory_img;
					}
				}
			else
				{
				$directory_img = $edit_directory_img;
				} // End of Img 
			
			if(!empty($_FILES['directory_cv']['name']))
				{
				$directory_cv = date("mdy")."-".preg_replace("([^a-z0-9._-])",'',strtolower(str_replace(' ', '', $_FILES["directory_cv"]["name"])));
				$directory_cv_target = "../assets/pdf/directory-cv/".$directory_cv;
				move_uploaded_file($_FILES["directory_cv"]["tmp_name"],$directory_cv_target);
				}
			else
				{
				$directory_cv = $edit_directory_cv;
				}
			
			
			
			$result = mysql_query("UPDATE directory SET directory_name='$directory_name', directory_full='$directory_full', directory_email='$directory_email', directory_chair='$directory_chair',directory_img='$directory_img', directory_cv='$directory_cv', directory_cat_id='$directory_cat_id' WHERE directory_id='$edit'");
			
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/directory">Directory Listing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory>';
			}
		else
			{ ?>
			<hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" enctype="multipart/form-data">			
			<fieldset>
			    <legend>Name:</legend>
			    <ul><li><input name="directory_name" value="<?php echo $edit_directory_name; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="directory_full" value="<?php echo $edit_directory_full; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>Email:</legend>
				<ul><li><input name="directory_email" value="<?php echo $edit_directory_email; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Category:</legend>
			    <ul><li><select name="directory_cat_id">
			    <option value="Choose a Category">Choose a Category</option>
			    <!-- <option value="">&nbsp;</option> -->
			    <?php
			    $result = mysql_query("SELECT * FROM directory_cat ORDER BY directory_cat_name ASC") or die(mysql_error());
			    while($row = mysql_fetch_array($result))
				    	{
				    	$directory_cat_id = $row['directory_cat_id'];
				    	$directory_cat_name = $row['directory_cat_name'];
				    	echo '<option value="' . $directory_cat_id . '"';
				    	if($directory_cat_id==$edit_directory_cat_id)
				    		{
				    		echo ' selected';
				    		}		
				    	else
				    		{
				    		}
				    	echo '>' . $directory_cat_name . '</option>';
				    	} ?></select></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Chair Member:</legend>
			    <ul><li>
			    		<select name="directory_chair">
			    		<option value="Choose One">Choose One</option>
			    		<option value="1" <?php if($edit_directory_chair=='1') { echo ' selected';} else {} ?>>Yes</option>
					<option value="0" <?php if($edit_directory_chair=='0') { echo ' selected';} else {} ?>>No</option>
			    		</select>
			    	</li></ul>
			</fieldset>
			<fieldset>
				<legend>Image:</legend>
				<ul><li>
				<?php
				if(!empty($edit_directory_img))
					{
					echo '<input type="hidden" name="directory_img" value="'.$edit_directory_img.'">';
					echo '<img src="/assets/img/directory/tn-'.$edit_directory_img.'">';
					echo '<br><a href="?del_img='.$edit.'">Delete Image</a>';
					}
				else
					{
					echo '<input name="directory_img" type="file" />';
					}
				?>
				</li>
				<fieldset>
					<legend>CV:</legend>
					<ul><li>
						<?php 
						if(!empty($edit_directory_cv))
							{
							echo '<input type="hidden" name="directory_cv" value="'.$edit_directory_cv.'">';
							//echo '<a href="../assets/img/directory-cv/'.$edit_directory_cv.'" target="_blank">'.$edit_directory_cv.'</a>';
							echo $edit_directory_cv;
							echo ' &middot; <a href="?del_cv='.$edit.'">Delete Directory Listing CV</a>';
							}
						else
							{
							echo '<input name="directory_cv" type="file" />';
							}
						
						 ?>
					</li></ul>
				</fieldset>
				<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			</fieldset>
			
			</form>
<?php
			}
		}
	}




// Edit Category 
	
elseif(isset($_GET['edit_cat']))
	{	
		$pagetype = 'Directory Listing Admin &middot; Edit Category';
		echo '<h1><a href="/panel/directory?cat">Categories</a> &middot; Edit Category</h1>';
		$edit_cat = $_GET['edit_cat'];
		$result = mysql_query("SELECT * FROM directory_cat WHERE directory_cat_id='$edit_cat' LIMIT 1");
		$row = mysql_fetch_assoc($result);
		$edit_directory_cat_name = $row["directory_cat_name"];
		if (empty($_GET['edit_cat']))
			{
			echo '<hr><p>Category must be selected to be edited. You will be redirected to <a href="/panel/directory/?cat">directory Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory?cat>';
			}
		else
			{
			if (isset($_POST) && !empty($_POST['directory_cat_name']))
				{
				$directory_cat_name = htmlentities(($_POST['directory_cat_name']), ENT_QUOTES, 'utf-8');
				$result = mysql_query("UPDATE directory_cat SET directory_cat_name='$directory_cat_name' WHERE directory_cat_id='$edit_cat'");
				echo '<hr><p>Edited successfully! You will be redirected to <a href="/panel/directory/?cat">directory Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory/?cat>';
				}
			else
				{ ?>
				<div class="main">
				<form method="post" action="<?php echo $PHP_SELF; ?>?edit_cat=<?php echo $edit_cat; ?>">	
				<fieldset>
				    <legend>Category Name:</legend>
				    <ul><li><input name="directory_cat_name" value="<?php echo $edit_directory_cat_name; ?>" type="text"></li>
				</fieldset>
				<fieldset>
					<ul><li class="login"><input type="submit" value="Save" name="submit"/></li></ul>
				</fieldset>
				</form>
				</div>
	<?php
				}
			}
		}	
	







elseif(isset($_GET['del']))
	{
	$pagetype = 'Directory Listing Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/directory">Directory Listing Admin</a> &middot; Delete Entry</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/directory">Directory Listing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory>';
		}
	else
		{	
		$subresult = mysql_query("SELECT directory_img FROM directory WHERE directory_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$directory_img=$subrow['directory_img'];
			$path= '../assets/img/directory/'. $directory_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/directory/tn-'. $directory_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
			
		$subresult2 = mysql_query("SELECT directory_cv FROM directory WHERE directory_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult2))
			{
			$directory_cv=$subrow['directory_cv'];
			$path= '../assets/pdf/directory-cv/'. $directory_cv .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			
			}	
		$result = mysql_query("DELETE FROM directory WHERE directory_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/directory">Directory Listing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory>';
		}
	}
	
	
	





// Delete Category
	
elseif(isset($_GET['del_cat']))
	{
	$pagetype = 'Directory Listing Admin &middot; Delete Category';
	//echo '<h1><a href="/panel/menu?cat">Categories</a> &middot; Delete Category</h1>';
	$del_cat = $_GET['del_cat'];
	$result = mysql_query("SELECT * FROM directory_cat WHERE directory_cat_id='$del_cat' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_directory_cat_name = $row["directory_cat_name"];
	if (empty($_GET['del_cat']))
		{ echo '<hr>Category must be selected to be deleted. You will be redirected to <a href="/panel/directory?cat">Category Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory?cat>';
		}
	else
		{
		echo '<h1>Deleted '.$del_directory_cat_name.'</h1>';
		//$subresult = mysql_query("DELETE FROM menu_cat_list WHERE menu_cat_id='$del_cat'");
		$result = mysql_query("DELETE FROM directory_cat WHERE directory_cat_id='$del_cat'");
		echo '<p>Deleted! You will be redirected to <a href="/panel/directory?cat">directory Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory?cat>';
		}
	}		
	
	
	
	
	
	
	
elseif(isset($_GET['del_img']))
	{
	$pagetype = 'Directory Listing Admin &middot; Delete Entry (kage';
	echo '<h1><a href="/panel/directory">Directory Listing Admin</a> &middot; Delete Entry Image</h1>';
	$del_img = $_GET['del_img'];
	if (empty($_GET['del_img']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/directory">Directory Listing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory>';
		}
	else
		{	
		$subresult = mysql_query("SELECT directory_img FROM directory WHERE directory_id='$del_img'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$directory_img=$subrow['directory_img'];
			$path= '../assets/img/directory/'. $directory_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/directory/tn-'. $directory_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE directory SET directory_img='' WHERE directory_id='$del_img'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/directory">Directory Listing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory>';
		
		}
	}
	
elseif(isset($_GET['del_cv']))
	{
	$pagetype = 'Directory Listing Admin &middot; Delete Entry CV (kage';
	echo '<h1><a href="/panel/directory">Directory Listing Admin</a> &middot; Delete Entry CV</h1>';
	$del_cv = $_GET['del_cv'];
	if (empty($_GET['del_cv']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/directory">Directory Listing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory>';
		}
	else
		{	
		$subresult = mysql_query("SELECT directory_cv FROM directory WHERE directory_id='$del_cv'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$directory_cv=$subrow['directory_cv'];
			$path= '../assets/pdf/directory-cv/'. $directory_cv .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE directory SET directory_cv='' WHERE directory_id='$del_cv'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/directory">Directory Listing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/directory>';
		
		}
	}
	
	
	
	
	


// Beginning of Category List Page

elseif(isset($_GET['cat']))
	{
	$pagetype = "Category List";
	echo '<h1 class="l2">'.$pagetype.'</h1> <h5 class="r"><a href="/panel/directory">Return to Directory Admin</a> &middot; <a href="?add_cat">Add Category</a> </h5><div class="clear">&nbsp;</div>';
	echo '<div class="hr"><hr /></div>';
	//echo '<div class="main2">';
	$result = mysql_query("SELECT * FROM directory_cat ORDER BY directory_cat_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no category entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$directory_cat_id=$row['directory_cat_id'];
			$directory_cat_name=$row['directory_cat_name'];
			
			echo '<h2>'.$directory_cat_name.'</h2>';
			
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit_cat='.$directory_cat_id.'">Edit</a> &middot; 
			<a href="'.$PHP_SELF.'?del_cat='.$directory_cat_id.'">Delete</a></em></small></p>';	
			//echo '</div><!-- close main div -->';	
			}
		}
	}

	
	
	
	
	
	
	

else
	{
	$pagetype = 'Directory Listing Admin';
	echo '<h1 class="l2">'.$pagetype.'</h1><h5 class="r"><a href="?add"> Add Entry</a> &middot; <a href="?add_cat"> Add Category</a> &middot; <a href="/panel/directory?cat">View Category List</a></h5><div class="clear">&nbsp;</div><p></p>';


	$result = mysql_query("SELECT * FROM directory, directory_cat WHERE directory.directory_cat_id=directory_cat.directory_cat_id ORDER BY directory_cat.directory_cat_name DESC, directory.directory_chair DESC, directory.directory_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<hr/><p>There are no directory listing entries.</p>';
		}
	else
		{
		$directory_cat_id = '';
		while($row = mysql_fetch_array($result))
			{
			$directory_id=$row['directory_id'];
			$directory_name=$row['directory_name'];
			$directory_full=$row['directory_full'];
			$directory_email=$row['directory_email'];
			$directory_chair=$row['directory_chair'];
			$directory_img=$row['directory_img'];
			$directory_cv=$row['directory_cv'];
			if($directory_cat_id!=$row['directory_cat_id'])
				{
				$directory_cat_id=$row['directory_cat_id'];
				$directory_cat_name=$row['directory_cat_name'];
				
				
				echo '<hr/><h2 align="center">'.$directory_cat_name.'</h2>';
				}
			
			
			
			
			echo '<hr><h3>';
			if(!empty($directory_img))
				{
				echo '<img src="/assets/img/icon-photo.gif"> ';
				} else {}
			echo ''.$directory_name.': '.$directory_full.'</h3>';
			
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit='.$directory_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$directory_id.'">Delete</a></em></small></p>';	
			}
		}
	}





include '../'.$foot; ?>