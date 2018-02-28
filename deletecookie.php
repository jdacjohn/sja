<?php
include 'core/base.php';
include 'core/template/head.php';

?>
<form method="post" action="https://www.paypal.com/cgi-bin/webscr" style="padding: 0;margin: 0;margin-top: 10px;">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="hosted_button_id" value="E7U3N4JJT942J">
<input type="hidden" name="business" value="<?php echo "mmartinez@sja.us"; ?>">
<input type="hidden" name="item_name" value="Total Application Fee">
<input type="hidden" name="item_number" value="Ramon">
<input type="hidden" name="amount" value="150">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="notify_url" value="http://www.sja.us/application.php?page=8&submit=ramon">
<input type="hidden" name="return" value="http://www.sja.us/application.php?page=8&submit=ramon">
<input type="image" src="http://www.nhcenters.com/images/paypal_checkout_button.png" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
<?php
if (isset($_COOKIE["recordkeeper"])) {
	$recordname = $_COOKIE["recordkeeper"];
	//setcookie("recordkeeper", $recordname, time()-10);
	echo "done";
}
	$recordname = $_COOKIE["recordkeeper"];
	$j = 1;
	//$success = $_GET['submit'];
	$tiempo = time();
	$success_sql="UPDATE applicant SET paid='1' WHERE cookie_id = '$recordname'";
	$success_result=mysql_query($success_sql) or die(mysql_error());
	$submitdate_sql="UPDATE applicant SET datesubmitted='$tiempo' WHERE cookie_id = '$recordname'";
	mysql_query($submitdate_sql) or die(mysql_error());

	$childrens_sql="SELECT * FROM children WHERE cookie_id = '$recordname'";
	$childrens_result=mysql_query($childrens_sql) or die(mysql_error());
	$numberofkid = mysql_num_rows($childrens_result);
	if($numberofkid > 0){
		while($row=mysql_fetch_assoc($childrens_result)){
			$kid_id =	$row['kid_id'];
			$school_sql="SELECT * FROM schools WHERE cookie_id = '$recordname' AND kid_id = '$kid_id'";
			echo " after ".$school_sql;
			$school_result=mysql_query($school_sql) or die(mysql_error());
			$numberofschools = mysql_num_rows($school_result);			
			$app_id = $row['app_id'];
			$cookie_id = $row['cookie_id'];
			$grade = $row['grade'];
			$gender = $row['gender'];
			$appstreetaddress = $row['appstreetaddress'];
			$appcity = $row['appcity'];
			$appstate = $row['appstate'];
			$appzipcode = $row['appzipcode'];
			$language = $row['language'];
			$yearsofstudy = $row['yearsofstudy'];
			$french = $row['french'];
			$spanish = $row['spanish'];
			$class1 = $row['class1'];
			$class2 = $row['class2'];
			$class3 = $row['class3'];
			$class4 = $row['class4'];
			$class5 = $row['class5'];
			$class6 = $row['class6'];
			$class7 = $row['class7'];
			$class8 = $row['class8'];
			$passfail1 = $row['passfail1'];
			$passfail2 = $row['passfail2'];
			$passfail3 = $row['passfail3'];
			$passfail4 = $row['passfail4'];
			$passfail5 = $row['passfail5'];
			$passfail6 = $row['passfail6'];
			$passfail7 = $row['passfail7'];
			$passfail8 = $row['passfail8'];
			$nodiagnosis = $row['nodiagnosis'];
			$diagnosis = $row['diagnosis'];
			$other = $row['other'];
			$paidfor = $row['paidfor'];
			$essaypath = $row['essaypath'];	
			$appfirstname =	$row['appfirstname'];
			$applastname = $row['applastname'];
			$appmiddlename = $row['appmiddlename'];
			unset($school_array);
			if($numberofschools > 0){
				while($school=mysql_fetch_assoc($school_result)){
					$school_id = $school['school_id'];
					$principal = $school['principal'];
					$address = $school['address'];
					$city = $school['city'];
					$state = $school['state'];
					$zipcode = $school['zipcode'];
					$gradescompleted = $school['gradescompleted'];
					$schoolname = $school['schoolname'];
					$datesattended = $school['datesattended'];
					$school_array[] = array($school_id,$schoolname,$principal,$address,$city,$state,$zipcode,$gradescompleted,$datesattended);
				}
				$child_array[] = array($kid_id,$app_id,$cookie_id,$grade,$gender,$appstreetaddress,$appcity,$appstate,$appzipcode,$language,$yearsofstudy,$french,$spanish,$class1,$class2,$class3,$class4,$class5,$class6,$class7,$class8,$passfail1,$passfail2,$passfail3,$passfail4,$passfail5,$passfail6,$passfail7,$passfail8,$nodiagnosis,$diagnosis,$other,$paidfor,$essaypath,$appfirstname,$applastname,$appmiddlename,$school_array);
			}else{
				echo "<br />No schools have been added to this applicant's application.<br />";
			}
				echo "</div>";
		}		
	}else{

	}
	
	$basicinfolast_sql="SELECT * FROM applicant WHERE cookie_id = '$recordname'";
	$basicinfolast_result=mysql_query($basicinfolast_sql) or die(mysql_error());
	$num_row = mysql_num_rows($basicinfolast_result);
	while($rows=mysql_fetch_assoc($basicinfolast_result)){
		$cookie_id = $rows['cookie_id'];
		$app_id = $rows['app_id'];
		$fatherfirstname = $rows['fatherfirstname'];
		$fatherlastname = $rows['fatherlastname'];
		$fathermiddlename = $rows['fathermiddlename'];
		$fatheraddress = $rows['fatheraddress'];
		$fathercity = $rows['fathercity'];
		$fatherstate = $rows['fatherstate'];
		$fatherzipcode = $rows['fatherzipcode'];
		$fatherworkphone = $rows['fatherworkphone'];
		$fathermobilephone = $rows['fathermobilephone'];
		$fatheremail = $rows['fatheremail'];
		$fatheremployment = $rows['fatheremployment'];
		$fatheroccupation = $rows['fatheroccupation'];
		$motherfirstname = $rows['motherfirstname'];
		$motherlastname = $rows['motherlastname'];
		$mothermiddlename = $rows['mothermiddlename'];
		$motheraddress = $rows['motheraddress'];
		$mothercity = $rows['mothercity'];
		$motherstate = $rows['motherstate'];
		$motherzipcode = $rows['motherzipcode'];
		$motherworkphone = $rows['motherworkphone'];
		$mothermobilephone = $rows['mothermobilephone'];
		$motheremail = $rows['motheremail'];
		$motheremployment = $rows['motheremployment'];
		$motheroccupation = $rows['motheroccupation'];
		$mailingaddress = $rows['mailingaddress'];
		$mailingcity = $rows['mailingcity'];
		$mailingstate = $rows['mailingstate'];
		$mailingzipcode = $rows['mailingzipcode'];
		$legacyname1 = $rows['legacyname1'];
		$legacyrelationship1 = $rows['legacyrelationship1'];
		$legacyclass1 = $rows['legacyclass1'];
		$legacyname2 = $rows['legacyname2'];
		$legacyrelationship2 = $rows['legacyrelationship2'];
		$legacyclass2 = $rows['legacyclass2'];
		$legacyname3 = $rows['legacyname3'];
		$legacyrelationship3 = $rows['legacyrelationship3'];
		$legacyclass3 = $rows['legacyclass3'];
		$legacyname4 = $rows['legacyname4'];
		$legacyrelationship4 = $rows['legacyrelationship4'];
		$legacyclass4 = $rows['legacyclass4'];
		$visit=$rows['visit'];
		$friend=$rows['friend'];
		$church=$rows['church'];
		$newspaper=$rows['newspaper'];
		$website=$rows['website'];
		$brochure=$rows['brochure'];
		$principal=$rows['principal'];
		$paid = $rows['paid'];
	}
	//$kidsnschool[] = array($child_array[$school_array]);
	$kidos = "";
	foreach($child_array as $child){
		$kidos.= "<br clear='all'/>
			<br /><table>
			<tr><td><strong>Applicants Information</strong></td><td></td></tr> 
			<tr><td>Applicant's First Name: </td><td>".$child[34]."</td></tr> 
			<tr><td>Applicant's Last Name: </td><td>".$child[35]."</td></tr> 
			<tr><td>Applicant's Middle Name: </td><td>".$child[36]."</td></tr> 
			<tr><td>Child ID: </td><td>".$child[0]."</td></tr> 
			<tr><td>Application ID: </td><td>".$child[1]."</td></tr> 
			<tr><td>Global ID: </td><td>".$child[2]."</td></tr> 
			<tr><td>Grade Student will Attend: </td><td>".$child[3]."</td></tr> 
			<tr><td>Child's Gender: </td><td>".$child[4]."</td></tr> 
			<tr><td>Street Address: </td><td>".$child[5]."</td></tr> 
			<tr><td>City: </td><td>".$child[6]."</td></tr> 
			<tr><td>State: </td><td>".$child[7]."</td></tr> 
			<tr><td>Zip Code: </td><td>".$child[8]."</td></tr> 
			<tr><td>Other Language: </td><td>".$child[9]."</td></tr> 
			<tr><td>Years of Study: </td><td>".$child[10]."</td></tr> 
			<tr><td>Speak French: </td><td>".$child[11]."</td></tr> 
			<tr><td>Speak Spanish? </td><td>".$child[12]."</td></tr> 
			</table><br /><table><tr><td>Previous Classes Taken</td><td></td></tr>
			 <tr><td>".$child[13]."</td><td>".$child[22]."</td></tr>
			 <tr><td>".$child[14]."</td><td>".$child[23]."</td></tr>
			 <tr><td>".$child[15]."</td><td>".$child[24]."</td></tr>
			 <tr><td>".$child[16]."</td><td>".$child[25]."</td></tr>
			 <tr><td>".$child[17]."</td><td>".$child[26]."</td></tr>
			 <tr><td>".$child[18]."</td><td>".$child[27]."</td></tr>
			 <tr><td>".$child[19]."</td><td>".$child[28]."</td></tr>
			 <tr><td>".$child[20]."</td><td>".$child[29]."</td></tr>
			 <tr><td>".$child[21]."</td><td>".$child[30]."</td></tr></table>
			 <br /> 31--".$child[31]." 32--".$child[32]."<br /> 33--".$child[33];
			 $schoolsforkid = $child[37];
			foreach($schoolsforkid as $school){
				$kidos.= "<br /><table>
				<tr><td>School ID: </td><td>".$school[0]."</td></tr>
				<tr><td>School Name: </td><td>".$school[1]."</td></tr>
				<tr><td>Principal: </td><td>".$school[2]."</td></tr>
				<tr><td>Address: </td><td>".$school[3]."</td></tr>
				<tr><td>City: </td><td>".$school[4]."</td></tr>
				<tr><td>State: </td><td>".$school[5]."</td></tr>
				<tr><td>Zip Code: </td><td>".$school[6]."</td></tr>
				<tr><td>Grades Completed: </td><td>".$school[7]."</td></tr>
				<tr><td>Dates Attended: </td><td>".$school[8]."</td></tr></table>";

			}
			$kidos.= "<br />BREAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAK<br />";
		}
	
	$personal="ramon@uppercasedesigngroup.com";
	$subject = "Feedback";
	$txt = "Hello world!";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: applicants@sja.us" . "\r\n" .
	"CC: ramone2001@gmail.com";
	$message = "
	<html>
	<head>
	  <title>New Application</title>
	  <link type='text/css' href='http://www.sja.us/assets/css/home.css' rel='stylesheet' media='screen'>
	  <style>
	  html
	  	{
	  	overflow-y:scroll;
	  	-webkit-font-smoothing:antialiased;
	  	width: 100%;
	  	min-height: 100%;
	  	margin:0;
	  	}
	  body
	  	{
	  	width: 100%;
	  	height: 100%;
	  	margin:0;
	  	padding:0;
	  	text-align:center;
	  	font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;
	  	background:#a2a6a7 url(http://www.sja.us/assets/img/bg-body.gif) repeat;
	  	}
	  	#container{
	  	margin: 0 auto;
	  	width:800px;
	  	background-color:#ffffff;
	  	}
	  </style>
	</head>
	<body><br /><br />
	<div id='container'>
		<img src='http://www.sja.us/assets/img/logo-home.gif'>	
	  <h3>New Applicants</h3>
		<table style='float:left;'>
			<tr><td><strong>Fathers's Information</strong></td><td></td></tr>
			<tr><td>First Name: </td><td>".$fatherfirstname."</td></tr>
			<tr><td>Last Name: </td><td>".$fatherlastname."</td></tr>
			<tr><td>Middle Name: </td><td>".$fathermiddlename."</td></tr> 
			<tr><td>Address: </td><td>".$fatheraddress."</td></tr>
			<tr><td>City: </td><td>".$fathercity."</td></tr>
			<tr><td>State: </td><td>".$fatherstate."</td></tr>
			<tr><td>Zip Code: </td><td>".$fatherzipcode."</td></tr> 
			<tr><td>Work Phone: </td><td>".$fatherworkphone."</td></tr> 
			<tr><td>Mobile Phone: </td><td>".$fathermobilephone."</td></tr> 
			<tr><td>Email: </td><td>".$fatheremail."</td></tr>
			<tr><td>Place of Employment: </td><td>".$fatheremployment."</td></tr> 
			<tr><td>Occupation: </td><td>".$fatheroccupation."</td></tr>
		</table> 
		<table style='float:left;'>
			<tr><td><strong>Mother's Information</strong></td><td></td></tr>
			<tr><td>First Name: </td><td>".$motherfirstname."</td></tr>
			<tr><td>Last Name: </td><td>".$motherlastname."</td></tr>
			<tr><td>Middle Name: </td><td>".$mothermiddlename."</td></tr> 
			<tr><td>Address: </td><td>".$motheraddress."</td></tr> 
			<tr><td>City: </td><td>".$mothercity."</td></tr> 
			<tr><td>State: </td><td>".$motherstate."</td></tr> 
			<tr><td>Zip Code: </td><td>".$motherzipcode."</td></tr>  
			<tr><td>Work Phone: </td><td>".$motherworkphone."</td></tr> 
			<tr><td>Mobile Phone: </td><td>".$mothermobilephone."</td></tr> 
			<tr><td>Email: </td><td>".$motheremail."</td></tr> 
			<tr><td>Place of Employment: </td><td>".$motheremployment."</td></tr>  
			<tr><td>Occupation: </td><td>".$motheroccupation."</td></tr> 
		</table>
