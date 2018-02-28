<?php $pagetitle = "Search"; include 'core/base.php'; $sidebar = 'off'; $pageid = ''; include $head;




echo '<hr><h1>'.$pagetitle.'</h1>';
if (isset($_GET['k']))
	{
	/* gneneral */
	if(isset($_GET['k']))
		{
		$search_keywords = preg_replace("[^A-Za-z0-9]", "", $_GET['k']);
		}
	else
		{
		$search_keywords = '';
		}
	/* image */
	if(isset($_GET['image']))
		{
		$search_image = preg_replace("[^A-Za-z0-9]", "", $_GET['image']);
		}
	else
		{
		$search_image = '';
		}
	?>
	<form method="GET" action="<?php echo $PHP_SELF; ?>">
	<fieldset>
	<legend></legend>
		<ul>
		<li><input name="k" type="text" value="<?php echo $_GET['k']; ?>"></li>
		</ul>
	</fieldset>
	<fieldset>
	<!--
	<legend>Etc...</legend>
		<ul>
		<li><input name="image" value="y" type="checkbox" class="styled"<?php if($search_image=='y'){echo ' checked="checked"';} else{} ?>>Images</li>
		</ul>
	</fieldset>
	-->
	<fieldset>
		<ul>
		<li><input type="submit" value="Search" /></li>
		</ul>
	</fieldset>
	</form>
	<?php
	if(!empty($search_keywords) or !empty($search_image))
		{
		$search = "SELECT * FROM page WHERE '1'='1'";
			
		/* first name, last name, user name */
		if(!empty($search_keywords))
			{
			$post=trim($search_keywords);
			$split = explode(' ', $post);
			$split = array_unique($split);
			$keyword ='';
			$count = substr_count($post,' ');
			for ($i=0; $i<=$count; $i++)
				{
				$keyword = '%'.$split[$i].'%';
				$search .= " AND (page_name LIKE '$keyword' OR page_full LIKE '$keyword' OR page_url LIKE '$keyword')";
				}
			} else {}
		/* image */
		if($search_image=='y')
			{
			$search .= " AND (page_banner!='' OR page_img1!='' OR page_img2!='')";
			} else {}
			
		$search .= " ORDER BY page_name ASC";
		
		$result = mysql_query($search) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		$row_count = mysql_num_rows($result);
	
		if ($row_count > 0)
			{
			echo '<hr><h2>'.$row_count.' Search Results:</h2>';
			do
				{
				$sja_page_name=$row['page_name'];
				$sja_page_full=$row['page_full'];
				$sja_page_url=$row['page_url'];
				echo '<hr><p><a href="/'.$sja_page_url.'">';
				//echo str_replace($search_keywords, "<strong>$search_keywords</strong>",$sja_page_name);
				if(!empty($sja_page_name)){echo $sja_page_name;} else {}
				//if(!empty($sja_page_full)){echo ' '.$sja_page_full;} else {}
				echo '</a>';
				echo '</p>';
				}
			while ($row = mysql_fetch_assoc($result));
			}
		
		else
			{
			echo '<hr><h2>There were no Search Results.</h2>';
			}
		}
	else
		{
		echo '<hr><h2>You must enter some information in order to search.</h2>';
		}
	}
else
	{
	?>
	<form method="GET" action="<?php echo $PHP_SELF; ?>">
	<fieldset>
	<legend></legend>
		<ul>
		<li><input name="k" type="text"></li>
		</ul>
	</fieldset>
	<!--
	<fieldset>
	<legend>Etc...</legend>
		<ul>
		<li><input name="image" value="y" type="checkbox" class="styled">Images</li>
		</ul>
	</fieldset>
	-->
	<fieldset>
		<ul>
		<li><input type="submit" value="Search" /></li>
		</ul>
	</fieldset>
	</form>
	<?php
	}





include $foot; ?>