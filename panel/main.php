<?php $pagetitle = "Control Panel"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged();





?>
<h1><?php echo $pagetitle; ?></h1>
<hr>

<div class="l">

<h2>Site Editor</h2>
<ul>
<?php
if($user_level >= '4')
	{
	?>
	<li><a href="/panel/page?edit=2">About Us Admin</a></li>
	<li><a href="/panel/page?edit=3">Academic Policies Admin</a></li>
	<li><a href="/panel/page?edit=4">Academic Support Admin</a></li>
	<li><a href="/panel/page?edit=5">Academics Admin</a></li>
	<li><a href="/panel/page?edit=6">Additional Resources Admin</a></li>
	<li><a href="/panel/page?edit=7">Admissions Admin</a></li>
	<li><a href="/panel/page?edit=8">Admissions Application Admin</a></li>
	<li><a href="/panel/page?edit=9">Admissions Process &amp; Entrance Exam Admin</a></li>
	<!--<li><a href="/panel/page?edit=10">After-School Supervised Study Program Admin</a></li>-->
	<li><a href="/panel/page?edit=11">Alumni Admin</a></li>
	<li><a href="/panel/alumni">Alumni Fun Facts and Photo Sharing &middot; Photo Admin</a></li>
	<li><a href="/panel/page.php?edit=158">Alumni Fun Facts and Photo Sharing &middot; Links Admin</a></li>
	<li><a href="/panel/announce">Announcement Admin</a></li>
	<li><a href="/panel/page?edit=12">Annual Fund Admin</a></li>
	<li><a href="/panel/page?edit=131">Annual Report of Philanthropy Admin</a></li>
	<li><a href="/panel/page?edit=13">Athletic Boosters Admin</a></li>
	<li><a href="/panel/page?edit=14">Athletics Admin</a></li>
	<li><a href="/panel/page?edit=16">Band Admin</a></li>
	<li><a href="/panel/page?edit=17">Band Boosters Admin</a></li>
	<li><a href="/panel/banner">Banner Admin</a></li>
	<li><a href="/panel/page?edit=19">Bus Schedule Admin</a></li>
	<li><a href="/panel/page?edit=20">Business Admin</a></li>
	<li><a href="/panel/page?edit=143">Bylaws Admin</a></li>
	<li><a href="/panel/page?edit=23">Campus Ministry Admin</a></li>
	<li><a href="/panel/page?edit=159">Campus Safety &amp; Security Admin</a></li>
	<li><a href="/panel/page?edit=24">Champagnat Learning Center Admin</a></li>
	<li><a href="/panel/page?edit=25">Choir Admin</a></li>
	<li><a href="/panel/page?edit=28">Class News Admin</a></li>
	<li><a href="/panel/page?edit=144">Committee Description and Members Admin</a></li>
	<li><a href="/panel/page?edit=145">Committee Description and Members &middot; Academic Committee Admin</a></li>
	<li><a href="/panel/page?edit=146">Committee Description and Members &middot; Academy Advancement/Endowment Liaison Committee Admin</a></li>
	<li><a href="/panel/page?edit=147">Committee Description and Members &middot; Audit/Benefits &amp; Insurance Committee Admin</a></li>
	<li><a href="/panel/page?edit=148">Committee Description and Members &middot; Buildings &amp; Grounds Committee Admin</a></li>
	<li><a href="/panel/page?edit=149">Committee Description and Members &middot; Executive Committee Admin</a></li>
	<li><a href="/panel/page?edit=150">Committee Description and Members &middot; Finance/Fiscal &amp; Financial Aid Oversight/Fund Management Committee Admin</a></li>
	<li><a href="/panel/page?edit=151">Committee Description and Members &middot; Nominations/Succession/Governance Committee Admin</a></li>
	<li><a href="/panel/page?edit=152">Committee Description and Members &middot; School Life &amp; Faculty Relations Committee</a></li>
	<li><a href="/panel/page?edit=153">Committee Description and Members &middot; Strategic Planning &amp; Mission Effectiveness Committee</a></li>
	<li><a href="/panel/page.php?edit=140">Community Prayer Breakfast Admin</a></li>
	<li><a href="/panel/page?edit=30">Computer Science Admin</a></li>
	<li><a href="/panel/page?edit=31">Contact Information Admin</a></li>
	<li><a href="/panel/page?edit=33">Debate Team Admin</a></li>
	<li><a href="/panel/page?edit=34">Departments Admin</a></li>
	<li><a href="/panel/directory">Directory Listing Admin</a></li>
	<!-- <li><a href="/panel/page?edit=142">Directory Listing Admin</a></li> -->
	<li><a href="/panel/page?edit=35">Drama Club Admin</a></li>
	<li><a href="/panel/emergency">Emergency Admin</a></li>
	<li><a href="/panel/page?edit=36">Employment Opportunities Admin</a></li>
	<li><a href="/panel/page?edit=37">English Admin</a></li>
	<li><a href="/panel/page?edit=38">Enrollment History Admin</a></li>
	<li><a href="/panel/faculty">Faculty Admin</a></li>
	<!--<li><a href="/panel/page?edit=40">Faculty Tutoring Admin</a></li> -->
	<li><a href="/panel/page?edit=42">Financial Assistance Admin</a></li>
	<li><a href="/panel/page?edit=43">Fine Arts Admin</a></li>
	<li><a href="/panel/page?edit=45">French Honor Society Admin</a></li>
	<li><a href="/panel/page?edit=41">Frequently Asked Questions Admin</a></li>
	<li><a href="/panel/page?edit=47">Golf Tournament Admin</a></li>
	<li><a href="/panel/page?edit=48">Grade Level Research Requirements Admin</a></li>
	<li><a href="/panel/page?edit=49">Graduation Outcomes Admin</a></li>
	<li><a href="/panel/page?edit=50">Green Team Admin</a></li>
	<li><a href="/panel/page?edit=51">Guidance and Counseling Admin</a></li>
	<li><a href="/panel/page?edit=52">High School &middot; Baseball Admin</a></li>
	<li><a href="/panel/page?edit=53">High School &middot; Basketball Admin</a></li>
	<li><a href="/panel/page?edit=54">High School &middot; Cheerleading Admin</a></li>
	<li><a href="/panel/page?edit=55">High School &middot; Cross Country Admin</a></li>
	<li><a href="/panel/page?edit=56">High School &middot; Football Admin</a></li>
	<li><a href="/panel/page?edit=57">High School &middot; Golf Admin</a></li>
	<li><a href="/panel/page?edit=59">High School &middot; Soccer Admin</a></li>
	<li><a href="/panel/page?edit=60">High School &middot; Swimming and Diving Admin</a></li>
	<li><a href="/panel/page?edit=61">High School &middot; Tennis Admin</a></li>
	<li><a href="/panel/page?edit=62">High School &middot; Track &amp; Field Admin</a></li>
	<li><a href="/panel/page?edit=58">High School Athletics Admin</a></li>
	<li><a href="/panel/page?edit=64">Honors and AP Programs Admin</a></li>
	<li><a href="/panel/hound-collar">Hound Collar Admin</a></li>
	<li><a href="/panel/image">Image Admin</a></li>
	<li><a href="/panel/page?edit=66">International Thespians Society Admin</a></li>
	<li><a href="/panel/page?edit=155">Middle School &middot; Cross Country Admin</a></li>
	<li><a href="/panel/page?edit=67">Middle School &middot; Basketball Admin</a></li>
	<li><a href="/panel/page?edit=68">Middle School &middot; Football Admin</a></li>
	<li><a href="/panel/page?edit=156">Middle School &middot; Swimming Admin</a></li>
	<li><a href="/panel/page?edit=157">Middle School &middot; Track Admin</a></li>
	<li><a href="/panel/page?edit=70">Middle School &middot; Volleyball Admin</a></li>
	<li><a href="/panel/page?edit=69">Middle School Athletics Admin</a></li>
	<li><a href="/panel/page?edit=71">Key Information Admin</a></li>
	<li><a href="/panel/page?edit=72">Leadership Circle Admin</a></li>
	<li><a href="/panel/page?edit=73">Library Media Center Admin</a></li>
	<li><a href="/panel/page?edit=74">Lunch Menu Admin</a></li>
	<li><a href="/panel/page?edit=75">Marist Schools Admin</a></li>
	<li><a href="/panel/page?edit=76">Marist Youth Movement Admin</a></li>
	<li><a href="/panel/page?edit=77">Masterminds Admin</a></li>
	<li><a href="/panel/page?edit=78">Mathematics Admin</a></li>
	<li><a href="/panel/page?edit=79">Mission Statement Admin</a></li>
	<li><a href="/panel/page?edit=80">Missions Admin</a></li>
	<li><a href="/panel/page?edit=82">Montagne Project Admin</a></li>
	<li><a href="/panel/page?edit=83">National Art Honor Society Admin</a></li>
	<li><a href="/panel/page?edit=84">National Honor Society Admin</a></li>
	<li><a href="/panel/page?edit=93">National Honor Society Peer Tutoring Admin</a></li>
	<li><a href="/panel/page?edit=85">National Junior Art Honor Society Admin</a></li>
	<li><a href="/panel/page?edit=86">National Junior Honor Society Admin</a></li>
	<li><a href="/panel/page?edit=88">Office of the President Admin</a></li>
	<li><a href="/panel/office-cabinet">Office of the President Admin &middot; Cabinet Members</a></li> 
	<!-- <li><a href="/panel/office">Office of the President Admin</a></li>-->
	
	<li><a href="/panel/page?edit=89">Office of the Principal Admin</a></li>
	<li><a href="/panel/page?edit=91">Parents Admin</a></li>
	<li><a href="/panel/page?edit=92">PAW Literary Magazine Admin</a></li>
	<li><a href="/panel/pdf">PDF Uploader</a></li>
	<li><a href="/panel/page?edit=96">Physical Education Admin</a></li>
	<li><a href="/panel/photo">Photos: View and Buy Admin</a></li>
	<li><a href="/panel/page?edit=97">Policies Admin</a></li>
	<li><a href="/panel/page?edit=98">Positive Peer Leadership Team Admin</a></li>
	<li><a href="/panel/page?edit=104">Printable School Calendars Admin</a></li>
	<li><a href="/panel/page?edit=99">Religious Studies Admin</a></li>
	<li><a href="/panel/page?edit=100">Reunion Info</a></li>
	<li><a href="/panel/page?edit=101">Save Our Gym Admin</a></li>
	<li><a href="/panel/page?edit=102">School Administration Admin</a></li>
	<li><a href="/panel/school-admin-officers">School Administration &middot; Executive Officers &amp; Administration Admin</a></li>
	<!-- <li><a href="/panel/page?edit=102">School Administration Admin</a></li> -->
	<li><a href="/panel/page?edit=18">School Board of Directors Admin</a></li>
	<li><a href="/panel/page?edit=63">School History Admin</a></li>
	<li><a href="/panel/page?edit=103">School Profile Admin</a></li>
	<li><a href="/panel/page?edit=105">Science Admin</a></li>
	<li><a href="/panel/page?edit=107">Shadow Program Admin</a></li>
	<li><a href="/panel/page?edit=109">Social Studies Admin</a></li>
	<li><a href="/panel/page?edit=110">Sociedad Honoraria Hispanica Admin</a></li>
	<li><a href="/panel/page?edit=111">Special Events Admin</a></li>
	<li><a href="/panel/page?edit=112">St. Joe Life Admin</a></li>
	<!-- <li><a href="/panel/page?edit=113">Strategic Plan Admin</a></li> -->
	<li><a href="/panel/page?edit=10">Student Advocate Services Admin</a></li>
	<li><a href="/panel/page?edit=115">Student and Parent Handbook Admin</a></li>
	<li><a href="/panel/page?edit=114">Student Council Admin</a></li>
	<li><a href="/panel/fun">Student Fun Facts and Photo Sharing &middot; Photo Admin</a></li>
	<li><a href="/panel/page?edit=46">Student Fun Facts and Photo Sharing &middot; Links Admin</a></li>
	<li><a href="/panel/page?edit=116">Students Admin</a></li>
	<li><a href="/panel/page?edit=129">Style Show Admin</a></li>
	<li><a href="/panel/page?edit=117">Summer Reading Admin</a></li>
	<li><a href="/panel/page?edit=118">Support SJA Admin</a></li>
	<li><a href="/panel/page?edit=119">Sweethearts Dance Team Admin</a></li>
	<li><a href="/panel/page?edit=120">Target Language Admin</a></li>
	<li><a href="/panel/page?edit=130">Taste of the Town Admin</a></li>
	<li><a href="/panel/page.php?edit=121">Teacher Recommendation Form Admin</a></li>
	<li><a href="/panel/page?edit=132">Tuition and Fees</a></li>
	<li><a href="/panel/page?edit=122">Uniform Regulations Admin</a></li>
	<li><a href="/panel/page.php?edit=124">Ways To Give Admin</a></li>
	<li><a href="/panel/page?edit=125">Welcome to St. Joe Admin</a></li>
	<li><a href="/panel/page?edit=126">Writing Portfolio Admin</a></li>
	<li><a href="/panel/page?edit=127">Yearbook Admin</a></li>
	<?php
	}
