<?php include 'core/base.php'; $sidebar = 'full'; $div = 'hound'; 





$result = mysql_query("SELECT * FROM page WHERE page_url='hound-collar'");
if(mysql_num_rows($result) > 0)
{
while($row = mysql_fetch_assoc($result))
	{
	$page_banner=$row['page_banner'];
	if(isset($_GET['story']))
		{
		$story = $_GET['story'];
		if (empty($_GET['story']))
			{
			$pagetitle = 'Hound Collar';
			include $head;
			echo '<div class="l">';
			echo '<h1 class="title"><a href="/hound-collar">Hound Collar</a></h1>';
			echo '<div class="story" id="article">This story does not exist. You will be redirected to <a href="/hound-collar">Hound Collar</a> shortly.</p></div>'.'<meta http-equiv=Refresh content=5;url=/hound-collar>';
			}
		else
			{
			$result = mysql_query("SELECT * FROM hound WHERE hound_id='$story' LIMIT 1") or die(mysql_error());
			if(mysql_num_rows($result)==0)
				{
				$pagetitle = 'Hound Collar';
				include $head;
				echo '<div class="l">';
				echo '<h1 class="title"><a href="/hound-collar">Hound Collar</a></h1>';
				echo '<div class="story" id="article">This story does not exist. You will be redirected to <a href="/hound-collar">Hound Collar</a> shortly.</p></div>'.'<meta http-equiv=Refresh content=5;url=/hound-collar>';
				}
			else
				{
				while($row = mysql_fetch_array($result))
					{
					$hound_name = $row["hound_name"];
					$hound_full = strip_tags(html_entity_decode($row['hound_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
					$hound_credit = $row["hound_credit"];
					$hound_date=convert_date($row['hound_date']);
					$hound_credit=$row['hound_credit'];
					$hound_credit2=$row['hound_credit2'];
					$hound_block=$row['hound_block'];
					$hound_video=strip_tags(html_entity_decode($row['hound_video'], ENT_QUOTES, 'utf-8'),$allowed_html);
					$hound_img=$row['hound_img'];
					$hound_img_caption=$row['hound_img_caption'];
					$hound_img_credit=$row['hound_img_credit'];
					$pagetitle = 'Hound Collar &middot; '.$hound_name;
					include $head;
					echo '<div class="l">';
					echo '<h1 class="title"><a href="/hound-collar">Hound Collar</a> &middot; '.$hound_name.'</h1>';
					echo '<div class="story" id="article">';
					if(!empty($hound_img))
						{
						echo '<img src="/assets/img/hound-collar/story-'.$hound_img.'">';
						} else {}
					if(!empty($hound_img_caption) or !empty($hound_img_credit))
						{
						echo '<div class="caption">';
						if(!empty($hound_img_caption))
							{
							echo $hound_img_caption;
							} else {}
						if(!empty($hound_img_credit))
							{
							echo ' <em>Photo Credit: '.$hound_img_credit.'</em>';
							} else {}	
						echo '</div>';
						} else {}
					echo '<h1>'.$hound_name.'</h1><h4 class="hound-credit"><em>'.$hound_date.'</em>';
					if(!empty($hound_credit))
						{
						echo '<br>'.$hound_credit;
						}
					else
						{
						}
					if(!empty($hound_credit2))
						{
						echo '<br>'.$hound_credit2;
						}
					else
						{
						}
					echo '</h4>';
					if(!empty($hound_block))
						{
						echo '<blockquote>'.$hound_block.'</blockquote>';
						} else {}
					echo $hound_full;
					if(!empty($hound_video))
						{
						echo $hound_video;
						} else {}
					$result = mysql_query("SELECT hound_cat.hound_cat_id, hound_cat.hound_cat_name FROM hound_cat_list, hound_cat WHERE hound_cat_list.hound_id='$story' AND hound_cat_list.hound_cat_id=hound_cat.hound_cat_id ORDER BY hound_cat_name ASC") or die(mysql_error());
					if(mysql_num_rows($result)==0)
						{
						}
					else
						{
						echo '<hr><h5>';
						while($row = mysql_fetch_array($result))
							{
							$sub_hound_cat_id=$row['hound_cat_id'];
							$sub_hound_cat_name=$row['hound_cat_name'];
							echo ' &middot; <a href="?cat='.$sub_hound_cat_id.'">'.$sub_hound_cat_name.'</a>';
							}
						echo '</h5>';
						}
					echo '</div>';
					}
				}
			}
		}
	
	
	elseif(isset($_GET['cat']))
		{
		$cat = $_GET['cat'];
		if (empty($_GET['cat']))
			{
			$pagetitle = 'Hound Collar';
			include $head;
			echo '<div class="l">';
			echo '<h1 class="title"><a href="/hound-collar">Hound Collar</a></h1>';
			echo '<div class="story" id="article"><p>This category does not exist. You will be redirected to <a href="/hound-collar">Hound Collar</a> shortly.</p></div>'.'<meta http-equiv=Refresh content=5;url=/hound-collar>';
			}
		else
			{
			$result = mysql_query("SELECT hound_cat_name FROM hound_cat WHERE hound_cat.hound_cat_id='$cat'") or die(mysql_error());
			if(mysql_num_rows($result)==0)
				{
				$pagetitle = 'Hound Collar';
				include $head;
				echo '<div class="l">';
				echo '<h1 class="title"><a href="/hound-collar">Hound Collar</a></h1>';
				echo '<div class="story" id="article"><p>This category does not exist. You will be redirected to <a href="/hound-collar">Hound Collar</a> shortly.</p></div>'.'<meta http-equiv=Refresh content=5;url=/hound-collar>';
				}
			else
				{
				while($row = mysql_fetch_array($result))
					{
					$hound_cat_name = $row["hound_cat_name"];
					$pagetitle = 'Hound Collar &middot; '.$hound_cat_name;
					include $head;
					echo '<div class="l">'; 
					echo '<h1 class="title"><a href="/hound-collar">Hound Collar</a> &middot; '.$hound_cat_name.'</h1>'; // CATEGORIES PAGE ORDER
					$result = mysql_query("SELECT hound.hound_id, hound.hound_name, hound.hound_short, hound.hound_credit, hound.hound_credit2, hound.hound_img, hound.hound_date FROM hound, hound_cat_list WHERE hound_cat_list.hound_cat_id='$cat' AND hound_cat_list.hound_id=hound.hound_id ORDER BY hound_date DESC") or die(mysql_error());
					if(mysql_num_rows($result)==0)
						{
						echo '<div class="story" id="article"><p>This category does not have any stories. You will be redirected to <a href="/hound-collar">Hound Collar</a> shortly.</p></div>'.'<meta http-equiv=Refresh content=5;url=/hound-collar>';
						}
					else
						{
						while($row = mysql_fetch_array($result))
							{
							$hound_id = $row["hound_id"];
							$hound_name = $row["hound_name"];
							$hound_short = strip_tags(html_entity_decode($row['hound_short'], ENT_QUOTES, 'utf-8'),$allowed_html);
							$hound_credit = $row["hound_credit"];
							$hound_date=convert_date($row['hound_date']);
							$hound_credit=$row['hound_credit'];
							$hound_credit2=$row['hound_credit2'];
							$hound_img=$row['hound_img'];
							echo '<div class="others">';
							if(!empty($hound_img))
								{
								echo '<div class="story"><div class="left"><a href="?story='.$hound_id.'"><img src="/assets/img/hound-collar/thumb-'.$hound_img.'"></a></div>';
								echo '<div class="right"><h1><a href="?story='.$hound_id.'">'.$hound_name.'</a></h1><h4 class="hound-credit">'.$hound_date.'';
								if(!empty($hound_credit))
									{
									echo ' &middot; '.$hound_credit;
									} else {}
								echo '</h4>';
								echo $hound_short;
								echo '<h5 class="hound-readmore"><a href="?story='.$hound_id.'">Read More</a></h5>';
								echo '</div><div class="clear">&nbsp;</div></div><hr>';
								}
							else {
								echo '<div class="story"><h1><a href="?story='.$hound_id.'">'.$hound_name.'</a></h1><h4 class="hound-credit"><em>'.$hound_date.'</em>';
								if(!empty($hound_credit))
									{
									echo ' &middot; '.$hound_credit;
									} else {}
								echo '</h4>';
								echo $hound_short;
								echo '<h5 class="hound-readmore"><a href="?story='.$hound_id.'">Read More</a></h5></div><hr>';
								}
							echo '</div>';
							
							
							}
						}
					}
				}
			}
		}
	
	
	else
		{
		$page_name=$row['page_name'];
		$pagetitle = $page_name;
		include $head;
		echo '<div class="l">';
		$headline_result = mysql_query("SELECT hound.hound_id, hound.hound_name, hound.hound_short, hound.hound_credit, hound.hound_credit2, hound.hound_img, hound.hound_date FROM hound, hound_cat_list WHERE hound_cat_list.hound_cat_id='11' AND hound_cat_list.hound_id=hound.hound_id ORDER BY hound.hound_date DESC LIMIT 1") or die(mysql_error());
		if(mysql_num_rows($headline_result)==0)
			{
			}
		else
			{
			echo '<div class="headline"><h1 class="title">Headline</h1>';
			while($headline_row = mysql_fetch_array($headline_result))
				{
				$hound_id=$headline_row['hound_id'];
				$hound_name=$headline_row['hound_name'];
				$hound_date=convert_date($headline_row['hound_date']);
				$hound_short = strip_tags(html_entity_decode($headline_row['hound_short'], ENT_QUOTES, 'utf-8'),$allowed_html);
				$hound_credit=$headline_row['hound_credit'];
				$hound_credit2=$headline_row['hound_credit2'];
				$hound_img=$headline_row['hound_img'];
				echo '<div class="story">';
				
				if(!empty($hound_img))
					{
					echo '<div class="left"><a href="?story='.$hound_id.'"><img src="/assets/img/hound-collar/headline-'.$hound_img.'"></a></div><div class="right">';
					echo '<h1><a href="?story='.$hound_id.'">'.$hound_name.'</a></h1><h4 class="hound-credit"><em>'.$hound_date.'</em>';
					if(!empty($hound_credit))
						{
						echo '<br>'.$hound_credit;
						}
					else
						{
						}
					if(!empty($hound_credit2))
						{
						echo '<br>'.$hound_credit2;
						}
					else
						{
						}
					echo '</h4>';
					echo $hound_short;
					echo '<h5 class="hound-readmore"><a href="?story='.$hound_id.'">Read More</a></h5>';
					echo '</div><div class="clear">&nbsp;</div>';
					}
				else
					{
					echo '<h1><a href="?story='.$hound_id.'">'.$hound_name.'</a></h1><h4 class="hound-credit">'.$hound_date.'';
					if(!empty($hound_credit))
						{
						echo ' &middot; '.$hound_credit;
						}
					else
						{
						}
					echo '</h4>';
					echo $hound_short;
					echo '<h5 class="hound-readmore"><a href="?story='.$hound_id.'">Read More</a></h5>';
					}
				}
			echo '</div></div><h1 class="title">Other Stories</h1>';
			}
		$result = mysql_query("SELECT hound.hound_id, hound.hound_name, hound.hound_short, hound.hound_credit, hound.hound_credit2, hound.hound_img, hound.hound_date FROM hound, hound_cat_list WHERE hound_cat_list.hound_cat_id!='11' AND hound.hound_id!='51' AND hound_cat_list.hound_id=hound.hound_id ORDER BY hound_date DESC") or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			echo '<p>This page is coming soon.</p>';
			}
		else
			{
			echo '<div class="others">';
			while($row = mysql_fetch_array($result))
				{
				$hound_id=$row['hound_id'];
				$hound_name=$row['hound_name'];
				$hound_date=convert_date($row['hound_date']);
				$hound_img=$row['hound_img'];
				$hound_short = strip_tags(html_entity_decode($row['hound_short'], ENT_QUOTES, 'utf-8'),$allowed_html);
				$hound_credit=$row['hound_credit'];
				$hound_credit2=$row['hound_credit2'];
				if(!empty($hound_img))
					{
					echo '<div class="story"><div class="left"><a href="?story='.$hound_id.'"><img src="/assets/img/hound-collar/headline-'.$hound_img.'"></a></div>';
					echo '<div class="right"><h1><a href="?story='.$hound_id.'">'.$hound_name.'</a></h1><h4 class="hound-credit"><em>'.$hound_date.'</em>';
					if(!empty($hound_credit))
						{
						echo '<br>'.$hound_credit;
						} else {}
					if(!empty($hound_credit2))
						{
						echo '<br>'.$hound_credit2;
						} else {}
					echo '</h4>';
					echo $hound_short;
					echo '<h5 class="hound-readmore"><a href="?story='.$hound_id.'">Read More</a></h5>';
					echo '</div><div class="clear">&nbsp;</div></div><hr>';
					}
				else {
					echo '<div class="story"><h1><a href="?story='.$hound_id.'">'.$hound_name.'</a></h1><h4 class="hound-credit">'.$hound_date.'';
					if(!empty($hound_credit))
						{
						echo '<br>'.$hound_credit;
						}
					else
						{
						}
					if(!empty($hound_credit2))
						{
						echo '<br>'.$hound_credit2;
						}
					echo '</h4>';
					echo $hound_short;
					echo '<h5 class="hound-readmore"><a href="?story='.$hound_id.'">Read More</a></h5></div><hr>';
					}
				}
			echo '</div>';
			}
		}
	}
}
echo '</div><div class="r">';
$feature_result = mysql_query("SELECT hound.hound_id, hound.hound_name, hound.hound_short, hound.hound_credit, hound.hound_img, hound.hound_date FROM hound, hound_cat_list WHERE hound_cat_list.hound_cat_id='2' AND hound_cat_list.hound_id=hound.hound_id ORDER BY hound.hound_date DESC LIMIT 5") or die(mysql_error());
if(mysql_num_rows($feature_result)==0)
	{
	}
else
	{
	echo '<div class="featured"><h1 class="title">Featured</h1><div class="story">';
	while($feature_row = mysql_fetch_array($feature_result))
		{
		$hound_id=$feature_row['hound_id'];
		$hound_name=$feature_row['hound_name'];
		$hound_date=convert_date($feature_row['hound_date']);
		$hound_credit=$feature_row['hound_credit'];
		$hound_img=$feature_row['hound_img'];
		if(!empty($hound_img))
			{
			echo '<div class="mini"><div class="left"><a href="?story='.$hound_id.'"><img src="/assets/img/hound-collar/feature-'.$hound_img.'" width="35" height="35"></a></div><div class="right">';
			echo '<h1><a href="?story='.$hound_id.'">'.$hound_name.'</a></h1><h4 class="hound-credit">'.$hound_date.'</h4></div><div class="clear">&nbsp;</div></div>';
			}
		else
			{
			echo '<h1><a href="?story='.$hound_id.'">'.$hound_name.'</a></h1><h4 class="hound-credit">'.$hound_date.'</h4>';
			}
		
		
		
		}
	echo '</div></div>';
	}
echo '<div class="categories"><h1 class="title">Categories</h1><div class="story"><ul>';
$result = mysql_query("SELECT * FROM hound_cat ORDER BY hound_cat_name ASC") or die(mysql_error());
while($row = mysql_fetch_array( $result ))
	{
	$sub_hound_cat_id=$row['hound_cat_id'];
	$sub_hound_cat_name=$row['hound_cat_name'];
	echo '<li><a href="?cat='.$sub_hound_cat_id.'">'.$sub_hound_cat_name.'</a></li>';
	}
echo '</ul></div></div>';

echo '</div><div class="clear">&nbsp;</div>';





include $foot; ?>