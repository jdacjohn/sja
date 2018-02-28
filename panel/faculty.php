<?php $pagetitle = "Faculty Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);



//faculty_name, faculty_full, faculty_email, faculty_img FROM faculty 
if(isset($_GET['add']))
	{
	$pagetype = 'Faculty Admin &middot; Add Entry';
	echo '<h1><a href="/panel/faculty">Faculty Admin</a> &middot; Add Entry</h1>';
	if (isset($_POST) && !empty($_POST['faculty_name']))
		{
		if (!empty($_FILES["faculty_img"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["faculty_img"]["tmp_name"];
			$img_size = ($_FILES["faculty_img"]["size"] / 1024);
			$file_name = basename($_FILES["faculty_img"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$faculty_img = $img_md5.'.'.$file_ext;
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$faculty_img = $img_md5.'.'.$file_ext;
				$faculty_img_target = "../assets/img/faculty/".$faculty_img;
				move_uploaded_file($_FILES["faculty_img"]["tmp_name"],$faculty_img_target);
				$resizeObj = new resize('../assets/img/faculty/'.$faculty_img); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/faculty/tn-'.$faculty_img, 100); // *** 3) Save image
				}
			else
				{
				$faculty_img = '';
				}
			}
		else
			{
			$faculty_img = '';
			}
		$faculty_name = htmlentities(($_POST['faculty_name']), ENT_QUOTES, 'utf-8');
		$faculty_full = htmlentities(($_POST['faculty_full']), ENT_QUOTES, 'utf-8');
		$faculty_email = htmlentities(($_POST['faculty_email']), ENT_QUOTES, 'utf-8');
		$faculty_cat_id = htmlentities(($_POST['faculty_cat_id']), ENT_QUOTES, 'utf-8');
		if(!empty($_FILES['faculty_cv']['name']))
			{
			$faculty_cv = date("mdy")."-".preg_replace("([^a-z0-9._-])",'',strtolower(str_replace(' ', '', $_FILES["faculty_cv"]["name"])));
			$faculty_cv_target = "../assets/pdf/faculty-cv/".$faculty_cv;
			move_uploaded_file($_FILES["faculty_cv"]["tmp_name"],$faculty_cv_target);
			}
		else
			{
			$faculty_cv='';
			}
			
			
		$result = mysql_query("INSERT INTO faculty (faculty_name, faculty_full, faculty_email, faculty_img, faculty_cv, faculty_cat_id) VALUES ('$faculty_name','$faculty_full','$faculty_email','$faculty_img','$faculty_cv','$faculty_cat_id')") or die(mysql_error());
		echo '<hr><p>'.$faculty_name.' was successfully added! You will be redirected to <a href="/panel/faculty">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty>';
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">
	<fieldset>
	    <legend>Name:</legend>
	    <ul><li><input name="faculty_name" value="<?= @$_POST['faculty_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="faculty_full" value="<?= @$_POST['faculty_full']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Email:</legend>
	    <ul><li><input name="faculty_email" value="<?= @$_POST['faculty_email']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>Category:</legend>
		<ul><li><select name="faculty_cat_id">
		<option value="Choose a Category">Choose a Category</option>
		<?php
		$result = mysql_query("SELECT * FROM faculty_cat ORDER BY faculty_cat_name ASC") or die(mysql_error());
		while($row = mysql_fetch_array( $result ))
			{
			$faculty_cat_id=$row['faculty_cat_id'];
			$faculty_cat_name=$row['faculty_cat_name'];
			echo '<option value="'.$faculty_cat_id.'">'.$faculty_cat_name.'</option>';
			}
		?></select></li>
		</ul>
	</fieldset>
	<fieldset>
		<legend>Image:</legend>
		<ul><li><input name="faculty_img" type="file" /></li></ul>
	</fieldset>
	<fieldset>
		<legend>CV:</legend>
		<ul><li><input name="faculty_cv" type="file" /></li>
	    <li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	
	</form>
<?php
		}
	}
	





// Add Category
	
elseif(isset($_GET['add_cat']))
	{
	$pagetype = 'Add Category';
	echo '<h1><a href="/panel/faculty?cat">Categories</a> &middot; Add Category</h1>';
	
	if (isset($_POST) && !empty($_POST['faculty_cat_name']))
		{
		$faculty_cat_name = htmlentities(($_POST['faculty_cat_name']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO faculty_cat (faculty_cat_name) VALUES ('$faculty_cat_name')");
		echo '<p>'.$faculty_cat_name.' was successfully added! You will be redirected to <a href="/panel/faculty/?cat">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty/?cat>';
		}
	else
		{
	?><hr/>
	<div class="main">
	<form method="post" action="?add_cat">
	<fieldset>
		<legend>Category Name:</legend>
		<ul><li><input name="faculty_cat_name" value="<?= @$_POST['faculty_cat_name']?>" type="text"></li></ul>	
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
	$pagetype = 'Faculty Admin &middot; Edit Entry';
	echo '<h1><a href="/panel/faculty">Faculty Admin</a> &middot; Edit Entry</h1>';
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM faculty WHERE faculty_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_faculty_name = $row["faculty_name"];
	$edit_faculty_full = $row["faculty_full"];
	$edit_faculty_email = $row["faculty_email"];
	$edit_faculty_img = $row["faculty_img"];
	$edit_faculty_cv = $row["faculty_cv"];
	$edit_faculty_cat_id = $row["faculty_cat_id"];
	if (empty($_GET['edit']))
		{
		echo '<hr>Entry must be selected to be edited. You will be redirected to <a href="/panel/faculty">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['faculty_name']))
			{
			$faculty_name = htmlentities(($_POST['faculty_name']), ENT_QUOTES, 'utf-8');
			$faculty_full = htmlentities(($_POST['faculty_full']), ENT_QUOTES, 'utf-8');
			$faculty_email = htmlentities(($_POST['faculty_email']), ENT_QUOTES, 'utf-8');			
			$faculty_cat_id = htmlentities(($_POST['faculty_cat_id']), ENT_QUOTES, 'utf-8');
			if (!empty($_FILES["faculty_img"]["name"]))
				{
				$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
				$img_tmp = $_FILES["faculty_img"]["tmp_name"];
				$img_size = ($_FILES["faculty_img"]["size"] / 1024);
				$file_name = basename($_FILES["faculty_img"]["name"]);
				$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
				$faculty_img = $img_md5.'.'.$file_ext;
				$max_file = '2048';
				if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
					{
					$faculty_img = $img_md5.'.'.$file_ext;
					$faculty_img_target = "../assets/img/faculty/".$faculty_img;
					move_uploaded_file($_FILES["faculty_img"]["tmp_name"],$faculty_img_target);
					$resizeObj = new resize('../assets/img/faculty/'.$faculty_img); // *** 1) Initialise / load image
					$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> saveImage('../assets/img/faculty/tn-'.$faculty_img, 100); // *** 3) Save image
					}
				else
					{
					$faculty_img = $edit_faculty_img;
					}
				}
			else
				{
				$faculty_img = $edit_faculty_img;
				} // End of Img 
			
			if(!empty($_FILES['faculty_cv']['name']))
				{
				$faculty_cv = date("mdy")."-".preg_replace("([^a-z0-9._-])",'',strtolower(str_replace(' ', '', $_FILES["faculty_cv"]["name"])));
				$faculty_cv_target = "../assets/pdf/faculty-cv/".$faculty_cv;
				move_uploaded_file($_FILES["faculty_cv"]["tmp_name"],$faculty_cv_target);
				}
			else
				{
				$faculty_cv = $edit_faculty_cv;
				}
	
			//echo "UPDATE faculty SET faculty_name='$faculty_name', faculty_full='$faculty_full', faculty_email='$faculty_email', faculty_img='$faculty_img', faculty_cv='$faculty_cv', faculty_cat_id='$faculty_cat_id' WHERE faculty_id='$edit' ";
			
			
			
			$result = mysql_query("UPDATE faculty SET faculty_name='$faculty_name', faculty_full='$faculty_full', faculty_email='$faculty_email', faculty_img='$faculty_img', faculty_cv='$faculty_cv', faculty_cat_id='$faculty_cat_id' WHERE faculty_id='$edit' ");
			
			
			
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/faculty">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty>';
			}
		else
			{ ?>
			<hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" enctype="multipart/form-data">			
			<fieldset>
			    <legend>Name:</legend>
			    <ul><li><input name="faculty_name" value="<?php echo $edit_faculty_name; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="faculty_full" value="<?php echo $edit_faculty_full; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>Email:</legend>
				<ul><li><input name="faculty_email" value="<?php echo $edit_faculty_email; ?>" type="text"></li></ul>
			</fieldset>
			
			
			<fieldset>
			    <legend>Menu Category:</legend>
			    <ul><li><select name="faculty_cat_id">
			    <option value="Choose a Category">Choose a Category</option>
			    <!-- <option value="">&nbsp;</option> -->
			    <?php
			    $result = mysql_query("SELECT * FROM faculty_cat ORDER BY faculty_cat_name ASC") or die(mysql_error());
			    while($row = mysql_fetch_array($result))
				    	{
				    	$faculty_cat_id = $row['faculty_cat_id'];
				    	$faculty_cat_name = $row['faculty_cat_name'];
				    	echo '<option value="' . $faculty_cat_id . '"';
				    	if($faculty_cat_id==$edit_faculty_cat_id)
				    		{
				    		echo ' selected';
				    		}		
				    	else
				    		{
				    		}
				    	echo '>' . $faculty_cat_name . '</option>';
				    	} ?></select></li></ul>
			</fieldset>
			
			<fieldset>
				<legend>Image:</legend>
				<ul><li>
				<?php
				if(!empty($edit_faculty_img))
					{
					echo '<input type="hidden" name="faculty_img" value="'.$edit_faculty_img.'">';
					echo '<img src="/assets/img/faculty/tn-'.$edit_faculty_img.'">';
					echo '<br><a href="?del_img='.$edit.'">Delete Image</a>';
					}
				else
					{
					echo '<input name="faculty_img" type="file" />';
					}
				?>
				</li>
				<fieldset>
					<legend>CV:</legend>
					<ul><li>
						<?php 
						if(!empty($edit_faculty_cv))
							{
							echo '<input type="hidden" name="faculty_cv" value="'.$edit_faculty_cv.'">';
							//echo '<a href="../assets/pdf/faculty-cv/'.$edit_faculty_cv.'" target="_blank">'.$edit_faculty_cv.'</a>';
							echo $edit_faculty_cv;
							echo ' &middot; <a href="?del_cv='.$edit.'">Delete Faculty CV</a>';
							}
						else
							{
							echo '<input name="faculty_cv" type="file" />';
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
		$pagetype = 'Faculty Admin &middot; Edit Category';
		echo '<h1><a href="/panel/faculty?cat">Categories</a> &middot; Edit Category</h1>';
		$edit_cat = $_GET['edit_cat'];
		$result = mysql_query("SELECT * FROM faculty_cat WHERE faculty_cat_id='$edit_cat' LIMIT 1");
		$row = mysql_fetch_assoc($result);
		$edit_faculty_cat_name = $row["faculty_cat_name"];
		if (empty($_GET['edit_cat']))
			{
			echo '<hr><p>Category must be selected to be edited. You will be redirected to <a href="/panel/faculty/?cat">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty?cat>';
			}
		else
			{
			if (isset($_POST) && !empty($_POST['faculty_cat_name']))
				{
				$faculty_cat_name = htmlentities(($_POST['faculty_cat_name']), ENT_QUOTES, 'utf-8');
				$result = mysql_query("UPDATE faculty_cat SET faculty_cat_name='$faculty_cat_name' WHERE faculty_cat_id='$edit_cat'");
				echo '<hr><p>Edited successfully! You will be redirected to <a href="/panel/faculty/?cat">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty/?cat>';
				}
			else
				{ ?>
				<div class="main">
				<form method="post" action="<?php echo $PHP_SELF; ?>?edit_cat=<?php echo $edit_cat; ?>">	
				<fieldset>
				    <legend>Category Name:</legend>
				    <ul><li><input name="faculty_cat_name" value="<?php echo $edit_faculty_cat_name; ?>" type="text"></li>
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
	$pagetype = 'Faculty Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/faculty">Faculty Admin</a> &middot; Delete Entry</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/faculty">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty>';
		}
	else
		{	
		$subresult = mysql_query("SELECT faculty_img FROM faculty WHERE faculty_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$faculty_img=$subrow['faculty_img'];
			$path= '../assets/img/faculty/'. $faculty_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/faculty/tn-'. $faculty_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
			
		$subresult2 = mysql_query("SELECT faculty_cv FROM faculty WHERE faculty_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult2))
			{
			$faculty_cv=$subrow['faculty_cv'];
			$path= '../assets/pdf/faculty-cv/'. $faculty_cv .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			
			}	
		$result = mysql_query("DELETE FROM faculty WHERE faculty_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/faculty">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty>';
		}
	}
	
	
	
	
	
	

// Delete Category
	
elseif(isset($_GET['del_cat']))
	{
	$pagetype = 'Faculty Admin &middot; Delete Category';
	//echo '<h1><a href="/panel/menu?cat">Categories</a> &middot; Delete Category</h1>';
	$del_cat = $_GET['del_cat'];
	$result = mysql_query("SELECT * FROM faculty_cat WHERE faculty_cat_id='$del_cat' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_faculty_cat_name = $row["faculty_cat_name"];
	if (empty($_GET['del_cat']))
		{ echo '<hr>Category must be selected to be deleted. You will be redirected to <a href="/panel/faculty?cat">Category Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty?cat>';
		}
	else
		{
		echo '<h1>Deleted '.$del_faculty_cat_name.'</h1>';
		//$subresult = mysql_query("DELETE FROM menu_cat_list WHERE menu_cat_id='$del_cat'");
		$result = mysql_query("DELETE FROM faculty_cat WHERE faculty_cat_id='$del_cat'");
		echo '<p>Deleted! You will be redirected to <a href="/panel/faculty?cat">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty?cat>';
		}
	}		

	
	
	
	
	
	
	
elseif(isset($_GET['del_img']))
	{
	$pagetype = 'Faculty Admin &middot; Delete Entry (kage';
	echo '<h1><a href="/panel/faculty">Faculty Admin</a> &middot; Delete Entry Image</h1>';
	$del_img = $_GET['del_img'];
	if (empty($_GET['del_img']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/faculty">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty>';
		}
	else
		{	
		$subresult = mysql_query("SELECT faculty_img FROM faculty WHERE faculty_id='$del_img'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$faculty_img=$subrow['faculty_img'];
			$path= '../assets/img/faculty/'. $faculty_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/faculty/tn-'. $faculty_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE faculty SET faculty_img='' WHERE faculty_id='$del_img'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/faculty">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty>';
		
		}
	}
	
elseif(isset($_GET['del_cv']))
	{
	$pagetype = 'Faculty Admin &middot; Delete Entry (kage';
	echo '<h1><a href="/panel/faculty">Faculty Admin</a> &middot; Delete Entry CV</h1>';
	$del_cv = $_GET['del_cv'];
	if (empty($_GET['del_cv']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/faculty">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty>';
		}
	else
		{	
		$subresult = mysql_query("SELECT faculty_cv FROM faculty WHERE faculty_id='$del_cv'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$faculty_cv=$subrow['faculty_cv'];
			$path= '../assets/pdf/faculty-cv/'. $faculty_cv .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			//$path2= '../assets/img/faculty/tn-'. $faculty_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE faculty SET faculty_cv='' WHERE faculty_id='$del_cv'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/faculty">Faculty Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/faculty>';
		
		}
	}
	
	
	
	
	





// Beginning of Category List Page

elseif(isset($_GET['cat']))
	{
	$pagetype = "Category List";
	echo '<h1 class="l2">'.$pagetype.'</h1> <h5 class="r"><a href="/panel/faculty">Return to Faculty Admin</a> &middot; <a href="?add_cat">Add Category</a> </h5><div class="clear">&nbsp;</div>';
	echo '<div class="hr"><hr /></div>';
	//echo '<div class="main2">';
	$result = mysql_query("SELECT * FROM faculty_cat ORDER BY faculty_cat_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no category entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$faculty_cat_id=$row['faculty_cat_id'];
			$faculty_cat_name=$row['faculty_cat_name'];
			
			echo '<h2>'.$faculty_cat_name.'</h2>';
			
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit_cat='.$faculty_cat_id.'">Edit</a> &middot; 
			<a href="'.$PHP_SELF.'?del_cat='.$faculty_cat_id.'">Delete</a></em></small></p>';	
			//echo '</div><!-- close main div -->';	
			}
		}
	}



	
	
	
	
	
	
	
	
	

else
	{
	$pagetype = 'Faculty Admin';
	echo '<h1 class="l2">'.$pagetype.'</h1><h5 class="r"><a href="?add"> Add Entry</a> &middot; <a href="?add_cat"> Add Category</a> &middot; <a href="/panel/faculty?cat">View Category List</a></h5><div class="clear">&nbsp;</div><p></p>';
	
	$result = mysql_query("SELECT * FROM faculty, faculty_cat WHERE faculty.faculty_cat_id=faculty_cat.faculty_cat_id ORDER BY faculty_cat.faculty_cat_name ASC, faculty.faculty_name ASC") or die(mysql_error());
	
	
	
	//$result = mysql_query("SELECT faculty_id, faculty_name, faculty_full, faculty_email, faculty_img, faculty_cv FROM faculty ORDER BY faculty_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<hr/><p>There are no faculty entries.</p>';
		}
	else
		{
		$faculty_cat_id = '';
		while($row = mysql_fetch_array($result))
			{
			$faculty_id=$row['faculty_id'];
			$faculty_name=$row['faculty_name'];
			$faculty_full=$row['faculty_full'];
			$faculty_email=$row['faculty_email'];
			$faculty_img=$row['faculty_img'];
			$faculty_cv=$row['faculty_cv'];
			if($faculty_cat_id!=$row['faculty_cat_id'])
				{
				$faculty_cat_id=$row['faculty_cat_id'];
				$faculty_cat_name=$row['faculty_cat_name'];
				
				
				echo '<hr/><h2 align="center">'.$faculty_cat_name.'</h2>';
				}
				
			echo '<hr><h3>';
			if(!empty($faculty_img))
				{
				echo '<img src="/assets/img/icon-photo.gif"> ';
				} else {}
			echo ''.$faculty_name.': '.$faculty_full.'</h3>';
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit='.$faculty_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$faculty_id.'">Delete</a></em></small></p>';
				
			
				
			}
		}
		
	}





include '../'.$foot; ?>