<?php include '../core/base.php'; $div="panel";




	
$pagetitle = "PDF Uploader";
include '../'.$head; check_logged(); check_access(4);
if (isset($_POST['submit']) && !empty($_FILES["pdf_name"]["name"]))
	{
	if (!empty($_FILES["pdf_name"]["name"]))
		{
		$pdf_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
		$pdf_tmp = $_FILES["pdf_name"]["tmp_name"];
		$pdf_size = ($_FILES["pdf_name"]["size"] / 1024);
		$file_name = basename($_FILES["pdf_name"]["name"]);
		$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
		$file_rename = substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100)),0,3).'-'.preg_replace("([^A-Za-z0-9._-])",'',str_replace(' ', '_', $file_name));
		$pdf_name_target = "../assets/pdf/".$file_rename;
		$max_file = '2048';
		if (($file_ext=="pdf") OR ($file_ext=="PDF"))
			{
			move_uploaded_file($_FILES["pdf_name"]["tmp_name"],$pdf_name_target);
			echo '<h1>'.$pagetitle.'</h1><hr><p>PDF was added successfully!</p><p>Please paste the following link into the Page Admin</p><form><fieldset><ul><li><textarea name="hound_block" rows="4">/assets/pdf/'.$file_rename.'</textarea></li></ul></fieldset></form>';
			}
		else
			{
			echo '<h1>'.$pagetitle.'</h1><hr><p>ONLY .pdf files are accepted for upload. Please try again. You will be redirected to the <a href="/panel/pdf">PDF Uploader</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/pdf>';
			}
		}
	}
else
	{ echo '<h1>'.$pagetitle.'</h1><hr>';
	?>
	<form method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data">
	<fieldset><legend>PDF:</legend>
	<ul><li><input name="pdf_name" type="file" /></li>
	<li><button type="submit" name="submit">Upload</button></li></ul></fieldset>
	
	</form>
<?php
	}





include '../'.$foot; ?>