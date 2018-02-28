<?php
$pagetitle = "Admissions Application Form"; include 'core/base.php'; include 'core/template/head.php';
//if(isset($_COOKIE["login"])){
//	$remove=$_COOKIE["login"];
//	setcookie("login", $remove, time() - 53600);
//}
//echo mime_content_type('assets/essays/-alphabet-soup.pdf');
if(isset($_GET['errormain'])){
	//echo "<span style='font-size:17px'>Information entered was not saved due to missing information:</span><br /><span style='background-color:#ffff00;color:#ff0000;padding:1px;'>".stripslashes($_GET['errormain'])."</span>";
	$recordname = $_COOKIE["recordkeeper"];
	setcookie("recordkeeper", $recordname, time() - 53600);  	
	$err = $_GET['errormain'];
	?>
		<script type="text/javascript">
		<!--
		window.location = "http://www.sja.us/application.php?error=<?php echo $err; ?>"
		//-->
		</script>		
	<?php
	
	
	}
	
if(isset($_GET['error'])){
	echo "<span style='font-size:17px'>Information entered was not saved due to missing information:</span><br /><span style='background-color:#ffff00;color:#ff0000;padding:1px;'>".stripslashes($_GET['error'])."</span>";}
if(isset($_POST['page'])){$page=$_POST['page'];}elseif(isset($_GET['page'])){$page=$_GET['page'];}


//echo time();
//echo "---1358143200";

