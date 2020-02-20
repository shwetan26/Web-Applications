<!DOCTYPE html>
<html lang='en'>
<!--
	Shweta Nazarkar
	823812620
	CS 545
	CSS Assigment 3 PHP Example
-->
<head>
	<title>Registration Confirmation</title>
		<link href="museum_stylesheet.css" rel="stylesheet">
	</head>
<body>
	<section>
	<!-- start session to retrieve form data-->
	<?php session_start();?>
		<div class="confirmation">
			<h2>Thank you for registration!</h2>
			<div class="confirm-form">	
				<h3>Here's what you gave us</h3>
				<br>
				<p>Name  : <?php echo $_SESSION['firstname'] . $_SESSION['lastname'];?></p>
				<p>Email : <?php echo $_SESSION['email'];?></p>
				<!--if address data is present then only display data with label-->
				<p><?php if(!empty($_SESSION['address'])) echo nl2br("Address: ".$_SESSION['address']."\n");?></p>
				<!--if contact data is present then only display data with label-->
				<p><?php if(!empty($_SESSION['contact'])) echo nl2br("Contact Number: ".$_SESSION['contact']."\n");?></p>
				<p>Registered Event: <?php echo $_SESSION['event'];?></p>
				<p>Total Attendees: <?php echo $_SESSION['total'];?></p>
				<p>Under 5 years old: <?php echo $_SESSION['belowfive'];?></p>
				<p>Between 5 - 12 years old: <?php echo $_SESSION['belowtwelve'];?></p>
				<p>Between 12 - 17 years old: <?php echo $_SESSION['abovetwelve'];?></p>
				<p>Above 18 years old: <?php echo $_SESSION['above18'];?></p>
				<!--if other events data is present then only display data with label-->
				<p><?php if(!empty($_SESSION['otherevents'])) echo nl2br("Other events you want us to offer: ".$_SESSION['otherevents']."\n");?></p>
				<!--display message based on value of checkbox -->
				<p><?php if($_SESSION['newsletter'] == 1) echo "You have signed up for Newsletter"; else echo "You have not signed up for Newsletter";?></p>
				<!-- redirect to home page on confirm click-->
				<form action="index.html">
						<button type="submit" class="input-confirm">Confirm</button>
					</form>
			</div>
				<!-- redirect to form page on cancel click-->
					<!--<form action="registration.php">
						<button type="submit" class="input-submit-confirmation">Cancel</button>
					</form>-->
		</div>
	</section>
</body>
</html>