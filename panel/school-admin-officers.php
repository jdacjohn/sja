<?php $pagetitle = "School Administration Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);



//school_admin_groups_name, school_admin_groups_full, school_admin_groups_email, school_admin_groups_img, school_admin_groups_cv FROM school_admin_groups 
if(isset($_GET['add']))
	{
	$pagetype = 'School Administration Admin &middot; Add Entry';
	echo '<h1><a href="/panel/school-admin-officers">School Administration Admin</a> &middot; Add Entry</h1>';
	if (isset($_POST) && !empty($_POST['school_admin_groups_name']))
		{
		if (!empty($_FILES["school_admin_groups_img"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["school_admin_groups_img"]["tmp_name"];
			$img_size = ($_FILES["school_admin_groups_img"]["size"] / 1024);
			$file_name = basename($_FILES["school_admin_groups_img"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$school_admin_groups_img = $img_md5.'.'.$file_ext;
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$school_admin_groups_img = $img_md5.'.'.$file_ext;
				$school_admin_groups_img_target = "../assets/img/school-admin/".$school_admin_groups_img;
				move_uploaded_file($_FILES["school_admin_groups_img"]["tmp_name"],$school_admin_groups_img_target);
				$resizeObj = new resize('../assets/img/school-admin/'.$school_admin_groups_img); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/school-admin/tn-'.$school_admin_groups_img, 100); // *** 3) Save image
				}
			else
				{
				$school_admin_groups_img = '';
				}
			}
		else
			{
			$school_admin_groups_img = '';
			}
		$school_admin_groups_name = htmlentities(($_POST['school_admin_groups_name']), ENT_QUOTES, 'utf-8');
		$school_admin_groups_full = htmlentities(($_POST['school_admin_groups_full']), ENT_QUOTES, 'utf-8');
		$school_admin_groups_email = htmlentities(($_POST['school_admin_groups_email']), ENT_QUOTES, 'utf-8');
		$school_admin_cat_id = htmlentities(($_POST['school_admin_cat_id']), ENT_QUOTES, 'utf-8');
		if(!empty($_FILES['school_admin_groups_cv']['name']))
			{
			$school_admin_groups_cv = date("mdy")."-".preg_replace("([^a-z0-9._-])",'',strtolower(str_replace(' ', '', $_FILES["school_admin_groups_cv"]["name"])));
			$school_admin_groups_cv_target = "../assets/pdf/school-admin-cv/".$school_admin_groups_cv;
			move_uploaded_file($_FILES["school_admin_groups_cv"]["tmp_name"],$school_admin_groups_cv_target);
			}
		else
			{
			$school_admin_groups_cv='';
			}
			
			
		$result = mysql_query("INSERT INTO school_admin_groups (school_admin_groups_name, school_admin_groups_full, school_admin_groups_email, school_admin_groups_img, school_admin_groups_cv, school_admin_cat_id) VALUES ('$school_admin_groups_name','$school_admin_groups_full','$school_admin_groups_email','$school_admin_groups_img','$school_admin_groups_cv','$school_admin_cat_id')") or die(mysql_error());
		echo '<hr><p>'.$school_admin_groups_name.' was successfully added! You will be redirected to <a href="/panel/school-admin-officers">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers>';
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">
	<fieldset>
	    <legend>Name:</legend>
	    <ul><li><input name="school_admin_groups_name" value="<?= @$_POST['school_admin_groups_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="school_admin_groups_full" value="<?= @$_POST['school_admin_groups_full']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Email:</legend>
	    <ul><li><input name="school_admin_groups_email" value="<?= @$_POST['school_admin_groups_email']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>Category:</legend>
		<ul><li><select name="school_admin_cat_id">
		<option value="Choose a Category">Choose a Category</option>
		<?php
		$result = mysql_query("SELECT * FROM school_admin_cat ORDER BY school_admin_cat_name ASC") or die(mysql_error());
		while($row = mysql_fetch_array( $result ))
			{
			$school_admin_cat_id=$row['school_admin_cat_id'];
			$school_admin_cat_name=$row['school_admin_cat_name'];
			echo '<option value="'.$school_admin_cat_id.'">'.$school_admin_cat_name.'</option>';
			}
		?></select></li>
		</ul>
	</fieldset>
	<fieldset>
		<legend>Image:</legend>
		<ul><li><input name="school_admin_groups_img" type="file" /></li></ul>
	</fieldset>
	<fieldset>
		<legend>CV:</legend>
		<ul><li><input name="school_admin_groups_cv" type="file" /></li>
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
	echo '<h1><a href="/panel/school-admin-officers?cat">Categories</a> &middot; Add Category</h1>';
	
	if (isset($_POST) && !empty($_POST['school_admin_cat_name']))
		{
		$school_admin_cat_name = htmlentities(($_POST['school_admin_cat_name']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO school_admin_cat (school_admin_cat_name) VALUES ('$school_admin_cat_name')");
		echo '<p>'.$school_admin_cat_name.' was successfully added! You will be redirected to <a href="/panel/school-admin-officers/?cat">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers/?cat>';
		}
	else
		{
	?><hr/>
	<div class="main">
	<form method="post" action="?add_cat">
	<fieldset>
		<legend>Category Name:</legend>
		<ul><li><input name="school_admin_cat_name" value="<?= @$_POST['school_admin_cat_name']?>" type="text"></li></ul>	
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
	$pagetype = 'School Administration Admin &middot; Edit Entry';
	echo '<h1><a href="/panel/school-admin-officers">School Administration Admin</a> &middot; Edit Entry</h1>';
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM school_admin_groups WHERE school_admin_groups_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_school_admin_groups_name = $row["school_admin_groups_name"];
	$edit_school_admin_groups_full = $row["school_admin_groups_full"];
	$edit_school_admin_groups_email = $row["school_admin_groups_email"];
	$edit_school_admin_groups_img = $row["school_admin_groups_img"];
	$edit_school_admin_groups_cv = $row["school_admin_groups_cv"];
	$edit_school_admin_cat_id = $row["school_admin_cat_id"];
	if (empty($_GET['edit']))
		{
		echo '<hr>Entry must be selected to be edited. You will be redirected to <a href="/panel/school-admin-officers">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['school_admin_groups_name']))
			{
			$school_admin_groups_name = htmlentities(($_POST['school_admin_groups_name']), ENT_QUOTES, 'utf-8');
			$school_admin_groups_full = htmlentities(($_POST['school_admin_groups_full']), ENT_QUOTES, 'utf-8');
			$school_admin_groups_email = htmlentities(($_POST['school_admin_groups_email']), ENT_QUOTES, 'utf-8');			
			$school_admin_cat_id = htmlentities(($_POST['school_admin_cat_id']), ENT_QUOTES, 'utf-8');
			if (!empty($_FILES["school_admin_groups_img"]["name"]))
				{
				$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
				$img_tmp = $_FILES["school_admin_groups_img"]["tmp_name"];
				$img_size = ($_FILES["school_admin_groups_img"]["size"] / 1024);
				$file_name = basename($_FILES["school_admin_groups_img"]["name"]);
				$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
				$school_admin_groups_img = $img_md5.'.'.$file_ext;
				$max_file = '2048';
				if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
					{
					$school_admin_groups_img = $img_md5.'.'.$file_ext;
					$school_admin_groups_img_target = "../assets/img/school-admin/".$school_admin_groups_img;
					move_uploaded_file($_FILES["school_admin_groups_img"]["tmp_name"],$school_admin_groups_img_target);
					$resizeObj = new resize('../assets/img/school-admin/'.$school_admin_groups_img); // *** 1) Initialise / load image
					$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> saveImage('../assets/img/school-admin/tn-'.$school_admin_groups_img, 100); // *** 3) Save image
					}
				else
					{
					$school_admin_groups_img = $edit_school_admin_groups_img;
					}
				}
			else
				{
				$school_admin_groups_img = $edit_school_admin_groups_img;
				} // End of Img 
			
			if(!empty($_FILES['school_admin_groups_cv']['name']))
				{
				$school_admin_groups_cv = date("mdy")."-".preg_replace("([^a-z0-9._-])",'',strtolower(str_replace(' ', '', $_FILES["school_admin_groups_cv"]["name"])));
				$school_admin_groups_cv_target = "../assets/pdf/school-admin-cv/".$school_admin_groups_cv;
				move_uploaded_file($_FILES["school_admin_groups_cv"]["tmp_name"],$school_admin_groups_cv_target);
				}
			else
				{
				$school_admin_groups_cv = $edit_school_admin_groups_cv;
				}
	
			//echo "UPDATE office SET school_admin_groups_name='$school_admin_groups_name', school_admin_groups_full='$school_admin_groups_full', school_admin_groups_email='$school_admin_groups_email', school_admin_groups_img='$school_admin_groups_img', school_admin_groups_cv='$school_admin_groups_cv', school_admin_cat_id='$school_admin_cat_id' WHERE school_admin_groups_id='$edit' ";
			
			
			
			$result = mysql_query("UPDATE school_admin_groups SET school_admin_groups_name='$school_admin_groups_name', school_admin_groups_full='$school_admin_groups_full', school_admin_groups_email='$school_admin_groups_email', school_admin_groups_img='$school_admin_groups_img', school_admin_groups_cv='$school_admin_groups_cv', school_admin_cat_id='$school_admin_cat_id' WHERE school_admin_groups_id='$edit' ");
			
			
			
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/school-admin-officers">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers>';
			}
		else
			{ ?>
			<hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" enctype="multipart/form-data">			
			<fieldset>
			    <legend>Name:</legend>
			    <ul><li><input name="school_admin_groups_name" value="<?php echo $edit_school_admin_groups_name; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="school_admin_groups_full" value="<?php echo $edit_school_admin_groups_full; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>Email:</legend>
				<ul><li><input name="school_admin_groups_email" value="<?php echo $edit_school_admin_groups_email; ?>" type="text"></li></ul>
			</fieldset>
			
			
			<fieldset>
			    <legend>Menu Category:</legend>
			    <ul><li><select name="school_admin_cat_id">
			    <option value="Choose a Category">Choose a Category</option>
			    <!-- <option value="">&nbsp;</option> -->
			    <?php
			    $result = mysql_query("SELECT * FROM school_admin_cat ORDER BY school_admin_cat_name ASC") or die(mysql_error());
			    while($row = mysql_fetch_array($result))
				    	{
				    	$school_admin_cat_id = $row['school_admin_cat_id'];
				    	$school_admin_cat_name = $row['school_admin_cat_name'];
				    	echo '<option value="' . $school_admin_cat_id . '"';
				    	if($school_admin_cat_id==$edit_school_admin_cat_id)
				    		{
				    		echo ' selected';
				    		}		
				    	else
				    		{
				    		}
				    	echo '>' . $school_admin_cat_name . '</option>';
				    	} ?></select></li></ul>
			</fieldset>
			
			<fieldset>
				<legend>Image:</legend>
				<ul><li>
				<?php
				if(!empty($edit_school_admin_groups_img))
					{
					echo '<input type="hidden" name="school_admin_groups_img" value="'.$edit_school_admin_groups_img.'">';
					echo '<img src="/assets/img/school-admin/tn-'.$edit_school_admin_groups_img.'">';
					echo '<br><a href="?del_img='.$edit.'">Delete Image</a>';
					}
				else
					{
					echo '<input name="school_admin_groups_img" type="file" />';
					}
				?>
				</li>
				<fieldset>
					<legend>CV:</legend>
					<ul><li>
						<?php 
						if(!empty($edit_school_admin_groups_cv))
							{
							echo '<input type="hidden" name="school_admin_groups_cv" value="'.$edit_school_admin_groups_cv.'">';
							//echo '<a href="../assets/pdf/school-admin-cv/'.$edit_school_admin_groups_cv.'" target="_blank">'.$edit_school_admin_groups_cv.'</a>';
							echo $edit_school_admin_groups_cv;
							echo ' &middot; <a href="?del_cv='.$edit.'">Delete School Administration CV</a>';
							}
						else
							{
							echo '<input name="school_admin_groups_cv" type="file" />';
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
		$pagetype = 'School Administration Admin &middot; Edit Category';
		echo '<h1><a href="/panel/school-admin-officers?cat">Categories</a> &middot; Edit Category</h1>';
		$edit_cat = $_GET['edit_cat'];
		$result = mysql_query("SELECT * FROM school_admin_cat WHERE school_admin_cat_id='$edit_cat' LIMIT 1");
		$row = mysql_fetch_assoc($result);
		$edit_school_admin_cat_name = $row["school_admin_cat_name"];
		if (empty($_GET['edit_cat']))
			{
			echo '<hr><p>Category must be selected to be edited. You will be redirected to <a href="/panel/school-admin-officers/?cat">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers?cat>';
			}
		else
			{
			if (isset($_POST) && !empty($_POST['school_admin_cat_name']))
				{
				$school_admin_cat_name = htmlentities(($_POST['school_admin_cat_name']), ENT_QUOTES, 'utf-8');
				$result = mysql_query("UPDATE school_admin_cat SET school_admin_cat_name='$school_admin_cat_name' WHERE school_admin_cat_id='$edit_cat'");
				echo '<hr><p>Edited successfully! You will be redirected to <a href="/panel/school-admin-officers/?cat">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers/?cat>';
				}
			else
				{ ?>
				<div class="main">
				<form method="post" action="<?php echo $PHP_SELF; ?>?edit_cat=<?php echo $edit_cat; ?>">	
				<fieldset>
				    <legend>Category Name:</legend>
				    <ul><li><input name="school_admin_cat_name" value="<?php echo $edit_school_admin_cat_name; ?>" type="text"></li>
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
	$pagetype = 'School Administration Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/school-admin-officers">School Administration Admin</a> &middot; Delete Entry</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/school-admin-officers">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers>';
		}
	else
		{	
		$subresult = mysql_query("SELECT school_admin_groups_img FROM school_admin_groups WHERE school_admin_groups_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$school_admin_groups_img=$subrow['school_admin_groups_img'];
			$path= '../assets/img/school-admin/'. $school_admin_groups_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/school-admin/tn-'. $school_admin_groups_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
			
		$subresult2 = mysql_query("SELECT school_admin_groups_cv FROM school_admin_groups WHERE school_admin_groups_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult2))
			{
			$school_admin_groups_cv=$subrow['school_admin_groups_cv'];
			$path= '../assets/pdf/school-admin-cv/'. $school_admin_groups_cv .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			
			}	
		$result = mysql_query("DELETE FROM school_admin_groups WHERE school_admin_groups_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/school-admin-officers">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers>';
		}
	}
	
	
	
	
	
	

// Delete Category
	
elseif(isset($_GET['del_cat']))
	{
	$pagetype = 'School Administration Admin &middot; Delete Category';
	//echo '<h1><a href="/panel/menu?cat">Categories</a> &middot; Delete Category</h1>';
	$del_cat = $_GET['del_cat'];
	$result = mysql_query("SELECT * FROM school_admin_cat WHERE school_admin_cat_id='$del_cat' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_school_admin_cat_name = $row["school_admin_cat_name"];
	if (empty($_GET['del_cat']))
		{ echo '<hr>Category must be selected to be deleted. You will be redirected to <a href="/panel/school-admin-officers?cat">Category Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers?cat>';
		}
	else
		{
		echo '<h1>Deleted '.$del_school_admin_cat_name.'</h1>';
		//$subresult = mysql_query("DELETE FROM menu_cat_list WHERE menu_cat_id='$del_cat'");
		$result = mysql_query("DELETE FROM school_admin_cat WHERE school_admin_cat_id='$del_cat'");
		echo '<p>Deleted! You will be redirected to <a href="/panel/school-admin-officers?cat">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers?cat>';
		}
	}		

	
	
	
	
	
	
	
elseif(isset($_GET['del_img']))
	{
	$pagetype = 'School Administration Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/school-admin-officers">School Administration Admin</a> &middot; Delete Entry Image</h1>';
	$del_img = $_GET['del_img'];
	if (empty($_GET['del_img']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/school-admin-officers">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers>';
		}
	else
		{	
		$subresult = mysql_query("SELECT school_admin_groups_img FROM school_admin_groups WHERE school_admin_groups_id='$del_img'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$school_admin_groups_img=$subrow['school_admin_groups_img'];
			$path= '../assets/img/school-admin/'. $school_admin_groups_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/school-admin/tn-'. $school_admin_groups_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE school_admin_groups SET school_admin_groups_img='' WHERE school_admin_groups_id='$del_img'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/school-admin-officers">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers>';
		
		}
	}
	
elseif(isset($_GET['del_cv']))
	{
	$pagetype = 'School Administration Admin &middot; Delete Entry (kage';
	echo '<h1><a href="/panel/school-admin-officers">School Administration Admin</a> &middot; Delete Entry CV</h1>';
	$del_cv = $_GET['del_cv'];
	if (empty($_GET['del_cv']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/school-admin-officers">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers>';
		}
	else
		{	
		$subresult = mysql_query("SELECT school_admin_groups_cv FROM school_admin_groups WHERE school_admin_groups_id='$del_cv'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$school_admin_groups_cv=$subrow['school_admin_groups_cv'];
			$path= '../assets/pdf/school-admin-cv/'. $school_admin_groups_cv .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			//$path2= '../assets/img/school-admin/tn-'. $school_admin_groups_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE school_admin_groups SET school_admin_groups_cv='' WHERE school_admin_groups_id='$del_cv'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/school-admin-officers">School Administration Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/school-admin-officers>';
		
		}
	}
	
	
	
	
	





// Beginning of Category List Page

elseif(isset($_GET['cat']))
	{
	$pagetype = "Category List";
	echo '<h1 class="l2">'.$pagetype.'</h1> <h5 class="r"><a href="/panel/school-admin-officers">Return to School Administration Admin</a> &middot; <a href="?add_cat">Add Category</a> </h5><div class="clear">&nbsp;</div>';
	echo '<div class="hr"><hr /></div>';
	//echo '<div class="main2">';
	$result = mysql_query("SELECT * FROM school_admin_cat ORDER BY school_admin_cat_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no category entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$school_admin_cat_id=$row['school_admin_cat_id'];
			$school_admin_cat_name=$row['school_admin_cat_name'];
			
			echo '<h2>'.$school_admin_cat_name.'</h2>';
			
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit_cat='.$school_admin_cat_id.'">Edit</a> &middot; 
			<a href="'.$PHP_SELF.'?del_cat='.$school_admin_cat_id.'">Delete</a></em></small></p>';	
			//echo '</div><!-- close main div -->';	
			}
		}
	}



	
	
	
	
	
	
	
	
	

else
	{
	$pagetype = 'School Administration Admin';
	echo '<h1 class="l2">'.$pagetype.'</h1><h5 class="r"><a href="?add"> Add Entry</a> &middot; <a href="?add_cat"> Add Category</a> &middot; <a href="/panel/school-admin-officers?cat">View Category List</a></h5><div class="clear">&nbsp;</div><p></p>';
	
	$result = mysql_query("SELECT * FROM school_admin_groups, school_admin_cat WHERE school_admin_groups.school_admin_cat_id=school_admin_cat.school_admin_cat_id ORDER BY school_admin_cat.school_admin_cat_name DESC, school_admin_groups.school_admin_groups_name ASC") or die(mysql_error());
	
	
	
	//$result = mysql_query("SELECT school_admin_groups_id, school_admin_groups_name, school_admin_groups_full, school_admin_groups_email, school_admin_groups_img, school_admin_groups_cv FROM office ORDER BY school_admin_groups_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<hr/><p>There are no cabinet entries.</p>';
		}
	else
		{
		$school_admin_cat_id = '';
		while($row = mysql_fetch_array($result))
			{
			$school_admin_groups_id=$row['school_admin_groups_id'];
			$school_admin_groups_name=$row['school_admin_groups_name'];
			$school_admin_groups_full=$row['school_admin_groups_full'];
			$school_admin_groups_email=$row['school_admin_groups_email'];
			$school_admin_groups_img=$row['school_admin_groups_img'];
			$school_admin_groups_cv=$row['school_admin_groups_cv'];
			if($school_admin_cat_id!=$row['school_admin_cat_id'])
				{
				$school_admin_cat_id=$row['school_admin_cat_id'];
				$school_admin_cat_name=$row['school_admin_cat_name'];
				
				
				echo '<hr/><h2 align="center">'.$school_admin_cat_name.'</h2>';
				}
				
			echo '<hr><h3>';
			if(!empty($school_admin_groups_img))
				{
				echo '<img src="/assets/img/icon-photo.gif"> ';
				} else {}
			echo ''.$school_admin_groups_name.': '.$school_admin_groups_full.'</h3>';
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit='.$school_admin_groups_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$school_admin_groups_id.'">Delete</a></em></small></p>';
				
			
				
			}
		}
		
	}





include '../'.$foot; ?>