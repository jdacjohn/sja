<?php $pagetitle = "Home Banner Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(2);




if(isset($_GET['add']))
	{
	$pagetype = 'Home Banner Admin &middot; Add Banner';
	echo '<h1><a href="/panel/banner">Banner Admin</a> &middot; Add Banner</h1>';
	if (isset($_POST) && !empty($_FILES["slideshow_name"]["name"]))
		{
		$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
		$img_tmp = $_FILES["slideshow_name"]["tmp_name"];
		$img_size = ($_FILES["slideshow_name"]["size"] / 1024);
		$file_name = basename($_FILES["slideshow_name"]["name"]);
		$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
		$slideshow_name = $img_md5.'.'.$file_ext;
		$max_file = '2048';
		if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
			{
			$slideshow_name = $img_md5.'.'.$file_ext;
			$slideshow_name_target = "../assets/img/banner/".$slideshow_name;
			move_uploaded_file($_FILES["slideshow_name"]["tmp_name"],$slideshow_name_target);
			$resizeObj = new resize('../assets/img/banner/'.$slideshow_name); // *** 1) Initialise / load image
			$resizeObj -> resizeImage(820, 173, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj -> saveImage('../assets/img/banner/0-'.$slideshow_name, 100); // *** 3) Save image
			$resizeObj2 = new resize('../assets/img/banner/'.$slideshow_name); // *** 1) Initialise / load image
			$resizeObj2 -> resizeImage(875, 225, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj2 -> saveImage('../assets/img/banner/1-'.$slideshow_name, 100); // *** 3) Save image
			$resizeObj3 = new resize('../assets/img/banner/'.$slideshow_name); // *** 1) Initialise / load image
			$resizeObj3 -> resizeImage(750, 158, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj3 -> saveImage('../assets/img/banner/mobile-'.$slideshow_name, 100); // *** 3) Save image
			$resizeObj4 = new resize('../assets/img/banner/'.$slideshow_name); // *** 1) Initialise / load image
			$resizeObj4 -> resizeImage(75, 150, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj4 -> saveImage('../assets/img/banner/thumb-'.$slideshow_name, 100); // *** 3) Save image
			} else {}
		$result = mysql_query("INSERT INTO slideshow (slideshow_name) VALUES ('$slideshow_name')");

		echo '<hr><p>Banner was successfully added! You will be redirected to <a href="/panel/banner">Banner Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/banner>';
		}
	else
		{
	?>
	<hr>
	<form method="post" action="?add" enctype="multipart/form-data">
	<fieldset>
		<legend>Image:</legend>
		<ul><li><input name="slideshow_name" type="file" /></li></li>
	    <li><button type="submit" value="Send" name="submit">Save</button></li></ul>
	</fieldset>
	</form>
<?php
		}
	}
	
	
elseif(isset($_GET['del']))
	{
	$pagetype = 'Home Banner Admin &middot; Delete Banner';
	echo '<h1><a href="/panel/banner">Banner Admin</a> &middot; Delete Banner</h1>';
	$del = $_GET['del'];
	if (empty($_GET['del']))
		{
		echo '<hr>Banner must be selected to be deleted. You will be redirected to <a href="/panel/banner">Banner Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/banner>';
		}
	else
		{	
		$subresult = mysql_query("SELECT slideshow_name FROM slideshow WHERE slideshow_id='$del'") or die(mysql_error());
		while($subrow = mysql_fetch_array($subresult))
			{
			$slideshow_name=$subrow['slideshow_name'];
			$path= '../assets/img/banner/'. $slideshow_name .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/banner/0-'. $slideshow_name .''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path3= '../assets/img/banner/1-'. $slideshow_name .''; if(@unlink($path3)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path4= '../assets/img/banner/mobile-'. $slideshow_name .''; if(@unlink($path4)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path5= '../assets/img/banner/thumb-'. $slideshow_name .''; if(@unlink($path5)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			}
		$result = mysql_query("DELETE FROM slideshow WHERE slideshow_id='$del'");
		echo '<hr><p>Deleted! You will be redirected to <a href="/panel/banner">Banner Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/banner>';
		}
	}
	
	
else
	{
	$pagetype = 'Home Banner Admin';
	echo '<h1 class="l">'.$pagetype.'</h1><h1 class="r"><a href="?add">Add New Banner</a></h1><div class="clear">&nbsp;</div>';
	$result = mysql_query("SELECT slideshow_id, slideshow_name FROM slideshow ORDER BY slideshow_id DESC") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no hound entries.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$slideshow_id=$row['slideshow_id'];
			$slideshow_name=$row['slideshow_name'];
			echo '<hr><a href="/assets/img/banner/'.$slideshow_name.'"><img src="/assets/img/banner/1-'.$slideshow_name.'"></a><p><small><em><a href="'.$PHP_SELF.'?del='.$slideshow_id.'">Delete</a></em></small></p>';	
			}
		}
	}





include '../'.$foot; ?>