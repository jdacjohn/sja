<?php $title = "Welcome to Saint Joseph Academy &middot; Brownsville, Texas"; include 'core/base.php';
ob_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<link type="text/css" href="./assets/css/home.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="./assets/js/script.js"></script>
<script type="text/javascript" src="./assets/js/jquery.min.js"></script>



<script>
/***********************************************
* Ultimate Fade-In Slideshow (v1.51): © Dynamic Drive (http://www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/
 
var fadeimages=new Array()
//SET IMAGE PATHS. Extend or contract array as needed
<?php
$result = mysql_query("SELECT slideshow_name FROM slideshow ORDER BY slideshow_id ASC") or die(mysql_error());
$n = '0';
while($row = mysql_fetch_array($result))
	{
	$slideshow_name=$row['slideshow_name'];
	$x = $n ++;
	echo '
	fadeimages['.$x.']=["./assets/img/banner/1-'.$slideshow_name.'", "", ""] //plain image syntax';
	}
?>
 
var fadebgcolor="fff"

////NO need to edit beyond here/////////////
 
var fadearray=new Array() //array to cache fadeshow instances
var fadeclear=new Array() //array to cache corresponding clearinterval pointers
 
var dom=(document.getElementById) //modern dom browsers
var iebrowser=document.all
 
function fadeshow(theimages, fadewidth, fadeheight, borderwidth, delay, pause, displayorder){
this.pausecheck=pause
this.mouseovercheck=0
this.delay=delay
this.degree=10 //initial opacity degree (10%)
this.curimageindex=0
this.nextimageindex=1
fadearray[fadearray.length]=this
this.slideshowid=fadearray.length-1
this.canvasbase="canvas"+this.slideshowid
this.curcanvas=this.canvasbase+"_0"
if (typeof displayorder!="undefined")
theimages.sort(function() {return 0.5 - Math.random();}) //thanks to Mike (aka Mwinter) :)
this.theimages=theimages
this.imageborder=parseInt(borderwidth)
this.postimages=new Array() //preload images
for (p=0;p<theimages.length;p++){
this.postimages[p]=new Image()
this.postimages[p].src=theimages[p][0]
}
 
var fadewidth=fadewidth+this.imageborder*2
var fadeheight=fadeheight+this.imageborder*2
 
if (iebrowser&&dom||dom) //if IE5+ or modern browsers (ie: Firefox)
document.write('<div id="master'+this.slideshowid+'" style="z-index:0;position:relative;width:'+fadewidth+'px;height:'+fadeheight+'px;overflow:hidden;"><div id="'+this.canvasbase+'_0" style="position:absolute;width:'+fadewidth+'px;height:'+fadeheight+'px;top:0;left:0;filter:progid:DXImageTransform.Microsoft.alpha(opacity=10);opacity:0.1;-moz-opacity:0.1;-khtml-opacity:0.1;background-color:'+fadebgcolor+'"></div><div id="'+this.canvasbase+'_1" style="position:absolute;width:'+fadewidth+'px;height:'+fadeheight+'px;top:0;left:0;filter:progid:DXImageTransform.Microsoft.alpha(opacity=10);opacity:0.1;-moz-opacity:0.1;-khtml-opacity:0.1;background-color:'+fadebgcolor+'"></div></div>')
else
document.write('<div><img name="defaultslide'+this.slideshowid+'" src="'+this.postimages[0].src+'"></div>')
 
if (iebrowser&&dom||dom) //if IE5+ or modern browsers such as Firefox
this.startit()
else{
this.curimageindex++
setInterval("fadearray["+this.slideshowid+"].rotateimage()", this.delay)
}
}

function fadepic(obj){
if (obj.degree<100){
obj.degree+=10
if (obj.tempobj.filters&&obj.tempobj.filters[0]){
if (typeof obj.tempobj.filters[0].opacity=="number") //if IE6+
obj.tempobj.filters[0].opacity=obj.degree
else //else if IE5.5-
obj.tempobj.style.filter="alpha(opacity="+obj.degree+")"
}
else if (obj.tempobj.style.MozOpacity)
obj.tempobj.style.MozOpacity=obj.degree/101
else if (obj.tempobj.style.KhtmlOpacity)
obj.tempobj.style.KhtmlOpacity=obj.degree/100
else if (obj.tempobj.style.opacity&&!obj.tempobj.filters)
obj.tempobj.style.opacity=obj.degree/101
}
else{
clearInterval(fadeclear[obj.slideshowid])
obj.nextcanvas=(obj.curcanvas==obj.canvasbase+"_0")? obj.canvasbase+"_0" : obj.canvasbase+"_1"
obj.tempobj=iebrowser? iebrowser[obj.nextcanvas] : document.getElementById(obj.nextcanvas)
obj.populateslide(obj.tempobj, obj.nextimageindex)
obj.nextimageindex=(obj.nextimageindex<obj.postimages.length-1)? obj.nextimageindex+1 : 0
setTimeout("fadearray["+obj.slideshowid+"].rotateimage()", obj.delay)
}
}
 
fadeshow.prototype.populateslide=function(picobj, picindex){
var slideHTML=""
if (this.theimages[picindex][1]!="") //if associated link exists for image
slideHTML='<a href="'+this.theimages[picindex][1]+'" target="'+this.theimages[picindex][2]+'">'
slideHTML+='<img src="'+this.postimages[picindex].src+'" border="'+this.imageborder+'px">'
if (this.theimages[picindex][1]!="") //if associated link exists for image
slideHTML+='</a>'
picobj.innerHTML=slideHTML
}
 
 
fadeshow.prototype.rotateimage=function(){
if (this.pausecheck==1) //if pause onMouseover enabled, cache object
var cacheobj=this
if (this.mouseovercheck==1)
setTimeout(function(){cacheobj.rotateimage()}, 100)
else if (iebrowser&&dom||dom){
this.resetit()
var crossobj=this.tempobj=iebrowser? iebrowser[this.curcanvas] : document.getElementById(this.curcanvas)
crossobj.style.zIndex++
fadeclear[this.slideshowid]=setInterval("fadepic(fadearray["+this.slideshowid+"])",50)
this.curcanvas=(this.curcanvas==this.canvasbase+"_0")? this.canvasbase+"_1" : this.canvasbase+"_0"
}
else{
var ns4imgobj=document.images['defaultslide'+this.slideshowid]
ns4imgobj.src=this.postimages[this.curimageindex].src
}
this.curimageindex=(this.curimageindex<this.postimages.length-1)? this.curimageindex+1 : 0
}
 
fadeshow.prototype.resetit=function(){
this.degree=10
var crossobj=iebrowser? iebrowser[this.curcanvas] : document.getElementById(this.curcanvas)
if (crossobj.filters&&crossobj.filters[0]){
if (typeof crossobj.filters[0].opacity=="number") //if IE6+
crossobj.filters(0).opacity=this.degree
else //else if IE5.5-
crossobj.style.filter="alpha(opacity="+this.degree+")"
}
else if (crossobj.style.MozOpacity)
crossobj.style.MozOpacity=this.degree/101
else if (crossobj.style.KhtmlOpacity)
crossobj.style.KhtmlOpacity=this.degree/100
else if (crossobj.style.opacity&&!crossobj.filters)
crossobj.style.opacity=this.degree/101
}
 
 
fadeshow.prototype.startit=function(){
var crossobj=iebrowser? iebrowser[this.curcanvas] : document.getElementById(this.curcanvas)
this.populateslide(crossobj, this.curimageindex)
if (this.pausecheck==1){ //IF SLIDESHOW SHOULD PAUSE ONMOUSEOVER
var cacheobj=this
var crossobjcontainer=iebrowser? iebrowser["master"+this.slideshowid] : document.getElementById("master"+this.slideshowid)
crossobjcontainer.onmouseover=function(){cacheobj.mouseovercheck=1}
crossobjcontainer.onmouseout=function(){cacheobj.mouseovercheck=0}
}
this.rotateimage()
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.head-slideshow').cycle({
		fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		speed:    1000, 
		timeout:  5000, 
		pause:  1
	});
});
</script>
</head>
<body>
<?php
if($user_log=='1')
{
	echo '<div id="toolbar">';
	echo '<div id="widget"><p id="buttons">';
	echo '<a href="./panel" class="panel">Control Panel</a> &middot; <a href="./login/?logout" class="logout">Log Out</a>';
	echo '</p><p id="greeting">';
	//greeting based on time
	$differencetolocaltime=2; $new_U=date("U")+$differencetolocaltime*3600; $fulllocaldatetime= date("d-m-Y h:i:s A", $new_U); $hour = date("H", $new_U);
	if ($hour < 12) 	{ echo 'Good morning '; }
	elseif ($hour < 13) { echo 'Hello '; }
	elseif ($hour < 16) { echo 'Good afternoon '; }
	elseif ($hour < 18) { echo 'Hello '; }
	else 			{ echo 'Good evening '; }
	//first name of user
	if($user_name_f!=''){echo $user_name_f;}else{echo $user_login;} echo '</li>';
	echo '</p></div>';
	echo '</div>';
}
else
{
	/*
	echo '<div id="toolbar">';
	echo '<form action="./login.php?Login" method="post" id="widget">
	<fieldset>
	username:
	<input type="text" name="user_login">
	password:
	<input type="password" name="user_pass">
	<input type="submit" name="submit" value="Log In" class="login">
	</fieldset>
	</form>';
	echo '</div>';
	*/
}
?>
<div id="container">
<div id="head">
<h1><a href="./" title="Today, Tomorrow, Forever St. Joe &middot; Saint Joseph Academy, Brownsville, Texas">Today, Tomorrow, Forever St. Joe &middot; Saint Joseph Academy, Brownsville, Texas</a></h1>
	<div id="banner">
		<div class="head-slideshow">
		<?php
		$result = mysql_query("SELECT emergency_id, emergency_name, emergency_date FROM emergency ORDER BY emergency_date DESC LIMIT 1") or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			}
		else
			{
			while($row = mysql_fetch_array($result))
				{ $emergency_id=$row['emergency_id']; $emergency_name=$row['emergency_name']; $emergency_date=convert_date($row['emergency_date']);
					echo '<marquee scrollamount="2">'.$emergency_name.'</marquee>';					
				}
			}
		?>
		<script type="text/javascript">
		//new fadeshow(IMAGES_ARRAY_NAME, slideshow_width, slideshow_height, borderwidth, delay, pause (0=no, 1=yes), optionalRandomOrder)
		new fadeshow(fadeimages, 875, 225, 0, 3000, 1, "R")
		</script>
		</div>
		<ul class="nav">
		<li class="drop divided"><a href="./students" title="Students">Students</a>
			<ul>
			<li><a href="./key-information" title="Key Information">Key Information</a></li>
			<li><a href="https://www.edline.net/Index.page" target="_blank" title="Edline">Edline</a></li>
			<li><a href="./student-parent-handbook" title="Student and Parent Handbook">Student and Parent Handbook</a></li>
			<li><a href="./fun-facts" title="Fun Facts and Photo Sharing">Fun Facts and Photo Sharing</a></li>
			<li><a href="http://sja.escobookstore.com/" target="_blank" title="Virtual Bookstore">Virtual Bookstore</a></li>
			<li><a href="http://sja.escobookstore.com/" target="_blank" title="Virtual Merchandise Store">Virtual Merchandise Store</a></li>
			<li><a href="./hound-collar" title="Hound Collar">Hound Collar</a></li>
			<li><a href="./paw" title="PAW">PAW</a></li>
			<li><a href="./academic-policies" title="Academic Policies">Academic Policies</a></li>
			<li><a href="./faq" title="FAQs">FAQs</a></li>
			</ul>
		</li>
		<li class="drop divided"><a href="./parents" title="Parents">Parents</a>
			<ul>
			<li><a href="./key-information" title="Key Information">Key Information</a></li>
			<li><a href="https://www.edline.net/Index.page" target="_blank" title="Edline">Edline</a></li>
			<li><a href="./faculty-staff" title="Faculty and Staff Directory">Faculty and Staff Directory</a></li>
			<li><a href="./academic-policies" title="Academic Policies">Academic Policies</a></li>
			<li><a href="./student-parent-handbook" title="Student and Parent Handbook">Student and Parent Handbook</a></li>
			<li><a href="./athletic-boosters" title="Athletic Boosters">Athletic Boosters</a></li>
			<li><a href="./band-boosters" title="Band Boosters">Band Boosters</a></li>
			<li><a href="./photos" title="Photos: View and Buy">Photos: View and Buy</a></li>
			<li><a href="./crisis-management" title="Crisis Management Plan">Crisis Management Plan</a></li>
			<!-- <li><a href="./emergency" title="Emergency Registry">Emergency Registry</a></li> -->
			</ul>
		</li>
		<li class="drop divided"><a href="./alumni" title="Alumni">Alumni</a>
			<ul>
			<li><a href="./reunion-info" title="Reunion Info">Reunion Info</a></li>
			<li><a href="./update-your-info" title="Update Your Info">Update Your Info</a></li>
			<li><a href="./class-news" title="Class News">Class News</a></li>
			<li><a href="./class-agent-contact" title="Class Agent Contact">Class Agent Contact</a></li>
			<li><a href="./fun-facts" title="Fun Facts and Photo Sharing">Fun Facts and Photo Sharing</a></li>
			<li><a href="./photo-sharing" title="Picture Sharing">Picture Sharing</a></li>
			<li><a href="./network" title="SJA Network">SJA Network</a></li>
			<li><a href="./golf-tournament" title="Alumni Golf Tournament">Alumni Golf Tournament</a></li>
			<li><a href="./annual-fund" title="Annual Fund">Annual Fund</a></li>
			<li><a href="./online-giving" title="Online Giving">Online Giving</a></li>
			<li><a href="./save-our-gym" title="Save Our Gym Campaign">Save Our Gym Campaign</a></li>
			<li><a href="./special-events" title="Special Events">Special Events</a></li>
			</ul>
		</li>
		<li><a href="./faculty-staff" title="Faculty">Faculty</a></li>
		</ul>
		<div class="clear">&nbsp;</div>
		<div class="arch1">&nbsp;</div>
	</div>
