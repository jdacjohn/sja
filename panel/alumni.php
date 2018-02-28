<?php $pagetitle = "Alumni Photo Sharing"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);


//alumni_caption, alumni_img FROM alumni 
if(isset($_GET['add']))
	{
	$pagetype = 'Alumni Photo Sharing Admin &middot; Add Image';
	echo '<h1><a href="/panel/alumni">Alumni Photo Sharing Admin</a> &middot; Add Image</h1>';
	if (isset($_POST) && !empty($_POST['alumni_caption']))
		{
		if (!empty($_FILES["alumni_img"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["alumni_img"]["tmp_name"];
			$img_size = ($_FILES["alumni_img"]["size"] / 1024);
			$file_name = basename($_FILES["alumni_img"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))

				{
				$alumni_img = $img_md5.'.'.$file_ext;
				$alumni_img_target = "../assets/img/alumni/".$alumni_img;
				move_uploaded_file($_FILES["alumni_img"]["tmp_name"],$alumni_img_target);
				square_crop('../assets/img/alumni/'.$alumni_img.'', '../assets/img/alumni/thumb-'.$alumni_img.'', 150);
				}
			else
				{
				echo '<h1>'.$pagetitle.'</h1><hr><p>ONLY images under 2MB are accepted for upload. Please try again. You will be redirected to the <a href="/panel/alumni">Alumni Photo Sharing Admin</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/alumni>';
				}
				
			}
		$alumni_caption = htmlentities(($_POST['alumni_caption']), ENT_QUOTES, 'utf-8');
		
		
				
		$result = mysql_query("INSERT INTO alumni (alumni_date, alumni_caption, alumni_img) VALUES (NOW(), '$alumni_caption','$alumni_img')") or die(mysql_error());
		for($i=0; $i < count($_POST['alumni_cat_list']);$i++)
			{
			if(($_POST['alumni_cat_list'][$i]) != '')
			{
			$result = mysql_query("SELECT alumni_id FROM alumni ORDER BY alumni_id DESC LIMIT 1") or die(mysql_error());
			while($row = mysql_fetch_array($result))
				{
				$alumni_id = $row["alumni_id"];
				//$fun_id = $row["fun_id"] +1;
				$alumni_cat_id = htmlspecialchars($_POST['alumni_cat_list'][$i]);
				$subresult = mysql_query("INSERT INTO alumni_cat_list (alumni_cat_id, alumni_id) VALUES ('$alumni_cat_id','$alumni_id')");
				}
			}
			else {
				
			}
		}
		
		
		
		echo '<hr><p> Your image was successfully added! You will be redirected to <a href="/panel/alumni">Alumni Photo Sharing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/alumni>';
		
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">
	<fieldset>
	    <legend>Caption:</legend>
	    <ul><li><input name="alumni_caption" value="<?= @$_POST['alumni_caption']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Category:</legend>
		    <ul>
		    <li><select name="alumni_cat_list[]">
		    <!--<option value="">&nbsp;</option> -->
		    <option value="Choose a Category">Choose a Category</option>
		    <?php $result = mysql_query("SELECT * FROM alumni_cat ORDER BY alumni_cat_name ASC") or die(mysql_error());
		    while($row = mysql_fetch_array( $result ))
		    	{
		    	$alumni_cat_id=$row['alumni_cat_id'];
		    	$alumni_cat_name=$row['alumni_cat_name'];
		    	echo '<option value="'.$alumni_cat_id.'">'.$alumni_cat_name.'</option>';
		    	}
		    ?></select></li>
		    </ul>
		    
	</fieldset>
	<fieldset>
		<legend>Image:</legend>
		<ul><li><input name="alumni_img" type="file" /></li>
		<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}
	


	
// ----- Category List ----- //

elseif(isset($_GET['cat']))
	{
	$pagetype = "Category List";
	echo '<h1 class="l"><a href="/panel/alumni">Alumni Photo Sharing Admin</a> &middot; Categories</h1>  <h1 class="r"><a href="?add_cat">Add Image Category</a></h1><div class="clear">&nbsp;</div><hr/> ';

	$result = mysql_query("SELECT alumni_cat_id, alumni_cat_name FROM alumni_cat ORDER BY alumni_cat_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no categories.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$alumni_cat_id=$row['alumni_cat_id'];
			$alumni_cat_name=$row['alumni_cat_name'];
			
			
			echo '<h4>'.$alumni_cat_name.'</h4>';
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit_cat='.$alumni_cat_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del_cat='.$alumni_cat_id.'">Delete</a></em></small></p>';	
			
			
			
			//echo '<p><small><em><a href="'.$PHP_SELF.'?edit_cat='.$fun_cat_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del_cat='.$fun_cat_id.'">Delete</a></p>';	
			
			}
		}
	}
		
		

		

// ----- Add Category ----- //
elseif(isset($_GET['add_cat']))
	{
	$pagetype = 'Add Category';
	echo '<h1><a href="/panel/alumni?cat">Alumni Photo Sharing Admin</a> &middot; Add Image Category</h1>';
	
	if (isset($_POST) && !empty($_POST['alumni_cat_name']))
		{
		$alumni_cat_name = htmlentities(($_POST['alumni_cat_name']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO alumni_cat (alumni_cat_name) VALUES ('$alumni_cat_name')");
		echo '<hr/><p>'.$alumni_cat_name.' was successfully added! You will be redirected to <a href="/panel/alumni/?cat">Alumni Photo Sharing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/alumni/?cat>';

		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add_cat">
	<fieldset>
		<legend>Category Name:</legend>
		<ul><li><input name="alumni_cat_name" value="<?= @$_POST['alumni_cat_name']?>" type="text"></li></ul>	
	</fieldset>
	<fieldset>
		<ul><li class="login"><input type="submit" value="Save" name="submit"/></li></ul>
	</fieldset>
	</form>
	
<?php
		}
	}



	
elseif(isset($_GET['edit']))
	{
	$pagetype = 'Alumni Photo Sharing Admin &middot; Edit Image';
	echo '<h1><a href="/panel/alumni">Alumni Photo Sharing Admin</a> &middot; Edit Image</h1>';
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM alumni WHERE alumni_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_alumni_caption = $row["alumni_caption"];
	$edit_alumni_img = $row["alumni_img"];
	
	if (empty($_GET['edit']))
		{
		echo '<hr>Image must be selected to be edited. You will be redirected to <a href="/panel/alumni">Alumni Photo Sharing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/alumni>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['alumni_caption']))
			{
			$alumni_caption = htmlentities(($_POST['alumni_caption']), ENT_QUOTES, 'utf-8');
			$subresult = mysql_query("DELETE FROM alumni_cat_list WHERE alumni_id='$edit'");
			for($i=0; $i < count($_POST['alumni_cat_list']);$i++)
				{
				if(!empty($_POST['alumni_cat_list'][$i]))
					{
					$alumni_cat_id = htmlspecialchars($_POST['alumni_cat_list'][$i]);
					$subresult = mysql_query("INSERT INTO alumni_cat_list (alumni_cat_id, alumni_id) VALUES ('$alumni_cat_id','$edit')");
					}
				else
					{
					}
				}
			
			
			
			
			$result = mysql_query("UPDATE alumni SET alumni_date=NOW(), alumni_caption='$alumni_caption' WHERE alumni_id='$edit'");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/alumni">Alumni Photo Sharing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/alumni>';
			}
		else
			{ ?>
			<hr>
			<img src="/assets/img/alumni/<?php echo $edit_alumni_img; ?>">
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" enctype="multipart/form-data">			
			<fieldset>
			    <legend>Caption:</legend>
			    <ul><li><input name="alumni_caption" value="<?php echo $edit_alumni_caption; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Category:</legend>
				    <ul>
				    <?php
				    $subresult = mysql_query("SELECT DISTINCT alumni_cat_list.alumni_cat_id FROM alumni_cat_list, alumni_cat WHERE alumni_cat_list.alumni_id='$edit' AND alumni_cat_list.alumni_cat_id=alumni_cat.alumni_cat_id ORDER BY alumni_cat_name ASC");
				    while($row = mysql_fetch_array( $subresult ))
				    	{
				    	$alumni_cat_id=$row['alumni_cat_id'];
				    	echo '<li><select name="alumni_cat_list[]"><option value="">&nbsp;</option>';
				    	$result = mysql_query("SELECT * FROM alumni_cat ORDER BY alumni_cat_name ASC") or die(mysql_error());
				    	while($row = mysql_fetch_array( $result ))
				    		{
				    		$sub_alumni_cat_id=$row['alumni_cat_id'];
				    		$sub_alumni_cat_name=$row['alumni_cat_name'];
				    		echo '<option value="'.$sub_alumni_cat_id.'"';
				    		if($sub_alumni_cat_id==$alumni_cat_id) {echo " selected";} else {}
				    		echo '>'.$sub_alumni_cat_name.'</option>';
				    		}
				    	echo '</select></li>';
				    	}
				    ?>
				    
				    
				    <li><select name="alumni_alumni_list[]">
				    <option value="">&nbsp;</option>
				    <?php $result = mysql_query("SELECT * FROM alumni_cat ORDER BY alumni_cat_name ASC") or die(mysql_error());
				    while($row = mysql_fetch_array( $result ))
				    	{
				    	$alumni_cat_id=$row['alumni_cat_id'];
				    	$alumni_cat_name=$row['alumni_cat_name'];
				    	echo '<option value="'.$alumni_cat_id.'">'.$alumni_cat_name.'</option>';
				    	
				    	if($alumni_cat_id==$edit_alumni_cat_id)
				    		{
				    		echo ' selected';
				    		}		
				    	else
				    		{
				    		}
				    	echo '>' . $alumni_cat_name . '</option>';
				    	}
				    ?></select></li>
				    </ul>
				    
			</fieldset>
			<fieldset>
				<ul><li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			</fieldset>
			
			</form>
<?php
			}
		}
	}


// ----- Edit Category ----- //
	
elseif(isset($_GET['edit_cat']))
	{
		$pagetype = 'Edit Category';
		echo '<h1><a href="/panel/alumni?cat">Alumni Photo Sharing Admin</a> &middot; Add Image Category</h1>';
		$edit_cat = $_GET['edit_cat'];
		$result = mysql_query("SELECT * FROM alumni_cat WHERE alumni_cat_id='$edit_cat' LIMIT 1");
		$row = mysql_fetch_assoc($result);
		$edit_alumni_cat_name = $row["alumni_cat_name"];
		if (empty($_GET['edit_cat']))
			{
			echo '<hr/><p>Category must be selected to be edited. You will be redirected to <a href="/panel/alumni/?cat">Alumni Photo Sharing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/alumni?cat>';
			}
		else
			{
			if (isset($_POST) && !empty($_POST['alumni_cat_name']))
				{
				$alumni_cat_name = htmlentities(($_POST['alumni_cat_name']), ENT_QUOTES, 'utf-8');
				$result = mysql_query("UPDATE alumni_cat SET alumni_cat_name='$alumni_cat_name' WHERE alumni_cat_id='$edit_cat'");
				echo '<hr/><p>Edited successfully! You will be redirected to <a href="/panel/alumni/?cat">Alumni Photo Sharing Admin</a>  shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/alumni/?cat>';
				}
			else
				{ ?>
				<div class="main">
				<form method="post" action="<?php echo $PHP_SELF; ?>?edit_cat=<?php echo $edit_cat; ?>">	
				<fieldset>
				    <legend>Category Name:</legend>
				    <ul><li><input name="alumni_cat_name" value="<?php echo $edit_alumni_cat_name; ?>" type="text"></li>
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
	$pagetype = 'Alumni Photo Sharing Admin &middot; Delete Image';
	echo '<h1><a href="/panel/alumni">Alumni Photo Sharing Admin</a> &middot; Delete Image</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Image must be selected to be deleted. You will be redirected to <a href="/panel/alumni">Alumni Photo Sharing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/alumni>';
		}
	else
		{	
		$subresult = mysql_query("SELECT alumni_img FROM alumni WHERE alumni_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$alumni_img=$subrow['alumni_img'];
			$path= '../assets/img/alumni/'. $alumni_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/alumni/thumb-'. $alumni_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$subresult2 = mysql_query("DELETE FROM alumni_cat_list WHERE alumni_id='$del'");	
		$result = mysql_query("DELETE FROM alumni WHERE alumni_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/alumni"> Alumni Photo Sharing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/alumni>';
		}
	}
	

// ----- Delete Category ----- //
	
elseif(isset($_GET['del_cat']))
	{
	$pagetype = 'Delete Category';
	//echo '<h1><a href="/panel/menu?cat">Categories</a> &middot; Delete Category</h1>';
	$del_cat = $_GET['del_cat'];
	$result = mysql_query("SELECT * FROM alumni_cat WHERE alumni_cat_id='$del_cat' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_alumni_cat_name = $row["alumni_cat_name"];
	if (empty($_GET['del_cat']))
		{ echo '<hr/><p>Category must be selected to be edited. You will be redirected to <a href="/panel/alumni/?cat">Alumni Photo Sharing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/alumni?cat>';
		}
	else
		{
		echo '<h1>Deleted '.$del_alumni_cat_name.'</h1>';
		//$subresult = mysql_query("DELETE FROM menu_cat_list WHERE menu_cat_id='$del_cat'");
		$result = mysql_query("DELETE FROM alumni_cat WHERE alumni_cat_id='$del_cat'");
		echo '<p align="center">Deleted! You will be redirected to <a href="/panel/alumni/?cat">Alumni Photo Sharing Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/alumni?cat>';
		}
	}		
	
	

else
	{
	$pagetype = 'Alumni Photo Sharing Admin';
	echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="?cat">Category List</a> &middot; <a href="?add">Add Image</a></h1><div class="clear">&nbsp;</div><hr/>';
	$result = mysql_query("SELECT * FROM alumni, alumni_cat, alumni_cat_list WHERE alumni.alumni_id=alumni_cat_list.alumni_id AND alumni_cat.alumni_cat_id=alumni_cat_list.alumni_cat_id ORDER BY alumni_cat_name ASC") or die(mysql_error());
	
	echo '<div class="image">';
	if(mysql_num_rows($result)==0)
		{
		echo 'There are no images at this time.';
		}
	else
		{
		$alumni_id = '';
		while($row = mysql_fetch_array($result))
			{
				if ($alumni_id!=$row['alumni_id'])
				{
				$alumni_cat_id=$row['alumni_cat_id'];
				$alumni_id=$row['alumni_id'];
				$alumni_date=$row['alumni_date'];
				$alumni_caption=$row['alumni_caption'];
				$alumni_img=$row['alumni_img'];
				$alumni_cat_name=$row['alumni_cat_name'];
				
				
				echo '<p><a href="'.$PHP_SELF.'?edit='.$alumni_id.'"><img src="/assets/img/alumni/thumb-'.$alumni_img.'"></a><br><a href="'.$PHP_SELF.'?edit='.$alumni_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$alumni_id.'">Delete</a><br/>';
				echo '"'.$alumni_caption.'"<br/><small><b>Tag: '.$alumni_cat_name.'</small></b><br/><small>'.$alumni_date.'</small> </p> ';
				echo '';
				}
			
				else {
					
				}
						
				
			}
		}
		echo '<div class="clear">&nbsp;</div></div>';
	}







	


include '../'.$foot; ?>