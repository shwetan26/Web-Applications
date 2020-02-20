	<!DOCTYPE html>
	<html lang='en'>
	<!--
	Shweta Nazarkar
	823812620
	CS 545
	CSS Assigment 3 PHP Example
	-->
	<head>
	    <title>SDSU Natural History Museum</title>
	    <meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <link rel="stylesheet" type="text/css" href="museum_stylesheet.css">
	    <style type=text/css> span{color:red; font-family: sans-serif;font-size: initial;}></style>
	</head>
	<body>
		<header>
			<div class="first">
				<a href="index.html" target="_self"><img class="fltrght" src="images/SDSUwLSH_3Color_RV.png" alt="San Diego State university: Leadership Starts Here" width="245" height="217" /></a>
				<h1>San Diego State University <br>Natural History Museum</h1>
			</div>
			<nav class="clrflt">
				<ul class="HNav1">
					<li><a href="index.html">Home</a></li>
					<li><a href="about.html">About the Museum</a></li>
					<li><a href="exhibits.html">Exhibits</a></li>
					<li><a href="events.html">Events</a></li>
					<li><a href="science.html">Science</a></li>
					<li><a href="involve.html">Get Involved</a></li>
				</ul>
			</nav>
		</header>
	<section >
		<div class="registration-elements">
		<?php
	     // define variables and set to empty values
	    $firstnameErr = $lastnameErr = $emailErr = $selectErr = $totalattendees = $totalErr = $contactErr = $numberErr= "";
	    $firstname = $lastname = $email = $event = $contactnumber = $address = $otherevents = $newsletter = "";
		//flag to validate form
		$isformvalid = 1;
		//on submit validate fields
		if(isset($_POST["submit"])){
			//total attendees are required
		 	if(!empty($_POST["totalattendees"])){	
         		 $total = $_POST["totalattendees"];		 
         		 $belowfive = $_POST["belowfive"];
         		 $belowtwelve = $_POST["belowtwelve"];
         		 $abovetwelve = $_POST["abovetwelve"];
         		 $above18 = $_POST["above18"];

         		 //validate under 5 category
         		 if (empty($belowfive)){
         		 	$belowfive = 0;
         		 	$belowfive = test_input($belowfive);
         		 } else if(is_numeric($belowfive)){
				 	 $belowfive = test_input($belowfive);
				 } 
				//validate  5 - 12 category
         		 if (empty($belowtwelve)) {
         		 	$belowtwelve = 0;
         		 	$belowtwelve = test_input($belowtwelve);
         		 } else{
				 	 $belowtwelve = test_input($belowtwelve);
				 }
				 //validate 12 - 17 category
         		 if (empty($abovetwelve)) {
         		 	$abovetwelve = 0;
         		 	$abovetwelve = test_input($abovetwelve);
         		 } else {
				 	 $abovetwelve = test_input($abovetwelve);
				 }
				 //validate above 18 category
         		 if (empty($above18)) {
         		 	$above18 = 0;
         		 	$above18 = test_input($above18);
         		 } else {
				 	 $above18 = test_input($above18);
				 }
         		//validate total attendees sum equal to subcategories 
         		if(is_numeric($belowfive) && is_numeric($belowtwelve) && is_numeric($abovetwelve) && is_numeric($above18)){
	         		if($total != ($belowfive + $belowtwelve + $abovetwelve + $above18)){
         				$totalErr = "Total attendees not matching with sum of age categories";
         				$total = test_input($_POST["totalattendees"]);
						$isformvalid = 0;
         			} else {
						$total = test_input($_POST["totalattendees"]);
					}
				} else if(!is_numeric($belowfive) || !is_numeric($belowtwelve) || !is_numeric($abovetwelve) || !is_numeric($above18)){
					$isformvalid = 0;
					$numberErr = "Invalid number";
				}  
     		} else {
					$isformvalid = 0;
					$total = test_input($_POST["totalattendees"]);
					$totalErr = "Please enter total attendees";
				}
			//validate contact number
			$contactnumber = $_POST["contact"];
			if(!empty($contactnumber)){
				if(preg_match("/^[0-9]{10}+$/", $contactnumber)) {
					$contactnumber = test_input($contactnumber);
				} else{
					$contactErr = "Invalid Phone number";
					$isformvalid = 0;
				}
			}
			//address
			$address = $_POST["address"];
			if(!empty($address)){
				$address = test_input($address);
			}
			//other events
			$otherevents = $_POST["otherevents"];
			if(!empty($otherevents)){
				$otherevents = test_input($otherevents);
			}

			//signup for newsletter
			$newsletter = $_POST["newsletter"];
			
			//validate required fields
			if(empty($_POST["firstname"])){
					$firstnameErr = "Please enter First Name";
					$isformvalid = 0;
			} 
			else{
					$firstname = test_input($_POST["firstname"]);
			}
			if(empty($_POST["lastname"])){
					$lastnameErr = "Please enter Last Name";
					$isformvalid = 0;
			} 
			else{
					$lastname = test_input($_POST["lastname"]);
			}
			if(empty($_POST["email"])){
					$emailErr = "Please enter Email ID";
					$isformvalid = 0;
			} 
			else {
					$email = test_input($_POST["email"]);
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$emailErr = "Invalid email format";
						$isformvalid = 0;
					}
			}
			if($_POST["event"] == "nil"){
					$selectErr = "Please select event";
					$isformvalid = 0;
			}
			else if($_POST["event"] == "Shot Hole Borer Citizen Science Project" || $_POST["event"] == "Desert Wildlife Walk"){
					$event = test_input($_POST["event"]);
			}
			//if all required fields are valid then redirect to confirmation page
			if($isformvalid == 1){
		 		session_start();
				$firstname = $_POST["firstname"];
				$lastname = $_POST["lastname"];
				$email = $_POST["email"];
				$event = $_POST["event"];
				$_SESSION['firstname']= $firstname;
				$_SESSION['lastname']=$lastname;
				$_SESSION['email']= $email;
				$_SESSION['contact'] = $contactnumber;
				$_SESSION['address'] = $address;
				$_SESSION['event']=$event;
				$_SESSION['total'] = $total;
				$_SESSION['belowfive'] = $belowfive;
				$_SESSION['belowtwelve'] = $belowtwelve;
				$_SESSION['abovetwelve'] = $abovetwelve;
				$_SESSION['above18'] = $above18;
				$_SESSION['otherevents'] = $otherevents;
				$_SESSION['newsletter'] = $newsletter;
				header('Location:confirmation.php');
				exit();
				}			
			 }
	         
	         function test_input($data) {
	            $data = trim($data);
	            $data = stripslashes($data);
	            $data = htmlspecialchars($data);
	            return $data;
	        }
	      ?>
	     
	     <!--HTML code for form input fields-->
			<h2>Register for the event</h2>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
				<input class="input-contain" type="text" name="firstname" placeholder="First Name" value="<?php if(!empty($_POST["firstname"])){echo $firstname;}?>"><span>*</span>
				<br>
				<span class = "error"><?php echo $firstnameErr;?></span>
				<br>
				<input class="input-contain" type="text" name="lastname" placeholder="Last Name" value="<?php if(!empty($_POST["lastname"])){echo $lastname;}?>"><span>*</span>
				<br>
				<span class = "error"><?php echo $lastnameErr;?></span>
				<br>
				<input class="input-contain" type="text" name="address" placeholder="Address" value="<?php if(!empty($_POST["address"])){echo $address;}?>">
				<br>
				<br>
				<input class="input-contain" type="email" name="email" placeholder="Email Address" value="<?php if(!empty($_POST["email"])){echo $email;}?>"><span>*</span>
				<br>
				<span class = "error"><?php echo $emailErr;?></span>
				<br>
				<input class="input-contain" type="text" name="contact" placeholder="Enter 10 digit contact number" value="<?php if(!empty($_POST["contact"])){echo $contactnumber;}?>">
				<br>
				<span class = "error"><?php echo $contactErr;?></span>
				<br>
				<div class="eventoptions">
					<select class="input-contain" name="event">
						<option <?php if (isset($_POST["event"]) && $_POST["event"] == "nil" ) echo 'selected';?> value="nil">Select Event</option>
						<option <?php if (isset($_POST["event"]) && $_POST["event"] == "Shot Hole Borer Citizen Science Project" ) echo 'selected';?> value="Shot Hole Borer Citizen Science Project">Shot Hole Borer Citizen Science Project</option>
						<option <?php if (isset($_POST["event"]) && $_POST["event"] == "Desert Wildlife Walk") echo 'selected';?> value="Desert Wildlife Walk">Desert Wildlife Walk</option>
					</select>
					<br>
					<span class="error"><?php echo $selectErr;?></span>
					<br>
				</div>
				
				<input class="input-contain" type="text" name="totalattendees" placeholder="Total Attendees" value="<?php if(!empty($_POST["totalattendees"])){echo $total;}?>"><span>*</span>
				<br>
				<span class = "error"><?php echo $totalErr;?></span>
				
				<div class="attendees">
					<br>
					<input class="input-age" type="text" name="belowfive" placeholder="Under 5 yrs" value="<?php if(!empty($_POST["belowfive"])){echo $belowfive;}?>">
					<input class="input-age" type="text" name="belowtwelve" placeholder="5-12 yrs" value="<?php if(!empty($_POST["belowtwelve"])){echo $belowtwelve;}?>">
					<input class="input-age" type="text" name="abovetwelve" placeholder="13-17 yrs" value="<?php if(!empty($_POST["abovetwelve"])){echo $abovetwelve;}?>">
					<input class="input-age" type="text" name="above18" placeholder="18+ yrs" value="<?php if(!empty($_POST["above18"])){echo $above18;}?>">
				</div>
				<span class = "error"><?php echo $numberErr;?></span>
				<br>
				<input class="input-contain" type="text" name="otherevents" placeholder="Enter other events you want us to offer" value="<?php if(!empty($_POST["otherevents"])){echo $otherevents;}?>">
				<br>
				<div class="newsletter-checkbox">
		     		<input type="checkbox" name="newsletter" value="1" checked> Signup for Newsletter
		    	</div>
				<br>
				<input class="input-submit"  type="submit" name="submit">
			</form>
		</div>
		<br>
	</section>
	<footer>
	        <div class="fcolumn1">
	            <address>
	                <br>San Diego State University
	                <br>Natural History Museum
	                <br>San Diego, CA 92182-0000
	                <br>(619) 594-5200<br />
	                <a href="mailto:nhmuseum@sdsu.edu">nhmuseum@sdsu.edu</a>
	            </address>
	        </div>
	        <div class="fcolumn2">
	            <p>
	                <br>Museum Hours

	                <br>Daily 10:00am to 5:00pm
	                <br>Closed when the campus is closed
	                <br>Hours subject to change
	            </p>
	        </div>
	        <div class="fcolumn3">
	            <br>
	            <ul class="footerbuttons">
	                <li><a href="involve.html">Become a Member</a></li>
	                <li><a href="volunteer.html">Volunteer and Intern Applications</a></li>
	                <li><a href="donate.html">Donate Now!</a></li>
	            </ul>
	        </div>
	        <div class="fcolumn3">
	            <p>
	                <br> Newsletter
	                <br>Receive the latest information about our new exhibitions, programs, events, and more.
	            </p>
	        </div>
	    </footer>
	</body>
	</html>