// check for cookie, if cookie retrieve record from DB
if (isset($_COOKIE["recordkeeper"])) {
	$recordname = $_COOKIE["recordkeeper"];
	//setcookie("recordkeeper", $recordname, time() - 53600); 
	$basicinfo_sql="SELECT * FROM applicant WHERE cookie_id = '$recordname'";
	$basicinfo_result=mysql_query($basicinfo_sql) or die(mysql_error());
	$num_row = mysql_num_rows($basicinfo_result);
	while($rows=mysql_fetch_assoc($basicinfo_result)){
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
		
		if ($mailingaddress == '' && $mailingcity == '' && $mailingstate == '' && $mailingzipcode == ''){
			$mailingtable = "";
		}else{
			//$insertmailing = "<br /><h1>Mailing Address</h1><br />";
			//$mailingaddress = $insertmailing . $mailingaddress;
			$mailingtable = "<table class='formTable' cellpadding='0' cellspacing='0' border='0'>
			<tbody>
				<tr><td colspan='3' class='formHeader'><span>Mailing Address</span></td><td class='formHeader'></td></tr>
				<tr>
					<td><span class='formLegend'>Street: </span></td>
					<td><span class='formText'>".$mailingaddress." <br/></td>
				</tr>
				<tr>
					<td><span class='formLegend'>City: </span></td>
					<td><span class='formText'>".$mailingcity."</span></td>
				</tr>
				<tr>
					<td><span class='formLegend'>State: </span></td>
					<td><span class='formText'>".$mailingstate."</span></td>
				</tr>
				<tr>
					<td><span class='formLegend'>Zip Code: </span></td>
					<td><span class='formText'>".$mailingzipcode."</span></td>
				</tr>
				
			</tbody>
			</table>";
			
		}
		
		if($legacyname1 == '' && $legacyrelationship1 == '' && $legacyclass1 == '' && $legacyname2 == '' && $legacyrelationship2 == '' && $legacyclass2 == '' && $legacyname3 == '' && $legacyrelationship3 == '' && $legacyclass3 == '' && $legacyname4 == '' && $legacyrelationship4 == '' && $legacyclass4 == ''){
		
			$legacytable = "";

		
		}else{
			$legacytable = "<table class='formTable' cellpadding='0' cellspacing='0' border='0'>";
			$legacytable .= "<tbody>";			
			$legacytable .= "<tr><td colspan='3' class='formHeader'><span>Legacies</span></td><td class='formHeader'></td></tr>";
			if($legacyname1 <> '' && $legacyrelationship1 <> '' && $legacyclass1 <> ''){
				$legacytable .= "<tr><td><span class='formLegend'>Legacy 1: </span></td>";
				$legacytable .= "<td><span class='formText'>".$legacyname1." <br/></td>";
				$legacytable .= "<td><span class='formText'>".$legacyrelationship1." <br/></td>";
				$legacytable .= "<td><span class='formText'>".$legacyclass1." <br/></td></tr>";
			}
			if($legacyname2 <> '' && $legacyrelationship2 <> '' && $legacyclass2 <> ''){
				$legacytable .= "<tr><td><span class='formLegend'>Legacy 2: </span></td>";
				$legacytable .= "<td><span class='formText'>".$legacyname2." <br/></td>";
				$legacytable .= "<td><span class='formText'>".$legacyrelationship2." <br/></td>";
				$legacytable .= "<td><span class='formText'>".$legacyclass2." <br/></td></tr>";
			}
			if($legacyname3 <> '' && $legacyrelationship3 <> '' && $legacyclass3 <> ''){
				$legacytable .= "<tr><td><span class='formLegend'>Legacy 3: </span></td>";
				$legacytable .= "<td><span class='formText'>".$legacyname3." <br/></td>";
				$legacytable .= "<td><span class='formText'>".$legacyrelationship3." <br/></td>";
				$legacytable .= "<td><span class='formText'>".$legacyclass3." <br/></td></tr>";
			}
			if($legacyname4 <> '' && $legacyrelationship4 <> '' && $legacyclass4 <> ''){
				$legacytable .= "<tr><td><span class='formLegend'>Legacy 4: </span></td>";
				$legacytable .= "<td><span class='formText'>".$legacyname4." <br/></td>";
				$legacytable .= "<td><span class='formText'>".$legacyrelationship4." <br/></td>";
				$legacytable .= "<td><span class='formText'>".$legacyclass4." <br/></td></tr>";
			}		
			$legacytable .= "</tbody>";
			$legacytable .= "</table>";
			
			$insertlegacy = "<br /><h1>Legacies</h1><br />";
			$legacyname1 = $insertlegacy . $legacyname1;
			
			
		}
		
		
		
		echo "<div style=''><h1>".$pagetitle."</h1><hr/>";
		?>
			<h1>Student's Application</h1>
			<!--<img src="/assets/img/bigemblem.png" width="250" align="right" style="margin-left:-150px;margin-right:150px;margin-top:-200px;">-->
		<?php
			if($paid <> 1){?>	
				<br />
				<p style="width:330px;"><strong>Click the "Add Child" button below to add more students to this application.  Students must have previous schools and essays before submission of application is possible.</strong></p>
				<a class="appButton" href="<?php echo $PHP_SELF; ?>?page=2">Add Child</a><?php ; 
			}else{
			
			}
			$children_sql="SELECT * FROM children WHERE cookie_id = '$recordname'";
			$children_result=mysql_query($children_sql) or die(mysql_error());
			$numberofkids = mysql_num_rows($children_result);
			if($numberofkids > 0){
				while($row=mysql_fetch_assoc($children_result)){
					$kid_id =	$row['kid_id'];
					$school_sql="SELECT * FROM schools WHERE cookie_id = '$recordname' AND kid_id = '$kid_id'";
					$school_result=mysql_query($school_sql) or die(mysql_error());
					$numberofschools = mysql_num_rows($school_result);			
					$childfirstname =	$row['appfirstname'];
					$childlastname = $row['applastname'];
					$childmiddlename = $row['appmiddlename'];
					echo "<br /><div class='appChild'><h2>".$childlastname.", ".$childfirstname." ".$childmiddlename. " <a href='".$PHP_SELF."?edit=child&ch=".$kid_id."'>[edit]</a></h2><hr/>";
					if($numberofschools > 0){
						echo "<h4>Schools</h4><p>";
						while($school=mysql_fetch_assoc($school_result)){
							$schoolname = $school['schoolname'];
							$school_id = $school['school_id'];
							$datesattended = $school['datesattended'];
							echo $schoolname." ".$datesattended." <a href='".$PHP_SELF."?edit=school&sc=".$school_id."'>[edit]</a><br />";
						}
						echo "</p>";
					}else{
						echo "<p> <strong>No schools have been added to this applicant's application. Please add school below.</strong></p>";
						
					}
					if($paid <> 1){			
						echo "<a class='formText' href='".$PHP_SELF."?page=3&ch=".$kid_id."'>Add School</a><br/>";
						echo "<a class='formText' href='".$PHP_SELF."?page=4&ch=".$kid_id."'>Upload Child Essay</a>";
						if(!empty($row['essay_path'])){echo " <small>(essay on file)</small>";}
					
					}else{
					
					}
					echo "</div>";
				}		
			}else{
			
			}
		if(isset($page) && $page == 4){
			if(isset($_GET['ch'])){
				$kid_id = $_GET['ch'];
				$search_sql = "Select * FROM children WHERE kid_id = '$kid_id'";
				$search_results = mysql_query($search_sql) or die(mysql_error());
				while($row=mysql_fetch_assoc($search_results)){
				$childfirstname =	$row['appfirstname'];
				$childlastname = $row['applastname'];
				$childmiddlename = $row['appmiddlename'];
				echo "<div class='formCenter'><h2 align='center'>Upload Child Essay &middot; ".$childlastname.", ".$childfirstname." ".$childmiddlename."</h2><hr/>";
				echo "<h2>Essay Questions</h2>
				<p>Responses to the following questions must be solely authored by the student applicant. <br/>Please complete
				the essays in one word doc or PDF file.</p>";
				
				echo "<p class='formLegend'>Essay 1: Discuss two reasons you want to attend Saint Joseph Academy.<br /><br/>";
				echo "Essay 2: Since part of the Saint Joseph Academy mission is to serve others, particularly the “least
				favored”, our students complete community service as part of their graduation requirements. How do
				you see yourself getting involved in the community and giving back to those in need?</p>";
				
				if(!empty($row['essay_path'])){echo " <p>We Currently have an Essay on file for this Applicant.  Uploading a new file will override that essay.</p>";}
				
				echo "<p>*It is my intention to meet all Saint Joseph Academy admissions requirements with enthusiasm, courtesy,	and respect.  By uploading my essays I guarantee that I am the author of the essays on this application and that these essays reflect my best efforts as a writer.</p>";

				echo "</div>"; // close div class formCenter
			}		
		}else{}
		
			if(isset($_POST['upload'])){
				$kid_id = $_POST['kid'];
				$search_sql = "Select * FROM children WHERE kid_id = '$kid_id'";
				$search_results = mysql_query($search_sql) or die(mysql_error());
				while($row=mysql_fetch_assoc($search_results)){
					$childfirstname =	$row['appfirstname'];
					$childlastname = $row['applastname'];
					$childmiddlename = $row['appmiddlename'];
					echo "<div class='formCenter'><br /><h2 align='center'>".$childlastname.", ".$childfirstname." ".$childmiddlename."</h2><hr/></div>";
				}
				$recordname = $_COOKIE["recordkeeper"];
				$target_path = "assets/essays/".$kid_id."-".$recordname;
				$extension = pathinfo($_FILES['uploadedfile']['name'],PATHINFO_EXTENSION);
				$target_path = $target_path.".".$extension; 
				//$thisthat = basename( $_FILES['uploadedfile']['tmp_name']);
				//echo $thisthat;
		
				if($_FILES['uploadedfile']['type'] == "application/rtf" || $_FILES['uploadedfile']['type'] == "application/pdf" || $_FILES['uploadedfile']['type']=="application/vnd.ms-word" || $_FILES['uploadedfile']['type'] == "application/msword" || $_FILES['uploadedfile']['type'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
					if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
						echo "<p>The file ".  basename( $_FILES['uploadedfile']['name']). " has been uploaded</p>";
						$filename = $target_path;
						//list($width, $height, $type, $attr) = getimagesize($filename);
						//$size = getimagesize($filename);
						fopen($filename, "rb");
						//$one = $width / $height;
						mysql_query("UPDATE children SET essay_path='$filename' WHERE kid_id='$kid_id'");
						$error = "&error=none";
						?>			
						<script type="text/javascript">
						<!--
						window.location = "http://www.sja.us/application.php"
						//-->
						</script>			
							
							<?php
					} else{
						$error = "&error=unknown";
						echo "<p align='center'>There was an error uploading the file, please try again!</p>";
					}
				} else {
					$error = "&error=extensions";
					echo "<p align='center'>Only .doc, .docx, and .pdf extensions allowed</p>";
				}
			}
			
			// uploader form
			?>
			<form enctype="multipart/form-data" action="<?php echo $PHP_SELF; ?>" method="POST" onSubmit="return confirm('Are you ready to proceed?')">
			<input type="hidden" name="MAX_FILE_SIZE" value="10000000000" />
			<fieldset>
				<legend>Choose a file to upload:  Only .doc, .docx, and .pdf extensions allowed</legend>
				<ul>
					<li><input name="uploadedfile" type="file" /></li>
					<li><input name="page" type="hidden" size="1" id="userlevel" value="4" />
			  		<input name="kid" type="hidden" value="<?php echo $kid_id ?>" /></li>
				</ul>
			</fieldset>	
			<fieldset>
				<ul>
					<li><input type="submit" value="Upload File" name="upload"/></li>
				</ul>
			</fieldset>	
					
					
			
			</form>
			<?php
		}
		
				if(isset($_GET['edit']) && $_GET['edit'] == "school"){
					$school_id = $_GET['sc'];
					$err = "";
					$i = 0;
					if(isset($_POST['editschool'])){
						if (!empty($_POST['schoolname'])){
							$schoolname = mysql_real_escape_string($_POST['schoolname']);
						}else{
							$i = 1;
							$err.= "Please fill in the school name";
							$err.= "<br />";
						}

						if (!empty($_POST['principal'])){
							$principal = mysql_real_escape_string($_POST['principal']);
						}else{
							$i = 1;
							$err.= "Please fill in the principal's name";
							$err.= "<br />";
						}

						if (!empty($_POST['address'])){
							$address = mysql_real_escape_string($_POST['address']);
						}else{
							$i = 1;
							$err.= "Please fill in the school address";
							$err.= "<br />";
						}

						if (!empty($_POST['city'])){
							$city = mysql_real_escape_string($_POST['city']);
						}else{
							$i = 1;
							$err.= "Please fill in the city of the school";
							$err.= "<br />";
						}

						if (!empty($_POST['state'])){
							$state = mysql_real_escape_string($_POST['state']);
						}else{
							$i = 1;
							$err.= "Please fill in the state of the school";
							$err.= "<br />";
						}

						if (!empty($_POST['zipcode'])){
							$zipcode = mysql_real_escape_string($_POST['zipcode']);
						}else{
							$i = 1;
							$err.= "Please fill in the zip code of the school";
							$err.= "<br />";
						}


						if(!empty($_POST['start_month'])){
							$start_month = mysql_real_escape_string($_POST['start_month']);
						}else{
							$i = 1;
							$err.= "Please fill in month started.";
							$err.= "<br />";
						}

						if(!empty($_POST['start_year'])){
							$start_year = mysql_real_escape_string($_POST['start_year']);
						}else{
							$i = 1;
							$err.= "Please fill in year started.";
							$err.= "<br />";
						}

						if(!empty($_POST['end_month'])){
							$end_month = mysql_real_escape_string($_POST['end_month']);
						}else{
							$i = 1;
							$err.= "Please fill in month ended.";
							$err.= "<br />";
						}

						if(!empty($_POST['end_year'])){
							$end_year = mysql_real_escape_string($_POST['end_year']);
						}else{
							$i = 1;
							$err.= "Please fill in year ended.";
							$err.= "<br />";
						}

$datesattended = $start_month."/".$start_year." &nbsp; - &nbsp;".$end_month."/".$end_year."";

						if (!empty($_POST['gradescompleted'])){
							$gradescompleted = mysql_real_escape_string($_POST['gradescompleted']);
						}else{
							$i = 1;
							$err.= "Please fill in how many grades you completed at this school";
							$err.= "<br />";
						}
						
						//if(isset($_POST['visit'])){$visit=$_POST['visit'];}else{$visit="";}
						if($i <> 1){
		
							mysql_query("UPDATE `schools` SET schoolname='$schoolname' ,principal='$principal', address='$address', city='$city', state='$state', zipcode='$zipcode', datesattended='$datesattended', gradescompleted='$gradescompleted' WHERE school_id='$school_id'") or die(mysql_error());

					?>			
					<script type="text/javascript">
					<!--
					window.location = "http://www.sja.us/application.php"
					//-->
					</script>			
						
				 	<?php }else{
				 	?>
				 		<script type="text/javascript">
				 		<!--
				 		window.location = "http://www.sja.us/application.php?error=<?php echo $err; ?>"
				 		//-->
				 		</script>		
				 	
				 	
				 	<?php
				 			}
				 	} 
				 	$edit_school_sql = "SELECT * FROM `schools` WHERE school_id='$school_id'";
				 	$edit_school_result = mysql_query($edit_school_sql);
				 	while($rowschool = mysql_fetch_array($edit_school_result)){
						$school_id = $rowschool['school_id'];
						$principal = $rowschool['principal'];
						$address = $rowschool['address'];
						$city = $rowschool['city'];
						$state = $rowschool['state'];
						$zipcode = $rowschool['zipcode'];
						$gradescompleted = $rowschool['gradescompleted'];
						$schoolname = $rowschool['schoolname'];
						$datesattended = $rowschool['datesattended'];
				 	}
				 	
				 	$dates=explode('-', $datesattended);
				 	$firstdate = explode('/',$dates[0]);
				 	$seconddate = explode('/',$dates[1]);
				 	//echo $firstdate[0]."/".$firstdate[1]." - ".$seconddate[0]."/".$seconddate[1];
				 	?>
				 	
				 
				 	
				 	<br />
				   <form method="post" action="<?php echo $PHP_SELF; ?>?edit=school&sc=<?php echo $school_id; ?>" enctype="multipart/form-data" onSubmit="return confirm('Are you ready to proceed?')">
				 	<hr>
				 	<h2>Previous Schools</h2>
				 	<p>Please provide information about the previous schools the applicant has attended, beginning with the
				 	<strong>most recent</strong>.</p><hr/>
				 	<fieldset><legend>School Name</legend><ul><li><input id="schoolname" type="text" size="25" value="<?php echo $schoolname; ?>" name="schoolname" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
 					<fieldset><legend>Principal's Name</legend><ul><li><input id="principal" type="text" size="25" value="<?php echo $principal; ?>" name="principal" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
				 	<fieldset><legend>Street Address</legend><ul><li><input type="text" size="25" value="<?php echo $address; ?>" name="address" onblur="selfaddresscheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
				 	<fieldset><legend>City</legend><ul><li><input type="text" size="25" name="city" value="<?php echo $city; ?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
				 	<fieldset><legend>State</legend><ul><li><select name="state" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
			 		<option value=""></option>
<option value="AL" <?php if($state=='AL') echo "selected='selected'";?>>Alabama</option>
<option value="AK" <?php if($state=='AK') echo "selected='selected'";?>>Alaska</option>
<option value="AZ" <?php if($state=='AZ') echo "selected='selected'";?>>Arizona</option>
<option value="AR" <?php if($state=='AR') echo "selected='selected'";?>>Arkansas</option>
<option value="CA" <?php if($state=='CA') echo "selected='selected'";?>>California</option>
<option value="CO" <?php if($state=='CO') echo "selected='selected'";?>>Colorado</option>
<option value="CT" <?php if($state=='CT') echo "selected='selected'";?>>Connecticut</option>
<option value="DE" <?php if($state=='DE') echo "selected='selected'";?>>Delaware</option>
<option value="DC" <?php if($state=='DC') echo "selected='selected'";?>>District of Columbia</option>
<option value="FL" <?php if($state=='FL') echo "selected='selected'";?>>Florida</option>
<option value="GA" <?php if($state=='GA') echo "selected='selected'";?>>Georgia</option>
<option value="HI" <?php if($state=='HI') echo "selected='selected'";?>>Hawaii</option>
<option value="ID" <?php if($state=='ID') echo "selected='selected'";?>>Idaho</option>
<option value="IL" <?php if($state=='IL') echo "selected='selected'";?>>Illinois</option>
<option value="IN" <?php if($state=='IN') echo "selected='selected'";?>>Indiana</option>
<option value="IA" <?php if($state=='IA') echo "selected='selected'";?>>Iowa</option>
<option value="KS" <?php if($state=='KS') echo "selected='selected'";?>>Kansas</option>
<option value="KY" <?php if($state=='KY') echo "selected='selected'";?>>Kentucky</option>
<option value="LA" <?php if($state=='LA') echo "selected='selected'";?>>Louisiana</option>
<option value="ME" <?php if($state=='ME') echo "selected='selected'";?>>Maine</option>
<option value="MD" <?php if($state=='MD') echo "selected='selected'";?>>Maryland</option>
<option value="MA" <?php if($state=='MA') echo "selected='selected'";?>>Massachusetts</option>
<option value="MI" <?php if($state=='MI') echo "selected='selected'";?>>Michigan</option>
<option value="MN" <?php if($state=='MN') echo "selected='selected'";?>>Minnesota</option>
<option value="MS" <?php if($state=='MS') echo "selected='selected'";?>>Mississippi</option>
<option value="MO" <?php if($state=='MO') echo "selected='selected'";?>>Missouri</option>
<option value="MT" <?php if($state=='MT') echo "selected='selected'";?>>Montana</option>
<option value="NE" <?php if($state=='NE') echo "selected='selected'";?>>Nebraska</option>
<option value="NV" <?php if($state=='NV') echo "selected='selected'";?>>Nevada</option>
<option value="NH" <?php if($state=='NH') echo "selected='selected'";?>>New Hampshire</option>
<option value="NJ" <?php if($state=='NJ') echo "selected='selected'";?>>New Jersey</option>
<option value="NM" <?php if($state=='NM') echo "selected='selected'";?>>New Mexico</option>
<option value="NY" <?php if($state=='NY') echo "selected='selected'";?>>New York</option>
<option value="NC" <?php if($state=='NC') echo "selected='selected'";?>>North Carolina</option>
<option value="ND" <?php if($state=='ND') echo "selected='selected'";?>>North Dakota</option>
<option value="OH" <?php if($state=='OH') echo "selected='selected'";?>>Ohio</option>
<option value="OK" <?php if($state=='OK') echo "selected='selected'";?>>Oklahoma</option>
<option value="OR" <?php if($state=='OR') echo "selected='selected'";?>>Oregon</option>
<option value="PA" <?php if($state=='PA') echo "selected='selected'";?>>Pennsylvania</option>
<option value="RI" <?php if($state=='RI') echo "selected='selected'";?>>Rhode Island</option>
<option value="SC" <?php if($state=='SC') echo "selected='selected'";?>>South Carolina</option>
<option value="SD" <?php if($state=='SD') echo "selected='selected'";?>>South Dakota</option>
<option value="TN" <?php if($state=='TN') echo "selected='selected'";?>>Tennessee</option>
<option value="TX" <?php if($state=='TX') echo "selected='selected'";?>>Texas</option>
<option value="UT" <?php if($state=='UT') echo "selected='selected'";?>>Utah</option>
<option value="VT" <?php if($state=='VT') echo "selected='selected'";?>>Vermont</option>
<option value="VA" <?php if($state=='VA') echo "selected='selected'";?>>Virginia</option>
<option value="WA" <?php if($state=='WA') echo "selected='selected'";?>>Washington</option>
<option value="WV" <?php if($state=='WY') echo "selected='selected'";?>>West Virginia</option>
<option value="WI" <?php if($state=='WI') echo "selected='selected'";?>>Wisconsin</option>
<option value="WY" <?php if($state=='WY') echo "selected='selected'";?>>Wyoming</option>
 	</select></li></ul></fieldset>
 	<fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" value="<?php echo $zipcode; ?>" name="zipcode" onblur="selfzipcodecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
 	<fieldset><legend>Dates Attended</legend><ul><li>
<span class="formLegend"> Start: </span>
 	<select name="start_month" class="formDates" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
 	        <option value="1" <?php if($firstdate[0]=='1') echo "selected='selected'";?>>January</option>
 	        <option value="2" <?php if($firstdate[0]=='2') echo "selected='selected'";?>>February</option>
 	        <option value="3" <?php if($firstdate[0]=='3') echo "selected='selected'";?>>March</option>
 	        <option value="4" <?php if($firstdate[0]=='4') echo "selected='selected'";?>>April</option>
 	        <option value="5" <?php if($firstdate[0]=='5') echo "selected='selected'";?>>May</option>
 	        <option value="6" <?php if($firstdate[0]=='6') echo "selected='selected'";?>>June</option>
 	        <option value="7" <?php if($firstdate[0]=='7') echo "selected='selected'";?>>July</option>
 	        <option value="8" <?php if($firstdate[0]=='8') echo "selected='selected'";?>>August</option>
 	        <option value="9" <?php if($firstdate[0]=='9') echo "selected='selected'";?>>September</option>
 	        <option value="10" <?php if($firstdate[0]=='10') echo "selected='selected'";?>>October</option>
 	        <option value="11" <?php if($firstdate[0]=='11') echo "selected='selected'";?>>November</option>
 	        <option value="12" <?php if($firstdate[0]=='12') echo "selected='selected'";?>>December</option>
 	    </select> 
 	<select name="start_year" class="formDates" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
 	<option value="2013" <?php if($firstdate[1]=='2013') echo "selected='selected'";?>>2013</option>
 	    <option value="2012" <?php if($firstdate[1]=='2012') echo "selected='selected'";?>>2012</option>
 	    <option value="2011" <?php if($firstdate[1]=='2011') echo "selected='selected'";?>>2011</option>
 	    <option value="2010" <?php if($firstdate[1]=='2010') echo "selected='selected'";?>>2010</option>
 	    <option value="2009" <?php if($firstdate[1]=='2009') echo "selected='selected'";?>>2009</option>
 	    <option value="2008" <?php if($firstdate[1]=='2008') echo "selected='selected'";?>>2008</option>
 	    <option value="2007" <?php if($firstdate[1]=='2007') echo "selected='selected'";?>>2007</option>
 	</select> 
<span class="formLegend"> &nbsp;&nbsp;End: </span>
 	<select name="end_month" class="formDates" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
 	        <option value="1" <?php if($seconddate[0]=='1') echo "selected='selected'";?>>January</option>
 	        <option value="2" <?php if($seconddate[0]=='2') echo "selected='selected'";?>>February</option>
 	        <option value="3" <?php if($seconddate[0]=='3') echo "selected='selected'";?>>March</option>
 	        <option value="4" <?php if($seconddate[0]=='4') echo "selected='selected'";?>>April</option>
 	        <option value="5" <?php if($seconddate[0]=='5') echo "selected='selected'";?>>May</option>
 	        <option value="6" <?php if($seconddate[0]=='6') echo "selected='selected'";?>>June</option>
 	        <option value="7" <?php if($seconddate[0]=='7') echo "selected='selected'";?>>July</option>
 	        <option value="8" <?php if($seconddate[0]=='8') echo "selected='selected'";?>>August</option>
 	        <option value="9" <?php if($seconddate[0]=='9') echo "selected='selected'";?>>September</option>
 	        <option value="10" <?php if($seconddate[0]=='10') echo "selected='selected'";?>>October</option>
 	        <option value="11" <?php if($seconddate[0]=='11') echo "selected='selected'";?>>November</option>
 	        <option value="12" <?php if($seconddate[0]=='12') echo "selected='selected'";?>>December</option>
 	    </select> 
 	<select name="end_year" class="formDates" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
 		<option value="2013" <?php if($seconddate[1]=='2013') echo "selected='selected'";?>>2013</option>
 	    <option value="2012" <?php if($seconddate[1]=='2012') echo "selected='selected'";?>>2012</option>
 	    <option value="2011" <?php if($seconddate[1]=='2011') echo "selected='selected'";?>>2011</option>
 	    <option value="2010" <?php if($seconddate[1]=='2010') echo "selected='selected'";?>>2010</option>
 	    <option value="2009" <?php if($seconddate[1]=='2009') echo "selected='selected'";?>>2009</option>
 	    <option value="2008" <?php if($seconddate[1]=='2008') echo "selected='selected'";?>>2008</option>
 	    <option value="2007" <?php if($seconddate[1]=='2007') echo "selected='selected'";?>>2007</option>
 	</select>
 	<!--<input type="text" size="25" name="datesattended" value="">--></li></ul></fieldset>
 	<fieldset><legend>Grades Completed</legend><ul><li><input type="text" size="25" value="<?php echo $gradescompleted; ?>" name="gradescompleted" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
				   <input name="edit" type="hidden" size="1" id="userlevel" value="school" > <br />
				   <fieldset><ul><li><input type="submit" value="Edit School Information" name="editschool"></li></ul></fieldset> 
				   </form>
				<?php
				}
		
		if(isset($_GET['edit']) && $_GET['edit'] == "child"){
			$kid_id = $_GET['ch'];
			$i = 0;
			$err = "";
			if(isset($_POST['editchild'])){
				if (!empty($_POST['grade'])){
					$grade = mysql_real_escape_string($_POST['grade']);
				}else{
					$i = 1;
					$err.= "Please indicate grade";
					$err.= "<br />";
				}
				
				if (!empty($_POST['gender'])){
					$gender = mysql_real_escape_string($_POST['gender']);
				}else{
					$i = 1;
					$err.= "Please indicate gender";
					$err.= "<br />";
				}
				
				if (!empty($_POST['applastname'])){
					$applastname = mysql_real_escape_string($_POST['applastname']);
				}else{
					$i = 1;
					$err.= "Please fill out last name of applicant";
					$err.= "<br />";	
				}
				
				if (!empty($_POST['appfirstname'])){
					$appfirstname = mysql_real_escape_string($_POST['appfirstname']);
				}else{
					$i = 1;
					$err.= "Please fill out first name of applicant";
					$err.= "<br />";
				}
				
				$appmiddlename = mysql_real_escape_string($_POST['appmiddlename']);
				
				if (!empty($_POST['appstreetaddress'])){
					$appstreetaddress = mysql_real_escape_string($_POST['appstreetaddress']);
				}else{
					$i = 1;
					$err.= "Please fill out the address of applicant";
					$err.= "<br />";
				}
				
				if (!empty($_POST['appcity'])){
					$appcity = mysql_real_escape_string($_POST['appcity']);
				}else{
					$i = 1;
					$err.= "Please fill out the city of applicant";
					$err.= "<br />";
				}
				
				if (!empty($_POST['appstate'])){
					$appstate = mysql_real_escape_string($_POST['appstate']);
				}else{
					$i = 1;
					$err.= "Please fill out the state of applicant";
					$err.= "<br />";
				}
				
				if (!empty($_POST['appzipcode'])){		
					$appzipcode = mysql_real_escape_string($_POST['appzipcode']);
				}else{
					$i = 1;
					$err.= "Please fill out zip code of applicant";
					$err.= "<br />";
				}
				
				if (!empty($_POST['language'])){	
					if (!empty($_POST['yearsofstudy'])){
						$yearsofstudy = mysql_real_escape_string($_POST['yearsofstudy']);
					}else{
						$i = 1;
						$err.= "Please indicate years of study";
						$err.= "<br />";
					}
					$language = mysql_real_escape_string($_POST['language']);
				}else{
					if(!empty($_POST['french']) || !empty($_POST['spanish'])){
					
					}else{
						$i = 1;
						$err.= "Please indicate other languages";
						$err.= "<br />";
					}
				}
				
				if (!empty($_POST['french'])){
					$french = mysql_real_escape_string($_POST['french']);
					if (!empty($_POST['spanish'])){
						$spanish = mysql_real_escape_string($_POST['spanish']);
					}else{
						$spanish = "N/A";
					}
				}else{
					$french = "N/A";
					if (!empty($_POST['spanish'])){
						$spanish = mysql_real_escape_string($_POST['spanish']);
					}else{
						if (!empty($_POST['yearsofstudy']) && !empty($_POST['language'])){
						
						}else{
							$i = 1;
							$err.= "Please indicate if applicant studies Spanish or French";
							$err.= "<br />";
						}
					}
				}
				
				if (!empty($_POST['class1'])){
					$class1 = mysql_real_escape_string($_POST['class1']);
				}else{
					$i = 1;
					$err.= "Please fill out applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['class2'])){
					$class2 = mysql_real_escape_string($_POST['class2']);
				}else{
					$i = 1;
					$err.= "Please fill out applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['class3'])){
					$class3 = mysql_real_escape_string($_POST['class3']);
				}else{
					$i = 1;
					$err.= "Please fill out applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['class4'])){
					$class4 = mysql_real_escape_string($_POST['class4']);
				}else{
					$i = 1;
					$err.= "Please fill out applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['class5'])){
					$class5 = mysql_real_escape_string($_POST['class5']);
				}else{
					$class5 = "";
					//$i = 1;
					//$err.= "Please fill out applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['class6'])){
					$class6 = mysql_real_escape_string($_POST['class6']);
				}else{
					$class6 = "";
					//$i = 1;
					//$err.= "Please fill out applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['class7'])){
					$class7 = mysql_real_escape_string($_POST['class7']);
				}else{
					$class7 = "";
					//$i = 1;
					//$err.= "Please fill out applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['class8'])){
					$class8 = mysql_real_escape_string($_POST['class8']);
				}else{
					$class8 = "";
					//$i = 1;
					//$err.= "Please fill out applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['passfail1'])){
					$passfail1 = mysql_real_escape_string($_POST['passfail1']);
				}else{
					$i = 1;
					$err.= "Please indicate pass/fail status on applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['passfail2'])){
					$passfail2 = mysql_real_escape_string($_POST['passfail2']);
				}else{
					$i = 1;
					$err.= "Please indicate pass/fail status on applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['passfail3'])){
					$passfail3 = mysql_real_escape_string($_POST['passfail3']);
				}else{
					$i = 1;
					$err.= "Please indicate pass/fail status on applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['passfail4'])){
					$passfail4 = mysql_real_escape_string($_POST['passfail4']);
				}else{
					$i = 1;
					$err.= "Please indicate pass/fail status on applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['passfail5'])){
					$passfail5 = mysql_real_escape_string($_POST['passfail5']);
				}else{
					$passfail5 = "";
					//$i = 1;
					//$err.= "Please indicate pass/fail status on applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['passfail6'])){
					$passfail6 = mysql_real_escape_string($_POST['passfail6']);
				}else{
					$passfail6 = "";
					//$i = 1;
					//$err.= "Please indicate pass/fail status on applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['passfail7'])){
					$passfail7 = mysql_real_escape_string($_POST['passfail7']);
				}else{
					$passfail7 = "";
					//$i = 1;
					//$err.= "Please indicate pass/fail status on applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['passfail8'])){
					$passfail8 = mysql_real_escape_string($_POST['passfail8']);
				}else{
					$passfail8 = "";
					//$i = 1;
					//$err.= "Please indicate pass/fail status on applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['diagnosis']) && $_POST['diagnosis'] == "no"){
					$diagnosis = mysql_real_escape_string($_POST['diagnosis']);
					$other = "";
				}elseif(!empty($_POST['diagnosis']) && $_POST['diagnosis'] == "yes" && !empty($_POST['other'])){
					$diagnosis = mysql_real_escape_string($_POST['diagnosis']);
					$other = mysql_real_escape_string($_POST['other']);
				}else{
					$i = 1;
					$err.= "Please correctly fill out the Special Services";
					$err.= "<br />";
				}
				
				//if(isset($_POST['visit'])){$visit=$_POST['visit'];}else{$visit="";}
				if($i <> 1){

					mysql_query("UPDATE `children` SET grade='$grade' ,gender='$gender', applastname='$applastname', appfirstname='$appfirstname', appmiddlename='$appmiddlename', appstreetaddress='$appstreetaddress', appcity='$appcity', appstate='$appstate', appzipcode='$appzipcode', language='$language', yearsofstudy='$yearsofstudy', french='$french', spanish='$spanish', class1='$class1', class2='$class2', class3='$class3', class4='$class4', class5='$class5', class6='$class6', class7='$class7', class8='$class8', passfail1='$passfail1', passfail2='$passfail2', passfail3='$passfail3', passfail4='$passfail4', passfail5='$passfail5', passfail6='$passfail6', passfail7='$passfail7', passfail8='$passfail8', diagnosis='$diagnosis', other='$other' WHERE kid_id='$kid_id'") or die(mysql_error()); 
				
			?>			
			<script type="text/javascript">
			<!--
			window.location = "http://www.sja.us/application.php"
			//-->
			</script>			
				
		 	<?php }else{
		 	?>
		 		<script type="text/javascript">
		 		<!--
		 		window.location = "http://www.sja.us/application.php?error=<?php echo $err; ?>"
		 		//-->
		 		</script>		
		 	
		 	
		 	<?php
		 			}
		 	} 
		 	$edit_child_sql = "SELECT * FROM `children` WHERE kid_id='$kid_id'";
		 	$edit_child_result = mysql_query($edit_child_sql);
		 	while($rowschild = mysql_fetch_array($edit_child_result)){
		 		$kid_id =	$rowschild['kid_id'];		
		 		$app_id = $rowschild['app_id'];
		 		$cookie_id = $rowschild['cookie_id'];
		 		$essaypath = $rowschild['essay_path'];	
		 		$appfirstname =	$rowschild['appfirstname'];
		 		$applastname = $rowschild['applastname'];
		 		$appmiddlename = $rowschild['appmiddlename'];
		 		$grade = $rowschild['grade'];
		 		$gender = $rowschild['gender'];
		 		$appstreetaddress = $rowschild['appstreetaddress'];
		 		$appcity = $rowschild['appcity'];
		 		$appstate = $rowschild['appstate'];
		 		$appzipcode = $rowschild['appzipcode'];
		 		$language = $rowschild['language'];
		 		$yearsofstudy = $rowschild['yearsofstudy'];
		 		$french = $rowschild['french'];
		 		$spanish = $rowschild['spanish'];
		 		$class1 = $rowschild['class1'];
		 		$class2 = $rowschild['class2'];
		 		$class3 = $rowschild['class3'];
		 		$class4 = $rowschild['class4'];
		 		$class5 = $rowschild['class5'];
		 		$class6 = $rowschild['class6'];
		 		$class7 = $rowschild['class7'];
		 		$class8 = $rowschild['class8'];
		 		$passfail1 = $rowschild['passfail1'];
		 		$passfail2 = $rowschild['passfail2'];
		 		$passfail3 = $rowschild['passfail3'];
		 		$passfail4 = $rowschild['passfail4'];
		 		$passfail5 = $rowschild['passfail5'];
		 		$passfail6 = $rowschild['passfail6'];
		 		$passfail7 = $rowschild['passfail7'];
		 		$passfail8 = $rowschild['passfail8'];
		 		$nodiagnosis = $rowschild['nodiagnosis'];
		 		$diagnosis = $rowschild['diagnosis'];
		 		$other = $rowschild['other'];
		 	}
		 	?>
		 	
		 
		 	
		 	<br />
		   <form method="post" action="<?php echo $PHP_SELF; ?>?edit=child&ch=<?php echo $kid_id; ?>" enctype="multipart/form-data" onSubmit="return confirm('Are you ready to proceed?')">
		   <hr>
		   <h2>Student Information</h2>
		   <hr>
		   <h2>Basic Information</h2><br/>
		      	<fieldset><legend>Last Name</legend><ul><li><input type="text" size="25" name="applastname" value="<?php echo $applastname;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		      <fieldset><legend>First Name</legend><ul><li><input type="text" size="25" name="appfirstname" value="<?php echo $appfirstname;?>"  onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <fieldset><legend>Middle Name</legend><ul><li><input type="text" size="25" name="appmiddlename" value="<?php echo $appmiddlename;?>" ></li></ul></fieldset>
		   <fieldset><legend>Street Address</legend><ul><li><input type="text" size="25" value="<?php echo $appstreetaddress;?>"  name="appstreetaddress" onblur="selfaddresscheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <fieldset><legend>City</legend><ul><li><input type="text" size="25" name="appcity" value="<?php echo $appcity;?>"  onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <fieldset><legend>State</legend><ul><li><select name="appstate" onblur="selfmessage(this)">
		   	<option value=""></option>
		   	<option value="AL" <?php if($appstate=='AL') echo "selected='selected'";?>>Alabama</option>
		   	<option value="AK" <?php if($appstate=='AK') echo "selected='selected'";?>>Alaska</option>
		   	<option value="AZ" <?php if($appstate=='AZ') echo "selected='selected'";?>>Arizona</option>
		   	<option value="AR" <?php if($appstate=='AR') echo "selected='selected'";?>>Arkansas</option>
		   	<option value="CA" <?php if($appstate=='CA') echo "selected='selected'";?>>California</option>
		   	<option value="CO" <?php if($appstate=='CO') echo "selected='selected'";?>>Colorado</option>
		   	<option value="CT" <?php if($appstate=='CT') echo "selected='selected'";?>>Connecticut</option>
		   	<option value="DE" <?php if($appstate=='DE') echo "selected='selected'";?>>Delaware</option>
		   	<option value="DC" <?php if($appstate=='DC') echo "selected='selected'";?>>District of Columbia</option>
		   	<option value="FL" <?php if($appstate=='FL') echo "selected='selected'";?>>Florida</option>
		   	<option value="GA" <?php if($appstate=='GA') echo "selected='selected'";?>>Georgia</option>
		   	<option value="HI" <?php if($appstate=='HI') echo "selected='selected'";?>>Hawaii</option>
		   	<option value="ID" <?php if($appstate=='ID') echo "selected='selected'";?>>Idaho</option>
		   	<option value="IL" <?php if($appstate=='IL') echo "selected='selected'";?>>Illinois</option>
		   	<option value="IN" <?php if($appstate=='IN') echo "selected='selected'";?>>Indiana</option>
		   	<option value="IA" <?php if($appstate=='IA') echo "selected='selected'";?>>Iowa</option>
		   	<option value="KS" <?php if($appstate=='KS') echo "selected='selected'";?>>Kansas</option>
		   	<option value="KY" <?php if($appstate=='KY') echo "selected='selected'";?>>Kentucky</option>
		   	<option value="LA" <?php if($appstate=='LA') echo "selected='selected'";?>>Louisiana</option>
		   	<option value="ME" <?php if($appstate=='ME') echo "selected='selected'";?>>Maine</option>
		   	<option value="MD" <?php if($appstate=='MD') echo "selected='selected'";?>>Maryland</option>
		   	<option value="MA" <?php if($appstate=='MA') echo "selected='selected'";?>>Massachusetts</option>
		   	<option value="MI" <?php if($appstate=='MI') echo "selected='selected'";?>>Michigan</option>
		   	<option value="MN" <?php if($appstate=='MN') echo "selected='selected'";?>>Minnesota</option>
		   	<option value="MS" <?php if($appstate=='MS') echo "selected='selected'";?>>Mississippi</option>
		   	<option value="MO" <?php if($appstate=='MO') echo "selected='selected'";?>>Missouri</option>
		   	<option value="MT" <?php if($appstate=='MT') echo "selected='selected'";?>>Montana</option>
		   	<option value="NE" <?php if($appstate=='NE') echo "selected='selected'";?>>Nebraska</option>
		   	<option value="NV" <?php if($appstate=='NV') echo "selected='selected'";?>>Nevada</option>
		   	<option value="NH" <?php if($appstate=='NH') echo "selected='selected'";?>>New Hampshire</option>
		   	<option value="NJ" <?php if($appstate=='NJ') echo "selected='selected'";?>>New Jersey</option>
		   	<option value="NM" <?php if($appstate=='NM') echo "selected='selected'";?>>New Mexico</option>
		   	<option value="NY" <?php if($appstate=='NY') echo "selected='selected'";?>>New York</option>
		   	<option value="NC" <?php if($appstate=='NC') echo "selected='selected'";?>>North Carolina</option>
		   	<option value="ND" <?php if($appstate=='ND') echo "selected='selected'";?>>North Dakota</option>
		   	<option value="OH" <?php if($appstate=='OH') echo "selected='selected'";?>>Ohio</option>
		   	<option value="OK" <?php if($appstate=='OK') echo "selected='selected'";?>>Oklahoma</option>
		   	<option value="OR" <?php if($appstate=='OR') echo "selected='selected'";?>>Oregon</option>
		   	<option value="PA" <?php if($appstate=='PA') echo "selected='selected'";?>>Pennsylvania</option>
		   	<option value="RI" <?php if($appstate=='RI') echo "selected='selected'";?>>Rhode Island</option>
		   	<option value="SC" <?php if($appstate=='SC') echo "selected='selected'";?>>South Carolina</option>
		   	<option value="SD" <?php if($appstate=='SD') echo "selected='selected'";?>>South Dakota</option>
		   	<option value="TN" <?php if($appstate=='TN') echo "selected='selected'";?>>Tennessee</option>
		   	<option value="TX" <?php if($appstate=='TX') echo "selected='selected'";?>>Texas</option>
		   	<option value="UT" <?php if($appstate=='UT') echo "selected='selected'";?>>Utah</option>
		   	<option value="VT" <?php if($appstate=='VT') echo "selected='selected'";?>>Vermont</option>
		   	<option value="VA" <?php if($appstate=='VA') echo "selected='selected'";?>>Virginia</option>
		   	<option value="WA" <?php if($appstate=='WA') echo "selected='selected'";?>>Washington</option>
		   	<option value="WV" <?php if($appstate=='WY') echo "selected='selected'";?>>West Virginia</option>
		   	<option value="WI" <?php if($appstate=='WI') echo "selected='selected'";?>>Wisconsin</option>
		   	<option value="WY" <?php if($appstate=='WY') echo "selected='selected'";?>>Wyoming</option>
		   </select></li></ul></fieldset>
		   <fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" name="appzipcode" value="<?php echo $appzipcode;?>" onblur="selfzipcodecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset><br />
		   	    <hr>
		   <h2>Select grade child will attend:</h2>	<br/>    		
		   <input type="radio" name="grade" value="seven" onClick="document.getElementById('addmale').focus();" <?php if($grade=='seven') echo "checked";?>><span class="formText"> Seven </span><br />
		   <input type="radio" name="grade" value="eight" onClick="document.getElementById('addmale').focus();" <?php if($grade=='eight') echo "checked'";?>><span class="formText"> Eight</span><br />
		   <input type="radio" name="grade" value="nine" onClick="document.getElementById('addmale').focus();" <?php if($grade=='nine') echo "checked";?>><span class="formText"> Nine</span><br />
		   <input type="radio" name="grade" value="ten" onClick="document.getElementById('addmale').focus();" <?php if($grade=='ten') echo "checked";?>><span class="formText"> Ten</span><br />
		   <input type="radio" name="grade" value="eleven" onClick="document.getElementById('addmale').focus();" <?php if($grade=='eleven') echo "checked";?>><span class="formText"> Eleven</span><br />
		   <input type="radio" name="grade" value="twelve" onClick="document.getElementById('addmale').focus();" <?php if($grade=='twelve') echo "checked";?>><span class="formText"> Twelve</span><br /><br />
		   <hr>
		   <h2>Select applicant's gender:</h2><br/>
		   <input type="radio" name="gender" value="male" id="addmale" onClick="document.getElementById('addlanguage').focus();" <?php if($gender=='male') echo "checked";?>><span class="formText"> Male</span><br />
		   <input type="radio" name="gender" value="female" onClick="document.getElementById('addlanguage').focus();" <?php if($gender=='female') echo "checked";?>><span class="formText"> Female</span><br /><br />
		   <hr>
		 
		   <h2>Foreign Language Study</h2><br />
		   	    <p>Please indicate the number of years of high school foreign language study the applicant has completed.</p>
		   <fieldset><legend>Language</legend><ul><li><input type="text" size="25" name="language" id="addlanguage" value="<?php echo $language;?>"  onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <fieldset><legend>Years of Study</legend><ul><li><input type="text" size="25" name="yearsofstudy" value="<?php echo $yearsofstudy;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset><br />
		   <p>* If the applicant has <strong>not</strong> completed 3 years of high school foreign language, please indicate the language <strong>preferred</strong> to fulfill the requirement.</p>
			<span class="formText">French</span><input type="checkbox" name="french" value="yes" <?php if($french=='yes') echo "checked";?>> 
			<span class="formText">Spanish</span><input type="checkbox" name="spanish" value="yes" <?php if($spanish=='yes') echo "checked";?>><br /><br />
		   	    		<hr>
		   <h2>Class Grades/Credits</h2><br />
		   <p>Please list the classes the applicant is currently taking and indicate if the applicant is passing or failing
		   each class as of this date.</p>
		   	    	
		   <fieldset>Math
		   <ul><li><select name="class1" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		   	<option value=""></option>
		   	<option value="6th Math" <?php if($class1=='6th Math') echo "selected='selected'";?>>6th Math</option>
		   	<option value="7th Math" <?php if($class1=='7th Math') echo "selected='selected'";?>>7th Math</option>
		   	<option value="Pre-Algebra" <?php if($class1=='Pre-Algebra') echo "selected='selected'";?>>Pre-Algebra</option>
		   	<option value="Algebra I" <?php if($class1=='Algebra I') echo "selected='selected'";?>>Algebra I</option>
		   	<option value="Geometry" <?php if($class1=='Geometry') echo "selected='selected'";?>>Geometry</option>
		   	<option value="Algebra II" <?php if($class1=='Algebra II') echo "selected='selected'";?>>Algebra II</option>
		   	<option value="Pre-Calculus" <?php if($class1=='Pre-Calculus') echo "selected='selected'";?>>Pre-Calculus</option>
		   	<option value="Calculus" <?php if($class1=='Calculus') echo "selected='selected'";?>>Calculus</option>
		   </select></li></ul>
		   </fieldset>
		   <span class="formText">  Pass</span><input type="radio" name="passfail1" value="pass" onClick="document.getElementById('add6th').focus();" <?php if($passfail1=='pass') echo "checked";?>><span class="formText" > Fail</span><input type="radio" name="passfail1" value="fail" onClick="document.getElementById('add6th').focus();" <?php if($passfail1=='fail') echo "checked";?>><br /><br/>
		   <fieldset>Science
		   <ul><li><select name="class2" onblur="selfmessage(this)" id="add6th" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		   	<option value=""></option>
		   	<option value="6th Science" <?php if($class2=='6th Science') echo "selected='selected'";?>>6th Science</option>
		   	<option value="7th Science" <?php if($class2=='7th Science') echo "selected='selected'";?>>7th Science</option>
		   	<option value="8th Science" <?php if($class2=='8th Science') echo "selected='selected'";?>>8th Science</option>
		   	<option value="Biology" <?php if($class2=='Biology') echo "selected='selected'";?>>Biology</option>
		   	<option value="Chemistry" <?php if($class2=='Chemistry') echo "selected='selected'";?>>Chemistry</option>
		   	<option value="Physics" <?php if($class2=='Physics') echo "selected='selected'";?>>Physics</option>
		   	<option value="Science-Elective" <?php if($class2=='Science-Elective') echo "selected='selected'";?>>Science-Elective</option>
		   </select></li></ul>
		   </fieldset>
		   <span class="formText">   Pass</span><input type="radio" name="passfail2" value="pass" onClick="document.getElementById('add7th').focus();" <?php if($passfail2=='pass') echo "checked";?>><span class="formText"> Fail</span><input type="radio" name="passfail2" value="fail" onClick="document.getElementById('add7th').focus();" <?php if($passfail2=='fail') echo "checked";?>><br /><br/>
		   <fieldset>Social Studies
		   <ul><li><select name="class3" onblur="selfmessage(this)" id="add7th" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		   	<option value=""></option>
		   	<option value="6th Social Studies" <?php if($class3=='6th Social Studies') echo "selected='selected'";?>>6th Social Studies</option>
		   	<option value="Texas History" <?php if($class3=='Texas History') echo "selected='selected'";?>>Texas History</option>
		   	<option value="U.S. History 8th" <?php if($class3=='U.S. History 8th') echo "selected='selected'";?>>U.S. History (8th)</option>
		   	<option value="World Geography" <?php if($class3=='World Geography') echo "selected='selected'";?>>World Geography</option>
		   	<option value="World History" <?php if($class3=='World History') echo "selected='selected'";?>>World History</option>
		   	<option value="U.S. History 11th" <?php if($class3=='U.S. History 11th') echo "selected='selected'";?>>U.S. History (11th)</option>
		   	<option value="Economics" <?php if($class3=='Economics') echo "selected='selected'";?>>Economics</option>
		   	<option value="American Government" <?php if($class3=='American Government') echo "selected='selected'";?>>American Government</option>
		   </select></li></ul>
		   </fieldset>
		   <span class="formText">   Pass</span><input type="radio" name="passfail3" value="pass" onClick="document.getElementById('add8th').focus();" <?php if($passfail3=='pass') echo "checked";?>><span class="formText"> Fail</span><input type="radio" name="passfail3" value="fail" onClick="document.getElementById('add8th').focus();" <?php if($passfail3=='fail') echo "checked";?>><br /><br/>
		   <fieldset>English
		   <ul><li><select name="class4" onblur="selfmessage(this)" id="add8th" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		   	<option value=""></option>
		   	<option value="6th Language Arts" <?php if($class4=='6th Language Arts') echo "selected='selected'";?>>6th Language Arts</option>
		   	<option value="7th Language Arts" <?php if($class4=='7th Language Arts') echo "selected='selected'";?>>7th Language Arts</option>
		   	<option value="8th Language Arts" <?php if($class4=='8th Language Arts') echo "selected='selected'";?>>8th Language Arts</option>
		   	<option value="9th English" <?php if($class4=='9th English') echo "selected='selected'";?>>9th English</option>
		   	<option value="10th English" <?php if($class4=='10th English') echo "selected='selected'";?>>10th English</option>
		   	<option value="11th English" <?php if($class4=='11th English') echo "selected='selected'";?>>11th English</option>
		   	<option value="12th English" <?php if($class4=='12th English') echo "selected='selected'";?>>12th English</option>
		   </select></li></ul>
		   </fieldset>
		   <span class="formText">   Pass</span><input type="radio" name="passfail4" value="pass" onClick="document.getElementById('add9th').focus();" <?php if($passfail4=='pass') echo "checked";?>><span class="formText"> Fail</span><input type="radio" name="passfail4" value="fail" onClick="document.getElementById('add9th').focus();" <?php if($passfail4=='fail') echo "checked";?>><br /><br/>
		   <fieldset>Other Classes (optional)<ul><li><input type="text" size="25" name="class5" id="add9th" value="<?php echo $class5;?>"></li></ul></fieldset><span class="formText">   Pass</span><input type="radio" name="passfail5" value="pass" onClick="document.getElementById('add10th').focus();" <?php if($passfail5=='pass') echo "checked";?>><span class="formText"> Fail</span><input type="radio" name="passfail5" value="fail" onClick="document.getElementById('add10th').focus();" <?php if($passfail5=='fail') echo "checked";?>><br /><br/>
		   <fieldset><ul><li><input type="text" size="25" name="class6" id="add10th" value="<?php echo $class6;?>"> </li></ul></fieldset><span class="formText"> Pass</span><input type="radio" name="passfail6" value="pass" onClick="document.getElementById('add11th').focus();"<?php if($passfail6=='pass') echo "checked";?>><span class="formText"> Fail</span><input type="radio" name="passfail6" value="fail" onClick="document.getElementById('add11th').focus();"  <?php if($passfail6=='fail') echo "checked";?>><br /><br/>
		   <fieldset> <ul><li><input type="text" size="25" name="class7" id="add11th" value="<?php echo $class7;?>"></li></ul></fieldset><span class="formText">   Pass</span><input type="radio" name="passfail7" value="pass" onClick="document.getElementById('add12th').focus();" <?php if($passfail7=='pass') echo "checked";?>><span class="formText"> Fail</span><input type="radio" name="passfail7" value="fail" onClick="document.getElementById('add12th').focus();" <?php if($passfail7=='fail') echo "checked";?>><br /><br/>
		   <fieldset><ul><li><input type="text" size="25" name="class8" id="add12th" value="<?php echo $class8;?>"></li></ul></fieldset><span class="formText">   Pass</span><input type="radio" name="passfail8" value="pass" onClick="document.getElementById('add13th').focus();" <?php if($passfail8=='pass') echo "checked";?>><span class="formText"> Fail</span><input type="radio" name="passfail8" value="fail" onClick="document.getElementById('add13th').focus();"<?php if($passfail8=='fail') echo "checked";?>><br /><br />
		   	    		<hr>
		  <h2>Special Services</h2><p>If yes, a current assessment of the diagnosed disability must be received at least one week prior to the entrance exam date to allow for appropriate accommodations.</p> <br />
		   	    	
		   <input type="radio" name="diagnosis" value="no" id="add13th" onClick="document.getElementById('addnext').focus();" <?php if($diagnosis=='no') echo "checked";?>><span class="formText"> No Diagnosed Learning Differences</span><br />
		   <input type="radio" name="diagnosis" value="yes" onClick="document.getElementById('addother').focus();" <?php if($diagnosis=='yes') echo "checked";?>><span class="formText"> Applicant has been diagnosed with the following</span><br /><br/>
		   
		   <fieldset>
		   	<ul>
		   		<li><textarea name="other" id="addother" value="<?php echo $other;?>"></textarea> </li>
		   	</ul>
		   </fieldset>
		   
		   <input name="edit" type="hidden" size="1" id="userlevel" value="child" > <br />
		   <fieldset><ul><li><input type="submit" id="addnext" value="Edit Child Information" name="editchild"></li></ul></fieldset> 
		   </form>
		<?php
		}
		
		if(isset($page) && $page == 2){
			$i = 0;
			$err = "";
			if(isset($_POST['addchild'])){
				if (!empty($_POST['grade'])){
					$grade = mysql_real_escape_string($_POST['grade']);
				}else{
					$i = 1;
					$err.= "Please indicate grade";
					$err.= "<br />";
				}
				
				if (!empty($_POST['gender'])){
					$gender = mysql_real_escape_string($_POST['gender']);
				}else{
					$i = 1;
					$err.= "Please indicate gender";
					$err.= "<br />";
				}
				
				if (!empty($_POST['applastname'])){
					$applastname = mysql_real_escape_string($_POST['applastname']);
				}else{
					$i = 1;
					$err.= "Please fill out last name of applicant";
					$err.= "<br />";	
				}
				
				if (!empty($_POST['appfirstname'])){
					$appfirstname = mysql_real_escape_string($_POST['appfirstname']);
				}else{
					$i = 1;
					$err.= "Please fill out first name of applicant";
					$err.= "<br />";
				}
				
				$appmiddlename = mysql_real_escape_string($_POST['appmiddlename']);
				
				if (!empty($_POST['appstreetaddress'])){
					$appstreetaddress = mysql_real_escape_string($_POST['appstreetaddress']);
				}else{
					$i = 1;
					$err.= "Please fill out the address of applicant";
					$err.= "<br />";
				}
				
				if (!empty($_POST['appcity'])){
					$appcity = mysql_real_escape_string($_POST['appcity']);
				}else{
					$i = 1;
					$err.= "Please fill out the city of applicant";
					$err.= "<br />";
				}
				
				if (!empty($_POST['appstate'])){
					$appstate = mysql_real_escape_string($_POST['appstate']);
				}else{
					$i = 1;
					$err.= "Please fill out the state of applicant";
					$err.= "<br />";
				}
				
				if (!empty($_POST['appzipcode'])){		
					$appzipcode = mysql_real_escape_string($_POST['appzipcode']);
				}else{
					$i = 1;
					$err.= "Please fill out zip code of applicant";
					$err.= "<br />";
				}
				
				if (!empty($_POST['language'])){	
					if (!empty($_POST['yearsofstudy'])){
						$yearsofstudy = mysql_real_escape_string($_POST['yearsofstudy']);
					}else{
						$i = 1;
						$err.= "Please indicate years of study";
						$err.= "<br />";
					}
					$language = mysql_real_escape_string($_POST['language']);
				}else{
					if(!empty($_POST['french']) || !empty($_POST['spanish'])){
					
					}else{
						$i = 1;
						$err.= "Please indicate other languages";
						$err.= "<br />";
					}
				}
				
				if (!empty($_POST['french'])){
					$french = mysql_real_escape_string($_POST['french']);
					if (!empty($_POST['spanish'])){
						$spanish = mysql_real_escape_string($_POST['spanish']);
					}else{
						$spanish = "N/A";
					}
				}else{
					$french = "N/A";
					if (!empty($_POST['spanish'])){
						$spanish = mysql_real_escape_string($_POST['spanish']);
					}else{
						if (!empty($_POST['yearsofstudy']) && !empty($_POST['language'])){
						
						}else{
							$i = 1;
							$err.= "Please indicate if applicant studies Spanish or French";
							$err.= "<br />";
						}
					}
				}
				
				if (!empty($_POST['class1'])){
					$class1 = mysql_real_escape_string($_POST['class1']);
				}else{
					$i = 1;
					$err.= "Please fill out applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['class2'])){
					$class2 = mysql_real_escape_string($_POST['class2']);
				}else{
					$i = 1;
					$err.= "Please fill out applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['class3'])){
					$class3 = mysql_real_escape_string($_POST['class3']);
				}else{
					$i = 1;
					$err.= "Please fill out applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['class4'])){
					$class4 = mysql_real_escape_string($_POST['class4']);
				}else{
					$i = 1;
					$err.= "Please fill out applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['class5'])){
					$class5 = mysql_real_escape_string($_POST['class5']);
				}else{
					$class5 = "";
					//$i = 1;
					//$err.= "Please fill out applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['class6'])){
					$class6 = mysql_real_escape_string($_POST['class6']);
				}else{
					$class6 = "";
					//$i = 1;
					//$err.= "Please fill out applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['class7'])){
					$class7 = mysql_real_escape_string($_POST['class7']);
				}else{
					$class7 = "";
					//$i = 1;
					//$err.= "Please fill out applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['class8'])){
					$class8 = mysql_real_escape_string($_POST['class8']);
				}else{
					$class8 = "";
					//$i = 1;
					//$err.= "Please fill out applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['passfail1'])){
					$passfail1 = mysql_real_escape_string($_POST['passfail1']);
				}else{
					$i = 1;
					$err.= "Please indicate pass/fail status on applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['passfail2'])){
					$passfail2 = mysql_real_escape_string($_POST['passfail2']);
				}else{
					$i = 1;
					$err.= "Please indicate pass/fail status on applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['passfail3'])){
					$passfail3 = mysql_real_escape_string($_POST['passfail3']);
				}else{
					$i = 1;
					$err.= "Please indicate pass/fail status on applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['passfail4'])){
					$passfail4 = mysql_real_escape_string($_POST['passfail4']);
				}else{
					$i = 1;
					$err.= "Please indicate pass/fail status on applicant's most recent classes";
					$err.= "<br />";
				}
				
				if (!empty($_POST['passfail5'])){
					$passfail5 = mysql_real_escape_string($_POST['passfail5']);
				}else{
					$passfail5 = "";
					//$i = 1;
					//$err.= "Please indicate pass/fail status on applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['passfail6'])){
					$passfail6 = mysql_real_escape_string($_POST['passfail6']);
				}else{
					$passfail6 = "";
					//$i = 1;
					//$err.= "Please indicate pass/fail status on applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['passfail7'])){
					$passfail7 = mysql_real_escape_string($_POST['passfail7']);
				}else{
					$passfail7 = "";
					//$i = 1;
					//$err.= "Please indicate pass/fail status on applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['passfail8'])){
					$passfail8 = mysql_real_escape_string($_POST['passfail8']);
				}else{
					$passfail8 = "";
					//$i = 1;
					//$err.= "Please indicate pass/fail status on applicant's most recent classes";
					//$err.= "<br />";
				}
				
				if (!empty($_POST['diagnosis']) && $_POST['diagnosis'] == "no"){
					$diagnosis = mysql_real_escape_string($_POST['diagnosis']);
					$other = "";
				}elseif(!empty($_POST['diagnosis']) && $_POST['diagnosis'] == "yes" && !empty($_POST['other'])){
					$diagnosis = mysql_real_escape_string($_POST['diagnosis']);
					$other = mysql_real_escape_string($_POST['other']);
				}else{
					$i = 1;
					$err.= "Please correctly fill out the Special Services";
					$err.= "<br />";
				}
				
		
				//if(isset($_POST['visit'])){$visit=$_POST['visit'];}else{$visit="";}
				if($i <> 1){
					mysql_query("INSERT INTO children(cookie_id,app_id,grade,gender,applastname,appfirstname,appmiddlename,appstreetaddress,appcity,appstate,appzipcode,language,yearsofstudy,french,spanish,class1,class2,class3,class4,class5,class6,class7,class8,passfail1,passfail2,passfail3,passfail4,passfail5,passfail6,passfail7,passfail8,nodiagnosis,diagnosis,other)
					VALUES ('$cookie_id','$app_id','$grade','$gender','$applastname','$appfirstname','$appmiddlename','$appstreetaddress','$appcity','$appstate','$appzipcode','$language','$yearsofstudy','$french','$spanish','$class1','$class2','$class3','$class4','$class5','$class6','$class7','$class8','$passfail1','$passfail2','$passfail3','$passfail4','$passfail5','$passfail6','$passfail7','$passfail8','','$diagnosis','$other')"); 
				
			?>			
			<script type="text/javascript">
			<!--
			window.location = "http://www.sja.us/application.php"
			//-->
			</script>			
				
		 	<?php }else{
		 	?>
		 		<script type="text/javascript">
		 		<!--
		 		window.location = "http://www.sja.us/application.php?error=<?php echo $err; ?>"
		 		//-->
		 		</script>		
		 	
		 	
		 	<?php
		 			}
		 	} ?>
		 	
		 
		 	
		 	<br />
		   <form method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data" onSubmit="return confirm('Are you ready to proceed?')">
		   <hr>
		   <h2>Student Information</h2>
		   <hr>
		   <h2>Basic Information</h2><br/>
		      	<fieldset><legend>Last Name</legend><ul><li><input type="text" size="25" name="applastname" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		      <fieldset><legend>First Name</legend><ul><li><input type="text" size="25" name="appfirstname" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <fieldset><legend>Middle Name</legend><ul><li><input type="text" size="25" name="appmiddlename" ></li></ul></fieldset>
		   <fieldset><legend>Street Address</legend><ul><li><input type="text" size="25" name="appstreetaddress" onblur="selfaddresscheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <fieldset><legend>City</legend><ul><li><input type="text" size="25" name="appcity" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <fieldset><legend>State</legend><ul><li><select name="appstate" onblur="selfmessage(this)">
		   	<option value=""></option>
		   	<option value="AL">Alabama</option>
		   	<option value="AK">Alaska</option>
		   	<option value="AZ">Arizona</option>
		   	<option value="AR">Arkansas</option>
		   	<option value="CA">California</option>
		   	<option value="CO">Colorado</option>
		   	<option value="CT">Connecticut</option>
		   	<option value="DE">Delaware</option>
		   	<option value="DC">District of Columbia</option>
		   	<option value="FL">Florida</option>
		   	<option value="GA">Georgia</option>
		   	<option value="HI">Hawaii</option>
		   	<option value="ID">Idaho</option>
		   	<option value="IL">Illinois</option>
		   	<option value="IN">Indiana</option>
		   	<option value="IA">Iowa</option>
		   	<option value="KS">Kansas</option>
		   	<option value="KY">Kentucky</option>
		   	<option value="LA">Louisiana</option>
		   	<option value="ME">Maine</option>
		   	<option value="MD">Maryland</option>
		   	<option value="MA">Massachusetts</option>
		   	<option value="MI">Michigan</option>
		   	<option value="MN">Minnesota</option>
		   	<option value="MS">Mississippi</option>
		   	<option value="MO">Missouri</option>
		   	<option value="MT">Montana</option>
		   	<option value="NE">Nebraska</option>
		   	<option value="NV">Nevada</option>
		   	<option value="NH">New Hampshire</option>
		   	<option value="NJ">New Jersey</option>
		   	<option value="NM">New Mexico</option>
		   	<option value="NY">New York</option>
		   	<option value="NC">North Carolina</option>
		   	<option value="ND">North Dakota</option>
		   	<option value="OH">Ohio</option>
		   	<option value="OK">Oklahoma</option>
		   	<option value="OR">Oregon</option>
		   	<option value="PA">Pennsylvania</option>
		   	<option value="RI">Rhode Island</option>
		   	<option value="SC">South Carolina</option>
		   	<option value="SD">South Dakota</option>
		   	<option value="TN">Tennessee</option>
		   	<option value="TX">Texas</option>
		   	<option value="UT">Utah</option>
		   	<option value="VT">Vermont</option>
		   	<option value="VA">Virginia</option>
		   	<option value="WA">Washington</option>
		   	<option value="WV">West Virginia</option>
		   	<option value="WI">Wisconsin</option>
		   	<option value="WY">Wyoming</option>
		   </select></li></ul></fieldset>
		   <fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" name="appzipcode" onblur="selfzipcodecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset><br />
		   	    <hr>
		   <h2>Select grade child will attend:</h2>	<br/>    		
		   <input type="radio" name="grade" value="seven" onClick="document.getElementById('addmale').focus();"><span class="formText"> Seven </span><br />
		   <input type="radio" name="grade" value="eight" onClick="document.getElementById('addmale').focus();"><span class="formText"  > Eight</span><br />
		   <input type="radio" name="grade" value="nine"  onClick="document.getElementById('addmale').focus();"><span class="formText"> Nine</span><br />
		   <input type="radio" name="grade" value="ten" onClick="document.getElementById('addmale').focus();"><span class="formText"> Ten</span><br />
		   <input type="radio" name="grade" value="eleven" onClick="document.getElementById('addmale').focus();"><span class="formText"> Eleven</span><br />
		   <input type="radio" name="grade" value="twelve" onClick="document.getElementById('addmale').focus();"><span class="formText"> Twelve</span><br /><br />
		   <hr>
		   <h2>Select applicant's gender:</h2><br/>
		   <input type="radio" name="gender" value="male" id="addmale" onClick="document.getElementById('addlanguage').focus();" checked><span class="formText" > Male</span><br />
		   <input type="radio" name="gender" value="female" onClick="document.getElementById('addlanguage').focus();"><span class="formText" > Female</span><br /><br />
		   <hr>
		 
		   <h2>Foreign Language Study</h2><br />
		   	    <p>Please indicate the number of years of high school foreign language study the applicant has completed.</p>
		   <fieldset><legend>Language</legend><ul><li><input type="text" size="25" name="language" id="addlanguage" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <fieldset><legend>Years of Study</legend><ul><li><input type="text" size="25" name="yearsofstudy" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset><br />
		   <p>* If the applicant has <strong>not</strong> completed 3 years of high school foreign language, please indicate the language <strong>preferred</strong> to fulfill the requirement.</p>
			<span class="formText">French</span><input type="checkbox" name="french" value="yes"> 
			<span class="formText">Spanish</span><input type="checkbox" name="spanish" value="yes"><br /><br />
		   	    		<hr>
		   <h2>Class Grades/Credits</h2><br />
		   <p>Please list the classes the applicant is currently taking and indicate if the applicant is passing or failing
		   each class as of this date.</p>
		   	    	
		   <fieldset>Math
		   <ul><li><select name="class1" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		   	<option value=""></option>
		   	<option value="6th Math">6th Math</option>
		   	<option value="7th Math">7th Math</option>
		   	<option value="Pre-Algebra">Pre-Algebra</option>
		   	<option value="Algebra I">Algebra I</option>
		   	<option value="Geometry">Geometry</option>
		   	<option value="Algebra II">Algebra II</option>
		   	<option value="Pre-Calculus">Pre-Calculus</option>
		   	<option value="Calculus">Calculus</option>
		   </select></li></ul>
		   </fieldset>
		   <span class="formText">  Pass</span><input type="radio" name="passfail1" value="pass" onClick="document.getElementById('add6th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail1" value="fail" onClick="document.getElementById('add6th').focus();"><br /><br/>
		   <fieldset>Science
		   <ul><li><select name="class2" onblur="selfmessage(this)" id="add6th" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		   	<option value=""></option>
		   	<option value="6th Science">6th Science</option>
		   	<option value="7th Science">7th Science</option>
		   	<option value="8th Science">8th Science</option>
		   	<option value="Biology">Biology</option>
		   	<option value="Chemistry">Chemistry</option>
		   	<option value="Physics">Physics</option>
		   	<option value="Science-Elective">Science-Elective</option>
		   </select></li></ul>
		   </fieldset>
		   <span class="formText">   Pass</span><input type="radio" name="passfail2" value="pass" onClick="document.getElementById('add7th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail2" value="fail" onClick="document.getElementById('add7th').focus();"><br /><br/>
		   <fieldset>Social Studies
		   <ul><li><select name="class3" onblur="selfmessage(this)" id="add7th" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		   	<option value=""></option>
		   	<option value="6th Social Studies">6th Social Studies</option>
		   	<option value="Texas History">Texas History</option>
		   	<option value="U.S. History 8th">U.S. History (8th)</option>
		   	<option value="World Geography">World Geography</option>
		   	<option value="World History">World History</option>
		   	<option value="U.S. History 11th">U.S. History (11th)</option>
		   	<option value="Economics">Economics</option>
		   	<option value="American Government">American Government</option>
		   </select></li></ul>
		   </fieldset>
		   <span class="formText">   Pass</span><input type="radio" name="passfail3" value="pass" onClick="document.getElementById('add8th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail3" value="fail" onClick="document.getElementById('add8th').focus();"><br /><br/>
		   <fieldset>English
		   <ul><li><select name="class4" onblur="selfmessage(this)" id="add8th" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		   	<option value=""></option>
		   	<option value="6th Language Arts">6th Language Arts</option>
		   	<option value="7th Language Arts">7th Language Arts</option>
		   	<option value="8th Language Arts">8th Language Arts</option>
		   	<option value="9th English">9th English</option>
		   	<option value="10th English">10th English</option>
		   	<option value="11th English">11th English</option>
		   	<option value="12th English">12th English</option>
		   </select></li></ul>
		   </fieldset>
		   <span class="formText">   Pass</span><input type="radio" name="passfail4" value="pass" onClick="document.getElementById('add9th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail4" value="fail" onClick="document.getElementById('add9th').focus();"><br /><br/>
		   <fieldset>Other Classes (optional)<ul><li><input type="text" size="25" name="class5" id="add9th"></li></ul></fieldset><span class="formText">   Pass</span><input type="radio" name="passfail5" value="pass" onClick="document.getElementById('add10th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail5" value="fail" onClick="document.getElementById('add10th').focus();"><br /><br/>
		   <fieldset><ul><li><input type="text" size="25" name="class6" id="add10th"> </li></ul></fieldset><span class="formText"> Pass</span><input type="radio" name="passfail6" value="pass" onClick="document.getElementById('add11th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail6" value="fail" onClick="document.getElementById('add11th').focus();"><br /><br/>
		   <fieldset> <ul><li><input type="text" size="25" name="class7" value="" id="add11th"></li></ul></fieldset><span class="formText">   Pass</span><input type="radio" name="passfail7" value="pass" onClick="document.getElementById('add12th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail7" value="fail" onClick="document.getElementById('add12th').focus();"><br /><br/>
		   <fieldset><ul><li><input type="text" size="25" name="class8" value="" id="add12th"></li></ul></fieldset><span class="formText">   Pass</span><input type="radio" name="passfail8" value="pass" onClick="document.getElementById('add13th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail8" value="fail" onClick="document.getElementById('add13th').focus();"><br /><br />
		   	    		<hr>
		  <h2>Special Services</h2><p>If yes, a current assessment of the diagnosed disability must be received at least one week prior to the entrance exam date to allow for appropriate accommodations.</p>  <br />
		   	    	
		   <input type="radio" name="diagnosis" value="no" id="add13th" onClick="document.getElementById('addnext').focus();"><span class="formText" > No Diagnosed Learning Differences</span><br />
		   <input type="radio" name="diagnosis" value="yes" onClick="document.getElementById('addother').focus();"><span class="formText"> Applicant has been diagnosed with the following</span><br /><br/>
		   
		   <fieldset>
		   	<ul>
		   		<li><textarea name="other" id="addother"></textarea> </li>
		   	</ul>
		   </fieldset>
		   
		   <input name="page" type="hidden" size="1" id="userlevel" value="2" /> <br />
		   <fieldset><ul><li><input type="submit" value="Next" name="addchild" id="addnext"></li></ul></fieldset> 
		   </form>
		<?php
		}
		
		if(isset($page) && $page == 3){
			if(isset($_GET['ch']) || isset($_POST['ch'])){
				if(isset($_POST['ch'])){$kidnum=$_POST['ch'];}elseif(isset($_GET['ch'])){$kidnum=$_GET['ch'];}
				//$kidnum = $_GET['ch'];
				$search_sql = "Select * FROM children WHERE kid_id = '$kidnum'";
				$search_results = mysql_query($search_sql) or die(mysql_error());
				while($row=mysql_fetch_assoc($search_results)){
					$childfirstname =	$row['appfirstname'];
					$childlastname = $row['applastname'];
					$childmiddlename = $row['appmiddlename'];
					echo "<br /><div> <h2 align='center'>Add School &middot; ".$childlastname.", ".$childfirstname." ".$childmiddlename."</h2></div>";
				}		
			}	
			if(isset($_POST['addschool'])){
				$i = 0;
				if (!empty($_POST['schoolname'])){
					$schoolname = mysql_real_escape_string($_POST['schoolname']);
				}else{
					$i = 1;
					$err.= "Please fill in the school name";
					$err.= "<br />";
				}
				
				if (!empty($_POST['principal'])){
					$principal = mysql_real_escape_string($_POST['principal']);
				}else{
					$i = 1;
					$err.= "Please fill in the principal's name";
					$err.= "<br />";
				}
				
				if (!empty($_POST['address'])){
					$address = mysql_real_escape_string($_POST['address']);
				}else{
					$i = 1;
					$err.= "Please fill in the school address";
					$err.= "<br />";
				}
				
				if (!empty($_POST['city'])){
					$city = mysql_real_escape_string($_POST['city']);
				}else{
					$i = 1;
					$err.= "Please fill in the city of the school";
					$err.= "<br />";
				}
				
				if (!empty($_POST['state'])){
					$state = mysql_real_escape_string($_POST['state']);
				}else{
					$i = 1;
					$err.= "Please fill in the state of the school";
					$err.= "<br />";
				}
				
				if (!empty($_POST['zipcode'])){
					$zipcode = mysql_real_escape_string($_POST['zipcode']);
				}else{
					$i = 1;
					$err.= "Please fill in the zip code of the school";
					$err.= "<br />";
				}
				
				
				if(!empty($_POST['start_month'])){
					$start_month = mysql_real_escape_string($_POST['start_month']);
				}else{
					$i = 1;
					$err.= "Please fill in month started.";
					$err.= "<br />";
				}
				
				if(!empty($_POST['start_year'])){
					$start_year = mysql_real_escape_string($_POST['start_year']);
				}else{
					$i = 1;
					$err.= "Please fill in year started.";
					$err.= "<br />";
				}
				
				if(!empty($_POST['end_month'])){
					$end_month = mysql_real_escape_string($_POST['end_month']);
				}else{
					$i = 1;
					$err.= "Please fill in month ended.";
					$err.= "<br />";
				}
				
				if(!empty($_POST['end_year'])){
					$end_year = mysql_real_escape_string($_POST['end_year']);
				}else{
					$i = 1;
					$err.= "Please fill in year ended.";
					$err.= "<br />";
				}
				
				$datesattended = $start_month."/".$start_year." &nbsp; - &nbsp;".$end_month."/".$end_year."";
				
				if (!empty($_POST['gradescompleted'])){
					$gradescompleted = mysql_real_escape_string($_POST['gradescompleted']);
				}else{
					$i = 1;
					$err.= "Please fill in how many grades you completed at this school";
					$err.= "<br />";
				}
				
				
				if($i <> 1){
				mysql_query("INSERT INTO schools(cookie_id,kid_id,schoolname,principal,address,city,state,zipcode,datesattended,gradescompleted)
				VALUES ('$cookie_id','$kidnum','$schoolname','$principal','$address','$city','$state','$zipcode','$datesattended','$gradescompleted')"); 
				?>
				<script type="text/javascript">
				<!--
				window.location = "http://www.sja.us/application.php"
				//-->
				</script>			
				<?php		
				}else{?>
						<script type="text/javascript">
						<!--
						window.location = "http://www.sja.us/application.php?error=<?php echo $err; ?>"
						//-->
						</script>		
				<?php
				}
		 	}
		 ?>
		  
		 	<form method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data" onSubmit="return confirm('Are you ready to proceed?')">  
		 	<hr>
		 	<h2>Previous Schools</h2>
		 	<p>Please provide information about the previous schools the applicant has attended, beginning with the
		 	<strong>most recent</strong>.</p><hr/>
		 	<fieldset><legend>School Name</legend><ul><li><input id="schoolname" type="text" size="25" name="schoolname" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		 	<fieldset><legend>Principal's Name</legend><ul><li><input id="principal" type="text" size="25" name="principal" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		 	<fieldset><legend>Street Address</legend><ul><li><input type="text" size="25" name="address" onblur="selfaddresscheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		 	<fieldset><legend>City</legend><ul><li><input type="text" size="25" name="city" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		 	<fieldset><legend>State</legend><ul><li><select name="state" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		 		<option value=""></option>
		 		<option value="AL">Alabama</option>
		 		<option value="AK">Alaska</option>
		 		<option value="AZ">Arizona</option>
		 		<option value="AR">Arkansas</option>
		 		<option value="CA">California</option>
		 		<option value="CO">Colorado</option>
		 		<option value="CT">Connecticut</option>
		 		<option value="DE">Delaware</option>
		 		<option value="DC">District of Columbia</option>
		 		<option value="FL">Florida</option>
		 		<option value="GA">Georgia</option>
		 		<option value="HI">Hawaii</option>
		 		<option value="ID">Idaho</option>
		 		<option value="IL">Illinois</option>
		 		<option value="IN">Indiana</option>
		 		<option value="IA">Iowa</option>
		 		<option value="KS">Kansas</option>
		 		<option value="KY">Kentucky</option>
		 		<option value="LA">Louisiana</option>
		 		<option value="ME">Maine</option>
		 		<option value="MD">Maryland</option>
		 		<option value="MA">Massachusetts</option>
		 		<option value="MI">Michigan</option>
		 		<option value="MN">Minnesota</option>
		 		<option value="MS">Mississippi</option>
		 		<option value="MO">Missouri</option>
		 		<option value="MT">Montana</option>
		 		<option value="NE">Nebraska</option>
		 		<option value="NV">Nevada</option>
		 		<option value="NH">New Hampshire</option>
		 		<option value="NJ">New Jersey</option>
		 		<option value="NM">New Mexico</option>
		 		<option value="NY">New York</option>
		 		<option value="NC">North Carolina</option>
		 		<option value="ND">North Dakota</option>
		 		<option value="OH">Ohio</option>
		 		<option value="OK">Oklahoma</option>
		 		<option value="OR">Oregon</option>
		 		<option value="PA">Pennsylvania</option>
		 		<option value="RI">Rhode Island</option>
		 		<option value="SC">South Carolina</option>
		 		<option value="SD">South Dakota</option>
		 		<option value="TN">Tennessee</option>
		 		<option value="TX">Texas</option>
		 		<option value="UT">Utah</option>
		 		<option value="VT">Vermont</option>
		 		<option value="VA">Virginia</option>
		 		<option value="WA">Washington</option>
		 		<option value="WV">West Virginia</option>
		 		<option value="WI">Wisconsin</option>
		 		<option value="WY">Wyoming</option>
		 	</select></li></ul></fieldset>
		 	<fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" name="zipcode" onblur="selfzipcodecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		 	<fieldset><legend>Dates Attended</legend><ul><li>
		<span class="formLegend"> Start: </span>
		 	<select name="start_month" class="formDates" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		 	        <option value="1">January</option>
		 	        <option value="2">February</option>
		 	        <option value="3">March</option>
		 	        <option value="4">April</option>
		 	        <option value="5">May</option>
		 	        <option value="6">June</option>
		 	        <option value="7">July</option>
		 	        <option value="8">August</option>
		 	        <option value="9">September</option>
		 	        <option value="10">October</option>
		 	        <option value="11">November</option>
		 	        <option value="12">December</option>
		 	    </select> 
		 	<select name="start_year" class="formDates" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		 	<option value="2013">2013</option>
		 	    <option value="2012">2012</option>
		 	    <option value="2011">2011</option>
		 	    <option value="2010">2010</option>
		 	    <option value="2009">2009</option>
		 	    <option value="2008">2008</option>
		 	    <option value="2007">2007</option>
		 	</select> 
		<span class="formLegend"> &nbsp;&nbsp;End: </span>
		 	<select name="end_month" class="formDates" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		 	        <option value="1">January</option>
		 	        <option value="2">February</option>
		 	        <option value="3">March</option>
		 	        <option value="4">April</option>
		 	        <option value="5">May</option>
		 	        <option value="6">June</option>
		 	        <option value="7">July</option>
		 	        <option value="8">August</option>
		 	        <option value="9">September</option>
		 	        <option value="10">October</option>
		 	        <option value="11">November</option>
		 	        <option value="12">December</option>
		 	    </select> 
		 	<select name="end_year" class="formDates" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
		 		<option value="2013">2013</option>
		 	    <option value="2012">2012</option>
		 	    <option value="2011">2011</option>
		 	    <option value="2010">2010</option>
		 	    <option value="2009">2009</option>
		 	    <option value="2008">2008</option>
		 	    <option value="2007">2007</option>
		 	</select>
		 	<!--<input type="text" size="25" name="datesattended" value="">--></li></ul></fieldset>
		 	<fieldset><legend>Grades Completed</legend><ul><li><input type="text" size="25" name="gradescompleted" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <input name="ch" type="hidden" size="1" id="userlevel" value="<?php echo $kidnum ?>" /> 
		 	<input name="page" type="hidden" size="1" id="userlevel" value="3" /> 
		 	<fieldset><ul><li><input type="submit" value="Next" name="addschool"></li></ul></li></ul></fieldset>
			</form>
			<?php
		}
		
		if(empty($motherlastname) && empty($motherfirstname) && empty($mothermiddlename) && empty($motheraddress) && empty($mothercity) && empty($motherstate) && empty($motherzipcode) && empty($motherworkphone) && empty($mothermobilephone) && empty($motheremail) && empty($motheremployment) && empty($motheroccupation)){
			$optionalmother = "<a href='".$PHP_SELF."?add=parent2&ap=".$app_id."'>[Add Guardian]</a>";
		}else{
			$optionalmother = "<div style='float:left;width:460px;'>
					<table class='formTable' cellpadding='0' cellspacing='0' border='0' style='width:450px;'>
					<tbody>
					<tr><td class='formHeader' colspan='2'><span>Parent/Legal Guardian #2 Information <a href='".$PHP_SELF."?edit=parent2&ap=".$app_id."'>[edit]</a></span></td></tr>
					<tr><td><span class='formLegend'>Last Name: </span></td><td><span class='formText'>".$motherlastname."</span></td></tr>
					<tr><td><span class='formLegend'>First Name: </span></td><td><span class='formText'>".$motherfirstname."</span></td></tr>
			
					<tr><td><span class='formLegend'>Middle Name: </span></td><td><span class='formText'>".$mothermiddlename."</span></td></tr> 
					<tr><td><span class='formLegend'>Address: </span></td><td><span class='formText'>".$motheraddress."</span></td></tr> 
					<tr><td><span class='formLegend'>City: </span></td><td><span class='formText'>".$mothercity."</span></td></tr> 
					<tr><td><span class='formLegend'>State: </span></td><td><span class='formText'>".$motherstate."</span></td></tr> 
					<tr><td><span class='formLegend'>Zip Code: </span></td><td><span class='formText'>".$motherzipcode."</span></td></tr>  
					<tr><td><span class='formLegend'>Work Phone: </span></td><td><span class='formText'>".$motherworkphone."</span></td></tr> 
					<tr><td><span class='formLegend'>Home Phone: </span></td><td><span class='formText'>".$mothermobilephone."</span></td></tr> 
					<tr><td><span class='formLegend'>Email: </span></td><td><span class='formText'>".$motheremail."</span></td></tr> 
					<tr><td><span class='formLegend'>Place of Employment: </span></td><td><span class='formText'>".$motheremployment."</span></td></tr>  
					<tr><td><span class='formLegend'>Occupation: </span></td><td><span class='formText'>".$motheroccupation."</span></td></tr> 
					</tbody>
					</table>
					<br />
					".$mailingtable."		
					</div>";
		}
		
		echo "<hr><h1>Parent/Legal Guardian Information:</h1><br/>
		<div style='float:left;width:460px;'>
		
		<table class='formTable' cellpadding='0' cellspacing='0' border='0' style='width:450px;'>
		<tbody>
		<tr><td class='formHeader' colspan='2'><span>Parent/Legal Guardian #1 Information <a href='".$PHP_SELF."?edit=parent1&ap=".$app_id."'>[edit]</a></span></td></tr>
		<tr><td><span class='formLegend'>Last Name: </span></td><td><span class='formText'>".$fatherlastname."</span></td></tr>
		<tr><td><span class='formLegend'>First Name:</span></td><td><span class='formText'>".$fatherfirstname."</span></td></tr>
		<tr><td><span class='formLegend'>Middle Name: </span></td><td><span class='formText'>".$fathermiddlename."</span></td></tr> 
		<tr><td><span class='formLegend'>Address: </span></td><td><span class='formText'>".$fatheraddress."</span></td></tr>
		<tr><td><span class='formLegend'>City: </span></td><td><span class='formText'>".$fathercity."</span></td></tr>
		<tr><td><span class='formLegend'>State: </span></td><td><span class='formText'>".$fatherstate."</span></td></tr>
		<tr><td><span class='formLegend'>Zip Code: </span></td><td><span class='formText'>".$fatherzipcode."</span></td></tr> 
		<tr><td><span class='formLegend'>Work Phone: </span></td><td><span class='formText'>".$fatherworkphone."</span></td></tr> 
		<tr><td><span class='formLegend'>Home Phone: </span></td><td><span class='formText'>".$fathermobilephone."</span></td></tr> 
		<tr><td><span class='formLegend'>Email: </span></td><td><span class='formText'>".$fatheremail."</span></td></tr>
		<tr><td><span class='formLegend'>Place of Employment: </span></td><td><span class='formText'>".$fatheremployment."</span></td></tr> 
		<tr><td><span class='formLegend'>Occupation: </span></td><td><span class='formText'>".$fatheroccupation."</span></td></tr>
		</tbody>
		</table><br />
		
".$legacytable."
		</div>".$optionalmother."<br clear='all'>"; 
	}
	
	
	
	//$page = 1;
	?><br /><?php
}else{

}



//echo $_POST['page']."------------";


if(isset($page) && $page == 1){
	if(isset($_POST['submit'])){
		$recordname = time();
			// number below is the strtotime date for 1/14/2013, the difference between now and that date 	is what is used to add back to now
		//$expiretime = 1358143200-time();
		$expiretime = 9999999999-time();
		$expiry = time() + $expiretime;
		setcookie("recordkeeper", $recordname, $expiry,'/');
    	//process form pg1
    	$i = 0;
    	if (!empty($_POST['ffirstname'])){
  	 		$fatherfirstname = mysql_real_escape_string($_POST['ffirstname']);
  	 	}else{
  	 		$i = 1;
  	 		$err.= "Please fill in the first name for Parent/Legal Guardian #1";
  	 		$err.= "<br />";
  	 	}
  	 	
  	 	if (!empty($_POST['flastname'])){
  			$fatherlastname = mysql_real_escape_string($_POST['flastname']);
  		}else{
  			$i = 1;
  			$err.= "Please fill in the last name for Parent/Legal Guardian #1";
  			$err.= "<br />";
  		}
  		
  		if (!empty($_POST['fmiddlename'])){
    		$fathermiddlename = mysql_real_escape_string($_POST['fmiddlename']);
    	}else{
    		$fathermiddlename = "";
    	}
    	
    	if (!empty($_POST['faddress'])){
  	 		$fatheraddress = mysql_real_escape_string($_POST['faddress']);
  	 	}else{
  	 		$i = 1;
  	 		$err.= "Please fill in address for Parent/Legal Guardian #1";
  	 		$err.= "<br />";
  	 	}
  	 	
  	 	if (!empty($_POST['fcity'])){
  			$fathercity = mysql_real_escape_string($_POST['fcity']);
  		}else{
  			$i = 1;
  			$err.= "Please fill in city for Parent/Legal Guardian #1";
  			$err.= "<br />";
  		}
  		
  		if (!empty($_POST['fstate'])){
    		$fatherstate = mysql_real_escape_string($_POST['fstate']);
    	}else{
    		$i = 1;
    		$err.= "Please fill in state for Parent/Legal Guardian #1";
    		$err.= "<br />";
    	}
    	
    	if (!empty($_POST['fzipcode'])){
  	 		$fatherzipcode = mysql_real_escape_string($_POST['fzipcode']);
  	 	}else{
  	 		$i = 1;
  	 		$err.= "Please fill in zip code for Parent/Legal Guardian #1";
  	 		$err.= "<br />";
  	 	}
  	 	
  	 	if (!empty($_POST['fworkphone'])){
  			$fatherworkphone = mysql_real_escape_string($_POST['fworkphone']);
  		}else{
  			$i = 1;
  			$err.= "Please fill in work number for Parent/Legal Guardian #1";
  			$err.= "<br />";
  		}
  		
  		if (!empty($_POST['fmobilephone'])){
    		$fathermobilephone = mysql_real_escape_string($_POST['fmobilephone']);
    	}else{
    		$i = 1;
    		$err.= "Please fill in phone number for Parent/Legal Guardian #1";
    		$err.= "<br />";
    	}
    	
    	
    	if (!empty($_POST['femail'])){
    		if (filter_var($_POST['femail'], FILTER_VALIDATE_EMAIL)) {
    		  	$fatheremail = mysql_real_escape_string($_POST['femail']);
    		} else {
    		 	$i = 1;
    			$err.= "Email provided for Parent/Legal Guardian #1 was not in the proper format";
    		 	$err.= "<br />";
    		}   	
  	 	}else{
  	 		$i = 1;
  	 		$err.= "Please fill in email for Parent/Legal Guardian #1";
  	 		$err.= "<br />";
  	 	}
  	 	
  	 	if (!empty($_POST['femployment'])){
  			$fatheremployment = mysql_real_escape_string($_POST['femployment']);
  		}else{
  			$i = 1;
  			$err.= "Please fill employment for Parent/Legal Guardian #1";
  			$err.= "<br />";
  		}
  		
  		if (!empty($_POST['foccupation'])){
    		$fatheroccupation = mysql_real_escape_string($_POST['foccupation']);
    	}else{
    		$i = 1;
    		$err.= "Please fill in occupation for Parent/Legal Guardian #1";
    		$err.= "<br />";
    	}
    	
    	if (!empty($_POST['mfirstname'])){
			$motherfirstname = mysql_real_escape_string($_POST['mfirstname']);
		}else{
			$motherfirstname = "";
			//$i = 1;
			//$err.= "Please fill in mother's first name";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['mlastname'])){
			$motherlastname = mysql_real_escape_string($_POST['mlastname']);
		}else{
			$motherlastname = "";
			//$i = 1;
			//$err.= "Please fill in mother's last name";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['mmiddlename'])){
			$mothermiddlename = mysql_real_escape_string($_POST['mmiddlename']);
		}else{
    		$mothermiddlename = "";
		}
		
		if (!empty($_POST['maddress'])){
			$motheraddress = mysql_real_escape_string($_POST['maddress']);
		}else{
			$motheraddress = "";
			//$i = 1;
			//$err.= "Please fill in mother's address";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['mcity'])){
			$mothercity = mysql_real_escape_string($_POST['mcity']);
		}else{
			$mothercity = "";
			//$i = 1;
			//$err.= "Please fill in father's city";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['mstate'])){
			$motherstate = mysql_real_escape_string($_POST['mstate']);
		}else{
			$motherstate = "";
			//$i = 1;
			//$err.= "Please fill in mother's state";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['mzipcode'])){
			$motherzipcode = mysql_real_escape_string($_POST['mzipcode']);
		}else{
			$motherzipcode = "";
			//$i = 1;
			//$err.= "Please fill in mother's zip code";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['mworkphone'])){
			$motherworkphone = mysql_real_escape_string($_POST['mworkphone']);
		}else{
			$motherworkphone = "";
			//$i = 1;
			//$err.= "Please fill in mother's work number";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['mmobilephone'])){
			$mothermobilephone = mysql_real_escape_string($_POST['mmobilephone']);
		}else{
			$mothermobilephone = "";
			//$i = 1;
			//$err.= "Please fill in mother's phone number";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['memail'])){
			if (filter_var($_POST['memail'], FILTER_VALIDATE_EMAIL)) {
			  	$motheremail = mysql_real_escape_string($_POST['memail']);
			} else {
				$motheremail = "";
				//	$i = 1;
			//	$err.= "Mother's email provided was not in the proper format";
			//	$err.= "<br />";
			} 
		}else{
			$motheremail = "";
			//$i = 1;
			//$err.= "Please fill in mother's email";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['memployment'])){
			$motheremployment = mysql_real_escape_string($_POST['memployment']);
		}else{
			$motheremployment = "";
			//$i = 1;
			//$err.= "Please fill in mother's employment";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['moccupation'])){
			$motheroccupation = mysql_real_escape_string($_POST['moccupation']);
		}else{
			$motheroccupation = "";
			//$i = 1;
			//$err.= "Please fill in mother's occupation";
			//$err.= "<br />";
		}
		
		if (!empty($_POST['mailingaddress'])){
			$mailingaddress = mysql_real_escape_string($_POST['mailingaddress']);
		}else{
			$mailingaddress = "";
		}
		
		if (!empty($_POST['mailingcity'])){
			$mailingcity = mysql_real_escape_string($_POST['mailingcity']);
		}else{
			$mailingcity = "";
		}
		
		if (!empty($_POST['mailingstate'])){
			$mailingstate = mysql_real_escape_string($_POST['mailingstate']);
		}else{
			$mailingstate = "";
		}
		
		if (!empty($_POST['mailingzipcode'])){
			$mailingzipcode = mysql_real_escape_string($_POST['mailingzipcode']);
		}else{
			$mailingzipcode = "";
		}
		
		if (!empty($_POST['legacyname1'])){
			$legacyname1 = mysql_real_escape_string($_POST['legacyname1']);
		}else{
			//$i = 1;
			//$err.= "Please fill in Legacy Name";
			//$err.= "<br />";
			$legacyname1 = "";
		}
		
		if (!empty($_POST['legacyrelationship1'])){
			$legacyrelationship1 = mysql_real_escape_string($_POST['legacyrelationship1']);
		}else{
			//$i = 1;
			//$err.= "Please fill in legacy relationship";
			//$err.= "<br />";
			$legacyrelationship1 = "";
		}
		
		if (!empty($_POST['legacyclass1'])){
			$legacyclass1 = mysql_real_escape_string($_POST['legacyclass1']);
		}else{
			//$i = 1;
			//$err.= "Please fill in legacy's graduation class";
			//$err.= "<br />";
			$legacyclass1 = "";
		}
		
		if (!empty($_POST['legacyname2'])){
			$legacyname2 = mysql_real_escape_string($_POST['legacyname2']);
		}else{
			//$i = 1;
			//$err.= "Please fill in Legacy Name";
			//$err.= "<br />";
			$legacyname2 = "";
		}
		
		if (!empty($_POST['legacyrelationship2'])){
			$legacyrelationship2 = mysql_real_escape_string($_POST['legacyrelationship2']);
		}else{
			//$i = 1;
			//$err.= "Please fill in legacy relationship";
			//$err.= "<br />";
			$legacyrelationship2 = "";
		}
		
		if (!empty($_POST['legacyclass2'])){
			$legacyclass2 = mysql_real_escape_string($_POST['legacyclass2']);
		}else{
			//$i = 1;
			//$err.= "Please fill in legacy's graduating class";
			//$err.= "<br />";
			$legacyclass2 = "";
		}
		
		if (!empty($_POST['legacyname3'])){
			$legacyname3 = mysql_real_escape_string($_POST['legacyname3']);
		}else{
			//$i = 1;
			//$err.= "Please fill in Legacy Name";
			//$err.= "<br />";
			$legacyname3 = "";
		}
		
		if (!empty($_POST['legacyrelationship3'])){
			$legacyrelationship3 = mysql_real_escape_string($_POST['legacyrelationship3']);
		}else{
			//$i = 1;
			//$err.= "Please fill in legacy relationship";
			//$err.= "<br />";
			$legacyrelationship3 = "";
		}
		
		if (!empty($_POST['legacyclass3'])){
			$legacyclass3 = mysql_real_escape_string($_POST['legacyclass3']);
		}else{
			//$i = 1;
			//$err.= "Please fill in legacy's graduating class";
			//$err.= "<br />";
			$legacyclass3 = "";
		}
		if (!empty($_POST['legacyname4'])){
			$legacyname4 = mysql_real_escape_string($_POST['legacyname4']);
		}else{
			//$i = 1;
			//$err.= "Please fill in Legacy Name";
			//$err.= "<br />";
			$legacyname4 = "";
		}
		
		if (!empty($_POST['legacyrelationship4'])){
			$legacyrelationship4 = mysql_real_escape_string($_POST['legacyrelationship4']);
		}else{
			//$i = 1;
			//$err.= "Please fill in legacy relationship";
			//$err.= "<br />";
			$legacyrelationship4 = "";
		}
		
		if (!empty($_POST['legacyclass4'])){
			$legacyclass4 = mysql_real_escape_string($_POST['legacyclass4']);
		}else{
			//$i = 1;
			//$err.= "Please fill in legacy's graduating class";
			//$err.= "<br />";
			$legacyclass4 = "";
		}
		
		if (!empty($_POST['visit'])){$visit=mysql_real_escape_string($_POST['visit']);}else{$visit="";}
		if (!empty($_POST['friend'])){$friend=mysql_real_escape_string($_POST['friend']);}else{$visit="";}
		if (!empty($_POST['church'])){$church=mysql_real_escape_string($_POST['church']);}else{$church="";}
		if (!empty($_POST['newspaper'])){$newspaper=mysql_real_escape_string($_POST['newspaper']);}else{$newspaper="";}
		if (!empty($_POST['website'])){$website=mysql_real_escape_string($_POST['website']);}else{$website="";}
		if (!empty($_POST['brochure'])){$brochure=mysql_real_escape_string($_POST['brochure']);}else{$brochure="";}
		if (!empty($_POST['principal'])){$principal=mysql_real_escape_string($_POST['principal']);}else{$principal="";}
		if (!empty($_POST['hearabout'])){$hearabout=mysql_real_escape_string($_POST['hearabout']);}else{$hearabout="";}

		if($i <> 1){
  			mysql_query("INSERT INTO applicant(cookie_id,fatherfirstname,fatherlastname,fathermiddlename,fatheraddress,fathercity,fatherstate,fatherzipcode,fatherworkphone,fathermobilephone,fatheremail,fatheremployment,fatheroccupation,motherfirstname,motherlastname,mothermiddlename,motheraddress,mothercity,motherstate,motherzipcode,motherworkphone,mothermobilephone,motheremail,motheremployment,motheroccupation,mailingaddress,mailingcity,mailingstate,mailingzipcode,legacyname1,legacyrelationship1,legacyclass1,legacyname2,legacyrelationship2,legacyclass2,legacyname3,legacyrelationship3,legacyclass3,legacyname4,legacyrelationship4,legacyclass4,visit,friend,church,newspaper,website,brochure,principal,hearabout)
  			VALUES ('$recordname','$fatherfirstname','$fatherlastname','$fathermiddlename','$fatheraddress','$fathercity','$fatherstate','$fatherzipcode','$fatherworkphone','$fathermobilephone','$fatheremail','$fatheremployment','$fatheroccupation','$motherfirstname','$motherlastname','$mothermiddlename','$motheraddress','$mothercity','$motherstate','$motherzipcode','$motherworkphone','$mothermobilephone','$motheremail','$motheremployment','$motheroccupation','$mailingaddress','$mailingcity','$mailingstate','$mailingzipcode','$legacyname1','$legacyrelationship1','$legacyclass1','$legacyname2','$legacyrelationship2','$legacyclass2','$legacyname3','$legacyrelationship3','$legacyclass3','$legacyname4','$legacyrelationship4','$legacyclass4','$visit','$friend','$church','$newspaper','$website','$brochure','$principal','$hearabout')"); 
  			
  			$basicinfo_sqls="SELECT * FROM applicant WHERE cookie_id = '$recordname'";
  			$basicinfo_results=mysql_query($basicinfo_sqls) or die(mysql_error());	
  			while($rowss=mysql_fetch_assoc($basicinfo_results)){
  				$cookie_id = $rowss['cookie_id'];
  				$app_id = $rowss['app_id'];
  			}	
  			
  			
  			if (!empty($_POST['grade'])){
  				$grade = mysql_real_escape_string($_POST['grade']);
  			}else{
  				$i = 1;
  				$err.= "Please indicate grade";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['gender'])){
  				$gender = mysql_real_escape_string($_POST['gender']);
  			}else{
  				$i = 1;
  				$err.= "Please indicate gender";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['applastname'])){
  				$applastname = mysql_real_escape_string($_POST['applastname']);
  			}else{
  				$i = 1;
  				$err.= "Please fill out last name of applicant";
  				$err.= "<br />";	
  			}
  			
  			if (!empty($_POST['appfirstname'])){
  				$appfirstname = mysql_real_escape_string($_POST['appfirstname']);
  			}else{
  				$i = 1;
  				$err.= "Please fill out first name of applicant";
  				$err.= "<br />";
  			}
  			
  			$appmiddlename = mysql_real_escape_string($_POST['appmiddlename']);
  			
  			if (!empty($_POST['appstreetaddress'])){
  				$appstreetaddress = mysql_real_escape_string($_POST['appstreetaddress']);
  			}else{
  				$i = 1;
  				$err.= "Please fill out the address of applicant";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['appcity'])){
  				$appcity = mysql_real_escape_string($_POST['appcity']);
  			}else{
  				$i = 1;
  				$err.= "Please fill out the city of applicant";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['appstate'])){
  				$appstate = mysql_real_escape_string($_POST['appstate']);
  			}else{
  				$i = 1;
  				$err.= "Please fill out the state of applicant";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['appzipcode'])){		
  				$appzipcode = mysql_real_escape_string($_POST['appzipcode']);
  			}else{
  				$i = 1;
  				$err.= "Please fill out zip code of applicant";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['language'])){	
  				if (!empty($_POST['yearsofstudy'])){
  					$yearsofstudy = mysql_real_escape_string($_POST['yearsofstudy']);
  				}else{
  					$i = 1;
  					$err.= "Please indicate years of study";
  					$err.= "<br />";
  				}
  				$language = mysql_real_escape_string($_POST['language']);
  			}else{
  				if(!empty($_POST['french']) || !empty($_POST['spanish'])){
  				
  				}else{
  					$i = 1;
  					$err.= "Please indicate other languages";
  					$err.= "<br />";
  				}
  			}
  			
  			if (!empty($_POST['french'])){
  				$french = mysql_real_escape_string($_POST['french']);
  				if (!empty($_POST['spanish'])){
  					$spanish = mysql_real_escape_string($_POST['spanish']);
  				}else{
  					$spanish = "N/A";
  				}
  			}else{
  				$french = "N/A";
  				if (!empty($_POST['spanish'])){
  					$spanish = mysql_real_escape_string($_POST['spanish']);
  				}else{
  					if (!empty($_POST['yearsofstudy']) && !empty($_POST['language'])){
  					
  					}else{
  						$i = 1;
  						$err.= "Please indicate if applicant studies Spanish or French";
  						$err.= "<br />";
  					}
  				}
  			}
  			
  			if (!empty($_POST['class1'])){
  				$class1 = mysql_real_escape_string($_POST['class1']);
  			}else{
  				$i = 1;
  				$err.= "Please fill out applicant's most recent classes";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['class2'])){
  				$class2 = mysql_real_escape_string($_POST['class2']);
  			}else{
  				$i = 1;
  				$err.= "Please fill out applicant's most recent classes";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['class3'])){
  				$class3 = mysql_real_escape_string($_POST['class3']);
  			}else{
  				$i = 1;
  				$err.= "Please fill out applicant's most recent classes";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['class4'])){
  				$class4 = mysql_real_escape_string($_POST['class4']);
  			}else{
  				$i = 1;
  				$err.= "Please fill out applicant's most recent classes";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['class5'])){
  				$class5 = mysql_real_escape_string($_POST['class5']);
  			}else{
  				$class5 = "";
  				//$i = 1;
  				//$err.= "Please fill out applicant's most recent classes";
  				//$err.= "<br />";
  			}
  			
  			if (!empty($_POST['class6'])){
  				$class6 = mysql_real_escape_string($_POST['class6']);
  			}else{
  				$class6 = "";
  				//$i = 1;
  				//$err.= "Please fill out applicant's most recent classes";
  				//$err.= "<br />";
  			}
  			
  			if (!empty($_POST['class7'])){
  				$class7 = mysql_real_escape_string($_POST['class7']);
  			}else{
  				$class7 = "";
  				//$i = 1;
  				//$err.= "Please fill out applicant's most recent classes";
  				//$err.= "<br />";
  			}
  			
  			if (!empty($_POST['class8'])){
  				$class8 = mysql_real_escape_string($_POST['class8']);
  			}else{
  				$class8 = "";
  				//$i = 1;
  				//$err.= "Please fill out applicant's most recent classes";
  				//$err.= "<br />";
  			}
  			
  			if (!empty($_POST['passfail1'])){
  				$passfail1 = mysql_real_escape_string($_POST['passfail1']);
  			}else{
  				$i = 1;
  				$err.= "Please indicate pass/fail status on applicant's most recent classes";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['passfail2'])){
  				$passfail2 = mysql_real_escape_string($_POST['passfail2']);
  			}else{
  				$i = 1;
  				$err.= "Please indicate pass/fail status on applicant's most recent classes";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['passfail3'])){
  				$passfail3 = mysql_real_escape_string($_POST['passfail3']);
  			}else{
  				$i = 1;
  				$err.= "Please indicate pass/fail status on applicant's most recent classes";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['passfail4'])){
  				$passfail4 = mysql_real_escape_string($_POST['passfail4']);
  			}else{
  				$i = 1;
  				$err.= "Please indicate pass/fail status on applicant's most recent classes";
  				$err.= "<br />";
  			}
  			
  			if (!empty($_POST['passfail5'])){
  				$passfail5 = mysql_real_escape_string($_POST['passfail5']);
  			}else{
  				$passfail5 = "";
  				//$i = 1;
  				//$err.= "Please indicate pass/fail status on applicant's most recent classes";
  				//$err.= "<br />";
  			}
  			
  			if (!empty($_POST['passfail6'])){
  				$passfail6 = mysql_real_escape_string($_POST['passfail6']);
  			}else{
  				$passfail6 = "";
  				//$i = 1;
  				//$err.= "Please indicate pass/fail status on applicant's most recent classes";
  				//$err.= "<br />";
  			}
  			
  			if (!empty($_POST['passfail7'])){
  				$passfail7 = mysql_real_escape_string($_POST['passfail7']);
  			}else{
  				$passfail7 = "";
  				//$i = 1;
  				//$err.= "Please indicate pass/fail status on applicant's most recent classes";
  				//$err.= "<br />";
  			}
  			
  			if (!empty($_POST['passfail8'])){
  				$passfail8 = mysql_real_escape_string($_POST['passfail8']);
  			}else{
  				$passfail8 = "";
  				//$i = 1;
  				//$err.= "Please indicate pass/fail status on applicant's most recent classes";
  				//$err.= "<br />";
  			}
  			
  			if (!empty($_POST['diagnosis']) && $_POST['diagnosis'] == "no"){
  				$diagnosis = mysql_real_escape_string($_POST['diagnosis']);
  				$other = "";
  			}elseif(!empty($_POST['diagnosis']) && $_POST['diagnosis'] == "yes" && !empty($_POST['other'])){
  				$diagnosis = mysql_real_escape_string($_POST['diagnosis']);
  				$other = mysql_real_escape_string($_POST['nother']);
  			}else{
  				$i = 1;
  				$err.= "Please correctly fill out the Special Services";
  				$err.= "<br />";
  			}
  			
  			
  				mysql_query("INSERT INTO children(cookie_id,app_id,grade,gender,applastname,appfirstname,appmiddlename,appstreetaddress,appcity,appstate,appzipcode,language,yearsofstudy,french,spanish,class1,class2,class3,class4,class5,class6,class7,class8,passfail1,passfail2,passfail3,passfail4,passfail5,passfail6,passfail7,passfail8,nodiagnosis,diagnosis,other)
  				VALUES ('$recordname','$app_id','$grade','$gender','$applastname','$appfirstname','$appmiddlename','$appstreetaddress','$appcity','$appstate','$appzipcode','$language','$yearsofstudy','$french','$spanish','$class1','$class2','$class3','$class4','$class5','$class6','$class7','$class8','$passfail1','$passfail2','$passfail3','$passfail4','$passfail5','$passfail6','$passfail7','$passfail8','','$diagnosis','$other')"); /**/
  			
  			?>
  			<script type="text/javascript">
  			<!--
  				window.location = "http://www.sja.us/application.php"
  			//-->
  			</script>			
  			
  			<?php
  			} else {
			
  				?>
  				<script type="text/javascript">
  				<!--
  				window.location = "http://www.sja.us/application.php?errormain=<?php echo $err; ?>"
  				//-->
  				</script>
  			<?php
  			}
		}  
  			$basicinfo_sql="SELECT * FROM applicant WHERE cookie_id = '$recordname'";
  			$basicinfo_result=mysql_query($basicinfo_sql) or die(mysql_error());	
  			while($rows=mysql_fetch_assoc($basicinfo_result)){
  				$cookie_id = $rows['cookie_id'];
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
  				echo $recordname." ".$fatherfirstname." ".$fatherlastname." ".$fathermiddlename." ".$fatheraddress." ".$fathercity." ".$fatherstate." ".$fatherzipcode." ".$fatherworkphone." ".$fathermobilephone." ".$fatheremail." ".$fatheremployment." ".$fatheroccupation." ".$motherfirstname." ".$motherlastname." ".$mothermiddlename." ".$motheraddress." ".$mothercity." ".$motherstate." ".$motherzipcode." ".$motherworkphone." ".$mothermobilephone." ".$motheremail." ".$motheremployment." ".$motheroccupation." ".$mailingaddress." ".$mailingcity." ".$mailingstate." ".$mailingzipcode." ".$legacyname1." ".$legacyrelationship1." ".$legacyclass1." ".$legacyname2." ".$legacyrelationship2." ".$legacyclass2." ".$legacyname3." ".$legacyrelationship3." ".$legacyclass3." ".$visit." ".$friend." ".$church." ".$newspaper." ".$website." ".$brochure." ".$principal; 
	}  		
}

		if(isset($_GET['edit']) && $_GET['edit'] == "parent1"){
			$app_id = $_GET['ap'];
			$err = "";
			$i = 0;
			if(isset($_POST['editparent1'])){
			if (!empty($_POST['ffirstname'])){
				$fatherfirstname = mysql_real_escape_string($_POST['ffirstname']);
			}else{
				$i = 1;
				$err.= "Please fill in the first name for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['flastname'])){
				$fatherlastname = mysql_real_escape_string($_POST['flastname']);
			}else{
				$i = 1;
				$err.= "Please fill in the last name for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['fmiddlename'])){
				$fathermiddlename = mysql_real_escape_string($_POST['fmiddlename']);
			}else{
				$fathermiddlename = "";
			}

			if (!empty($_POST['faddress'])){
				$fatheraddress = mysql_real_escape_string($_POST['faddress']);
			}else{
				$i = 1;
				$err.= "Please fill in address for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['fcity'])){
				$fathercity = mysql_real_escape_string($_POST['fcity']);
			}else{
				$i = 1;
				$err.= "Please fill in city for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['fstate'])){
				$fatherstate = mysql_real_escape_string($_POST['fstate']);
			}else{
				$i = 1;
				$err.= "Please fill in state for Parent/Legal Guardian #1";
				$err.= "<br />";
			}

			if (!empty($_POST['fzipcode'])){
				$fatherzipcode = mysql_real_escape_string($_POST['fzipcode']);
			}else{
				$i = 1;
				$err.= "Please fill in zip code for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['fworkphone'])){
				$fatherworkphone = mysql_real_escape_string($_POST['fworkphone']);
			}else{
				$i = 1;
				$err.= "Please fill in work number for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['fmobilephone'])){
				$fathermobilephone = mysql_real_escape_string($_POST['fmobilephone']);
			}else{
				$i = 1;
				$err.= "Please fill in phone number for Parent/Legal Guardian #1";
				$err.= "<br />";
			}


			if (!empty($_POST['femail'])){
				if (filter_var($_POST['femail'], FILTER_VALIDATE_EMAIL)) {
	  				$fatheremail = mysql_real_escape_string($_POST['femail']);
				} else {
	 				$i = 1;
					$err.= "Email provided for Parent/Legal Guardian #1 was not in the proper format";
	 				$err.= "<br />";
				}   	
			}else{
				$i = 1;
				$err.= "Please fill in email for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['femployment'])){
				$fatheremployment = mysql_real_escape_string($_POST['femployment']);
			}else{
				$i = 1;
				$err.= "Please fill employment for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['foccupation'])){
				$fatheroccupation = mysql_real_escape_string($_POST['foccupation']);
			}else{
				$i = 1;
				$err.= "Please fill in occupation for Parent/Legal Guardian #1";
				$err.= "<br />";
			}


				
				//if(isset($_POST['visit'])){$visit=$_POST['visit'];}else{$visit="";}
				if($i <> 1){

					mysql_query("UPDATE `applicant` SET fatherfirstname='$fatherfirstname' ,fatherlastname='$fatherlastname', fathermiddlename='$fathermiddlename', fatheraddress='$fatheraddress', fathercity='$fathercity', fatherstate='$fatherstate', fatherzipcode='$fatherzipcode', fatherworkphone='$fatherworkphone', fathermobilephone='$fathermobilephone', fatheremail='$fatheremail', fatheremployment='$fatheremployment', fatheroccupation='$fatheroccupation' WHERE app_id='$app_id'") or die(mysql_error()); 
			?>			
			<script type="text/javascript">
			<!--
			window.location = "http://www.sja.us/application.php"
			//-->
			</script>			
				
		 	<?php }else{
		 	?>
		 		<script type="text/javascript">
		 		<!--
		 		window.location = "http://www.sja.us/application.php?error=<?php echo $err; ?>"
		 		//-->
		 		</script>		
		 	
		 	
		 	<?php
		 			}
		 	} 
		 	$edit_parent1_sql = "SELECT * FROM `applicant` WHERE app_id='$app_id'";
		 	$edit_parent1_result = mysql_query($edit_parent1_sql);
		 	while($rowsparent1 = mysql_fetch_array($edit_parent1_result)){
				$cookie_id = $rowsparent1['cookie_id'];
				$app_id = $rowsparent1['app_id'];
				$fatherfirstname = $rowsparent1['fatherfirstname'];
				$fatherlastname = $rowsparent1['fatherlastname'];
				$fathermiddlename = $rowsparent1['fathermiddlename'];
				$fatheraddress = $rowsparent1['fatheraddress'];
				$fathercity = $rowsparent1['fathercity'];
				$fatherstate = $rowsparent1['fatherstate'];
				$fatherzipcode = $rowsparent1['fatherzipcode'];
				$fatherworkphone = $rowsparent1['fatherworkphone'];
				$fathermobilephone = $rowsparent1['fathermobilephone'];
				$fatheremail = $rowsparent1['fatheremail'];
				$fatheremployment = $rowsparent1['fatheremployment'];
				$fatheroccupation = $rowsparent1['fatheroccupation'];
		 	}
		 	?>
		 	
		 
		 	
		 	<br />
		   <form method="post" action="<?php echo $PHP_SELF; ?>?edit=parent1&ap=<?php echo $app_id; ?>" enctype="multipart/form-data" onSubmit="return confirm('Are you ready to proceed?')">
<h1>Parent/Legal Guardian Information:</h1>
<hr>
<h1>Parent/Legal Guardian #1</h1><br />
		<fieldset><legend>Last Name </legend><ul><li><input type="text" size="25" name="flastname" value="<?php echo $fatherlastname;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>First Name</legend><ul><li> <input type="text" size="25" name="ffirstname" value="<?php echo $fatherfirstname;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Middle Name </legend><ul><li><input type="text" size="25" name="fmiddlename" value="<?php echo $fathermiddlename;?>" ></li></ul></fieldset>
		<span id="checkqty"></span>
		<fieldset><legend>Street Address </legend><ul><li><input type="text" size="25" value="<?php echo $fatheraddress;?>" onblur="selfaddresscheck(this)"  onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }" name="faddress"></li></ul></fieldset>
		<fieldset><legend>City </legend><ul><li><input type="text" size="25" name="fcity" value="<?php echo $fathercity;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>State</legend><ul><li><select name="fstate" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
			<option value=""></option>
			<option value="AL" <?php if($fatherstate=='AL') echo "selected='selected'";?>>Alabama</option>
			<option value="AK" <?php if($fatherstate=='AK') echo "selected='selected'";?>>Alaska</option>
			<option value="AZ" <?php if($fatherstate=='AZ') echo "selected='selected'";?>>Arizona</option>
			<option value="AR" <?php if($fatherstate=='AR') echo "selected='selected'";?>>Arkansas</option>
			<option value="CA" <?php if($fatherstate=='CA') echo "selected='selected'";?>>California</option>
			<option value="CO" <?php if($fatherstate=='CO') echo "selected='selected'";?>>Colorado</option>
			<option value="CT" <?php if($fatherstate=='CT') echo "selected='selected'";?>>Connecticut</option>
			<option value="DE" <?php if($fatherstate=='DE') echo "selected='selected'";?>>Delaware</option>
			<option value="DC" <?php if($fatherstate=='DC') echo "selected='selected'";?>>District of Columbia</option>
			<option value="FL" <?php if($fatherstate=='FL') echo "selected='selected'";?>>Florida</option>
			<option value="GA" <?php if($fatherstate=='GA') echo "selected='selected'";?>>Georgia</option>
			<option value="HI" <?php if($fatherstate=='HI') echo "selected='selected'";?>>Hawaii</option>
			<option value="ID" <?php if($fatherstate=='ID') echo "selected='selected'";?>>Idaho</option>
			<option value="IL" <?php if($fatherstate=='IL') echo "selected='selected'";?>>Illinois</option>
			<option value="IN" <?php if($fatherstate=='IN') echo "selected='selected'";?>>Indiana</option>
			<option value="IA" <?php if($fatherstate=='IA') echo "selected='selected'";?>>Iowa</option>
			<option value="KS" <?php if($fatherstate=='KS') echo "selected='selected'";?>>Kansas</option>
			<option value="KY" <?php if($fatherstate=='KY') echo "selected='selected'";?>>Kentucky</option>
			<option value="LA" <?php if($fatherstate=='LA') echo "selected='selected'";?>>Louisiana</option>
			<option value="ME" <?php if($fatherstate=='ME') echo "selected='selected'";?>>Maine</option>
			<option value="MD" <?php if($fatherstate=='MD') echo "selected='selected'";?>>Maryland</option>
			<option value="MA" <?php if($fatherstate=='MA') echo "selected='selected'";?>>Massachusetts</option>
			<option value="MI" <?php if($fatherstate=='MI') echo "selected='selected'";?>>Michigan</option>
			<option value="MN" <?php if($fatherstate=='MN') echo "selected='selected'";?>>Minnesota</option>
			<option value="MS" <?php if($fatherstate=='MS') echo "selected='selected'";?>>Mississippi</option>
			<option value="MO" <?php if($fatherstate=='MO') echo "selected='selected'";?>>Missouri</option>
			<option value="MT" <?php if($fatherstate=='MT') echo "selected='selected'";?>>Montana</option>
			<option value="NE" <?php if($fatherstate=='NE') echo "selected='selected'";?>>Nebraska</option>
			<option value="NV" <?php if($fatherstate=='NV') echo "selected='selected'";?>>Nevada</option>
			<option value="NH" <?php if($fatherstate=='NH') echo "selected='selected'";?>>New Hampshire</option>
			<option value="NJ" <?php if($fatherstate=='NJ') echo "selected='selected'";?>>New Jersey</option>
			<option value="NM" <?php if($fatherstate=='NM') echo "selected='selected'";?>>New Mexico</option>
			<option value="NY" <?php if($fatherstate=='NY') echo "selected='selected'";?>>New York</option>
			<option value="NC" <?php if($fatherstate=='NC') echo "selected='selected'";?>>North Carolina</option>
			<option value="ND" <?php if($fatherstate=='ND') echo "selected='selected'";?>>North Dakota</option>
			<option value="OH" <?php if($fatherstate=='OH') echo "selected='selected'";?>>Ohio</option>
			<option value="OK" <?php if($fatherstate=='OK') echo "selected='selected'";?>>Oklahoma</option>
			<option value="OR" <?php if($fatherstate=='OR') echo "selected='selected'";?>>Oregon</option>
			<option value="PA" <?php if($fatherstate=='PA') echo "selected='selected'";?>>Pennsylvania</option>
			<option value="RI" <?php if($fatherstate=='RI') echo "selected='selected'";?>>Rhode Island</option>
			<option value="SC" <?php if($fatherstate=='SC') echo "selected='selected'";?>>South Carolina</option>
			<option value="SD" <?php if($fatherstate=='SD') echo "selected='selected'";?>>South Dakota</option>
			<option value="TN" <?php if($fatherstate=='TN') echo "selected='selected'";?>>Tennessee</option>
			<option value="TX" <?php if($fatherstate=='TX') echo "selected='selected'";?>>Texas</option>
			<option value="UT" <?php if($fatherstate=='UT') echo "selected='selected'";?>>Utah</option>
			<option value="VT" <?php if($fatherstate=='VT') echo "selected='selected'";?>>Vermont</option>
			<option value="VA" <?php if($fatherstate=='VA') echo "selected='selected'";?>>Virginia</option>
			<option value="WA" <?php if($fatherstate=='WA') echo "selected='selected'";?>>Washington</option>
			<option value="WV" <?php if($fatherstate=='WY') echo "selected='selected'";?>>West Virginia</option>
			<option value="WI" <?php if($fatherstate=='WI') echo "selected='selected'";?>>Wisconsin</option>
			<option value="WY" <?php if($fatherstate=='WY') echo "selected='selected'";?>>Wyoming</option>
		</select></li></ul></fieldset>
		<fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" name="fzipcode" value="<?php echo $fatherzipcode;?>" onblur="selfzipcodecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Work Phone</legend><ul><li><input type="text" size="25" name="fworkphone" value="<?php echo $fatherworkphone;?>" onblur="selfphonecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Home Phone:</legend><ul><li><input type="text" size="25" name="fmobilephone" value="<?php echo $fathermobilephone;?>" onblur="selfphonecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Email Address: </legend><ul><li><input type="text" size="25" name="femail" value="<?php echo $fatheremail;?>" onblur="selfemailcheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }else if(this.value == '*Email Must be in proper format'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Place of Employment</legend><ul><li><input type="text" size="25" name="femployment" value="<?php echo $fatheremployment;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field' || this.value == '*Email Must be in proper format'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Occupation</legend><ul><li><input type="text" size="25" name="foccupation" value="<?php echo $fatheroccupation;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <input name="edit" type="hidden" size="1" id="userlevel" value="parent1" > <br />
		   <fieldset><ul><li><input type="submit" value="Edit Guardian Information" name="editparent1"></li></ul></fieldset> 
		   </form>
		<?php
		}

		if(isset($_GET['edit']) && $_GET['edit'] == "parent2"){
			$app_id = $_GET['ap'];
			$err = "";
			$i = 0;
			if(isset($_POST['editparent2'])){
			if (!empty($_POST['mfirstname'])){
				$motherfirstname = mysql_real_escape_string($_POST['mfirstname']);
			}else{
				$i = 1;
				$err.= "Please fill in the first name for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mlastname'])){
				$motherlastname = mysql_real_escape_string($_POST['mlastname']);
			}else{
				$i = 1;
				$err.= "Please fill in the last name for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mmiddlename'])){
				$mothermiddlename = mysql_real_escape_string($_POST['mmiddlename']);
			}else{
				$mothermiddlename = "";
			}

			if (!empty($_POST['maddress'])){
				$motheraddress = mysql_real_escape_string($_POST['maddress']);
			}else{
				$i = 1;
				$err.= "Please fill in address for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mcity'])){
				$mothercity = mysql_real_escape_string($_POST['mcity']);
			}else{
				$i = 1;
				$err.= "Please fill in city for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mstate'])){
				$motherstate = mysql_real_escape_string($_POST['mstate']);
			}else{
				$i = 1;
				$err.= "Please fill in state for Parent/Legal Guardian #1";
				$err.= "<br />";
			}

			if (!empty($_POST['mzipcode'])){
				$motherzipcode = mysql_real_escape_string($_POST['mzipcode']);
			}else{
				$i = 1;
				$err.= "Please fill in zip code for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mworkphone'])){
				$motherworkphone = mysql_real_escape_string($_POST['mworkphone']);
			}else{
				$i = 1;
				$err.= "Please fill in work number for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mmobilephone'])){
				$mothermobilephone = mysql_real_escape_string($_POST['mmobilephone']);
			}else{
				$i = 1;
				$err.= "Please fill in phone number for Parent/Legal Guardian #1";
				$err.= "<br />";
			}


			if (!empty($_POST['memail'])){
				if (filter_var($_POST['memail'], FILTER_VALIDATE_EMAIL)) {
	  				$motheremail = mysql_real_escape_string($_POST['memail']);
				} else {
	 				$i = 1;
					$err.= "Email provided for Parent/Legal Guardian #1 was not in the proper format";
	 				$err.= "<br />";
				}   	
			}else{
				$i = 1;
				$err.= "Please fill in email for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['memployment'])){
				$motheremployment = mysql_real_escape_string($_POST['memployment']);
			}else{
				$i = 1;
				$err.= "Please fill employment for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['moccupation'])){
				$motheroccupation = mysql_real_escape_string($_POST['moccupation']);
			}else{
				$i = 1;
				$err.= "Please fill in occupation for Parent/Legal Guardian #1";
				$err.= "<br />";
			}


				
				//if(isset($_POST['visit'])){$visit=$_POST['visit'];}else{$visit="";}
				if($i <> 1){

					mysql_query("UPDATE `applicant` SET motherfirstname='$motherfirstname' ,motherlastname='$motherlastname', mothermiddlename='$mothermiddlename', motheraddress='$motheraddress', mothercity='$mothercity', motherstate='$motherstate', motherzipcode='$motherzipcode', motherworkphone='$motherworkphone', mothermobilephone='$mothermobilephone', motheremail='$motheremail', motheremployment='$motheremployment', motheroccupation='$motheroccupation' WHERE app_id='$app_id'") or die(mysql_error()); 
			?>			
			<script type="text/javascript">
			<!--
			window.location = "http://www.sja.us/application.php"
			//-->
			</script>			
				
		 	<?php }else{
		 	?>
		 		<script type="text/javascript">
		 		<!--
		 		window.location = "http://www.sja.us/application.php?error=<?php echo $err; ?>"
		 		//-->
		 		</script>		
		 	
		 	
		 	<?php
		 			}
		 	} 
		 	$edit_parent2_sql = "SELECT * FROM `applicant` WHERE app_id='$app_id'";
		 	$edit_parent2_result = mysql_query($edit_parent2_sql);
		 	while($rowsparent2 = mysql_fetch_array($edit_parent2_result)){
				$cookie_id = $rowsparent2['cookie_id'];
				$app_id = $rowsparent2['app_id'];
				$motherfirstname = $rowsparent2['motherfirstname'];
				$motherlastname = $rowsparent2['motherlastname'];
				$mothermiddlename = $rowsparent2['mothermiddlename'];
				$motheraddress = $rowsparent2['motheraddress'];
				$mothercity = $rowsparent2['mothercity'];
				$motherstate = $rowsparent2['motherstate'];
				$motherzipcode = $rowsparent2['motherzipcode'];
				$motherworkphone = $rowsparent2['motherworkphone'];
				$mothermobilephone = $rowsparent2['mothermobilephone'];
				$motheremail = $rowsparent2['motheremail'];
				$motheremployment = $rowsparent2['motheremployment'];
				$motheroccupation = $rowsparent2['motheroccupation'];
		 	}
		 	?>
		 	
		 
		 	
		 	<br />
		   <form method="post" action="<?php echo $PHP_SELF; ?>?edit=parent2&ap=<?php echo $app_id; ?>" enctype="multipart/form-data" onSubmit="return confirm('Are you ready to proceed?')">
<h1>Parent/Legal Guardian Information:</h1>
<hr>
<h1>Parent/Legal Guardian #1</h1><br />
		<fieldset><legend>Last Name </legend><ul><li><input type="text" size="25" name="mlastname" value="<?php echo $motherlastname;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>First Name</legend><ul><li> <input type="text" size="25" name="mfirstname" value="<?php echo $motherfirstname;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Middle Name </legend><ul><li><input type="text" size="25" name="mmiddlename" value="<?php echo $mothermiddlename;?>" ></li></ul></fieldset>
		<span id="checkqty"></span>
		<fieldset><legend>Street Address </legend><ul><li><input type="text" size="25" value="<?php echo $motheraddress;?>" onblur="selfaddresscheck(this)"  onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }" name="maddress"></li></ul></fieldset>
		<fieldset><legend>City </legend><ul><li><input type="text" size="25" name="mcity" value="<?php echo $mothercity;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>State</legend><ul><li><select name="mstate" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
			<option value=""></option>
			<option value="AL" <?php if($motherstate=='AL') echo "selected='selected'";?>>Alabama</option>
			<option value="AK" <?php if($motherstate=='AK') echo "selected='selected'";?>>Alaska</option>
			<option value="AZ" <?php if($motherstate=='AZ') echo "selected='selected'";?>>Arizona</option>
			<option value="AR" <?php if($motherstate=='AR') echo "selected='selected'";?>>Arkansas</option>
			<option value="CA" <?php if($motherstate=='CA') echo "selected='selected'";?>>California</option>
			<option value="CO" <?php if($motherstate=='CO') echo "selected='selected'";?>>Colorado</option>
			<option value="CT" <?php if($motherstate=='CT') echo "selected='selected'";?>>Connecticut</option>
			<option value="DE" <?php if($motherstate=='DE') echo "selected='selected'";?>>Delaware</option>
			<option value="DC" <?php if($motherstate=='DC') echo "selected='selected'";?>>District of Columbia</option>
			<option value="FL" <?php if($motherstate=='FL') echo "selected='selected'";?>>Florida</option>
			<option value="GA" <?php if($motherstate=='GA') echo "selected='selected'";?>>Georgia</option>
			<option value="HI" <?php if($motherstate=='HI') echo "selected='selected'";?>>Hawaii</option>
			<option value="ID" <?php if($motherstate=='ID') echo "selected='selected'";?>>Idaho</option>
			<option value="IL" <?php if($motherstate=='IL') echo "selected='selected'";?>>Illinois</option>
			<option value="IN" <?php if($motherstate=='IN') echo "selected='selected'";?>>Indiana</option>
			<option value="IA" <?php if($motherstate=='IA') echo "selected='selected'";?>>Iowa</option>
			<option value="KS" <?php if($motherstate=='KS') echo "selected='selected'";?>>Kansas</option>
			<option value="KY" <?php if($motherstate=='KY') echo "selected='selected'";?>>Kentucky</option>
			<option value="LA" <?php if($motherstate=='LA') echo "selected='selected'";?>>Louisiana</option>
			<option value="ME" <?php if($motherstate=='ME') echo "selected='selected'";?>>Maine</option>
			<option value="MD" <?php if($motherstate=='MD') echo "selected='selected'";?>>Maryland</option>
			<option value="MA" <?php if($motherstate=='MA') echo "selected='selected'";?>>Massachusetts</option>
			<option value="MI" <?php if($motherstate=='MI') echo "selected='selected'";?>>Michigan</option>
			<option value="MN" <?php if($motherstate=='MN') echo "selected='selected'";?>>Minnesota</option>
			<option value="MS" <?php if($motherstate=='MS') echo "selected='selected'";?>>Mississippi</option>
			<option value="MO" <?php if($motherstate=='MO') echo "selected='selected'";?>>Missouri</option>
			<option value="MT" <?php if($motherstate=='MT') echo "selected='selected'";?>>Montana</option>
			<option value="NE" <?php if($motherstate=='NE') echo "selected='selected'";?>>Nebraska</option>
			<option value="NV" <?php if($motherstate=='NV') echo "selected='selected'";?>>Nevada</option>
			<option value="NH" <?php if($motherstate=='NH') echo "selected='selected'";?>>New Hampshire</option>
			<option value="NJ" <?php if($motherstate=='NJ') echo "selected='selected'";?>>New Jersey</option>
			<option value="NM" <?php if($motherstate=='NM') echo "selected='selected'";?>>New Mexico</option>
			<option value="NY" <?php if($motherstate=='NY') echo "selected='selected'";?>>New York</option>
			<option value="NC" <?php if($motherstate=='NC') echo "selected='selected'";?>>North Carolina</option>
			<option value="ND" <?php if($motherstate=='ND') echo "selected='selected'";?>>North Dakota</option>
			<option value="OH" <?php if($motherstate=='OH') echo "selected='selected'";?>>Ohio</option>
			<option value="OK" <?php if($motherstate=='OK') echo "selected='selected'";?>>Oklahoma</option>
			<option value="OR" <?php if($motherstate=='OR') echo "selected='selected'";?>>Oregon</option>
			<option value="PA" <?php if($motherstate=='PA') echo "selected='selected'";?>>Pennsylvania</option>
			<option value="RI" <?php if($motherstate=='RI') echo "selected='selected'";?>>Rhode Island</option>
			<option value="SC" <?php if($motherstate=='SC') echo "selected='selected'";?>>South Carolina</option>
			<option value="SD" <?php if($motherstate=='SD') echo "selected='selected'";?>>South Dakota</option>
			<option value="TN" <?php if($motherstate=='TN') echo "selected='selected'";?>>Tennessee</option>
			<option value="TX" <?php if($motherstate=='TX') echo "selected='selected'";?>>Texas</option>
			<option value="UT" <?php if($motherstate=='UT') echo "selected='selected'";?>>Utah</option>
			<option value="VT" <?php if($motherstate=='VT') echo "selected='selected'";?>>Vermont</option>
			<option value="VA" <?php if($motherstate=='VA') echo "selected='selected'";?>>Virginia</option>
			<option value="WA" <?php if($motherstate=='WA') echo "selected='selected'";?>>Washington</option>
			<option value="WV" <?php if($motherstate=='WY') echo "selected='selected'";?>>West Virginia</option>
			<option value="WI" <?php if($motherstate=='WI') echo "selected='selected'";?>>Wisconsin</option>
			<option value="WY" <?php if($motherstate=='WY') echo "selected='selected'";?>>Wyoming</option>
		</select></li></ul></fieldset>
		<fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" name="mzipcode" value="<?php echo $motherzipcode;?>" onblur="selfzipcodecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Work Phone</legend><ul><li><input type="text" size="25" name="mworkphone" value="<?php echo $motherworkphone;?>" onblur="selfphonecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Home Phone:</legend><ul><li><input type="text" size="25" name="mmobilephone" value="<?php echo $mothermobilephone;?>" onblur="selfphonecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Email Address: </legend><ul><li><input type="text" size="25" name="memail" value="<?php echo $motheremail;?>" onblur="selfemailcheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }else if(this.value == '*Email Must be in proper format'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Place of Employment</legend><ul><li><input type="text" size="25" name="memployment" value="<?php echo $motheremployment;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field' || this.value == '*Email Must be in proper format'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Occupation</legend><ul><li><input type="text" size="25" name="moccupation" value="<?php echo $motheroccupation;?>" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <input name="edit" type="hidden" size="1" id="userlevel" value="parent1" > <br />
		   <fieldset><ul><li><input type="submit" value="Edit Guardian2 Information" name="editparent2"></li></ul></fieldset> 
		   </form>
		<?php
		}


		if(isset($_GET['add']) && $_GET['add'] == "parent2"){
			$app_id = $_GET['ap'];
			$err = "";
			$i = 0;
			if(isset($_POST['addparent2'])){
			if (!empty($_POST['mfirstname'])){
				$motherfirstname = mysql_real_escape_string($_POST['mfirstname']);
			}else{
				$i = 1;
				$err.= "Please fill in the first name for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mlastname'])){
				$motherlastname = mysql_real_escape_string($_POST['mlastname']);
			}else{
				$i = 1;
				$err.= "Please fill in the last name for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mmiddlename'])){
				$mothermiddlename = mysql_real_escape_string($_POST['mmiddlename']);
			}else{
				$mothermiddlename = "";
			}

			if (!empty($_POST['maddress'])){
				$motheraddress = mysql_real_escape_string($_POST['maddress']);
			}else{
				$i = 1;
				$err.= "Please fill in address for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mcity'])){
				$mothercity = mysql_real_escape_string($_POST['mcity']);
			}else{
				$i = 1;
				$err.= "Please fill in city for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mstate'])){
				$motherstate = mysql_real_escape_string($_POST['mstate']);
			}else{
				$i = 1;
				$err.= "Please fill in state for Parent/Legal Guardian #1";
				$err.= "<br />";
			}

			if (!empty($_POST['mzipcode'])){
				$motherzipcode = mysql_real_escape_string($_POST['mzipcode']);
			}else{
				$i = 1;
				$err.= "Please fill in zip code for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mworkphone'])){
				$motherworkphone = mysql_real_escape_string($_POST['mworkphone']);
			}else{
				$i = 1;
				$err.= "Please fill in work number for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['mmobilephone'])){
				$mothermobilephone = mysql_real_escape_string($_POST['mmobilephone']);
			}else{
				$i = 1;
				$err.= "Please fill in phone number for Parent/Legal Guardian #1";
				$err.= "<br />";
			}


			if (!empty($_POST['memail'])){
				if (filter_var($_POST['memail'], FILTER_VALIDATE_EMAIL)) {
	  				$motheremail = mysql_real_escape_string($_POST['memail']);
				} else {
	 				$i = 1;
					$err.= "Email provided for Parent/Legal Guardian #1 was not in the proper format";
	 				$err.= "<br />";
				}   	
			}else{
				$i = 1;
				$err.= "Please fill in email for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['memployment'])){
				$motheremployment = mysql_real_escape_string($_POST['memployment']);
			}else{
				$i = 1;
				$err.= "Please fill employment for Parent/Legal Guardian #1";
				$err.= "<br />";
			}
	
			if (!empty($_POST['moccupation'])){
				$motheroccupation = mysql_real_escape_string($_POST['moccupation']);
			}else{
				$i = 1;
				$err.= "Please fill in occupation for Parent/Legal Guardian #1";
				$err.= "<br />";
			}


				
				//if(isset($_POST['visit'])){$visit=$_POST['visit'];}else{$visit="";}
				if($i <> 1){

					mysql_query("UPDATE `applicant` SET motherfirstname='$motherfirstname' ,motherlastname='$motherlastname', mothermiddlename='$mothermiddlename', motheraddress='$motheraddress', mothercity='$mothercity', motherstate='$motherstate', motherzipcode='$motherzipcode', motherworkphone='$motherworkphone', mothermobilephone='$mothermobilephone', motheremail='$motheremail', motheremployment='$motheremployment', motheroccupation='$motheroccupation' WHERE app_id='$app_id'") or die(mysql_error()); 
			?>			
			<script type="text/javascript">
			<!--
			window.location = "http://www.sja.us/application.php"
			//-->
			</script>			
				
		 	<?php }else{
		 	?>
		 		<script type="text/javascript">
		 		<!--
		 		window.location = "http://www.sja.us/application.php?error=<?php echo $err; ?>"
		 		//-->
		 		</script>		
		 	
		 	
		 	<?php
		 			}
		 	} 
		 	$edit_parent1_sql = "SELECT * FROM `applicant` WHERE app_id='$app_id'";
		 	$edit_parent1_result = mysql_query($edit_parent1_sql);
		 	while($rowsparent1 = mysql_fetch_array($edit_parent1_result)){
				$cookie_id = $rowsparent1['cookie_id'];
				$app_id = $rowsparent1['app_id'];
				$motherfirstname = $rowsparent1['motherfirstname'];
				$motherlastname = $rowsparent1['motherlastname'];
				$mothermiddlename = $rowsparent1['mothermiddlename'];
				$motheraddress = $rowsparent1['motheraddress'];
				$mothercity = $rowsparent1['mothercity'];
				$motherstate = $rowsparent1['motherstate'];
				$motherzipcode = $rowsparent1['motherzipcode'];
				$motherworkphone = $rowsparent1['motherworkphone'];
				$mothermobilephone = $rowsparent1['mothermobilephone'];
				$motheremail = $rowsparent1['motheremail'];
				$motheremployment = $rowsparent1['motheremployment'];
				$motheroccupation = $rowsparent1['motheroccupation'];
		 	}
		 	?> 	
		 	<br />
		   <form method="post" action="<?php echo $PHP_SELF; ?>?add=parent2&ap=<?php echo $app_id; ?>" enctype="multipart/form-data" onSubmit="return confirm('Are you ready to proceed?')">
<hr>
<h1>Add Parent/Legal Guardian</h1><br />
		<fieldset><legend>Last Name </legend><ul><li><input type="text" size="25" name="mlastname" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>First Name</legend><ul><li> <input type="text" size="25" name="mfirstname" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Middle Name </legend><ul><li><input type="text" size="25" name="mmiddlename" ></li></ul></fieldset>
		<span id="checkqty"></span>
		<fieldset><legend>Street Address </legend><ul><li><input type="text" size="25" onblur="selfaddresscheck(this)"  onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }" name="maddress"></li></ul></fieldset>
		<fieldset><legend>City </legend><ul><li><input type="text" size="25" name="mcity" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>State</legend><ul><li><select name="mstate" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
			<option value=""></option>
			<option value="AL" >Alabama</option>
			<option value="AK" >Alaska</option>
			<option value="AZ" >Arizona</option>
			<option value="AR" >Arkansas</option>
			<option value="CA" >California</option>
			<option value="CO" >Colorado</option>
			<option value="CT" >Connecticut</option>
			<option value="DE" >Delaware</option>
			<option value="DC" >District of Columbia</option>
			<option value="FL" >Florida</option>
			<option value="GA" >Georgia</option>
			<option value="HI" >Hawaii</option>
			<option value="ID" >Idaho</option>
			<option value="IL" >Illinois</option>
			<option value="IN" >Indiana</option>
			<option value="IA" >Iowa</option>
			<option value="KS" >Kansas</option>
			<option value="KY" >Kentucky</option>
			<option value="LA" >Louisiana</option>
			<option value="ME" >Maine</option>
			<option value="MD" >Maryland</option>
			<option value="MA" >Massachusetts</option>
			<option value="MI" >Michigan</option>
			<option value="MN" >Minnesota</option>
			<option value="MS" >Mississippi</option>
			<option value="MO" >Missouri</option>
			<option value="MT" >Montana</option>
			<option value="NE" >Nebraska</option>
			<option value="NV" >Nevada</option>
			<option value="NH" >New Hampshire</option>
			<option value="NJ" >New Jersey</option>
			<option value="NM" >New Mexico</option>
			<option value="NY" >New York</option>
			<option value="NC" >North Carolina</option>
			<option value="ND" >North Dakota</option>
			<option value="OH" >Ohio</option>
			<option value="OK" >Oklahoma</option>
			<option value="OR" >Oregon</option>
			<option value="PA" >Pennsylvania</option>
			<option value="RI" >Rhode Island</option>
			<option value="SC" >South Carolina</option>
			<option value="SD" >South Dakota</option>
			<option value="TN" >Tennessee</option>
			<option value="TX" >Texas</option>
			<option value="UT" >Utah</option>
			<option value="VT" >Vermont</option>
			<option value="VA" >Virginia</option>
			<option value="WA" >Washington</option>
			<option value="WV" >West Virginia</option>
			<option value="WI" >Wisconsin</option>
			<option value="WY" >Wyoming</option>
		</select></li></ul></fieldset>
		<fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" name="mzipcode" onblur="selfzipcodecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Work Phone</legend><ul><li><input type="text" size="25" name="mworkphone" onblur="selfphonecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Home Phone:</legend><ul><li><input type="text" size="25" name="mmobilephone" onblur="selfphonecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Email Address: </legend><ul><li><input type="text" size="25" name="memail" onblur="selfemailcheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }else if(this.value == '*Email Must be in proper format'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Place of Employment</legend><ul><li><input type="text" size="25" name="memployment" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field' || this.value == '*Email Must be in proper format'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Occupation</legend><ul><li><input type="text" size="25" name="moccupation" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		   <input name="edit" type="hidden" size="1" id="userlevel" value="parent2" > <br />
		   <fieldset><ul><li><input type="submit" value="Add Guardian" name="addparent2"></li></ul></fieldset> 
		   </form>
		<?php
		}

