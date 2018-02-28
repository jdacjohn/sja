<?php $pagetitle = "Edit Banner"; include '../../core/base.php'; include '../../'.$head; check_logged(); check_access(4);





if(isset($_GET['edit']))
	{
	$page_id = $_GET['edit'];
	$path= 'banner/'.$page_id.'-banner.jpg'; if(@unlink($path)){/* echo "Deleted file "; */} else{}
	$res = json_decode(stripslashes($_POST['jsondata']), true);
	/* get data */
	$count_images = count($res['images']);
	/* the background image is the first one */
	$background 	= $res['images'][0]['src'];
	$photo1 		= imagecreatefromjpeg($background);
	$foto1W 		= imagesx($photo1);
	$foto1H 		= imagesy($photo1);
	$photoFrameW 	= $res['images'][0]['width'];
	$photoFrameH 	= $res['images'][0]['height'];
	$photoFrame 	= imagecreatetruecolor($photoFrameW,$photoFrameH);
	imagecopyresampled($photoFrame, $photo1, 0, 0, 0, 0, $photoFrameW, $photoFrameH, $foto1W, $foto1H);
	
	/* the other images */
	for($i = 1; $i < $count_images; ++$i)
		{
		$insert 		= $res['images'][$i]['src'];
		$photoFrame2Rotation = (180-$res['images'][$i]['rotation']) + 180;
		
		$photo2 		= imagecreatefromjpeg($insert);
		
		$foto2W 		= imagesx($photo2);
		$foto2H 		= imagesy($photo2);
		$photoFrame2W	= $res['images'][$i]['width'];
		$photoFrame2H 	= $res['images'][$i]['height'];
	
		$photoFrame2TOP = $res['images'][$i]['top'];
		$photoFrame2LEFT= $res['images'][$i]['left'];
	
		$photoFrame2 	= imagecreatetruecolor($photoFrame2W,$photoFrame2H);
		$trans_colour 	= imagecolorallocatealpha($photoFrame2, 0, 0, 0, 127);
		imagefill($photoFrame2, 0, 0, $trans_colour);
	
		imagecopyresampled($photoFrame2, $photo2, 0, 0, 0, 0, $photoFrame2W, $photoFrame2H, $foto2W, $foto2H);
		
		$photoFrame2 	= imagerotate($photoFrame2,$photoFrame2Rotation, -1,0);
		/*after rotating calculate the difference of new height/width with the one before*/
		$extraTop		=(imagesy($photoFrame2)-$photoFrame2H)/2;
		$extraLeft	=(imagesx($photoFrame2)-$photoFrame2W)/2;
	
		imagecopy($photoFrame, $photoFrame2,$photoFrame2LEFT-$extraLeft, $photoFrame2TOP-$extraTop, 0, 0, imagesx($photoFrame2), imagesy($photoFrame2));
		}
		imagejpeg($photoFrame, 'banner/'.$page_id.'-banner.jpg');
		imagedestroy($photoFrame);
		echo '<h1>'.$pagetitle.'</h1><hr><p>Banner was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
		$new_page_banner = $page_id.'-banner.jpg';
		$result = mysql_query("UPDATE page SET page_banner='$new_page_banner' WHERE page_id='$page_id' ");
	}

else
	{
	echo '<h1>'.$pagetitle.'</h1><hr><p>Image must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
	}





include '../../'.$foot; ?>