<table style='float:left;'>
<tr><td><strong>Mailing Address</strong></td><td></td></tr>
	<tr><td>Mailing Street Address: </td><td>".$mailingaddress." </td></tr>
	<tr><td>Mailing City: </td><td>".$mailingcity." </td></tr>
	<tr><td>Mailing State: </td><td>".$mailingstate." </td></tr>
	<tr><td>Mailing Zip Code: </td><td>".$mailingzipcode."</td></tr>
	</table>
	<table style='float:left;'>
	 <tr><td><strong>Legacy Information</strong></td><td></td><td></td></tr>
	 <tr><td>".$legacyname1." </td><td> ".$legacyrelationship1." </td><td> ".$legacyclass1."</td></tr>
	 <tr><td>".$legacyname2." </td><td> ".$legacyrelationship2." </td><td> ".$legacyclass2."</td></tr>
	 <tr><td>".$legacyname3." </td><td> ".$legacyrelationship3." </td><td> ".$legacyclass3."</td></tr>
	 <tr><td>".$legacyname4." </td><td> ".$legacyrelationship4." </td><td> ".$legacyclass4."</td></tr>
	</table><br />
	<table style='float:left;'>
	<tr><td><strong>How did you Hear about Us?</strong></td><td></td></tr>
	<tr><td>School Visit? </td><td>".$visit." </td></tr> 
	<tr><td>Friend? </td><td>".$friend." </td></tr> 
	<tr><td>Church?  </td><td>".$church." </td></tr> 
	<tr><td>Newspaper? </td><td>".$newspaper." </td></tr> 
	<tr><td>Website? </td><td>".$website." </td></tr> 
	<tr><td>Brochure? </td><td>".$brochure." </td></tr> 
	<tr><td>Principal</td><td>".$principal." </td></tr>
	</table> 
	".$kidos."
	</div>
	</body>
	</html>
	";
	
	//mail($personal,$subject,$message,$headers);
	$j = 1;
	echo $kidos;
?>