if(!isset($_POST['page']) && !isset($_GET['page']) && !isset($_COOKIE["recordkeeper"])){
	// show form pg 1 
	?>
  <form method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data" name="firstform" onSubmit="return confirm('Are you ready to proceed?')">
<h1><?php echo $pagetitle; ?> </h1>
<p><strong>Please fill out the form below.  Cookies must be enabled in your browser in order to complete the submission of this form.  When moving though each of the fields please use the mouse or tab button. </strong></p>
	<hr/>
<h2>Student Information</h2>
 <hr>
 <h2>Basic Information</h2><br/>
 	 <fieldset><legend>Last Name</legend><ul><li><input type="text" size="25" name="applastname" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
    <fieldset><legend>First Name</legend><ul><li><input type="text" size="25" name="appfirstname" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
 <fieldset><legend>Middle Name</legend><ul><li><input type="text" size="25" name="appmiddlename" ></li></ul></fieldset>
 <fieldset><legend>Street Address</legend><ul><li><input type="text" size="25" name="appstreetaddress" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
 <fieldset><legend>City</legend><ul><li><input type="text" size="25" name="appcity" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
 <fieldset><legend>State</legend><ul><li><select name="appstate" onblur="selfmessage(this)">
 	<option value=""></option>
 	<option value="AL">Alabama</option>
 	<option value="AK">Alaska</option>
 	<option value="AZ">Arizona</option>
 	<option value="AR">Arkansas</option>
 	<option value="CA">California</option>
 	<option value="CO">Colorado</option>
 	<option value="CT">Connecticut</option>
 	<option value="DE">Delaware</option>
 	<option value="DC">District of Columbia</option>
 	<option value="FL">Florida</option>
 	<option value="GA">Georgia</option>
 	<option value="HI">Hawaii</option>
 	<option value="ID">Idaho</option>
 	<option value="IL">Illinois</option>
 	<option value="IN">Indiana</option>
 	<option value="IA">Iowa</option>
 	<option value="KS">Kansas</option>
 	<option value="KY">Kentucky</option>
 	<option value="LA">Louisiana</option>
 	<option value="ME">Maine</option>
 	<option value="MD">Maryland</option>
 	<option value="MA">Massachusetts</option>
 	<option value="MI">Michigan</option>
 	<option value="MN">Minnesota</option>
 	<option value="MS">Mississippi</option>
 	<option value="MO">Missouri</option>
 	<option value="MT">Montana</option>
 	<option value="NE">Nebraska</option>
 	<option value="NV">Nevada</option>
 	<option value="NH">New Hampshire</option>
 	<option value="NJ">New Jersey</option>
 	<option value="NM">New Mexico</option>
 	<option value="NY">New York</option>
 	<option value="NC">North Carolina</option>
 	<option value="ND">North Dakota</option>
 	<option value="OH">Ohio</option>
 	<option value="OK">Oklahoma</option>
 	<option value="OR">Oregon</option>
 	<option value="PA">Pennsylvania</option>
 	<option value="RI">Rhode Island</option>
 	<option value="SC">South Carolina</option>
 	<option value="SD">South Dakota</option>
 	<option value="TN">Tennessee</option>
 	<option value="TX">Texas</option>
 	<option value="UT">Utah</option>
 	<option value="VT">Vermont</option>
 	<option value="VA">Virginia</option>
 	<option value="WA">Washington</option>
 	<option value="WV">West Virginia</option>
 	<option value="WI">Wisconsin</option>
 	<option value="WY">Wyoming</option>
 </select></li></ul></fieldset>
 <fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" name="appzipcode" onblur="selfzipcodecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset><br />
 	    <hr>
 <h2>Select grade child will attend:</h2>	<br/>    		
 <input type="radio" name="grade" value="seven" onClick="document.getElementById('newmale').focus();"><span class="formText"> Seven </span><br />
 <input type="radio" name="grade" value="eight" onClick="document.getElementById('newmale').focus();"><span class="formText"> Eight</span><br />
 <input type="radio" name="grade" value="nine" onClick="document.getElementById('newmale').focus();" checked><span class="formText"> Nine</span><br />
 <input type="radio" name="grade" value="ten" onClick="document.getElementById('newmale').focus();"><span class="formText"> Ten</span><br />
 <input type="radio" name="grade" value="eleven" onClick="document.getElementById('newmale').focus();"><span class="formText"> Eleven</span><br />
 <input type="radio" name="grade" value="twelve" onClick="document.getElementById('newmale').focus();"><span class="formText"> Twelve</span><br /><br />
 <hr>
  <h2>Select applicant's gender:</h2><br/>
  <input type="radio" name="gender" value="male" id="newmale" onClick="document.getElementById('newlanguage').focus();" checked><span class="formText" > Male</span><br />
  <input type="radio" name="gender" value="female" onClick="document.getElementById('newlanguage').focus();"><span class="formText" > Female</span><br /><br />
  <hr>

  <h2>Foreign Language Study</h2><br />
  	    <p>Please indicate the number of years of high school foreign language study the applicant has completed.</p>
  <fieldset><legend>Language</legend><ul><li><input type="text" size="25" name="language" id="newlanguage" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
  <fieldset><legend>Years of Study</legend><ul><li><input type="text" size="25" name="yearsofstudy" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset><br />
  <p>* If the applicant has <strong>not</strong> completed 3 years of high school foreign language, please indicate the language <strong>preferred</strong> to fulfill the requirement.</p>
	<span class="formText">French</span><input type="checkbox" name="french" value="yes"> 
	<span class="formText">Spanish</span><input type="checkbox" name="spanish" value="yes"><br /><br />
  	    		<hr>
  <h2>Class Grades/Credits</h2><br />
  <p>Please list the classes the applicant is currently taking and indicate if the applicant is passing or failing
  each class as of this date.</p>
  	    	
  <fieldset>Math
  <ul><li><select name="class1" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
  	<option value=""></option>
  	<option value="6th Math">6th Math</option>
  	<option value="7th Math">7th Math</option>
  	<option value="Pre-Algebra">Pre-Algebra</option>
  	<option value="Algebra I">Algebra I</option>
  	<option value="Geometry">Geometry</option>
  	<option value="Algebra II">Algebra II</option>
  	<option value="Pre-Calculus">Pre-Calculus</option>
  	<option value="Calculus">Calculus</option>
  </select></li></ul>
  </fieldset>
  <span class="formText">  Pass</span><input type="radio" name="passfail1" value="pass" onClick="document.getElementById('new6th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail1" value="fail" onClick="document.getElementById('new6th').focus();"><br /><br/>
  <fieldset>Science
  <ul><li><select name="class2" onblur="selfmessage(this)" id="new6th" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
  	<option value=""></option>
  	<option value="6th Science">6th Science</option>
  	<option value="7th Science">7th Science</option>
  	<option value="8th Science">8th Science</option>
  	<option value="Biology">Biology</option>
  	<option value="Chemistry">Chemistry</option>
  	<option value="Physics">Physics</option>
  	<option value="Science-Elective">Science-Elective</option>
  </select></li></ul>
  </fieldset>
  <span class="formText">   Pass</span><input type="radio" name="passfail2" value="pass" onClick="document.getElementById('new7th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail2" value="fail" onClick="document.getElementById('new7th').focus();"><br /><br/>
  <fieldset>Social Studies
  <ul><li><select name="class3" onblur="selfmessage(this)" id="new7th" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
  	<option value=""></option>
  	<option value="6th Social Studies">6th Social Studies</option>
  	<option value="Texas History">Texas History</option>
  	<option value="U.S. History 8th">U.S. History (8th)</option>
  	<option value="World Geography">World Geography</option>
  	<option value="World History">World History</option>
  	<option value="U.S. History 11th">U.S. History (11th)</option>
  	<option value="Economics">Economics</option>
  	<option value="American Government">American Government</option>
  </select></li></ul>
  </fieldset>
  <span class="formText">   Pass</span><input type="radio" name="passfail3" value="pass" onClick="document.getElementById('new8th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail3" value="fail" onClick="document.getElementById('new8th').focus();"><br /><br/>
  <fieldset>English
  <ul><li><select name="class4" onblur="selfmessage(this)" id="new8th" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
  	<option value=""></option>
  	<option value="6th Language Arts">6th Language Arts</option>
  	<option value="7th Language Arts">7th Language Arts</option>
  	<option value="8th Language Arts">8th Language Arts</option>
  	<option value="9th English">9th English</option>
  	<option value="10th English">10th English</option>
  	<option value="11th English">11th English</option>
  	<option value="12th English">12th English</option>
  </select></li></ul>
  </fieldset>
  <span class="formText">   Pass</span><input type="radio" name="passfail4" value="pass" onClick="document.getElementById('new9th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail4" value="fail" onClick="document.getElementById('new9th').focus();"><br /><br/>
  <fieldset>Other Classes (optional)<ul><li><input type="text" size="25" name="class5" id="new9th"></li></ul></fieldset><span class="formText">   Pass</span><input type="radio" name="passfail5" value="pass" onClick="document.getElementById('new10th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail5" value="fail" onClick="document.getElementById('new10th').focus();"><br /><br/>
  <fieldset><ul><li><input type="text" size="25" name="class6" id="new10th"> </li></ul></fieldset><span class="formText"> Pass</span><input type="radio" name="passfail6" value="pass" onClick="document.getElementById('new11th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail6" value="fail" onClick="document.getElementById('new11th').focus();"><br /><br/>
  <fieldset> <ul><li><input type="text" size="25" name="class7" value="" id="new11th"></li></ul></fieldset><span class="formText">   Pass</span><input type="radio" name="passfail7" value="pass" onClick="document.getElementById('new12th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail7" value="fail" onClick="document.getElementById('new12th').focus();"><br /><br/>
  <fieldset><ul><li><input type="text" size="25" name="class8" value="" id="new12th"></li></ul></fieldset><span class="formText">   Pass</span><input type="radio" name="passfail8" value="pass" onClick="document.getElementById('new13th').focus();"><span class="formText"> Fail</span><input type="radio" name="passfail8" value="fail" onClick="document.getElementById('new13th').focus();"><br /><br />
  	    		<hr>
 <h2>Special Services</h2><p>If yes, a current assessment of the diagnosed disability must be received at least one week prior to the entrance exam date to allow for appropriate accommodations.</p>  <br />
  	    	
  <input type="radio" name="diagnosis" value="no" id="new13th" onClick="document.getElementById('newfathersname').focus();"><span class="formText" > No Diagnosed Learning Differences</span><br />
  <input type="radio" name="diagnosis" value="yes" onClick="document.getElementById('newother').focus();"><span class="formText"> Applicant has been diagnosed with the following</span><br /><br/>
  
  <fieldset>
  	<ul>
  		<li><textarea name="other" id="newother"></textarea> </li>
  	</ul>
  </fieldset>
 
<hr>
<h1>Parent/Legal Guardian Information:</h1>
<hr>
<h1>Parent/Legal Guardian #1 (required)</h1><br />
		<fieldset><legend>Last Name </legend><ul><li><input type="text" size="25" name="flastname" id="newfathersname" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>First Name</legend><ul><li> <input type="text" size="25" name="ffirstname" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Middle Name </legend><ul><li><input type="text" size="25" name="fmiddlename" ></li></ul></fieldset>
		<span id="checkqty"></span>
		<fieldset><legend>Street Address </legend><ul><li><input type="text" size="25" onblur="selfaddresscheck(this)"  onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }" name="faddress"></li></ul></fieldset>
		<fieldset><legend>City </legend><ul><li><input type="text" size="25" name="fcity" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>State</legend><ul><li><select name="fstate" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }">
			<option value=""></option>
			<option value="AL">Alabama</option>
			<option value="AK">Alaska</option>
			<option value="AZ">Arizona</option>
			<option value="AR">Arkansas</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DE">Delaware</option>
			<option value="DC">District of Columbia</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="IA">Iowa</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="ME">Maine</option>
			<option value="MD">Maryland</option>
			<option value="MA">Massachusetts</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MS">Mississippi</option>
			<option value="MO">Missouri</option>
			<option value="MT">Montana</option>
			<option value="NE">Nebraska</option>
			<option value="NV">Nevada</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NY">New York</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VT">Vermont</option>
			<option value="VA">Virginia</option>
			<option value="WA">Washington</option>
			<option value="WV">West Virginia</option>
			<option value="WI">Wisconsin</option>
			<option value="WY">Wyoming</option>
		</select></li></ul></fieldset>
		<fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" name="fzipcode" onblur="selfzipcodecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Work Phone</legend><ul><li><input type="text" size="25" name="fworkphone" onblur="selfphonecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Home Phone:</legend><ul><li><input type="text" size="25" name="fmobilephone" onblur="selfphonecheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Email Address: </legend><ul><li><input type="text" size="25" name="femail" onblur="selfemailcheck(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }else if(this.value == '*Email Must be in proper format'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Place of Employment</legend><ul><li><input type="text" size="25" name="femployment" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field' || this.value == '*Email Must be in proper format'){ this.value = ''; }"></li></ul></fieldset>
		<fieldset><legend>Occupation</legend><ul><li><input type="text" size="25" name="foccupation" onblur="selfmessage(this)" onclick="javascript: if(this.value == '*Required Field'){ this.value = ''; }"></li></ul></fieldset>