else
	{}
echo '</ul>';
?>
</ul>
<?php
//echo $_SESSION['user_id']."-----";
$users_sql="SELECT * FROM `user` WHERE user_id = 29";
$users_result= mysql_query($users_sql) or die(mysql_error());
$pending_sql="SELECT * FROM `applicant` WHERE paid = '2'";
$pending_result= mysql_query($pending_sql) or die(mysql_error());
while($rows = mysql_fetch_array($users_result)){
	if($rows['user_id'] == $_SESSION['user_id']){
			if(isset($_GET['pending'])){
			echo "<br clear='all'>";
			if(mysql_num_rows($pending_result) > 0){
				echo "<form method='post' action='".$PHP_SELF."?paid'>";
				while($row = mysql_fetch_array($pending_result)){
					$app_id = $row['app_id'];
					$children_result = mysql_query("SELECT * FROM `children` WHERE app_id='$app_id'");
					$children_count = mysql_num_rows($children_result);
					if($children_count > 1){
						$child = "children";					
					}else{
						$child = "child";
					}
					echo "<input type='radio' value='".$row['app_id']."' name='application_paid' style='width:20px;'>Parents: ".$row['fatherfirstname']." ".$row['fatherlastname']." & ".$row['motherfirstname']." ".$row['motherlastname']." (".$children_count." ".$child.")<br />";
				}
				echo "<br /><input type='submit'>";
			}elseif(isset($_GET['paid'])){
				echo "No Pending Applicants at this time.";
			}
		}elseif(!isset($_GET['pending'])){
			echo "<ul>
			<li><a href='/panel/?pending'>Pending Applicant Payments</a></li>
			</ul>";
		}
		if(isset($_GET['paid'])){
			$id = $_POST['application_paid'];
			mysql_query("UPDATE `applicant` SET paid='1' WHERE app_id='$id'");
			echo "Application status has been updated";
		}
	}
}

?>
</div>
	
<div class="r">
<h2>User Settings</h2>
<ul>
<li><a href="user-email">Name &amp; Email</a></li>
<li><a href="user-password">Password</a></li>
<li><a href="user-login">Username</a></li>
</ul>			
<?php
if($user_level == '5')
	{
	?>
	<hr>
	<h2>Administration</h2>
	<ul>
	<li><a href="admin-user">User Admin</a></li>
	</ul>
	<?php
	}
else
	{}
?>
</div>
<?php
echo $clear;





include '../'.$foot; ?>