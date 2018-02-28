<?php

if($sidebar == "on")
	{
	if(!empty($pageid))
		{
		?>
		</div><div id="col2">
		<img src="/assets/img/sidebar/<?php echo $pageid; ?>-a.jpg" alt="<?php echo $title; ?>">
		<img src="/assets/img/sidebar/<?php echo $pageid; ?>-b.jpg" alt="<?php echo $title; ?>">
		</div><div class="clear">&nbsp;</div></div>
		<?php
		}
	else
		{
		?>
		</div><div id="col2">
		[photo]
		</div><div class="clear">&nbsp;</div></div>
		<?php
		}
	}
else
	{
	if(!empty($page_img1) OR !empty($page_img2))
		{
		echo '</div><div id="col2">';
		if(!empty($page_img1))
			{
			echo '<img src="/assets/img/sidebar/'.$page_img1.'" alt="'.$title.'">';
			} else {}
		if(!empty($page_img2))
			{
			echo '<img src="/assets/img/sidebar/'.$page_img2.'" alt="'.$title.'">';
			} else {}
		echo '</div><div class="clear">&nbsp;</div></div>';
		}
	else
		{
		echo '</div>';
		}
	
	}
?>

<div id="foot">
<ul>
	<li><a href="/contact" title="Contact">Contact</a></li>
	<li><a href="/login" title="Login">Log In</a></li>
	<li><a href="/search" title="Search">Search</a></li>
	<!--<li><a href="/site-map" title="Site Map">Site Map</a></li>-->
</ul>
<ol>
	<li><?php $copyYear = 2011; $curYear = date('Y'); echo ' &copy;' . $copyYear . (($copyYear != $curYear) ? '-' . $curYear : ' '); ?> Saint Joseph Academy <em>&middot;</em></li>
	<li><a href="https://sja-exchange1.sjafms.org/exchweb/bin/auth/owalogon.asp" target="_blank" title="SJA Email"><img src="/assets/img/social-email.png" width="16" height="16" alt="SJA Email"></a></li>
	<li><a href="http://www.facebook.com/pages/Saint-Joseph-Academy/147754321916794" target="_blank" title="SJA Facebook"><img src="/assets/img/social-facebook.png" width="16" height="16" alt="SJA Facebook"></a></li>
	<li><a href="http://twitter.com/#!/SJAFBall" title="SJA Twitter"><img src="/assets/img/social-twitter.png" width="16" height="16" alt="SJA Twitter"></a></li>
	<li><a href="/paypal" title="SJA PayPal"><img src="/assets/img/social-paypal.png" width="16" height="16" alt="SJA PayPal"></a></li>
</ol>
<div class="clear"></div>
</div>
</div>

</body>
</html>
<?php ob_flush(); ?>