<h1>Parent/Legal Guardian #2 (optional)</h1><br />
		<fieldset><legend>Last Name </legend><ul><li><input type="text" size="25" name="mlastname" ></li></ul></fieldset>
		<fieldset><legend>First Name </legend><ul><li><input type="text" size="25" name="mfirstname" ></li></ul></fieldset>
		<fieldset><legend>Middle Name </legend><ul><li><input type="text" size="25" name="mmiddlename" value=""></li></ul></fieldset><br/>
		<input type="checkbox"name="sameaddress" onClick="checkAll(this.form)"value=""><span class="datetitle" style="margin-left:0px;"><span class="formText">Address same as above?</span></span>
		<fieldset><legend>Street Address </legend><ul><li><input type="text" size="25" name="maddress" onClick="checkAll(this.form)" value=""></li></ul></fieldset>
		<fieldset><legend>City </legend><ul><li><input type="text" size="25" name="mcity" onClick="checkAll(this.form)" value=""></li></ul></fieldset>
		<fieldset><legend>State</legend><ul><li><select name="mstate" onClick="checkAll(this.form)">
			<option value=""></option>
			<option value="AL">Alabama</option>
			<option value="AK">Alaska</option>
			<option value="AZ">Arizona</option>
			<option value="AR">Arkansas</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DE">Delaware</option>
			<option value="DC">District of Columbia</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="IA">Iowa</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="ME">Maine</option>
			<option value="MD">Maryland</option>
			<option value="MA">Massachusetts</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MS">Mississippi</option>
			<option value="MO">Missouri</option>
			<option value="MT">Montana</option>
			<option value="NE">Nebraska</option>
			<option value="NV">Nevada</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NY">New York</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VT">Vermont</option>
			<option value="VA">Virginia</option>
			<option value="WA">Washington</option>
			<option value="WV">West Virginia</option>
			<option value="WI">Wisconsin</option>
			<option value="WY">Wyoming</option>
		</select></li></ul></fieldset>
		<fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" name="mzipcode"  value=""></li></ul></fieldset>
		<fieldset><legend>Work Phone</legend><ul><li><input type="text" size="25" name="mworkphone" ></li></ul></fieldset>
		<fieldset><legend>Home Phone:</legend><ul><li><input type="text" size="25" name="mmobilephone" ></li></ul></fieldset>
		<fieldset><legend>Email Address: </legend><ul><li><input type="text" size="25" name="memail" ></li></ul></fieldset>
		<fieldset><legend>Place of Employment</legend><ul><li><input type="text" size="25" name="memployment" ></li></ul></fieldset>
		<fieldset><legend>Occupation</legend><ul><li><input type="text" size="25" name="moccupation" ></li></ul></fieldset>
		<hr>
