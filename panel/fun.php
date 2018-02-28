<?php $pagetitle = "Fun Facts and Photo Sharing"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);


//fun_caption, fun_img FROM fun 
if(isset($_GET['add']))
	{
	$pagetype = 'Fun Facts and Photo Sharing Admin &middot; Add Image';
	echo '<h1><a href="/panel/fun">Fun Facts Admin</a> &middot; Add Image</h1>';
	if (isset($_POST) && !empty($_POST['fun_caption']))
		{
		if (!empty($_FILES["fun_img"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["fun_img"]["tmp_name"];
			$img_size = ($_FILES["fun_img"]["size"] / 1024);
			$file_name = basename($_FILES["fun_img"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))

				{
				$fun_img = $img_md5.'.'.$file_ext;
				$fun_img_target = "../assets/img/fun/".$fun_img;
				move_uploaded_file($_FILES["fun_img"]["tmp_name"],$fun_img_target);
				square_crop('../assets/img/fun/'.$fun_img.'', '../assets/img/fun/thumb-'.$fun_img.'', 150);
				}
			else
				{
				echo '<h1>'.$pagetitle.'</h1><hr><p>ONLY images under 2MB are accepted for upload. Please try again. You will be redirected to the <a href="/panel/fun">Fun Facts Admin</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/fun>';
				}
				
			}
		
		
		$fun_caption = htmlentities(($_POST['fun_caption']), ENT_QUOTES, 'utf-8');
		
		
				
		$result = mysql_query("INSERT INTO fun (fun_date, fun_caption, fun_img) VALUES (NOW(), '$fun_caption','$fun_img')") or die(mysql_error());
		for($i=0; $i < count($_POST['fun_cat_list']);$i++)
			{
			if(($_POST['fun_cat_list'][$i]) != '')
			{
			$result = mysql_query("SELECT fun_id FROM fun ORDER BY fun_id DESC LIMIT 1") or die(mysql_error());
			while($row = mysql_fetch_array($result))
				{
				$fun_id = $row["fun_id"];
				//$fun_id = $row["fun_id"] +1;
				$fun_cat_id = htmlspecialchars($_POST['fun_cat_list'][$i]);
				$subresult = mysql_query("INSERT INTO fun_cat_list (fun_cat_id, fun_id) VALUES ('$fun_cat_id','$fun_id')");
				}
			}
			else {
				
			}
		}
		
		
		
		echo '<hr><p> Your image was successfully added! You will be redirected to <a href="/panel/fun">Fun Facts Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/fun>';
		
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">
	<fieldset>
	    <legend>Caption:</legend>
	    <ul><li><input name="fun_caption" value="<?= @$_POST['fun_caption']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Category:</legend>
		    <ul>
		    <li><select name="fun_cat_list[]">
		    <!--<option value="">&nbsp;</option> -->
		    <option value="Choose a Category">Choose a Category</option>
		    <?php $result = mysql_query("SELECT * FROM fun_cat ORDER BY fun_cat_name ASC") or die(mysql_error());
		    while($row = mysql_fetch_array( $result ))
		    	{
		    	$fun_cat_id=$row['fun_cat_id'];
		    	$fun_cat_name=$row['fun_cat_name'];
		    	echo '<option value="'.$fun_cat_id.'">'.$fun_cat_name.'</option>';
		    	}
		    ?></select></li>
		    </ul>
		    
	</fieldset>
	<fieldset>
		<legend>Image:</legend>
		<ul><li><input name="fun_img" type="file" /></li>
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
	echo '<h1 class="l"><a href="/panel/fun">Fun Facts Admin</a> &middot; Categories</h1>  <h1 class="r"><a href="?add_cat">Add Image Category</a></h1> <div class="clear">&nbsp;</div><hr/> ';

	$result = mysql_query("SELECT fun_cat_id, fun_cat_name FROM fun_cat ORDER BY fun_cat_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no categories.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$fun_cat_id=$row['fun_cat_id'];
			$fun_cat_name=$row['fun_cat_name'];
			
			
			echo '<h4>'.$fun_cat_name.'</h4>';
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit_cat='.$fun_cat_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del_cat='.$fun_cat_id.'">Delete</a></em></small></p>';	
			
			//echo '<p><small><em><a href="'.$PHP_SELF.'?edit_cat='.$fun_cat_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del_cat='.$fun_cat_id.'">Delete</a></p>';	
			
			}
		}
	}
		
		

		

// ----- Add Category ----- //
elseif(isset($_GET['add_cat']))
	{
	$pagetype = 'Add Category';
	echo '<h1><a href="/panel/fun?cat">Fun Facts Admin</a> &middot; Add Image Category</h1>';
	
	if (isset($_POST) && !empty($_POST['fun_cat_name']))
		{
		$fun_cat_name = htmlentities(($_POST['fun_cat_name']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO fun_cat (fun_cat_name) VALUES ('$fun_cat_name')");
		echo '<hr/><p>'.$fun_cat_name.' was successfully added! You will be redirected to <a href="/panel/fun/?cat">Fun Facts Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/fun/?cat>';

		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add_cat">
	<fieldset>
		<legend>Category Name:</legend>
		<ul><li><input name="fun_cat_name" value="<?= @$_POST['fun_cat_name']?>" type="text"></li></ul>	
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
	$pagetype = 'Fun Facts and Photo Sharing Admin &middot; Edit Image';
	echo '<h1><a href="/panel/fun">Fun Facts Admin</a> &middot; Edit Image</h1>';
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM fun WHERE fun_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_fun_caption = $row["fun_caption"];
	$edit_fun_img = $row["fun_img"];
	
	if (empty($_GET['edit']))
		{
		echo '<hr>Image must be selected to be edited. You will be redirected to <a href="/panel/fun">Fun Facts Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/fun>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['fun_caption']))
			{
			$fun_caption = htmlentities(($_POST['fun_caption']), ENT_QUOTES, 'utf-8');
			$subresult = mysql_query("DELETE FROM fun_cat_list WHERE fun_id='$edit'");
			for($i=0; $i < count($_POST['fun_cat_list']);$i++)
				{
				if(!empty($_POST['fun_cat_list'][$i]))
					{
					$fun_cat_id = htmlspecialchars($_POST['fun_cat_list'][$i]);
					$subresult = mysql_query("INSERT INTO fun_cat_list (fun_cat_id, fun_id) VALUES ('$fun_cat_id','$edit')");
					}
				else
					{
					}
				}
			
			
			
			
			$result = mysql_query("UPDATE fun SET fun_date=NOW(), fun_caption='$fun_caption' WHERE fun_id='$edit'");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/fun">Fun Facts Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/fun>';
			}
		else
			{ ?>
			<hr>
			<img src="/assets/img/fun/<?php echo $edit_fun_img; ?>">
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" enctype="multipart/form-data">			
			<fieldset>
			    <legend>Caption:</legend>
			    <ul><li><input name="fun_caption" value="<?php echo $edit_fun_caption; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Category:</legend>
				    <ul>
				    <?php
				    $subresult = mysql_query("SELECT DISTINCT fun_cat_list.fun_cat_id FROM fun_cat_list, fun_cat WHERE fun_cat_list.fun_id='$edit' AND fun_cat_list.fun_cat_id=fun_cat.fun_cat_id ORDER BY fun_cat_name ASC");
				    while($row = mysql_fetch_array( $subresult ))
				    	{
				    	$fun_cat_id=$row['fun_cat_id'];
				    	echo '<li><select name="fun_cat_list[]"><option value="">&nbsp;</option>';
				    	$result = mysql_query("SELECT * FROM fun_cat ORDER BY fun_cat_name ASC") or die(mysql_error());
				    	while($row = mysql_fetch_array( $result ))
				    		{
				    		$sub_fun_cat_id=$row['fun_cat_id'];
				    		$sub_fun_cat_name=$row['fun_cat_name'];
				    		echo '<option value="'.$sub_fun_cat_id.'"';
				    		if($sub_fun_cat_id==$fun_cat_id) {echo " selected";} else {}
				    		echo '>'.$sub_fun_cat_name.'</option>';
				    		}
				    	echo '</select></li>';
				    	}
				    ?>
				    
				    
				    <li><select name="fun_cat_list[]">
				    <option value="">&nbsp;</option>
				    <?php $result = mysql_query("SELECT * FROM fun_cat ORDER BY fun_cat_name ASC") or die(mysql_error());
				    while($row = mysql_fetch_array( $result ))
				    	{
				    	$fun_cat_id=$row['fun_cat_id'];
				    	$fun_cat_name=$row['fun_cat_name'];
				    	echo '<option value="'.$fun_cat_id.'">'.$fun_cat_name.'</option>';
				    	
				    	if($fun_cat_id==$edit_fun_cat_id)
				    		{
				    		echo ' selected';
				    		}		
				    	else
				    		{
				    		}
				    	echo '>' . $fun_cat_name . '</option>';
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
		echo '<h1><a href="/panel/fun?cat">Fun Facts Admin</a> &middot; Add Image Category</h1>';
		$edit_cat = $_GET['edit_cat'];
		$result = mysql_query("SELECT * FROM fun_cat WHERE fun_cat_id='$edit_cat' LIMIT 1");
		$row = mysql_fetch_assoc($result);
		$edit_fun_cat_name = $row["fun_cat_name"];
		if (empty($_GET['edit_cat']))
			{
			echo '<hr/><p>Category must be selected to be edited. You will be redirected to <a href="/panel/fun/?cat">Fun Facts Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/fun?cat>';
			}
		else
			{
			if (isset($_POST) && !empty($_POST['fun_cat_name']))
				{
				$fun_cat_name = htmlentities(($_POST['fun_cat_name']), ENT_QUOTES, 'utf-8');
				$result = mysql_query("UPDATE fun_cat SET fun_cat_name='$fun_cat_name' WHERE fun_cat_id='$edit_cat'");
				echo '<hr/><p>Edited successfully! You will be redirected to <a href="/panel/fun/?cat">Fun Facts Admin</a>  shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/fun/?cat>';
				}
			else
				{ ?>
				<div class="main">
				<form method="post" action="<?php echo $PHP_SELF; ?>?edit_cat=<?php echo $edit_cat; ?>">	
				<fieldset>
				    <legend>Category Name:</legend>
				    <ul><li><input name="fun_cat_name" value="<?php echo $edit_fun_cat_name; ?>" type="text"></li>
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
	$pagetype = 'Fun Facts Admin &middot; Delete Image';
	echo '<h1><a href="/panel/fun">Fun Facts Admin</a> &middot; Delete Image</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Image must be selected to be deleted. You will be redirected to <a href="/panel/fun">Fun Facts Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/fun>';
		}
	else
		{	
		$subresult = mysql_query("SELECT fun_img FROM fun WHERE fun_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$fun_img=$subrow['fun_img'];
			$path= '../assets/img/fun/'. $fun_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/fun/thumb-'. $fun_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$subresult2 = mysql_query("DELETE FROM fun_cat_list WHERE fun_id='$del'");	
		$result = mysql_query("DELETE FROM fun WHERE fun_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/fun"> Fun Facts Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/fun>';
		}
	}
	

// ----- Delete Category ----- //
	
elseif(isset($_GET['del_cat']))
	{
	$pagetype = 'Delete Category';
	//echo '<h1><a href="/panel/menu?cat">Categories</a> &middot; Delete Category</h1>';
	$del_cat = $_GET['del_cat'];
	$result = mysql_query("SELECT * FROM fun_cat WHERE fun_cat_id='$del_cat' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_fun_cat_name = $row["fun_cat_name"];
	if (empty($_GET['del_cat']))
		{ echo '<hr/><p>Category must be selected to be edited. You will be redirected to <a href="/panel/fun/?cat">Fun Facts Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/fun?cat>';
		}
	else
		{
		echo '<h1>Deleted '.$del_fun_cat_name.'</h1>';
		//$subresult = mysql_query("DELETE FROM menu_cat_list WHERE menu_cat_id='$del_cat'");
		$result = mysql_query("DELETE FROM fun_cat WHERE fun_cat_id='$del_cat'");
		echo '<p align="center">Deleted! You will be redirected to <a href="/panel/fun/?cat">Fun Facts Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/fun?cat>';
		}
	}		
	
	

else
	{
	$pagetype = 'Fun Facts Admin';
	echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="?cat">Category List</a> &middot; <a href="?add">Add Image</a></h1><div class="clear">&nbsp;</div><hr/>';
	$result = mysql_query("SELECT * FROM fun, fun_cat, fun_cat_list WHERE fun.fun_id=fun_cat_list.fun_id AND fun_cat.fun_cat_id=fun_cat_list.fun_cat_id ORDER BY fun_cat_name ASC") or die(mysql_error());
	
	echo '<div class="image">';
	if(mysql_num_rows($result)==0)
		{
		echo 'There are no images at this time.';
		}
	else
		{
		$fun_id = '';
		while($row = mysql_fetch_array($result))
			{
				if ($fun_id!=$row['fun_id'])
				{
				$fun_cat_id=$row['fun_cat_id'];
				$fun_id=$row['fun_id'];
				$fun_date=$row['fun_date'];
				$fun_caption=$row['fun_caption'];
				$fun_img=$row['fun_img'];
				$fun_cat_name=$row['fun_cat_name'];
				
				
				echo '<p><a href="'.$PHP_SELF.'?edit='.$fun_id.'"><img src="/assets/img/fun/thumb-'.$fun_img.'"></a><br><a href="'.$PHP_SELF.'?edit='.$fun_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$fun_id.'">Delete</a><br/>';
				echo '"'.$fun_caption.'"<br/><small><b>Tag: '.$fun_cat_name.'</b></small><br/> <small>'.$fun_date.'</small></p> ';
				echo '';
				}
			
				else {
					
				}
						
				
			}
		}
		echo '<div class="clear">&nbsp;</div></div>';
	}







	


include '../'.$foot; ?>