<?php include 'core/base.php';





//page
if(isset($_GET['page']))
	{
	$page = $_GET['page'];
	$page_id = mysql_escape_string($page);
	if (!empty($page_id))
		{
		$result = mysql_query("SELECT * FROM page WHERE page_url='$page_id'");
		if (mysql_num_rows($result) > 0)
			{
			while($row = mysql_fetch_assoc($result))
				{
				$page_id=$row['page_id'];
				$page_name=$row['page_name'];
				$page_full=strip_tags(html_entity_decode($row['page_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
				$page_url=$row['page_url'];
				$page_date=convert_date($row['page_date']);
				$page_banner=$row['page_banner'];
				$page_img1=$row['page_img1'];
				$page_img2=$row['page_img2'];
				
				$pagetitle = $page_name;
				include $head;
				echo '<hr><h1>'.$pagetitle.'</h1>';
				if(!empty($page_full))
					{		
					if($page_id == 73)
						{
						$widget = "";
						$widget.= "<div class='myWidget'>
						<script type='text/javascript'";
						$widget.= "src='http://widgets1.renlearn.com/content/widgets/reading activity/readingactivitywidget.js'>";
						$widget.="</script><script>if (READINGACTIVITYWIDGET) READINGACTIVITYWIDGET.renderWidget('http://widgets1.renlearn.com/', 'SJAX2RG');</script><noscript>Enable Javascript in your browser to view this content.</noscript></div>";
						//echo $widget;
						$find = '<hr><h2><a href="http://www.esc1';
						$insert = $widget.'<hr><h2><a href="http://www.esc1';
						$page_full = str_replace($find,$insert,$page_full);
						
						}				
					echo $page_full;
					if($page_id == 88)
						{ 
						include 'siteInclude/eightyeight.php';
						}
					if($page_id == 102)
						{ 
						include 'siteInclude/onehundredtwo.php';
						}
	
									
					}							
				else
					{
					
					
					echo '<p>This page is coming soon.</p>';
					}
				
				
				
				}
			}
		else
			{
			include $head;
			header("Location: /sja");
			}
		}
	}





else
	{
	include $head;
	header("Location: /sja");
	}





include $foot; ?>