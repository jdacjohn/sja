<?php $pagetitle = "Office Cabinet Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);



//office_cabinet_name, office_cabinet_full, office_cabinet_email, office_cabinet_img, office_cabinet_cv FROM office_cabinet 
if(isset($_GET['add']))
	{
	$pagetype = 'Office Cabinet Admin &middot; Add Entry';
	echo '<h1><a href="/panel/office-cabinet">Office Cabinet Admin</a> &middot; Add Entry</h1>';
	if (isset($_POST) && !empty($_POST['office_cabinet_name']))
		{
		if (!empty($_FILES["office_cabinet_img"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["office_cabinet_img"]["tmp_name"];
			$img_size = ($_FILES["office_cabinet_img"]["size"] / 1024);
			$file_name = basename($_FILES["office_cabinet_img"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$office_cabinet_img = $img_md5.'.'.$file_ext;
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$office_cabinet_img = $img_md5.'.'.$file_ext;
				$office_cabinet_img_target = "../assets/img/office/".$office_cabinet_img;
				move_uploaded_file($_FILES["office_cabinet_img"]["tmp_name"],$office_cabinet_img_target);
				$resizeObj = new resize('../assets/img/office/'.$office_cabinet_img); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/office/tn-'.$office_cabinet_img, 100); // *** 3) Save image
				}
			else
				{
				$office_cabinet_img = '';
				}
			}
		else
			{
			$office_cabinet_img = '';
			}
		$office_cabinet_name = htmlentities(($_POST['office_cabinet_name']), ENT_QUOTES, 'utf-8');
		$office_cabinet_full = htmlentities(($_POST['office_cabinet_full']), ENT_QUOTES, 'utf-8');
		$office_cabinet_email = htmlentities(($_POST['office_cabinet_email']), ENT_QUOTES, 'utf-8');
		$office_cat_id = htmlentities(($_POST['office_cat_id']), ENT_QUOTES, 'utf-8');
		if(!empty($_FILES['office_cabinet_cv']['name']))
			{
			$office_cabinet_cv = date("mdy")."-".preg_replace("([^a-z0-9._-])",'',strtolower(str_replace(' ', '', $_FILES["office_cabinet_cv"]["name"])));
			$office_cabinet_cv_target = "../assets/pdf/office-cv/".$office_cabinet_cv;
			move_uploaded_file($_FILES["office_cabinet_cv"]["tmp_name"],$office_cabinet_cv_target);
			}
		else
			{
			$office_cabinet_cv='';
			}
			
			
		$result = mysql_query("INSERT INTO office_cabinet (office_cabinet_name, office_cabinet_full, office_cabinet_email, office_cabinet_img, office_cabinet_cv, office_cat_id) VALUES ('$office_cabinet_name','$office_cabinet_full','$office_cabinet_email','$office_cabinet_img','$office_cabinet_cv','$office_cat_id')") or die(mysql_error());
		echo '<hr><p>'.$office_cabinet_name.' was successfully added! You will be redirected to <a href="/panel/office-cabinet">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet>';
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">
	<fieldset>
	    <legend>Name:</legend>
	    <ul><li><input name="office_cabinet_name" value="<?= @$_POST['office_cabinet_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="office_cabinet_full" value="<?= @$_POST['office_cabinet_full']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Email:</legend>
	    <ul><li><input name="office_cabinet_email" value="<?= @$_POST['office_cabinet_email']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>Category:</legend>
		<ul><li><select name="office_cat_id">
		<option value="Choose a Category">Choose a Category</option>
		<?php
		$result = mysql_query("SELECT * FROM office_cat ORDER BY office_cat_name ASC") or die(mysql_error());
		while($row = mysql_fetch_array( $result ))
			{
			$office_cat_id=$row['office_cat_id'];
			$office_cat_name=$row['office_cat_name'];
			echo '<option value="'.$office_cat_id.'">'.$office_cat_name.'</option>';
			}
		?></select></li>
		</ul>
	</fieldset>
	<fieldset>
		<legend>Image:</legend>
		<ul><li><input name="office_cabinet_img" type="file" /></li></ul>
	</fieldset>
	<fieldset>
		<legend>CV:</legend>
		<ul><li><input name="office_cabinet_cv" type="file" /></li>
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
	echo '<h1><a href="/panel/office-cabinet?cat">Categories</a> &middot; Add Category</h1>';
	
	if (isset($_POST) && !empty($_POST['office_cat_name']))
		{
		$office_cat_name = htmlentities(($_POST['office_cat_name']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO office_cat (office_cat_name) VALUES ('$office_cat_name')");
		echo '<p>'.$office_cat_name.' was successfully added! You will be redirected to <a href="/panel/office-cabinet/?cat">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet/?cat>';
		}
	else
		{
	?><hr/>
	<div class="main">
	<form method="post" action="?add_cat">
	<fieldset>
		<legend>Category Name:</legend>
		<ul><li><input name="office_cat_name" value="<?= @$_POST['office_cat_name']?>" type="text"></li></ul>	
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
	$pagetype = 'Office Cabinet Admin &middot; Edit Entry';
	echo '<h1><a href="/panel/office-cabinet">Office Cabinet Admin</a> &middot; Edit Entry</h1>';
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM office_cabinet WHERE office_cabinet_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_office_cabinet_name = $row["office_cabinet_name"];
	$edit_office_cabinet_full = $row["office_cabinet_full"];
	$edit_office_cabinet_email = $row["office_cabinet_email"];
	$edit_office_cabinet_img = $row["office_cabinet_img"];
	$edit_office_cabinet_cv = $row["office_cabinet_cv"];
	$edit_office_cat_id = $row["office_cat_id"];
	if (empty($_GET['edit']))
		{
		echo '<hr>Entry must be selected to be edited. You will be redirected to <a href="/panel/office-cabinet">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['office_cabinet_name']))
			{
			$office_cabinet_name = htmlentities(($_POST['office_cabinet_name']), ENT_QUOTES, 'utf-8');
			$office_cabinet_full = htmlentities(($_POST['office_cabinet_full']), ENT_QUOTES, 'utf-8');
			$office_cabinet_email = htmlentities(($_POST['office_cabinet_email']), ENT_QUOTES, 'utf-8');			
			$office_cat_id = htmlentities(($_POST['office_cat_id']), ENT_QUOTES, 'utf-8');
			if (!empty($_FILES["office_cabinet_img"]["name"]))
				{
				$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
				$img_tmp = $_FILES["office_cabinet_img"]["tmp_name"];
				$img_size = ($_FILES["office_cabinet_img"]["size"] / 1024);
				$file_name = basename($_FILES["office_cabinet_img"]["name"]);
				$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
				$office_cabinet_img = $img_md5.'.'.$file_ext;
				$max_file = '2048';
				if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
					{
					$office_cabinet_img = $img_md5.'.'.$file_ext;
					$office_cabinet_img_target = "../assets/img/office/".$office_cabinet_img;
					move_uploaded_file($_FILES["office_cabinet_img"]["tmp_name"],$office_cabinet_img_target);
					$resizeObj = new resize('../assets/img/office/'.$office_cabinet_img); // *** 1) Initialise / load image
					$resizeObj -> resizeImage(80, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> saveImage('../assets/img/office/tn-'.$office_cabinet_img, 100); // *** 3) Save image
					}
				else
					{
					$office_cabinet_img = $edit_office_cabinet_img;
					}
				}
			else
				{
				$office_cabinet_img = $edit_office_cabinet_img;
				} // End of Img 
			
			if(!empty($_FILES['office_cabinet_cv']['name']))
				{
				$office_cabinet_cv = date("mdy")."-".preg_replace("([^a-z0-9._-])",'',strtolower(str_replace(' ', '', $_FILES["office_cabinet_cv"]["name"])));
				$office_cabinet_cv_target = "../assets/pdf/office-cv/".$office_cabinet_cv;
				move_uploaded_file($_FILES["office_cabinet_cv"]["tmp_name"],$office_cabinet_cv_target);
				}
			else
				{
				$office_cabinet_cv = $edit_office_cabinet_cv;
				}
	
			//echo "UPDATE office SET office_cabinet_name='$office_cabinet_name', office_cabinet_full='$office_cabinet_full', office_cabinet_email='$office_cabinet_email', office_cabinet_img='$office_cabinet_img', office_cabinet_cv='$office_cabinet_cv', office_cat_id='$office_cat_id' WHERE office_cabinet_id='$edit' ";
			
			
			
			$result = mysql_query("UPDATE office_cabinet SET office_cabinet_name='$office_cabinet_name', office_cabinet_full='$office_cabinet_full', office_cabinet_email='$office_cabinet_email', office_cabinet_img='$office_cabinet_img', office_cabinet_cv='$office_cabinet_cv', office_cat_id='$office_cat_id' WHERE office_cabinet_id='$edit' ");
			
			
			
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/office-cabinet">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet>';
			}
		else
			{ ?>
			<hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" enctype="multipart/form-data">			
			<fieldset>
			    <legend>Name:</legend>
			    <ul><li><input name="office_cabinet_name" value="<?php echo $edit_office_cabinet_name; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="office_cabinet_full" value="<?php echo $edit_office_cabinet_full; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>Email:</legend>
				<ul><li><input name="office_cabinet_email" value="<?php echo $edit_office_cabinet_email; ?>" type="text"></li></ul>
			</fieldset>
			
			
			<fieldset>
			    <legend>Menu Category:</legend>
			    <ul><li><select name="office_cat_id">
			    <option value="Choose a Category">Choose a Category</option>
			    <!-- <option value="">&nbsp;</option> -->
			    <?php
			    $result = mysql_query("SELECT * FROM office_cat ORDER BY office_cat_name ASC") or die(mysql_error());
			    while($row = mysql_fetch_array($result))
				    	{
				    	$office_cat_id = $row['office_cat_id'];
				    	$office_cat_name = $row['office_cat_name'];
				    	echo '<option value="' . $office_cat_id . '"';
				    	if($office_cat_id==$edit_office_cat_id)
				    		{
				    		echo ' selected';
				    		}		
				    	else
				    		{
				    		}
				    	echo '>' . $office_cat_name . '</option>';
				    	} ?></select></li></ul>
			</fieldset>
			
			<fieldset>
				<legend>Image:</legend>
				<ul><li>
				<?php
				if(!empty($edit_office_cabinet_img))
					{
					echo '<input type="hidden" name="office_cabinet_img" value="'.$edit_office_cabinet_img.'">';
					echo '<img src="/assets/img/office/tn-'.$edit_office_cabinet_img.'">';
					echo '<br><a href="?del_img='.$edit.'">Delete Image</a>';
					}
				else
					{
					echo '<input name="office_cabinet_img" type="file" />';
					}
				?>
				</li>
				<fieldset>
					<legend>CV:</legend>
					<ul><li>
						<?php 
						if(!empty($edit_office_cabinet_cv))
							{
							echo '<input type="hidden" name="office_cabinet_cv" value="'.$edit_office_cabinet_cv.'">';
							//echo '<a href="../assets/pdf/office-cv/'.$edit_office_cabinet_cv.'" target="_blank">'.$edit_office_cabinet_cv.'</a>';
							echo $edit_office_cabinet_cv;
							echo ' &middot; <a href="?del_cv='.$edit.'">Delete Office Cabinet CV</a>';
							}
						else
							{
							echo '<input name="office_cabinet_cv" type="file" />';
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
		$pagetype = 'Office Cabinet Admin &middot; Edit Category';
		echo '<h1><a href="/panel/office-cabinet?cat">Categories</a> &middot; Edit Category</h1>';
		$edit_cat = $_GET['edit_cat'];
		$result = mysql_query("SELECT * FROM office_cat WHERE office_cat_id='$edit_cat' LIMIT 1");
		$row = mysql_fetch_assoc($result);
		$edit_office_cat_name = $row["office_cat_name"];
		if (empty($_GET['edit_cat']))
			{
			echo '<hr><p>Category must be selected to be edited. You will be redirected to <a href="/panel/office-cabinet/?cat">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet?cat>';
			}
		else
			{
			if (isset($_POST) && !empty($_POST['office_cat_name']))
				{
				$office_cat_name = htmlentities(($_POST['office_cat_name']), ENT_QUOTES, 'utf-8');
				$result = mysql_query("UPDATE office_cat SET office_cat_name='$office_cat_name' WHERE office_cat_id='$edit_cat'");
				echo '<hr><p>Edited successfully! You will be redirected to <a href="/panel/office-cabinet/?cat">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet/?cat>';
				}
			else
				{ ?>
				<div class="main">
				<form method="post" action="<?php echo $PHP_SELF; ?>?edit_cat=<?php echo $edit_cat; ?>">	
				<fieldset>
				    <legend>Category Name:</legend>
				    <ul><li><input name="office_cat_name" value="<?php echo $edit_office_cat_name; ?>" type="text"></li>
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
	$pagetype = 'Office Cabinet Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/office-cabinet">Office Cabinet Admin</a> &middot; Delete Entry</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/office-cabinet">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet>';
		}
	else
		{	
		$subresult = mysql_query("SELECT office_cabinet_img FROM office_cabinet WHERE office_cabinet_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$office_cabinet_img=$subrow['office_cabinet_img'];
			$path= '../assets/img/office/'. $office_cabinet_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/office/tn-'. $office_cabinet_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
			
		$subresult2 = mysql_query("SELECT office_cabinet_cv FROM office_cabinet WHERE office_cabinet_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult2))
			{
			$office_cabinet_cv=$subrow['office_cabinet_cv'];
			$path= '../assets/pdf/office-cv/'. $office_cabinet_cv .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			
			}	
		$result = mysql_query("DELETE FROM office_cabinet WHERE office_cabinet_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/office-cabinet">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet>';
		}
	}
	
	
	
	
	
	

// Delete Category
	
elseif(isset($_GET['del_cat']))
	{
	$pagetype = 'Office Cabinet Admin &middot; Delete Category';
	//echo '<h1><a href="/panel/menu?cat">Categories</a> &middot; Delete Category</h1>';
	$del_cat = $_GET['del_cat'];
	$result = mysql_query("SELECT * FROM office_cat WHERE office_cat_id='$del_cat' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_office_cat_name = $row["office_cat_name"];
	if (empty($_GET['del_cat']))
		{ echo '<hr>Category must be selected to be deleted. You will be redirected to <a href="/panel/office-cabinet?cat">Category Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet?cat>';
		}
	else
		{
		echo '<h1>Deleted '.$del_office_cat_name.'</h1>';
		//$subresult = mysql_query("DELETE FROM menu_cat_list WHERE menu_cat_id='$del_cat'");
		$result = mysql_query("DELETE FROM office_cat WHERE office_cat_id='$del_cat'");
		echo '<p>Deleted! You will be redirected to <a href="/panel/office-cabinet?cat">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet?cat>';
		}
	}		

	
	
	
	
	
	
	
elseif(isset($_GET['del_img']))
	{
	$pagetype = 'Office Cabinet Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/office-cabinet">Office Cabinet Admin</a> &middot; Delete Entry Image</h1>';
	$del_img = $_GET['del_img'];
	if (empty($_GET['del_img']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/office-cabinet">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet>';
		}
	else
		{	
		$subresult = mysql_query("SELECT office_cabinet_img FROM office_cabinet WHERE office_cabinet_id='$del_img'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$office_cabinet_img=$subrow['office_cabinet_img'];
			$path= '../assets/img/office/'. $office_cabinet_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/office/tn-'. $office_cabinet_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE office_cabinet SET office_cabinet_img='' WHERE office_cabinet_id='$del_img'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/office-cabinet">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet>';
		
		}
	}
	
elseif(isset($_GET['del_cv']))
	{
	$pagetype = 'Office Cabinet Admin &middot; Delete Entry (kage';
	echo '<h1><a href="/panel/office-cabinet">Office Cabinet Admin</a> &middot; Delete Entry CV</h1>';
	$del_cv = $_GET['del_cv'];
	if (empty($_GET['del_cv']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/office-cabinet">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet>';
		}
	else
		{	
		$subresult = mysql_query("SELECT office_cabinet_cv FROM office_cabinet WHERE office_cabinet_id='$del_cv'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$office_cabinet_cv=$subrow['office_cabinet_cv'];
			$path= '../assets/pdf/office-cv/'. $office_cabinet_cv .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			//$path2= '../assets/img/office/tn-'. $office_cabinet_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE office_cabinet SET office_cabinet_cv='' WHERE office_cabinet_id='$del_cv'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/office-cabinet">Office Cabinet Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/office-cabinet>';
		
		}
	}
	
	
	
	
	





// Beginning of Category List Page

elseif(isset($_GET['cat']))
	{
	$pagetype = "Category List";
	echo '<h1 class="l2">'.$pagetype.'</h1> <h5 class="r"><a href="/panel/office-cabinet">Return to Office Cabinet Admin</a> &middot; <a href="?add_cat">Add Category</a> </h5><div class="clear">&nbsp;</div>';
	echo '<div class="hr"><hr /></div>';
	//echo '<div class="main2">';
	$result = mysql_query("SELECT * FROM office_cat ORDER BY office_cat_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no category entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$office_cat_id=$row['office_cat_id'];
			$office_cat_name=$row['office_cat_name'];
			
			echo '<h2>'.$office_cat_name.'</h2>';
			
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit_cat='.$office_cat_id.'">Edit</a> &middot; 
			<a href="'.$PHP_SELF.'?del_cat='.$office_cat_id.'">Delete</a></em></small></p>';	
			//echo '</div><!-- close main div -->';	
			}
		}
	}



	
	
	
	
	
	
	
	
	

else
	{
	$pagetype = 'Office Cabinet Admin';
	echo '<h1 class="l2">'.$pagetype.'</h1><h5 class="r"><a href="?add"> Add Entry</a> &middot; <a href="?add_cat"> Add Category</a> &middot; <a href="/panel/office-cabinet?cat">View Category List</a></h5><div class="clear">&nbsp;</div><p></p>';
	
	$result = mysql_query("SELECT * FROM office_cabinet, office_cat WHERE office_cabinet.office_cat_id=office_cat.office_cat_id ORDER BY office_cat.office_cat_name ASC, office_cabinet.office_cabinet_name ASC") or die(mysql_error());
	
	
	
	//$result = mysql_query("SELECT office_cabinet_id, office_cabinet_name, office_cabinet_full, office_cabinet_email, office_cabinet_img, office_cabinet_cv FROM office ORDER BY office_cabinet_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<hr/><p>There are no cabinet entries.</p>';
		}
	else
		{
		$office_cat_id = '';
		while($row = mysql_fetch_array($result))
			{
			$office_cabinet_id=$row['office_cabinet_id'];
			$office_cabinet_name=$row['office_cabinet_name'];
			$office_cabinet_full=$row['office_cabinet_full'];
			$office_cabinet_email=$row['office_cabinet_email'];
			$office_cabinet_img=$row['office_cabinet_img'];
			$office_cabinet_cv=$row['office_cabinet_cv'];
			if($office_cat_id!=$row['office_cat_id'])
				{
				$office_cat_id=$row['office_cat_id'];
				$office_cat_name=$row['office_cat_name'];
				
				
				echo '<hr/><h2 align="center">'.$office_cat_name.'</h2>';
				}
				
			echo '<hr><h3>';
			if(!empty($office_cabinet_img))
				{
				echo '<img src="/assets/img/icon-photo.gif"> ';
				} else {}
			echo ''.$office_cabinet_name.': '.$office_cabinet_full.'</h3>';
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit='.$office_cabinet_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$office_cabinet_id.'">Delete</a></em></small></p>';
				
			
				
			}
		}
		
	}





include '../'.$foot; ?>