<h1>U.S. Mailing Address (optional)</h1><br />

		<fieldset><legend>Address</legend><ul><li><input type="text" size="25" name="mailingaddress" value=""></li></ul></fieldset>
		<fieldset><legend>City</legend><ul><li><input type="text" size="25" name="mailingcity" value=""></li></ul></fieldset>
		<fieldset><legend>State</legend><ul><li><select name="mailingstate">
			<option value=""></option>
			<option value="AL">Alabama</option>
			<option value="AK">Alaska</option>
			<option value="AZ">Arizona</option>
			<option value="AR">Arkansas</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DE">Delaware</option>
			<option value="DC">District of Columbia</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="IA">Iowa</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="ME">Maine</option>
			<option value="MD">Maryland</option>
			<option value="MA">Massachusetts</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MS">Mississippi</option>
			<option value="MO">Missouri</option>
			<option value="MT">Montana</option>
			<option value="NE">Nebraska</option>
			<option value="NV">Nevada</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NY">New York</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VT">Vermont</option>
			<option value="VA">Virginia</option>
			<option value="WA">Washington</option>
			<option value="WV">West Virginia</option>
			<option value="WI">Wisconsin</option>
			<option value="WY">Wyoming</option>
		</select></li></ul></fieldset>
		<fieldset><legend>Zip Code</legend><ul><li><input type="text" size="25" name="mailingzipcode" value=""></li></ul></fieldset>
		<hr>
