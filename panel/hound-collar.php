<?php $pagetitle = "Hound Collar Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);




if(isset($_GET['add']))
	{
	$pagetype = 'Hound Collar Admin &middot; Add Entry';
	echo '<h1><a href="/panel/hound-collar">Hound Collar Admin</a> &middot; Add Entry</h1>';
	if (isset($_POST) && !empty($_POST['hound_name']))
		{
		if (!empty($_FILES["hound_img"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["hound_img"]["tmp_name"];
			$img_size = ($_FILES["hound_img"]["size"] / 1024);
			$file_name = basename($_FILES["hound_img"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$hound_img = $img_md5.'.'.$file_ext;
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$hound_img = $img_md5.'.'.$file_ext;
				$hound_img_target = "../assets/img/hound-collar/".$hound_img;
				move_uploaded_file($_FILES["hound_img"]["tmp_name"],$hound_img_target);
				$resizeObj = new resize('../assets/img/hound-collar/'.$hound_img); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(100, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/hound-collar/thumb-'.$hound_img, 100); // *** 3) Save image
				$resizeObj2 = new resize('../assets/img/hound-collar/'.$hound_img); // *** 1) Initialise / load image
				$resizeObj2 -> resizeImage(175, 175, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj2 -> saveImage('../assets/img/hound-collar/headline-'.$hound_img, 100); // *** 3) Save image
				$resizeObj3 = new resize('../assets/img/hound-collar/'.$hound_img); // *** 1) Initialise / load image
				$resizeObj3 -> resizeImage(620, 620, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj3 -> saveImage('../assets/img/hound-collar/story-'.$hound_img, 100); // *** 3) Save image
				$resizeObj4 = new resize('../assets/img/hound-collar/'.$hound_img); // *** 1) Initialise / load image
				$resizeObj4 -> resizeImage(35, 35, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj4 -> saveImage('../assets/img/hound-collar/feature-'.$hound_img, 100); // *** 3) Save image			
				}
			else
				{
				$hound_img = '';
				}
			}
		else
			{
			$hound_img = '';
			}
		$hound_name = htmlentities(($_POST['hound_name']), ENT_QUOTES, 'utf-8');
		$hound_short = htmlentities(($_POST['hound_short']), ENT_QUOTES, 'utf-8');
		$hound_full = htmlentities(($_POST['hound_full']), ENT_QUOTES, 'utf-8');
		$hound_credit = htmlentities(($_POST['hound_credit']), ENT_QUOTES, 'utf-8');
		$hound_credit2 = htmlentities(($_POST['hound_credit2']), ENT_QUOTES, 'utf-8');
		$hound_img_caption = htmlentities(($_POST['hound_img_caption']), ENT_QUOTES, 'utf-8');
		$hound_img_credit = htmlentities(($_POST['hound_img_credit']), ENT_QUOTES, 'utf-8');
		$hound_block = htmlentities(($_POST['hound_block']), ENT_QUOTES, 'utf-8');
		$hound_video = htmlentities(($_POST['hound_video']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO hound (hound_name, hound_short, hound_full, hound_img, hound_img_caption, hound_img_credit, hound_credit, hound_credit2, hound_block, hound_video, hound_date) VALUES ('$hound_name','$hound_short','$hound_full','$hound_img','$hound_img_caption','$hound_img_credit','$hound_credit','$hound_credit2','$hound_block','$hound_video',NOW())");
		for($i=0; $i < count($_POST['hound_cat_list']);$i++)
			{
			if(($_POST['hound_cat_list'][$i]) != '')
			{
			$result = mysql_query("SELECT hound_id FROM hound ORDER BY hound_id DESC LIMIT 1") or die(mysql_error());
			while($row = mysql_fetch_array($result))
				{
				$hound_id = $row["hound_id"];
				$hound_cat_id = htmlspecialchars($_POST['hound_cat_list'][$i]);
				$subresult = mysql_query("INSERT INTO hound_cat_list (hound_cat_id, hound_id) VALUES ('$hound_cat_id','$hound_id')");
				}
			}
			else
				{
				}
			}
		echo '<hr><p>'.$hound_name.' was successfully added! You will be redirected to <a href="/panel/hound-collar">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar>';
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">
	<fieldset>
	    <legend>Title:</legend>
	    <ul><li><input name="hound_name" value="<?= @$_POST['hound_name']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Blockquote:</legend>
	    <ul><li><textarea name="hound_block" rows="4"><?= @$_POST['hound_block']?></textarea></li></ul>
	</fieldset>
	<fieldset>
		<legend>Short Text:</legend>
		<ul><li><textarea name="hound_short" rows="8" class="widgEditor"><?= @$_POST['hound_short']?></textarea></li></ul>
	</fieldset>
	<fieldset>
		<legend>Full Text:</legend>
		<ul><li><textarea name="hound_full" rows="15" class="widgEditor"><?= @$_POST['hound_full']?></textarea></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Video:</legend>
	    <ul><li><textarea name="hound_video" rows="4"><?= @$_POST['hound_video']?></textarea></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Credit Line 1:</legend>
	    <ul><li><input name="hound_credit" value="<?= @$_POST['hound_credit']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Credit Line 2:</legend>
	    <ul><li><input name="hound_credit2" value="<?= @$_POST['hound_credit2']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Category:</legend>
	    <ul>
	    <li><select name="hound_cat_list[]">
	    <option value="">&nbsp;</option>
	    <?php $result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
	    while($row = mysql_fetch_array( $result ))
	    {
	    $hound_cat_id=$row['hound_cat_id'];
	    $hound_cat_name=$row['hound_cat_name'];
	    echo '<option value="'.$hound_cat_id.'">'.$hound_cat_name.'</option>';
	    }
	    ?></select></li>
	    <li><select name="hound_cat_list[]">
	    <option value="">&nbsp;</option>
	    <?php $result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
	    while($row = mysql_fetch_array( $result ))
	    {
	    $hound_cat_id=$row['hound_cat_id'];
	    $hound_cat_name=$row['hound_cat_name'];
	    echo '<option value="'.$hound_cat_id.'">'.$hound_cat_name.'</option>';
	    }
	    ?></select></li>
	    <li><select name="hound_cat_list[]">
	    <option value="">&nbsp;</option>
	    <?php $result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
	    while($row = mysql_fetch_array( $result ))
	    {
	    $hound_cat_id=$row['hound_cat_id'];
	    $hound_cat_name=$row['hound_cat_name'];
	    echo '<option value="'.$hound_cat_id.'">'.$hound_cat_name.'</option>';
	    }
	    ?></select></li>
	    <li><select name="hound_cat_list[]">
	    <option value="">&nbsp;</option>
	    <?php $result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
	    while($row = mysql_fetch_array( $result ))
	    {
	    $hound_cat_id=$row['hound_cat_id'];
	    $hound_cat_name=$row['hound_cat_name'];
	    echo '<option value="'.$hound_cat_id.'">'.$hound_cat_name.'</option>';
	    }
	    ?></select></li>
	    <li><select name="hound_cat_list[]">
	    <option value="">&nbsp;</option>
	    <?php $result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
	    while($row = mysql_fetch_array( $result ))
	    {
	    $hound_cat_id=$row['hound_cat_id'];
	    $hound_cat_name=$row['hound_cat_name'];
	    echo '<option value="'.$hound_cat_id.'">'.$hound_cat_name.'</option>';
	    }
	    ?></select></li>
	    </ul>
	</fieldset>
	<fieldset>
		<legend>Image:</legend>
		<ul><li><input name="hound_img" type="file" /></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Image Caption:</legend>
	    <ul><li><input name="hound_img_caption" value="<?= @$_POST['hound_img_caption']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Image Credit:</legend>
	    <ul><li><input name="hound_img_credit" value="<?= @$_POST['hound_img_credit']?>" type="text"></li>
	    <li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}
	
	
elseif(isset($_GET['add_cat']))
	{
	$pagetype = 'Hound Collar Admin &middot; Categories &middot; Add Category';
	echo '<h1><a href="/panel/hound-collar">Hound Collar Admin</a> &middot; <a href="/panel/hound-collar?cat">Categories</a> &middot; Add Category</h1>';
	if (isset($_POST) && !empty($_POST['hound_cat_name']))
		{
		$hound_cat_name = htmlentities(($_POST['hound_cat_name']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO hound_cat (hound_cat_name) VALUES ('$hound_cat_name')");
		echo '<hr><p>'.$hound_cat_name.' was successfully added! You will be redirected to <a href="/panel/hound-collar/?cat">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar/?cat>';
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add_cat">
	<fieldset>
		<legend>Category Name:</legend>
		<ul><li><input name="hound_cat_name" value="<?= @$_POST['hound_cat_name']?>" type="text"></li>
		<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}


elseif(isset($_GET['edit']))
	{
	$pagetype = 'Hound Collar Admin &middot; Edit Entry';
	echo '<h1><a href="/panel/hound-collar">Hound Collar Admin</a> &middot; Edit Entry</h1>';
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM hound WHERE hound_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_hound_name = $row["hound_name"];
	$edit_hound_short = $row["hound_short"];
	$edit_hound_full = $row["hound_full"];
	$edit_hound_credit = $row["hound_credit"];
	$edit_hound_credit2 = $row["hound_credit2"];
	$edit_hound_img_caption = $row["hound_img_caption"];
	$edit_hound_img_credit = $row["hound_img_credit"];
	$edit_hound_block = $row["hound_block"];
	$edit_hound_video = $row["hound_video"];
	$edit_hound_img = $row["hound_img"];
	$edit_hound_date = $row["hound_date"];
	if (empty($_GET['edit']))
		{
		echo '<hr>Entry must be selected to be edited. You will be redirected to <a href="/panel/hound-collar">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['hound_name']))
			{
			$hound_name = htmlentities(($_POST['hound_name']), ENT_QUOTES, 'utf-8');
			$hound_short = htmlentities(($_POST['hound_short']), ENT_QUOTES, 'utf-8');
			$hound_full = htmlentities(($_POST['hound_full']), ENT_QUOTES, 'utf-8');
			$hound_credit = htmlentities(($_POST['hound_credit']), ENT_QUOTES, 'utf-8');
			$hound_credit2 = htmlentities(($_POST['hound_credit2']), ENT_QUOTES, 'utf-8');
			$hound_img_caption = htmlentities(($_POST['hound_img_caption']), ENT_QUOTES, 'utf-8');
			$hound_img_credit = htmlentities(($_POST['hound_img_credit']), ENT_QUOTES, 'utf-8');
			$hound_block = htmlentities(($_POST['hound_block']), ENT_QUOTES, 'utf-8');
			$hound_video = htmlentities(($_POST['hound_video']), ENT_QUOTES, 'utf-8');
			
			if (!empty($_FILES["hound_img"]["name"]))
				{
				$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
				$img_tmp = $_FILES["hound_img"]["tmp_name"];
				$img_size = ($_FILES["hound_img"]["size"] / 1024);
				$file_name = basename($_FILES["hound_img"]["name"]);
				$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
				$hound_img = $img_md5.'.'.$file_ext;
				$max_file = '2048';
				if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
					{
					$hound_img = $img_md5.'.'.$file_ext;
					$hound_img_target = "../assets/img/hound-collar/".$hound_img;
					move_uploaded_file($_FILES["hound_img"]["tmp_name"],$hound_img_target);
					$resizeObj = new resize('../assets/img/hound-collar/'.$hound_img); // *** 1) Initialise / load image
					$resizeObj -> resizeImage(100, 100, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> saveImage('../assets/img/hound-collar/thumb-'.$hound_img, 100); // *** 3) Save image
					$resizeObj2 = new resize('../assets/img/hound-collar/'.$hound_img); // *** 1) Initialise / load image
					$resizeObj2 -> resizeImage(175, 175, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj2 -> saveImage('../assets/img/hound-collar/headline-'.$hound_img, 100); // *** 3) Save image
					$resizeObj3 = new resize('../assets/img/hound-collar/'.$hound_img); // *** 1) Initialise / load image
					$resizeObj3 -> resizeImage(620, 620, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj3 -> saveImage('../assets/img/hound-collar/story-'.$hound_img, 100); // *** 3) Save image
					$resizeObj4 = new resize('../assets/img/hound-collar/'.$hound_img); // *** 1) Initialise / load image
					$resizeObj4 -> resizeImage(35, 35, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj4 -> saveImage('../assets/img/hound-collar/feature-'.$hound_img, 100); // *** 3) Save image
					}
				else
					{
					$hound_img = $edit_hound_credit;
					}
				}
			else
				{
				$hound_img = $edit_hound_img;
				}
			
			$subresult = mysql_query("DELETE FROM hound_cat_list WHERE hound_id='$edit'");
			for($i=0; $i < count($_POST['hound_cat_list']);$i++)
				{
				if(!empty($_POST['hound_cat_list'][$i]))
					{
					$hound_cat_id = htmlspecialchars($_POST['hound_cat_list'][$i]);
					$subresult = mysql_query("INSERT INTO hound_cat_list (hound_cat_id, hound_id) VALUES ('$hound_cat_id','$edit')");
					}
				else
					{
					}
				}
			$result = mysql_query("UPDATE hound SET hound_name='$hound_name', hound_short='$hound_short', hound_full='$hound_full', hound_credit='$hound_credit', hound_credit2='$hound_credit2', hound_block='$hound_block', hound_video='$hound_video', hound_img='$hound_img', hound_img_caption='$hound_img_caption', hound_img_credit='$hound_img_credit',hound_date=NOW() WHERE hound_id='$edit'");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/hound-collar">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar>';
			}
		else
			{ ?>
			<hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" enctype="multipart/form-data">			
			<fieldset>
			    <legend>Title:</legend>
			    <ul><li><input name="hound_name" value="<?php echo $edit_hound_name; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Blockquote:</legend>
			    <ul><li><textarea name="hound_block" rows="4"><?php echo $edit_hound_block; ?></textarea></li></ul>
			</fieldset>
			<fieldset>
				<legend>Short Text:</legend>
				<ul><li><textarea name="hound_short" rows="8" class="widgEditor"><?php echo $edit_hound_short; ?></textarea></li></ul>
			</fieldset>
			<fieldset>
				<legend>Full Text:</legend>
				<ul><li><textarea name="hound_full" rows="15" class="widgEditor"><?php echo $edit_hound_full; ?></textarea></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Video:</legend>
			    <ul><li><textarea name="hound_video" rows="4"><?php echo $edit_hound_video; ?></textarea></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Credit Line 1:</legend>
			    <ul><li><input name="hound_credit" value="<?php echo $edit_hound_credit; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Credit Line 2:</legend>
			    <ul><li><input name="hound_credit2" value="<?php echo $edit_hound_credit2; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>Category:</legend>
				<ul>
				<?php
				$subresult = mysql_query("SELECT DISTINCT hound_cat_list.hound_cat_id FROM hound_cat_list, hound_cat WHERE hound_cat_list.hound_id='$edit' AND hound_cat_list.hound_cat_id=hound_cat.hound_cat_id ORDER BY hound_cat_name ASC");
				while($row = mysql_fetch_array( $subresult ))
					{
					$hound_cat_id=$row['hound_cat_id'];
					echo '<li><select name="hound_cat_list[]"><option value="">&nbsp;</option>';
					$result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
					while($row = mysql_fetch_array( $result ))
						{
						$sub_hound_cat_id=$row['hound_cat_id'];
						$sub_hound_cat_name=$row['hound_cat_name'];
						echo '<option value="'.$sub_hound_cat_id.'"';
						if($sub_hound_cat_id==$hound_cat_id) {echo " selected";} else {}
						echo '>'.$sub_hound_cat_name.'</option>';
						}
					echo '</select></li>';
					}
				?>
				<li><select name="hound_cat_list[]">
				<option value="">&nbsp;</option>
				<?php $result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
				while($row = mysql_fetch_array( $result ))
				{
				$hound_cat_id=$row['hound_cat_id'];
				$hound_cat_name=$row['hound_cat_name'];
				echo '<option value="'.$hound_cat_id.'">'.$hound_cat_name.'</option>';
				}
				?></select></li>
				<li><select name="hound_cat_list[]">
				<option value="">&nbsp;</option>
				<?php $result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
				while($row = mysql_fetch_array( $result ))
				{
				$hound_cat_id=$row['hound_cat_id'];
				$hound_cat_name=$row['hound_cat_name'];
				echo '<option value="'.$hound_cat_id.'">'.$hound_cat_name.'</option>';
				}
				?></select></li>
				<li><select name="hound_cat_list[]">
				<option value="">&nbsp;</option>
				<?php $result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
				while($row = mysql_fetch_array( $result ))
				{
				$hound_cat_id=$row['hound_cat_id'];
				$hound_cat_name=$row['hound_cat_name'];
				echo '<option value="'.$hound_cat_id.'">'.$hound_cat_name.'</option>';
				}
				?></select></li>
				<li><select name="hound_cat_list[]">
				<option value="">&nbsp;</option>
				<?php $result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
				while($row = mysql_fetch_array( $result ))
				{
				$hound_cat_id=$row['hound_cat_id'];
				$hound_cat_name=$row['hound_cat_name'];
				echo '<option value="'.$hound_cat_id.'">'.$hound_cat_name.'</option>';
				}
				?></select></li>
				<li><select name="hound_cat_list[]">
				<option value="">&nbsp;</option>
				<?php $result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
				while($row = mysql_fetch_array( $result ))
				{
				$hound_cat_id=$row['hound_cat_id'];
				$hound_cat_name=$row['hound_cat_name'];
				echo '<option value="'.$hound_cat_id.'">'.$hound_cat_name.'</option>';
				}
				?></select></li>
				</ul>
			</fieldset>
			<fieldset>
				<legend>Image:</legend>
				<ul><li>
				<?php
				if(!empty($edit_hound_img))
					{
					echo '<input type="hidden" name="hound_img" value="'.$edit_hound_img.'">';
					echo '<img src="/assets/img/hound-collar/thumb-'.$edit_hound_img.'">';
					echo '<br><a href="?del_img='.$edit.'">Delete Image</a>';
					}
				else
					{
					echo '<input name="hound_img" type="file" />';
					}
				?>
				</li></ul>
			</fieldset>
			<fieldset>
			    <legend>Image Caption:</legend>
			    <ul><li><input name="hound_img_caption" value="<?php echo $edit_hound_img_caption; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Image Credit:</legend>
			    <ul><li><input name="hound_img_credit" value="<?php echo $edit_hound_img_credit; ?>" type="text"></li>
			    <li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			</fieldset>
			
			</form>
<?php
			}
		}
	}


elseif(isset($_GET['edit_cat']))
	{
	$pagetype = 'Hound Collar Admin &middot; Categories &middot; Edit Category';
	echo '<h1><a href="/panel/hound-collar">Hound Collar Admin</a> &middot; <a href="/panel/hound-collar?cat">Categories</a> &middot; Edit Category</h1>';
	$edit_cat = $_GET['edit_cat'];
	$result = mysql_query("SELECT * FROM hound_cat WHERE hound_cat_id='$edit_cat' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_hound_cat_name = $row["hound_cat_name"];
	if (empty($_GET['edit_cat']))
		{
		echo '<hr><p>Category must be selected to be edited. You will be redirected to <a href="/panel/hound-collar">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar>';
		}
	else
		{
		if (isset($_POST) && !empty($_POST['hound_cat_name']))
			{
			$hound_cat_name = htmlentities(($_POST['hound_cat_name']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE hound_cat SET hound_cat_name='$hound_cat_name' WHERE hound_cat_id='$edit_cat'");
			echo '<hr><p>Edited successfully! You will be redirected to <a href="/panel/hound-collar/?cat">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar/?cat>';
			}
		else
			{ ?>
			<hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit_cat=<?php echo $edit_cat; ?>">	
			<fieldset>
			    <legend>Category Name:</legend>
			    <ul><li><input name="hound_cat_name" value="<?php echo $edit_hound_cat_name; ?>" type="text"></li>
				<li><button type="submit" value="Send" name="submit">Save</button></li></ul>
			</fieldset>
			</form>
<?php
			}
		}
	}

	
elseif(isset($_GET['del']))
	{
	$pagetype = 'Hound Collar Admin &middot; Delete Entry';
	echo '<h1><a href="/panel/hound-collar">Hound Collar Admin</a> &middot; Delete Entry</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/hound-collar">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar>';
		}
	else
		{	
		$subresult = mysql_query("SELECT hound_img FROM hound WHERE hound_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$hound_img=$subrow['hound_img'];
			$path= '../assets/img/hound-collar/'. $hound_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/hound-collar/thumb-'. $hound_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path3= '../assets/img/hound-collar/headline-'. $hound_img .''; if(@unlink($path3)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path4= '../assets/img/hound-collar/story-'. $hound_img .''; if(@unlink($path4)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path5= '../assets/img/hound-collar/feature-'. $hound_img .''; if(@unlink($path5)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$subresult2 = mysql_query("DELETE FROM hound_cat_list WHERE hound_id='$del'");
		$result = mysql_query("DELETE FROM hound WHERE hound_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/hound-collar">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar>';
		}
	}
	
	
elseif(isset($_GET['del_img']))
	{
	$pagetype = 'Hound Collar Admin &middot; Delete Entry (kage';
	echo '<h1><a href="/panel/hound-collar">Hound Collar Admin</a> &middot; Delete Entry Image</h1>';
	$del_img = $_GET['del_img'];
	if (empty($_GET['del_img']))
		{
		echo '<hr>Entry must be selected to be deleted. You will be redirected to <a href="/panel/hound-collar">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar>';
		}
	else
		{	
		$subresult = mysql_query("SELECT hound_img FROM hound WHERE hound_id='$del_img'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$hound_img=$subrow['hound_img'];
			$path= '../assets/img/hound-collar/'. $hound_img .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/hound-collar/thumb-'. $hound_img .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path3= '../assets/img/hound-collar/headline-'. $hound_img .''; if(@unlink($path3)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path4= '../assets/img/hound-collar/story-'. $hound_img .''; if(@unlink($path4)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path5= '../assets/img/hound-collar/feature-'. $hound_img .''; if(@unlink($path5)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("UPDATE hound SET hound_img='' WHERE hound_id='$del_img'");
		echo '<p>Deleted successfully! You will be redirected to <a href="/panel/hound-collar">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar>';
		
		}
	}
	

elseif(isset($_GET['del_cat']))
	{
	$pagetype = 'Hound Collar Admin &middot; Categories &middot; Delete Category';
	echo '<h1><a href="/panel/hound-collar?cat">Hound Collar Admin</a> &middot; <a href="/panel/hound-collar?cat">Categories</a> &middot; Delete Category</h1>';
	$del_cat = $_GET['del_cat'];
	$result = mysql_query("SELECT * FROM hound_cat WHERE hound_cat_id='$del_cat' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$del_cat_hound_name = $row["hound_cat_name"];
	if (empty($_GET['del_cat']))
		{ echo '<hr>Category must be selected to be deleted. You will be redirected to <a href="/panel/hound-collar?cat">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar?cat>';
		}
	else
		{
		echo '<hr>';
		$subresult = mysql_query("DELETE FROM hound_cat_list WHERE hound_cat_id='$del_cat'");
		$result = mysql_query("DELETE FROM hound_cat WHERE hound_cat_id='$del_cat'");
		echo '<p>Deleted! You will be redirected to <a href="/panel/hound-collar?cat">Hound Collar Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/hound-collar?cat>';
		}
	}


elseif(isset($_GET['cat']))
	{
	$pagetype = 'Hound Collar Admin &middot; Categories';
	echo '<h1 class="l"><a href="/panel/hound-collar">Hound Collar Admin</a> &middot; Categories</h1><h1 class="r"><a href="?add_cat">Add Category</a></h1><div class="clear">&nbsp;</div>';
	$result = mysql_query("SELECT hound_cat_id, hound_cat_name FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no hound entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$hound_cat_id=$row['hound_cat_id'];
			$hound_cat_name=$row['hound_cat_name'];
			echo '<hr><h1>'.$hound_cat_name.'</h1>';
			echo '<p><small><em><a href="'.$PHP_SELF.'?edit_cat='.$hound_cat_id.'">Edit</a></em></small></p>';					
			}
		}
	}	


else
	{
	$pagetype = 'Hound Collar Admin';
	echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="?add">Add News Entry</a></h1><div class="clear">&nbsp;</div>';
	$result = mysql_query("SELECT hound_id, hound_name, hound_full, hound_img, hound_credit, hound_date FROM hound WHERE  hound_id!='51' ORDER BY hound_date DESC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no hound entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$hound_id=$row['hound_id'];
			$hound_name=$row['hound_name'];
			$hound_full=$row['hound_full'];
			$hound_img=$row['hound_img'];
			$hound_date=convert_date($row['hound_date']);
			$hound_credit=$row['hound_credit'];
			echo '<hr><h1>';
			if(!empty($hound_img))
				{
				echo '<img src="/assets/img/icon-photo.gif"> ';
				} else {}
			echo '<a href="/hound-collar/?story='.$hound_id.'">'.$hound_name.'</a></h1><h4 class="hound-credit">'.$hound_date.'';
			if(!empty($hound_credit))
				{
				echo ' &middot; '.$hound_credit;
				} else {}
			echo '</h4><p><small><em><a href="'.$PHP_SELF.'?edit='.$hound_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$hound_id.'">Delete</a></em></small></p>';	
			}
		}
	echo '<hr><a href="?cat">Categories</a>';
	}





include '../'.$foot; ?>