</div>


<div id="content">
	<div id="col1">
		
		<ul id="verticalmenu" class="glossymenu">
		<li><a href="./about-us" title="About Us">About Us</a>
		    <ul>
		    <li><a href="./mission-statement" title="Mission Statement">Mission Statement</a></li>
		    <li><a href="./history" title="School History">School History</a></li>
		    <li><a href="./campus-safety" title="Campus Safety &amp; Security">Campus Safety &amp; Security</a></li>
		    <!-- <li><a href="./strategic-plan" title="Strategic Plan">Strategic Plan</a></li> -->
		    <li><a href="./marist-schools" title="Marist Schools">Marist Schools</a></li>
		    <li><a href="./office-of-the-president" title="Office of the President">Office of the President</a></li>
		    <li><a href="./office-of-the-principal" title="Office of the Principal">Office of the Principal</a></li>
		    <li><a href="./school-administration" title="School Administration">School Administration</a></li>
		    <li><a href="./faculty-staff" title="Faculty and Staff Directory">Faculty and Staff Directory</a></li>
		    <li><a href="./board-of-directors" title="School Board of Directors">School Board of Directors</a></li>
		    <li><a href="./enrollment-history" title="Enrollment History">Enrollment History</a></li>
		    <li><a href="./employment-opportunities" title="Employment Opportunities">Employment Opportunities</a></li>
		    <li><a href="./campus-map" title="Campus Map">Campus Map</a></li>
		    <li><a href="./contact" title="Contact Information">Contact Information</a></li>
		    </ul>
		</li>
		<li><a href="./admissions" title="Admissions">Admissions</a>
		    <ul>
		    <li><a href="./admissions-process" title="Admissions Process &amp; Entrance Exam">Admissions Process &amp; Entrance Exam</a></li>
		    <li><a href="./tuition" title="Tuition and Fees">Tuition and Fees</a></li>
		    <li><a href="./financial-assistance" title="Financial Assistance">Financial Assistance</a></li>
		    <li><a href="./school-profile" title="School Profile">School Profile</a></li>
		    <li><a href="./shadow-program" title="Shadow Program">Shadow Program</a></li>
		    <li><a href="./teacher-recommendation" title="Teacher Recommendation Form">Teacher Recommendation Form</a></li>
		    <li><a href="./admissions-application" title="Electronic Admissions / Application Form">Electronic Admissions / Application Form</a></li>
		    </ul>
		</li>
		<li><a href="./academics" title="Academics">Academics</a>
		    <ul>
		    <li><a href="./academic-support" title="Academic Support">Academic Support</a></li>
		    	<li><a href="./assets/pdf/815-CourseBulletinCover.pdf">Course Bulletin 2013-2014</a></li>
		    <li><a href="./graduation-outcomes" title="Graduation Outcomes">Graduation Outcomes</a></li>
		    <li><a href="./guidance-counseling" title="Guidance and Counseling">Guidance and Counseling</a></li>
		    <li><a href="./grade-level-research" title="Grade Level Research Requirements">Grade Level Research Requirements</a></li>
		    <li><a href="./honors-ap" title="Honors and AP Programs">Honors and AP Programs</a></li>
		    <li><a href="./library" title="Library Media Center">Library Media Center</a></li>
		    <li><a href="./writing-portfolio" title="Writing Portfolio">Writing Portfolio</a></li>
		    <li><a href="./summer-reading" title="Summer Reading">Summer Reading</a></li>
		    <li><a href="./departments" title="Departments">Departments</a></li>
		    </ul>
		</li>
		<li><a href="./athletics" title="Athletics">Athletics</a>
		    <ul>
		    <li><a href="./high-school" title="High School">High School</a></li>
		    <li><a href="./jr-high-school" title="Middle Division">Middle Division</a></li>
		    <li><a href="./athletic-boosters" title="Athletic Booster Club">Athletic Booster Club</a></li>
		    </ul>
		</li>
		<li><a href="./school-year-dates" title="Printable Calendar">Printable Calendar</a></li>
		<li><a href="./support" title="Support SJA">Support SJA</a>
		    <ul>
		    <li><a href="./annual-fund" title="Annual Fund">Annual Fund</a></li>
		    <li><a href="./leadership-circle" title="Leadership Circle">Leadership Circle</a></li>
		    <li><a href="./ways-to-give" title="Ways to Give">Ways to Give</a></li>
		    <li><a href="./montagne-project" title="Montagne Project">Montagne Project</a></li>
		    <li><a href="./special-events" title="Special Events">Special Events</a></li>
		    <li><a href="./sja-endowment" title="SJA Endowment">SJA Endowment</a></li>
		    </ul>
		</li>
		<li><a href="http://maps.google.com/maps?q=101+Saint+Joseph+Drive%0ABrownsville,+TX+78520" target="_blank">Map to St. Joe</a></li>
		</ul>
	<!-- <a href="/paypal" class="paypal"><img src="./assets/img/paypal.png"></a> -->
	<a href="http://youtu.be/Qtw40zM6utk" target="_blank" class="projRed"> </a>
	
	</div>
	
	<div id="col2">
	
	
	
	
	<?php
	
	
	$result = mysql_query("SELECT * FROM hound WHERE hound_id!='51' ORDER BY hound_date DESC LIMIT 2") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<p>This page is coming soon.</p>';
		}
	else
		{
		echo '<div class="hound">';
		while($row = mysql_fetch_array($result))
			{
			$hound_id=$row['hound_id'];
			$hound_name=$row['hound_name'];
			$hound_date=convert_date($row['hound_date']);
			$hound_img=$row['hound_img'];
			$hound_short = strip_tags(html_entity_decode($row['hound_short'], ENT_QUOTES, 'utf-8'),$allowed_html);
			$hound_credit=$row['hound_credit'];
			if(!empty($hound_img))
				{
				echo '<div class="story"><div class="left"><a href="./hound-collar/?story='.$hound_id.'"><img src="./assets/img/hound-collar/headline-'.$hound_img.'" width="35" height="35" alt="'.$hound_name.'"></a></div>';
				echo '<div class="right"><h1><a href="./hound-collar/?story='.$hound_id.'">'.$hound_name.'</a></h1>';
				echo '<div class="tease">'.$hound_short.'</div>';
				echo '<p class="hound-readmore"><a href="./hound-collar/?story='.$hound_id.'">Read More</a></p>';
				echo '</div><div class="clear">&nbsp;</div></div>';
				}
			else {
				echo '<div class="story"><h1><a href="./hound-collar/?story='.$hound_id.'">'.$hound_name.'</a></h1><h4 class="hound-credit">'.$hound_date.'</h4>';
				echo '<div class="tease">'.$hound_short.'</div>';
				echo '<p class="hound-readmore"><a href="./hound-collar/?story='.$hound_id.'">Read More</a></p></div>';
				}
			}
		echo '</div>';
		}
	/*
	$result = mysql_query("SELECT home_id, home_name, home_full, home_img FROM home ORDER BY RAND() LIMIT 1") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{ $home_id=$row['home_id']; $home_name=$row['home_name']; $home_full = strip_tags(html_entity_decode($row['home_full'], ENT_QUOTES, 'utf-8'),$allowed_html); $home_img=$row['home_img'];
				echo '<div class="home"><div class="l"><h2>'.$home_name.'</h2>'.$home_full.'</div><div class="r"><img src="./assets/img/home/'.$home_img.'" width="150" height="90"></div><div class="clear">&nbsp;</div></div>';					
			}
		}
	*/
	?>
	<?php
	$result = mysql_query("SELECT announce_id, announce_name, announce_short, announce_date FROM announce ORDER BY announce_date DESC LIMIT 1") or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		echo '<h2>Daily Announcements</h2><p>There are no entries.</p>';
		}
	else
		{
		echo '<h2><a href="./announcements">Daily Announcements</a></h2>';
		while($row = mysql_fetch_array($result))
			{ $announce_id=$row['announce_id']; $announce_name=$row['announce_name']; $announce_date=convert_date($row['announce_date']); $announce_short = strip_tags(html_entity_decode($row['announce_short'], ENT_QUOTES, 'utf-8'),$allowed_html3);
				echo $announce_short;					
			}
		}
	?><p class="readmore"><a href="./announcements">Read More</a></p>
	</div>
	<div id="col3">
	<!-- <h2><a href="./calendar">Calendar</a></h2> -->
	<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showDate=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=350&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=sjawebcalendar%40gmail.com&amp;color=%23182C57&amp;ctz=America%2FChicago" style=" border-width:0 " width="400" height="275" frameborder="0" scrolling="no"></iframe>
	<p><a href="./school-year-dates" title="Printable Calendar">Printable Calendar</a></p>
		<div class="paypalbtn">
			<a href="./paypal" class="paypal"><img src="./assets/img/paypal2.png" /></a> 
		</div><!-- close div paypal btn -->
	</div>
	
	<div class="clear">&nbsp;</div>
	
	<div id="sub-foot">
	<ul class="nav">
	<li class="a"><a href="./welcome" title="Welcome to St. Joe">Welcome to St. Joe</a></li>
	<li class="b"><a href="./st-joe-life" title="St. Joe Life">St. Joe Life</a></li>
	<li class="c"><a href="https://www.edline.net/Index.page" target="_blank" title="Edline">Edline</a></li>
	<li class="d"><a href="https://sja-exchange1.sjafms.org/exchweb/bin/auth/owalogon.asp" target="_blank" title="Email">Email</a><!--<a href="http://sja.escobookstore.com/" target="_blank" title="Store">Store</a>--></li>
	</ul>
	</div>
