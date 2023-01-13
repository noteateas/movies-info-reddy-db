<?php
	session_start();
	require "connection.php";

	if(isset($_POST['dugmeContact'])){
		$errors = array();
		$fullName = $_POST['fullNameContact'];
		$subject = $_POST['subjectContact'];
		$msg = $_POST['messageContact'];

		$regexFullName = "/^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{2,20})+$/";
		$regexSubject = "/^[\w\d]{1,30}$/";
		$regexMessage = "/^.{5,150}$/";

		if(!preg_match($regexFullName,$fullName)){
			array_push($errors,'Name in invalid format.');
		}
		if(!preg_match($regexSubject,$subject)){
			array_push($errors, 'Subject in invalid format.');
		}
		if(!preg_match($regexMessage,$msg)){
			array_push($errors, 'Message in invalid format.');
		}

		if(count($errors)==0){
			header('Location: contact.php?msg=success');
		} else{
			header('Location: contact.php?msg=invalid');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"/>
	<meta charset="utf-8"/>
	<meta name="description" content="Contact the administrator."/>
	<meta name="keywords" content=""/>
	<meta name="author" content=" Teodora Nedeljković"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" href="assets/img/favicon.ico"/>
</head>
<body>
	<div id="contact">
		<div id="poster">
			<?php include "header.php";?>
			<div id="contactBlock">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" id="formContact" onsubmit="return proveraContact()">
					<div><h4>Contact the administrator</h4></div>
					
					<div><input type="text" name="fullNameContact" id="fullNameContact" placeholder="Full Name"/></div>
					<div><input type="text" name="subjectContact" id="subjectContact" placeholder="Subject" placeholder="Your message..." /></div>
					<div>
						<textarea id="messageContact" name="messageContact"></textarea>
					</div>
					
					<div id="dugmeProveraContact"><input type="submit" name="dugmeContact" id="dugmeContact" value="Continue"></div>
					<div id="contactError" class="errorsBlock">
						<?php
							if(isset($_GET['msg'])){
								$msg = $_GET['msg'];
								if($msg=='success'){
									echo "<p>Successfully sent!</p>";
								} else if($msg=='invalid'){
									echo "<p>Invalid format!</p>";
								}
							}
						?>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>