<h1>Legacy</h1>
<p>* Leave blank if not applicable.</p>

<fieldset><legend>Name</legend><ul><li><input type="text" size="25" name="legacyname1" value=""></li></ul></fieldset>
<fieldset><legend>Relationship to Applicant</legend><ul><li><input type="text" size="25" name="legacyrelationship1" value=""></li></ul></fieldset>
<fieldset><legend>Class of XXXX</legend><ul><li>
<select name="legacyclass1">
    <option></option>
    <option value="2012">2012</option>
    <option value="2011">2011</option>
    <option value="2010">2010</option>
    <option value="2009">2009</option>
    <option value="2008">2008</option>
    <option value="2007">2007</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <option value="2003">2003</option>
    <option value="2002">2002</option>
    <option value="2001">2001</option>
    <option value="2000">2000</option>
    <option value="1999">1999</option>
    <option value="1998">1998</option>
    <option value="1997">1997</option>
    <option value="1996">1996</option>
    <option value="1995">1995</option>
    <option value="1994">1994</option>
    <option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
    <option value="1980">1980</option>
    <option value="1979">1979</option>
    <option value="1978">1978</option>
    <option value="1977">1977</option>
    <option value="1976">1976</option>
    <option value="1975">1975</option>
    <option value="1974">1974</option>
    <option value="1973">1973</option>
    <option value="1972">1972</option>
    <option value="1971">1971</option>
    <option value="1970">1970</option>
    <option value="1969">1969</option>
    <option value="1968">1968</option>
    <option value="1967">1967</option>
    <option value="1966">1966</option>
    <option value="1965">1965</option>
    <option value="1964">1964</option>
    <option value="1963">1963</option>
    <option value="1962">1962</option>
    <option value="1961">1961</option>
    <option value="1960">1960</option>
    <option value="1959">1959</option>
    <option value="1958">1958</option>
    <option value="1957">1957</option>
    <option value="1956">1956</option>
    <option value="1955">1955</option>
    <option value="1954">1954</option>
    <option value="1953">1953</option>
    <option value="1952">1952</option>
    <option value="1951">1951</option>
    <option value="1950">1950</option>
    <option value="1949">1949</option>
    <option value="1948">1948</option>
    <option value="1947">1947</option>
    <option value="1946">1946</option>
    <option value="1945">1945</option>
    <option value="1944">1944</option>
    <option value="1943">1943</option>
    <option value="1942">1942</option>
    <option value="1941">1941</option>
    <option value="1940">1940</option>
    <option value="1939">1939</option>
    <option value="1938">1938</option>
    <option value="1937">1937</option>
    <option value="1936">1936</option>
    <option value="1935">1935</option>
    <option value="1934">1934</option>
    <option value="1933">1933</option>
    <option value="1932">1932</option>
    <option value="1931">1931</option>
    <option value="1930">1930</option>
    <option value="1929">1929</option>
    <option value="1928">1928</option>
    <option value="1927">1927</option>
    <option value="1926">1926</option>
    <option value="1925">1925</option>
    <option value="1924">1924</option>
    <option value="1923">1923</option>
    <option value="1922">1922</option>
    <option value="1921">1921</option>
    <option value="1920">1920</option>
    <option value="1919">1919</option>
    <option value="1918">1918</option>
    <option value="1917">1917</option>
    <option value="1916">1916</option>
    <option value="1915">1915</option>
    <option value="1914">1914</option>
    <option value="1913">1913</option>
    <option value="1912">1912</option>
    <option value="1911">1911</option>
    <option value="1910">1910</option>
    <option value="1909">1909</option>
    <option value="1908">1908</option>
    <option value="1907">1907</option>
    <option value="1906">1906</option>
    <option value="1905">1905</option>
    <option value="1904">1904</option>
    <option value="1903">1903</option>
    <option value="1902">1902</option>
    <option value="1901">1901</option>
    <option value="1900">1900</option>
