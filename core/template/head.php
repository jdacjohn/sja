<?php ob_start();

/*title*/
$site_name = 'Saint Joseph Academy';
$site_tagline = 'Today, tomorrow, Forever St. Joe';
if(!empty($pagetitle))
	{
	if(!empty($pagetype))
		{
		$title = $pagetype.' '.$pagetitle.' &middot; '.$site_name;
		}
	else
		{
		$title = $pagetitle.' &middot; '.$site_name;
		}
	}
else
	{
	$title = $site_name;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<link type="text/css" href="/assets/css/jquery.css" rel="stylesheet" />
<link type="text/css" href="/assets/css/style.css" rel="stylesheet" media="screen">
<link type="text/css" href="/assets/css/print.css" rel="stylesheet" media="print">
<link type="text/css" href="/assets/css/lightbox.css" rel="stylesheet">
<link rel="shortcut icom" href="favicon.ico" />
<script type="text/javascript" src="/assets/js/script.js"></script>
<script type="text/javascript" src="/assets/js/jquery.min.js"></script>

<script type="text/javascript" src="/assets/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/assets/js/lightbox.js"></script>

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
	fadeimages['.$x.']=["/assets/img/banner/0-'.$slideshow_name.'", "", ""] //plain image syntax';
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
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/assets/js/json.js"></script>
<script type="text/javascript" src="/assets/js/cropper.js"></script>
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
	echo '<a href="/panel" class="panel">Control Panel</a> &middot; <a href="/login/?logout" class="logout">Log Out</a>';
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
	echo '<form action="/login.php?Login" method="post" id="widget">
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
<h3><a href="/" title="Saint Joseph Academy, Brownsville, Texas">Saint Joseph Academy, Brownsville, Texas</a></h3>
<h1><a href="/" title="<?php echo $site_name; ?>"><?php echo $site_name; ?></a></h1>
<h2><?php echo $site_tagline; ?></h2>
<div class="clear">&nbsp;</div>

	<ul class="nav" id="nav">
	<li class="drop"><a href="/students" title="Students">Students</a>
		<ul>
		<li><a href="/key-information" title="Key Information">Key Information</a>
			<ul>
			<li><a href="/calendar" title="Calendar">Calendar</a></li>
			<li><a href="/lunch" title="Lunch Menus">Lunch Menus</a></li>
			<li><a href="/bus" title="Bus Schedules">Bus Schedules</a></li>
			<li><a href="/school-year-dates" title="2011 / 2012 Printable Calendar">Printable Calendars</a></li>
			<li><a href="/uniform-regulations" title="Uniform Regulations">Uniform Regulations</a></li>
			</ul>
		</li>
		<li><a href="https://www.edline.net/Index.page" target="_blank" title="Edline">Edline</a></li>
		<li><a href="/student-parent-handbook" title="Student and Parent Handbook">Student and Parent Handbook</a></li>
		<li><a href="/fun-facts" title="Fun Facts and Photo Sharing">Fun Facts and Photo Sharing</a></li>
		<li><a href="http://sja.escobookstore.com/" target="_blank" title="Virtual Bookstore">Virtual Bookstore</a></li>
		<li><a href="http://sja.escobookstore.com/" target="_blank" title="Virtual Merchandise Store">Virtual Merchandise Store</a></li>
		<li><a href="/hound-collar" title="Hound Collar">Hound Collar</a></li>
		<li><a href="/paw" title="PAW">PAW</a></li>
		<li><a href="/academic-policies" title="Academic Policies">Academic Policies</a></li>
		<li><a href="/faq" title="FAQs">FAQs</a></li>
		</ul>
	</li>
	<li class="drop"><a href="/parents" title="Parents">Parents</a>
		<ul>
		<li><a href="/key-information" title="Key Information">Key Information</a>
			<ul>
			<li><a href="/calendar" title="Calendar">Calendar</a></li>
			<li><a href="/lunch" title="Lunch Menus">Lunch Menus</a></li>
			<li><a href="/bus" title="Bus Schedules">Bus Schedules</a></li>
			<li><a href="/school-year-dates" title="2011 / 2012 Printable Calendar">Printable Calendars</a></li>
			</ul>
		</li>
		<li><a href="https://www.edline.net/Index.page" target="_blank" title="Edline">Edline</a></li>
		<li><a href="/faculty-staff" title="Faculty and Staff Directory">Faculty and Staff Directory</a></li>
		<li><a href="/academic-policies" title="Academic Policies">Academic Policies</a></li>
		<li><a href="/student-parent-handbook" title="Student and Parent Handbook">Student and Parent Handbook</a></li>
		<li><a href="/athletic-boosters" title="Athletic Boosters">Athletic Boosters</a></li>
		<li><a href="/band-boosters" title="Band Boosters">Band Boosters</a></li>
		<li><a href="/photos" title="Photos: View and Buy">Photos: View and Buy</a></li>
		<li><a href="/crisis-management" title="Crisis Management Plan">Crisis Management Plan</a></li>
		<li><a href="/emergency" title="Emergency Registry">Emergency Registry</a></li>
		</ul>
	</li>
	<li class="drop"><a href="/alumni" title="Alumni">Alumni</a>
		<ul>
		<li><a href="/reunion-info" title="Reunion Info">Reunion Info</a></li>
		<li><a href="/update-your-info" title="Update Your Info">Update Your Info</a></li>
		<li><a href="/class-news" title="Class News">Class News</a></li>
		<li><a href="/class-agent-contact" title="Class Agent Contact">Class Agent Contact</a></li>
		<li><a href="/alumni-fun-facts" title="Fun Facts and Photo Sharing">Fun Facts and Photo Sharing</a></li>
		<li><a href="/photo-sharing" title="Picture Sharing">Picture Sharing</a></li>
		<li><a href="/golf-tournament" title="Alumni Golf Tournament">Alumni Golf Tournament</a></li>
		<li><a href="/annual-fund" title="Annual Fund">Annual Fund</a></li>
		<li><a href="/online-giving" title="Online Giving">Online Giving</a></li>
		<li><a href="/save-our-gym" title="Save Our Gym Campaign">Save Our Gym Campaign</a></li>
		<li><a href="/network" title="SJA Network">SJA Network</a></li>
		<li><a href="/special-events" title="Special Events">Special Events</a>
			<ul>
			<li><a href="/style-show" title="Style Show">Style Show</a></li>
			<li><a href="/taste-of-the-town" title="Taste of the Town">Taste of the Town</a></li>
			<li><a href="/golf-tournament" title="Special Events">Alumni Golf Tournament</a></li>
			</ul>
		</li>
		</ul>
	</li>
	<li><a href="/faculty-staff" title="Faculty">Faculty</a></li>
	</ul>
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
	<?php
	if(!empty($page_banner))
		{
		echo '<a><img src="/assets/img/banner/'.$page_banner.'" alt="'.$title.'" width="820" height="173"></a>';
		}
	else
		{
		?>
		<script type="text/javascript">
		//new fadeshow(IMAGES_ARRAY_NAME, slideshow_width, slideshow_height, borderwidth, delay, pause (0=no, 1=yes), optionalRandomOrder)
		new fadeshow(fadeimages, 875, 225, 0, 3000, 1, "R")
		</script>
		<?php
		}
	?>
	</div>
	<ul class="subnav" id="subnav">
	<li><a href="/welcome" title="Welcome to St. Joe">Welcome to St. Joe</a></li>
	<li class="drop"><a href="/st-joe-life" title="St. Joe Life">St. Joe Life</a>
		<ul>
		<li><a href="/band" title="Band">Band</a></li>
		<li><a href="/choir" title="Choir">Choir</a></li>
		<li><a href="/campus-ministry" title="Campus Ministry">Campus Ministry</a></li>
		<li><a href="/civic-youth-group" title="Civic Youth Group">Civic Youth Group</a></li>
		<li><a href="/debate-team" title="Debate Team">Debate Team</a></li>
		<li><a href="/drama-club" title="Drama Club">Drama Club</a></li>
		<li><a href="/fishing-club" title="Fishing Club">Fishing Club</a></li>
		<li><a href="/french-honor-society" title="French Honor Society">French Honor Society</a></li>
		<li><a href="/green-team" title="Green Team">Green Team</a></li>
		<li><a href="/hound-collar" title="Hound Collar">Hound Collar</a></li>
		<li><a href="/international-thespians" title="International Thespians Society">International Thespians Society</a></li>
		<li><a href="/marist-youth" title="Marist Youth Movement">Marist Youth Movement</a></li>
		<li><a href="/masterminds" title="Masterminds">Masterminds</a></li>
		<li><a href="/missions" title="Missions">Missions</a></li>
		<li><a href="/model-un" title="Model UN">Model UN</a></li>
		<li><a href="/national-art-honor-society" title="National Art Honor Society">National Art Honor Society</a></li>
		<li><a href="/national-junior-art-honor-society" title="National Junior Art Honor Society">National Junior Art Honor Society</a></li>
		<li><a href="/national-honor-society" title="National Honor Society">National Honor Society</a></li>
		<li><a href="/national-junior-honor-society" title="National Junior Honor Society">National Junior Honor Society</a></li>
		<li><a href="/paw" title="PAW Literary Magazine">PAW Literary Magazine</a></li>
		<li><a href="/positive-peer" title="Positive Peer Leadership Team">Positive Peer Leadership Team</a></li>
		<li><a href="/sociedad-honoraria-hispanica" title="Sociedad Honoraria Hispanica">Sociedad Honoraria Hispanica</a></li>
		<li><a href="/student-council" title="Student Council">Student Council</a></li>
		<li><a href="/sweethearts-dance-team" title="Sweethearts Dance Team">Sweethearts Dance Team</a></li>
		<li><a href="/yearbook" title="Yearbook">Yearbook</a></li>
		</ul>
	</li>
	<li><a href="https://www.edline.net/Index.page" target="_blank" title="Edline">Edline</a></li>
	<li><a href="https://sja-exchange1.sjafms.org/exchweb/bin/auth/owalogon.asp" target="_blank" title="Email">Email</a><!--<a href="http://sja.escobookstore.com/" target="_blank" title="Store">Store</a>--></li>
	</ul>
	<div class="clear">&nbsp;</div>
	</div>
	<ul class="nav" id="nav2">
	<li><a href="/" title="Home">Home</a></li>
	<li class="drop"><a href="/about-us" title="About Us">About Us</a>
		<ul>
		<li><a href="/mission-statement" title="Mission Statement">Mission Statement</a></li>
		<li><a href="/history" title="School History">School History</a></li>
		<li><a href="/campus-safety" title="Campus Safety &amp; Security">Campus Safety &amp; Security</a></li>
		<!-- <li><a href="/strategic-plan" title="Campus Safety &amp; Security">Campus Safety &amp; Security</a></li> -->
		<li><a href="/marist-schools" title="Marist Schools">Marist Schools</a></li>
		<li><a href="/office-of-the-president" title="Office of the President">Office of the President</a></li>
		<!-- <li><a href="/office-of-the-president" title="Office of the President">Office of the President</a></li>-->
		<li><a href="/office-of-the-principal" title="Office of the Principal">Office of the Principal</a></li>
		<li><a href="/school-administration" title="School Administration">School Administration</a></li>
		<!-- <li><a href="/school-administration-officers" title="School Administration">School Administration</a></li> -->
		<li><a href="/faculty-staff" title="Faculty and Staff Directory">Faculty and Staff Directory</a></li>
		<li><a href="/board-of-directors" title="School Board of Directors">School Board of Directors</a>
			<ul>
			<li><a href="/bylaws" title="Bylaws">Bylaws</a></li>
			<li><a href="/committee-description-and-members" title="Committee Description and Members">Committee Description and Members</a></li>
			<li><a href="/directory-listing" title="Directory Listing">Directory Listing</a></li> 
			</ul>
		</li>	
		<li><a href="/enrollment-history" title="Enrollment History">Enrollment History</a></li>
		<li><a href="/employment-opportunities" title="Employment Opportunities">Employment Opportunities</a></li>
		<li><a href="/campus-map" title="Campus Map">Campus Map</a></li>
		<li><a href="/contact" title="Contact Information">Contact Information</a></li>
		</ul>
	</li>
	<li class="drop"><a href="/admissions" title="Admissions">Admissions</a>
		<ul>
		<li><a href="/admissions-process" title="Admissions Process &amp; Entrance Exam">Admissions Process &amp; Entrance Exam</a></li>
		<li><a href="/tuition" title="Tuition and Fees">Tuition and Fees</a></li>
		<li><a href="/financial-assistance" title="Financial Assistance">Financial Assistance</a></li>
		<li><a href="/school-profile" title="School Profile">School Profile</a></li>
		<li><a href="/shadow-program" title="Shadow Program">Shadow Program</a></li>
		<li><a href="/teacher-recommendation" title="Teacher Recommendation Form">Teacher Recommendation Form</a></li>
		<li><a href="/admissions-application" title="Electronic Admissions / Application Form">Electronic Admissions / Application Form</a></li>
		</ul>
	</li>
	<li class="drop"><a href="/academics" title="Academics">Academics</a>
		<ul>
		<li><a href="/academic-support" title="Academic Support">Academic Support</a>
			<ul>
			<li><a href="/champagnat" title="Champagnat Learning Center">Champagnat Learning Center</a></li>
			<!-- <li><a href="/faculty-tutors" title="Faculty Tutors">Faculty Tutors</a></li> -->
			
			<li><a href="/peer-tutors" title="Peer Tutors">Peer Tutors</a></li>
			<li><a href="/student-advocate-services" title="Student Advocate Services">Student Advocate Services</a></li>
			<li><a href="/additional-resources" title="Additional Resources">Additional Resources</a></li>
			</ul>
		</li>
		<li><a href="/assets/pdf/815-CourseBulletinCover.pdf">Course Bulletin 2013-2014</a></li>
		<li><a href="/graduation-outcomes" title="Graduation Outcomes">Graduation Outcomes</a></li>
		<li><a href="/guidance-counseling" title="Guidance and Counseling">Guidance and Counseling</a></li>
		<li><a href="/grade-level-research" title="Grade Level Research Requirements">Grade Level Research Requirements</a></li>
		<li><a href="/honors-ap" title="Honors and AP Programs">Honors and AP Programs</a></li>
		<li><a href="/library" title="Library Media Center">Library Media Center</a></li>
		<li><a href="/writing-portfolio" title="Writing Portfolio">Writing Portfolio</a></li>
		<li><a href="/summer-reading" title="Summer Reading">Summer Reading</a></li>
		<li><a href="/departments" title="Departments">Departments</a>
			<ul>
			<li><a href="/business" title="Business">Business</a></li>
			<li><a href="/computer-science" title="Computer Science">Computer Science</a></li>
			<li><a href="/english" title="English">English</a></li>
			<li><a href="/fine-arts" title="Fine Arts">Fine Arts</a></li>
			<li><a href="/mathematics" title="Mathematics">Mathematics</a></li>
			<li><a href="/physical-education" title="Physical Education">Physical Education</a></li>
			<li><a href="/religious-studies" title="Religious Studies">Religious Studies</a></li>
			<li><a href="/science" title="Science">Science</a></li>
			<li><a href="/social-studies" title="Social Studies">Social Studies</a></li>
			<li><a href="/target-language" title="Target Language">Target Language</a></li>
			</ul>
		</li>
		</ul>
	</li>
	<li class="drop"><a href="/athletics" title="Athletics">Athletics</a>
		<ul>
		<li><a href="/high-school" title="High School">High School</a>
			<ul>
			<li><a href="/high-baseball" title="Baseball">Baseball</a></li>
			<li><a href="/high-basketball" title="Basketball">Basketball</a></li>
			<li><a href="/high-cheerleading" title="Cheerleading">Cheerleading</a></li>
			<li><a href="/high-cross-country" title="Cross Country">Cross Country</a></li>
			<li><a href="/high-football" title="Football">Football</a></li>
			<li><a href="/high-golf" title="Golf">Golf</a></li>
			<li><a href="/high-soccer" title="Soccer">Soccer</a></li>
			<li><a href="/high-swimming-diving" title="Swimming and Diving">Swimming and Diving</a></li>
			<li><a href="/high-tennis" title="Tennis">Tennis</a></li>
			<li><a href="/high-track-field" title="Track &amp; Field">Track &amp; Field</a></li>
			</ul>
		</li>
		<li><a href="/jr-high-school" title="Middle Division">Middle Division</a>
			<ul>
			<li><a href="/jr-basketball" title="Basketball">Basketball</a></li>
			<li><a href="/jr-cross-country" title="Cross Country">Cross Country</a></li>
			<li><a href="/jr-football" title="Football">Football</a></li>
			<li><a href="/jr-swimming" title="Swimming">Swimming</a></li>
			<li><a href="/jr-track" title="Track">Track</a></li>
			<li><a href="/jr-volleyball" title="Volleyball">Volleyball</a></li>
			</ul>
		</li>
		<li><a href="/athletic-boosters" title="Athletic Booster Club">Athletic Booster Club</a></li>
		</ul>
	</li>
	<li class="drop"><a href="/support" title="Support SJA">Support SJA</a>
		<ul>
		<li><a href="/annual-fund" title="Annual Fund">Annual Fund</a></li>
		<li><a href="/philanthropy-report" title="Annual Report of Philanthropy">Annual Report of Philanthropy</a></li>
		<li><a href="/leadership-circle" title="Leadership Circle">Leadership Circle</a></li>
		<li><a href="/paypal" title="Online Giving">Online Giving</a></li>
		<li><a href="/ways-to-give" title="Ways to Give">Ways to Give</a></li>
		<li><a href="/montagne-project" title="Montagne Project">Montagne Project</a></li>
		<!--
		<li><a href="/science-quad-project" title="Science Quad Project">Science Quad Project</a></li>
		<li><a href="/save-our-gym" title="Save Our Gym Campaign">Save Our Gym Campaign</a></li>
		-->
		<li><a href="/special-events" title="Special Events">Special Events</a>
			<ul>
			<li><a href="/community-prayer-breakfast" title="Community Prayer Breakfast">Community Prayer Breakfast</a></li>
			<li><a href="/style-show" title="Style Show">Style Show</a></li>
			<li><a href="/taste-of-the-town" title="Taste of the Town">Taste of the Town</a></li>
			<li><a href="/golf-tournament" title="Special Events">Alumni Golf Tournament</a></li>
			</ul>
		</li>
		<li><a href="/sja-endowment" title="SJA Endowment">SJA Endowment</a></li>
		</ul>
	</li>
	</ul>
</div>
<?php






if($sidebar == "on")
	{
	if($div!='')
		{
		echo '<div class="col '.$div.'" id="content"><div id="col1">';
		}
	else
		{
		echo '<div class="col" id="content"><div id="col1">';
		}
	}
elseif($sidebar == "full")
	{
	if($div!='')
		{
		echo '<div class="full '.$div.'" id="content">';
		}
	else
		{
		echo '<div class="full" id="content">';
		}
	}
else
	{
	
	if(!empty($page_img1) OR !empty($page_img2))
		{
		echo '<div class="col" id="content"><div id="col1">';
		}
	elseif($div!='')
		{
		echo '<div class="padded '.$div.'" id="content">';
		}
	else
		{
		echo '<div class="padded" id="content">';
		}
	}
?>