</div>
<div id="foot">
<ul>
	<li><a href="./contact" title="Contact">Contact</a></li>
	<li><a href="./login" title="Login">Log In</a></li>
	<li><a href="./search" title="Search">Search</a></li>
	<!--<li><a href="./site-map" title="Site Map">Site Map</a></li>-->
</ul>
<ol>
	<li><?php $copyYear = 2011; $curYear = date('Y'); echo ' &copy;' . $copyYear . (($copyYear != $curYear) ? '-' . $curYear : ' '); ?> Saint Joseph Academy <em>&middot;</em></li>
	<li><a href="https://sja-exchange1.sjafms.org/exchweb/bin/auth/owalogon.asp" target="_blank" title="SJA Email"><img src="./assets/img/social-email.png" width="16" height="16" alt="SJA Email"></a></li>
	<li><a href="http://www.facebook.com/pages/Saint-Joseph-Academy/147754321916794" target="_blank" title="SJA Facebook"><img src="./assets/img/social-facebook.png" width="16" height="16" alt="SJA Facebook"></a></li>
	<li><a href="http://twitter.com/#!/SJAFBall" target="_blank" title="SJA Twitter"><img src="./assets/img/social-twitter.png" width="16" height="16" alt="SJA Twitter"></a></li>
	<li><a href="./ways-to-give" target="_blank" title="SJA PayPal"><img src="./assets/img/social-paypal.png" width="16" height="16" alt="SJA PayPal"></a></li>
</ol>
<div class="clear"></div>
</div>
</div>

</body>
</html>
<?php ob_flush(); ?>