</select> </li></ul></fieldset>
<br/><br/>
<fieldset><legend>Name</legend><ul><li><input type="text" size="25" name="legacyname2" value=""></li></ul></fieldset>
<fieldset><legend>Relationship to Applicant</legend><ul><li><input type="text" size="25" name="legacyrelationship2" value=""></li></ul></fieldset>
<fieldset><legend>Class of XXXX</legend><ul><li>
<select name="legacyclass2">
    <option></option>
    <option value="2012">2012</option>
    <option value="2011">2011</option>
    <option value="2010">2010</option>
    <option value="2009">2009</option>
    <option value="2008">2008</option>
    <option value="2007">2007</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <option value="2003">2003</option>
    <option value="2002">2002</option>
    <option value="2001">2001</option>
    <option value="2000">2000</option>
    <option value="1999">1999</option>
    <option value="1998">1998</option>
    <option value="1997">1997</option>
    <option value="1996">1996</option>
    <option value="1995">1995</option>
    <option value="1994">1994</option>
    <option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
    <option value="1980">1980</option>
    <option value="1979">1979</option>
    <option value="1978">1978</option>
    <option value="1977">1977</option>
    <option value="1976">1976</option>
    <option value="1975">1975</option>
    <option value="1974">1974</option>
    <option value="1973">1973</option>
    <option value="1972">1972</option>
    <option value="1971">1971</option>
    <option value="1970">1970</option>
    <option value="1969">1969</option>
    <option value="1968">1968</option>
    <option value="1967">1967</option>
    <option value="1966">1966</option>
    <option value="1965">1965</option>
    <option value="1964">1964</option>
    <option value="1963">1963</option>
    <option value="1962">1962</option>
    <option value="1961">1961</option>
    <option value="1960">1960</option>
    <option value="1959">1959</option>
    <option value="1958">1958</option>
    <option value="1957">1957</option>
    <option value="1956">1956</option>
    <option value="1955">1955</option>
    <option value="1954">1954</option>
    <option value="1953">1953</option>
    <option value="1952">1952</option>
    <option value="1951">1951</option>
    <option value="1950">1950</option>
    <option value="1949">1949</option>
    <option value="1948">1948</option>
    <option value="1947">1947</option>
    <option value="1946">1946</option>
    <option value="1945">1945</option>
    <option value="1944">1944</option>
    <option value="1943">1943</option>
    <option value="1942">1942</option>
    <option value="1941">1941</option>
    <option value="1940">1940</option>
    <option value="1939">1939</option>
    <option value="1938">1938</option>
    <option value="1937">1937</option>
    <option value="1936">1936</option>
    <option value="1935">1935</option>
    <option value="1934">1934</option>
    <option value="1933">1933</option>
    <option value="1932">1932</option>
    <option value="1931">1931</option>
    <option value="1930">1930</option>
    <option value="1929">1929</option>
    <option value="1928">1928</option>
    <option value="1927">1927</option>
    <option value="1926">1926</option>
    <option value="1925">1925</option>
    <option value="1924">1924</option>
    <option value="1923">1923</option>
    <option value="1922">1922</option>
    <option value="1921">1921</option>
    <option value="1920">1920</option>
    <option value="1919">1919</option>
    <option value="1918">1918</option>
    <option value="1917">1917</option>
    <option value="1916">1916</option>
    <option value="1915">1915</option>
    <option value="1914">1914</option>
    <option value="1913">1913</option>
    <option value="1912">1912</option>
    <option value="1911">1911</option>
    <option value="1910">1910</option>
    <option value="1909">1909</option>
    <option value="1908">1908</option>
    <option value="1907">1907</option>
    <option value="1906">1906</option>
    <option value="1905">1905</option>
    <option value="1904">1904</option>
    <option value="1903">1903</option>
    <option value="1902">1902</option>
    <option value="1901">1901</option>
    <option value="1900">1900</option>
</select> </li></ul></fieldset>
<br/><br/>
<fieldset><legend>Name</legend><ul><li><input type="text" size="25" name="legacyname3" value=""></li></ul></fieldset>
<fieldset><legend>Relationship to Applicant</legend><ul><li><input type="text" size="25" name="legacyrelationship3" value=""></li></ul></fieldset>
<fieldset><legend>Class of XXXX</legend><ul><li>
<select name="legacyclass3">
    <option></option>
    <option value="2012">2012</option>
    <option value="2011">2011</option>
    <option value="2010">2010</option>
    <option value="2009">2009</option>
    <option value="2008">2008</option>
    <option value="2007">2007</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <option value="2003">2003</option>
    <option value="2002">2002</option>
    <option value="2001">2001</option>
    <option value="2000">2000</option>
    <option value="1999">1999</option>
    <option value="1998">1998</option>
    <option value="1997">1997</option>
    <option value="1996">1996</option>
    <option value="1995">1995</option>
    <option value="1994">1994</option>
    <option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
    <option value="1980">1980</option>
    <option value="1979">1979</option>
    <option value="1978">1978</option>
    <option value="1977">1977</option>
    <option value="1976">1976</option>
    <option value="1975">1975</option>
    <option value="1974">1974</option>
    <option value="1973">1973</option>
    <option value="1972">1972</option>
    <option value="1971">1971</option>
    <option value="1970">1970</option>
    <option value="1969">1969</option>
    <option value="1968">1968</option>
    <option value="1967">1967</option>
    <option value="1966">1966</option>
    <option value="1965">1965</option>
    <option value="1964">1964</option>
    <option value="1963">1963</option>
    <option value="1962">1962</option>
    <option value="1961">1961</option>
    <option value="1960">1960</option>
    <option value="1959">1959</option>
    <option value="1958">1958</option>
    <option value="1957">1957</option>
    <option value="1956">1956</option>
    <option value="1955">1955</option>
    <option value="1954">1954</option>
    <option value="1953">1953</option>
    <option value="1952">1952</option>
    <option value="1951">1951</option>
    <option value="1950">1950</option>
    <option value="1949">1949</option>
    <option value="1948">1948</option>
    <option value="1947">1947</option>
    <option value="1946">1946</option>
    <option value="1945">1945</option>
    <option value="1944">1944</option>
    <option value="1943">1943</option>
    <option value="1942">1942</option>
    <option value="1941">1941</option>
    <option value="1940">1940</option>
    <option value="1939">1939</option>
    <option value="1938">1938</option>
    <option value="1937">1937</option>
    <option value="1936">1936</option>
    <option value="1935">1935</option>
    <option value="1934">1934</option>
    <option value="1933">1933</option>
    <option value="1932">1932</option>
    <option value="1931">1931</option>
    <option value="1930">1930</option>
    <option value="1929">1929</option>
    <option value="1928">1928</option>
    <option value="1927">1927</option>
    <option value="1926">1926</option>
    <option value="1925">1925</option>
    <option value="1924">1924</option>
    <option value="1923">1923</option>
    <option value="1922">1922</option>
    <option value="1921">1921</option>
    <option value="1920">1920</option>
    <option value="1919">1919</option>
    <option value="1918">1918</option>
    <option value="1917">1917</option>
    <option value="1916">1916</option>
    <option value="1915">1915</option>
    <option value="1914">1914</option>
    <option value="1913">1913</option>
    <option value="1912">1912</option>
    <option value="1911">1911</option>
    <option value="1910">1910</option>
    <option value="1909">1909</option>
    <option value="1908">1908</option>
    <option value="1907">1907</option>
    <option value="1906">1906</option>
    <option value="1905">1905</option>
    <option value="1904">1904</option>
    <option value="1903">1903</option>
    <option value="1902">1902</option>
    <option value="1901">1901</option>
    <option value="1900">1900</option>
</select> </li></ul></fieldset>
<br/><br/>
<fieldset><legend>Name</legend><ul><li><input type="text" size="25" name="legacyname4" value=""></li></ul></fieldset>
<fieldset><legend>Relationship to Applicant</legend><ul><li><input type="text" size="25" name="legacyrelationship4" value=""></li></ul></fieldset>
<fieldset><legend>Class of XXXX</legend><ul><li>
<select name="legacyclass4">
    <option></option>
    <option value="2012">2012</option>
    <option value="2011">2011</option>
    <option value="2010">2010</option>
    <option value="2009">2009</option>
    <option value="2008">2008</option>
    <option value="2007">2007</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <option value="2003">2003</option>
    <option value="2002">2002</option>
    <option value="2001">2001</option>
    <option value="2000">2000</option>
    <option value="1999">1999</option>
    <option value="1998">1998</option>
    <option value="1997">1997</option>
    <option value="1996">1996</option>
    <option value="1995">1995</option>
    <option value="1994">1994</option>
    <option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
    <option value="1980">1980</option>
    <option value="1979">1979</option>
    <option value="1978">1978</option>
    <option value="1977">1977</option>
    <option value="1976">1976</option>
    <option value="1975">1975</option>
    <option value="1974">1974</option>
    <option value="1973">1973</option>
    <option value="1972">1972</option>
    <option value="1971">1971</option>
    <option value="1970">1970</option>
    <option value="1969">1969</option>
    <option value="1968">1968</option>
    <option value="1967">1967</option>
    <option value="1966">1966</option>
    <option value="1965">1965</option>
    <option value="1964">1964</option>
    <option value="1963">1963</option>
    <option value="1962">1962</option>
    <option value="1961">1961</option>
    <option value="1960">1960</option>
    <option value="1959">1959</option>
    <option value="1958">1958</option>
    <option value="1957">1957</option>
    <option value="1956">1956</option>
    <option value="1955">1955</option>
    <option value="1954">1954</option>
    <option value="1953">1953</option>
    <option value="1952">1952</option>
    <option value="1951">1951</option>
    <option value="1950">1950</option>
    <option value="1949">1949</option>
    <option value="1948">1948</option>
    <option value="1947">1947</option>
    <option value="1946">1946</option>
    <option value="1945">1945</option>
    <option value="1944">1944</option>
    <option value="1943">1943</option>
    <option value="1942">1942</option>
    <option value="1941">1941</option>
    <option value="1940">1940</option>
    <option value="1939">1939</option>
    <option value="1938">1938</option>
    <option value="1937">1937</option>
    <option value="1936">1936</option>
    <option value="1935">1935</option>
    <option value="1934">1934</option>
    <option value="1933">1933</option>
    <option value="1932">1932</option>
    <option value="1931">1931</option>
    <option value="1930">1930</option>
    <option value="1929">1929</option>
    <option value="1928">1928</option>
    <option value="1927">1927</option>
    <option value="1926">1926</option>
    <option value="1925">1925</option>
    <option value="1924">1924</option>
    <option value="1923">1923</option>
    <option value="1922">1922</option>
    <option value="1921">1921</option>
    <option value="1920">1920</option>
    <option value="1919">1919</option>
    <option value="1918">1918</option>
    <option value="1917">1917</option>
    <option value="1916">1916</option>
    <option value="1915">1915</option>
    <option value="1914">1914</option>
    <option value="1913">1913</option>
    <option value="1912">1912</option>
    <option value="1911">1911</option>
    <option value="1910">1910</option>
    <option value="1909">1909</option>
    <option value="1908">1908</option>
    <option value="1907">1907</option>
    <option value="1906">1906</option>
    <option value="1905">1905</option>
    <option value="1904">1904</option>
    <option value="1903">1903</option>
    <option value="1902">1902</option>
    <option value="1901">1901</option>
    <option value="1900">1900</option>
</select> </li></ul></fieldset>
<hr>
<h2>How did you hear about Saint Joseph Academy?</h2><br/>
      <input type="checkbox" name="visit" value="checked"> <span class="formText">School Visit</span>
		<input type="checkbox" name="friend" value="checked" checked> <span class="formText">Family/Friend</span>
		<input type="checkbox" name="church" value="checked"> <span class="formText">Church</span>
		<input type="checkbox" name="newspaper" value="checked"> <span class="formText">Newspaper</span>
		<input type="checkbox" name="website" value="checked"> <span class="formText">Website</span><br/>
		<input type="checkbox" name="brochure" value="checked"> <span class="formText">Brochure</span>
		<input type="checkbox" name="principal" value="checked"> <span class="formText">Current School Principal</span><br /><br/>
		
		<fieldset><legend>Other </legend></fieldset>
		<fieldset><ul><li><textarea name="hearabout"></textarea></li></ul></fieldset><br/>
	   <input name="page" type="hidden" size="1" id="userlevel" value="1" />
	   
    	<fieldset><ul><li><input type="submit" value="Next" name="submit" ></li></ul></fieldset>
   </form><br />
    <?php
}

if(isset($page) && $page == 7){
	//if(isset($_GET['ch']) || isset($_POST['ch'])){
	$i = 1;
	//}
	$childrenfinal_sql="SELECT * FROM children WHERE cookie_id = '$recordname'";
	$childrenfinal_result=mysql_query($childrenfinal_sql) or die(mysql_error());
	$numberofkidsfinal = mysql_num_rows($childrenfinal_result);
	if($numberofkidsfinal > 0){
		echo "<br />";
		while($row=mysql_fetch_assoc($childrenfinal_result)){
			$kid_id =	$row['kid_id'];
			$essay_path = $row['essay_path'];
			$school_sql="SELECT * FROM schools WHERE cookie_id = '$recordname'";
			$school_result=mysql_query($school_sql) or die(mysql_error());
			$numberofschools = mysql_num_rows($school_result);			
			$childfirstname =	$row['appfirstname'];
			$childlastname = $row['applastname'];
			$childmiddlename = $row['appmiddlename'];
			echo "<p class='formLegend'>$50 Application/Entrance Exam Fee: ".$childlastname.", ".$childfirstname." ".$childmiddlename."</p>";
			if(empty($essay_path)){
				$i = 0;
			}
		}
		//echo $numberofschools." ".$numberofkidsfinal;
		if($numberofschools >= $numberofkidsfinal){
			if($i == 1){
				$priceper = 50;
				$total_owed = $numberofkidsfinal * $priceper;
				echo "<hr><table><tr><td width='50'><h2>Total Application fee is: <span style='font-size:25px;color:#333366;'>$".$total_owed."</span><h2>";?>
				<form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" style="padding: 0;margin: 0;margin-top:-20px;width: 300px;">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="hosted_button_id" value="E7U3N4JJT942J">
				<input type="hidden" name="business" value="<?php echo "mmartinez@sja.us"; ?>">
				<input type="hidden" name="item_name" value="Total Application Fee">
				<input type="hidden" name="item_number" value="<?php echo $recordname; ?>">
				<input type="hidden" name="amount" value="<?php echo $total_owed; ?>">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="notify_url" value="http://www.sja.us/application.php?page=8&submit=<?php echo $recordname; ?>">
				<input type="hidden" name="return" value="http://www.sja.us/application.php?page=9&submit=<?php echo $recordname; ?>">
				<input type="image" src="http://www.nhcenters.com/images/paypal_checkout_button.png" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
				</form>
		<?php echo "</td><td><h2>Parent/Legal Guardian Acknowledgement</h2>
		<p>By completing the paypal transaction for this application I achknowledge that I am the parent/legal guardian of the applicant and hold legal rights regarding the applicant’s care and education. It is my intention to meet all Saint Joseph Academy admissions requirements with enthusiasm, courtesy, and respect. I am responsible for submitting the Saint Joseph Academy Application for	Admission, Records Request, application/entrance exam fee, and other required documents on the applicant’s behalf.</p></td></tr></table>";
			}else{
				echo "<span style='background-color:#ffff00;color:#ff0000;padding:1px;margin-left:100px;'>Application not submitted.  Please upload essays for child.</span><br />";
			}
		}else{
			echo "<span style='background-color:#ffff00;color:#ff0000;padding:1px;margin-left:100px;'>Application not submitted.  Please provide schools for child.</span><br />";		
		}
	}else{
		echo "<span style='background-color:#ffff00;color:#ff0000;padding:1px;margin-left:100px;'>Application not submitted.  You have to add children to your application.  You can't submit this application until having at least 1 child recorded in the application.</span><br />";
	}
}

if(isset($page) && $page == 8 && isset($_GET['submit']) && !empty($_GET['submit'])){
	$j = 1;
	$success = $_GET['submit'];
	$tiempo = time();
	$success_sql="UPDATE applicant SET paid='1' WHERE cookie_id = '$success'";
	$success_result=mysql_query($success_sql) or die(mysql_error());
	$submitdate_sql="UPDATE applicant SET datesubmitted='$tiempo' WHERE cookie_id = '$success'";
	mysql_query($submitdate_sql) or die(mysql_error());

	$childrens_sql="SELECT * FROM children WHERE cookie_id = '$success'";
	$childrens_result=mysql_query($childrens_sql) or die(mysql_error());
	$numberofkid = mysql_num_rows($childrens_result);
	if($numberofkid > 0){
		while($row=mysql_fetch_assoc($childrens_result)){
			$kid_id =	$row['kid_id'];
			$school_sql="SELECT * FROM schools WHERE cookie_id = '$success' AND kid_id = '$kid_id'";
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
			//$paid = $row['paid'];
			//if ($row['paid'] == 1){
			//	$paid = "Yes";
			//}
			$essaypath = $row['essay_path'];	
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
				$child_array[] = array($kid_id,$app_id,$cookie_id,$grade,$gender,$appstreetaddress,$appcity,$appstate,$appzipcode,$language,$yearsofstudy,$french,$spanish,$class1,$class2,$class3,$class4,$class5,$class6,$class7,$class8,$passfail1,$passfail2,$passfail3,$passfail4,$passfail5,$passfail6,$passfail7,$passfail8,$nodiagnosis,$diagnosis,$other,$paid,$essaypath,$appfirstname,$applastname,$appmiddlename,$school_array);
			}else{
				echo "<br /><p>* No schools have been added to this applicant's application.</p>";
			}
				echo "";
		}		
	}else{

	}
	
	$basicinfolast_sql="SELECT * FROM applicant WHERE cookie_id = '$success'";
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
		$hearabout = $rows['hearabout'];
		$paid = $rows['paid'];
		$datesubmitted = $rows['datesubmitted'];
		$applicationdate = date("m-d-Y", $datesubmitted);
		if ($rows['paid'] == 1){
			$paid = 1;
		}
	}
	//$kidsnschool[] = array($child_array[$school_array]);
	$kidos = "";
	foreach($child_array as $child){
		$kidos.= "<br clear='all'/><hr>
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
			<tr><td>Speak French? </td><td>".$child[11]."</td></tr> 
			<tr><td>Speak Spanish? </td><td>".$child[12]."</td></tr> 
			</table><br /><table><tr><td><strong>Previous Classes Taken</strong></td><td></td></tr>
			 <tr><td>".$child[13]."</td><td>".$child[21]."</td></tr>
			 <tr><td>".$child[14]."</td><td>".$child[22]."</td></tr>
			 <tr><td>".$child[15]."</td><td>".$child[23]."</td></tr>
			 <tr><td>".$child[16]."</td><td>".$child[24]."</td></tr>
			 <tr><td>".$child[17]."</td><td>".$child[25]."</td></tr>
			 <tr><td>".$child[18]."</td><td>".$child[26]."</td></tr>
			 <tr><td>".$child[19]."</td><td>".$child[27]."</td></tr>
			 <tr><td>".$child[20]."</td><td>".$child[28]."</td></tr></table>
			 <br /> The applicant has a diagnosed learning difference? ".$child[30]."<br />
			 <br /> Diagnosis Comments: ".$child[31]."<br /><br /> Path to Essay: ".$child[33]."<br />
			 <br /><br /><strong>Schools for Applicant</strong>";
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
			
			$kidos.= "<br clear='all'><a href='http://www.sja.us/".$child[33]."' style='font-size:20px;'>This Applicant's Essay</a>";
			
			//if(isset($path[0])){
			//	$docfile = str_replace("assets/essays/", "", $child[33]);
			//	array_push($path,$docfile);
			//}else{
			//	$docfile = str_replace("assets/essays/", "", $child[33]);
			//	$path = array($docfile);
			//}
		}
	$semi_rand = md5(time()); 
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
	
	/*for($x=0;$x<count($path);$x++){
		$file = fopen($path[$x],"rb");
		$data = fread($file,filesize($path[$x]));
		fclose($file);
		$data = chunk_split(base64_encode($data));
		$header .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$path[$x]\"\n" . 
		"Content-Disposition: attachment;\n" . " filename=\"$path[$x]\"\n" . 
		"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
		$message .= "--{$mime_boundary}\n";
	}*/
	if($paid == 1){
		$emailpaid = "yes";
	}else{
		$emailpaid = "no";
	}
	$message = "";
	$personal="john@jdacsolutions.com";
	$subject = "New Application";
	$txt = "Hello world!";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: applicants@sja.us" . "\r\n" .
	"CC: veronica@uppercasedesigngroup.com";
	$message .= "
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
	  	padding:25px 20px;
	  	}
	  </style>
	</head>
	<body><br /><br />
	<div id='container'>
		<img src='http://www.sja.us/assets/img/logo-home.gif'>	
	  <h3>New Applicants</h3><br clear='all'>
	  <strong>Application Date:</strong> ".$applicationdate."<br clear='all'><hr>
		<table style='float:left;'>
			<tr><td><strong>Parent/Legal Guardian #1 Information</strong></td><td></td></tr>
			<tr><td>First Name: </td><td>".$fatherfirstname."</td></tr>
			<tr><td>Last Name: </td><td>".$fatherlastname."</td></tr>
			<tr><td>Middle Name: </td><td>".$fathermiddlename."</td></tr> 
			<tr><td>Address: </td><td>".$fatheraddress."</td></tr>
			<tr><td>City: </td><td>".$fathercity."</td></tr>
			<tr><td>State: </td><td>".$fatherstate."</td></tr>
			<tr><td>Zip Code: </td><td>".$fatherzipcode."</td></tr> 
			<tr><td>Work Phone: </td><td>".$fatherworkphone."</td></tr> 
			<tr><td>Home Phone: </td><td>".$fathermobilephone."</td></tr> 
			<tr><td>Email: </td><td>".$fatheremail."</td></tr>
			<tr><td>Place of Employment: </td><td>".$fatheremployment."</td></tr> 
			<tr><td>Occupation: </td><td>".$fatheroccupation."</td></tr>
		</table> 
		<table style='float:left;'>
			<tr><td><strong>Parent/Legal Guardian #2 Information</strong></td><td></td></tr>
			<tr><td>First Name: </td><td>".$motherfirstname."</td></tr>
			<tr><td>Last Name: </td><td>".$motherlastname."</td></tr>
			<tr><td>Middle Name: </td><td>".$mothermiddlename."</td></tr> 
			<tr><td>Address: </td><td>".$motheraddress."</td></tr> 
			<tr><td>City: </td><td>".$mothercity."</td></tr> 
			<tr><td>State: </td><td>".$motherstate."</td></tr> 
			<tr><td>Zip Code: </td><td>".$motherzipcode."</td></tr>  
			<tr><td>Work Phone: </td><td>".$motherworkphone."</td></tr> 
			<tr><td>Home Phone: </td><td>".$mothermobilephone."</td></tr> 
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
	</table><br clear='all'/>
	<table style='float:left;'>
	<tr><td><strong>How did you Hear about Us?</strong></td><td></td></tr>
	<tr><td>School Visit? </td><td>".$visit." </td></tr> 
	<tr><td>Friend? </td><td>".$friend." </td></tr> 
	<tr><td>Church?  </td><td>".$church." </td></tr> 
	<tr><td>Newspaper? </td><td>".$newspaper." </td></tr> 
	<tr><td>Website? </td><td>".$website." </td></tr> 
	<tr><td>Brochure? </td><td>".$brochure." </td></tr> 
	<tr><td>Principal? </td><td>".$principal." </td></tr>
	<tr><td>Other? </td><td>".$hearabout."</td></tr>
	</table><br clear='all' /><br clear='all' /> <table>
	<tr><td>Has this application been paid for? </td><td><strong>".$emailpaid."</strong></td></tr></table>	".$kidos."
	</div>
	</body>
	</html>";

	mail($personal,$subject,$message,$headers);
	$j = 1;
}

if (isset($_COOKIE["recordkeeper"])) {
$h = 0;
$recordname = $_COOKIE["recordkeeper"];
//setcookie("recordkeeper", $recordname, time() - 53600); 
$children_sql="SELECT * FROM children WHERE cookie_id = '$recordname'";
$children_result=mysql_query($children_sql) or die(mysql_error());
while($esspath = mysql_fetch_array($children_result)){
	$p = 0;
	$kid_id = $esspath['kid_id'];
	$essapath = str_replace(' ', '',$esspath['essay_path']);
	if($essapath <> '' ){
		$h++;
	}
	$escuela_sql="SELECT * FROM schools WHERE cookie_id = '$recordname' and kid_id = '$kid_id'";
	$escuela_result=mysql_query($escuela_sql) or die(mysql_error());
	$numberofescuelas = mysql_num_rows($escuela_result);	
	if($numberofescuelas == 0){
		$p = 1;
	}
	
}

//if(isset($_POST['page'])){$page=$_POST['page'];}elseif(isset($_GET['page'])){$page=$_GET['page'];}else{$page}

$escuela_sql="SELECT * FROM schools WHERE cookie_id = '$recordname'";
$escuela_result=mysql_query($escuela_sql) or die(mysql_error());
$numberofescuelas = mysql_num_rows($escuela_result);
$numberofkids = mysql_num_rows($children_result);
$paidstatus_sql= "SELECT * FROM applicant WHERE cookie_id = '$recordname'";
$paidstatus_result=mysql_query($paidstatus_sql);
//while($statusrow = mysql_fetch_array($paidstatus_result)){
//	$paid = $statusrow['paid'];
//}
	 if($numberofkids > 0 && $h == $numberofkids && $p <> 1){
			if($paid <> 1 && isset($page) <> 7){
				?><hr/><a class="appButtonSubmit" href="<?php echo $PHP_SELF; ?>?page=7">Proceed to Checkout</a><div class="clear"></div>
				<?php
			}elseif($paid == 1){
				echo "Application has been Submitted!";
			}elseif($page == 7 && !isset($_GET['status']) && $paid <> 2){
				?><hr/><a class="appButtonSubmit" href="<?php echo $PHP_SELF; ?>?page=7&status=pending">Submit Application &amp; Pay Later</a><div class="clear"></div>
				<?php
			}elseif($page == 7 && isset($_GET['status']) == 'pending' ){
				echo "<hr/>Application has been Submitted and is currently in Pending Status";
				mysql_query("UPDATE applicant SET paid='2' WHERE cookie_id = '$recordname'");
			}elseif($paid == 2){
				echo "<hr/>Application has been Submitted and is currently in Pending Status";
			}
	 }else{echo "";}
	//$page = 1;
	?></div><?php
}



include 'core/template/foot.php';
?>
