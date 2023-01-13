<?php 
	session_start();
	if(isset($_SESSION['username'])){
		header('Location: 403.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"/>
	<meta charset="utf-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<meta name="author" content=" Teodora Nedeljković"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" href="assets/img/favicon.ico"/>
</head>
<body>
	<div id="poster">

	</div>

	<?php include "footer.php"; ?>

	<div id="registerBlock" class="signInRegisterPage">
		<div id="header">
			<div class="wrapper">
				<div>
					<a href="index.php"><img src="assets/img/logo.png" alt="logo"></a>
				</div>
				<div>
					<ul id="nav">
						<li><a href="movies.php">movies</a></li>
						<li><a href="reviews.php">reviews</a></li>
						<li><a href="watchlist.php">watchlist</a></li>
					</ul>
				</div>
				<div>
					
				</div>
			</div>
		</div>

		<?php
			if(isset($_SESSION['username'])){
				echo "You're already registered and signed in!<br/> Click <a href='index.php'>here</a> to go back to the home page.";
			} else{
				$currentPage = $_SERVER['PHP_SELF'];

				echo "<form method='POST' action='{$currentPage}' id='formRegister' onsubmit='return proveraRegister()'>
						<div><h4>Create An Account</h4></div>";
				if(isset($_GET['register'])){
					$name = $_GET['name'];
					$username = $_GET['user'];
					$email = $_GET['email'];
					echo "<div><input type='text' name='fullName' id='fullName' value='{$name}'/></div>
						<div><input type='text' name='usernameRegister' id='usernameRegister' value='{$username}'/></div>
						<div><input type='email' name='emailRegister' id='emailRegister' value='{$email}'/></div>";
				} else{
					echo "<div><input type='text' name='fullName' id='fullName' placeholder='Full Name'/></div>
						<div><input type='text' name='usernameRegister' id='usernameRegister' placeholder='Username'/></div>
						<div><input type='text' name='emailRegister' id='emailRegister' placeholder='Email'/></div>";
				}
				echo "<div><input type='password' name='passwordRegister' id='passwordRegister' placeholder='Password'/></div>
					<div><input type='password' name='passwordConfirm' id='passwordConfirm' placeholder='Confirm Password'/></div>";

				if(isset($_GET['register'])){
					$registerErr = $_GET['register'];
					if($registerErr=='invalid'){
						echo "<div class='error'><p>data not in right format</p></div>";
					} else if($registerErr=='email'){
						echo "<div class='error'><p>email already taken</p></div>";
					} else if($registerErr=='user'){
						echo "<div class='error'><p>username already taken</p></div>";
					}
				}

				echo "
					
					<div class='redirectSignInRegister'><p>Already have an account?</p>&nbsp;<a href='signin.php'>Sign in here.</a></div>
					<div><input type='submit' name='dugmeRegister' id='dugmeRegister' value='Continue'></div>
					</form><div class='errorsBlock' id='registerErrorsBlock'>
				
					</div>";
			}
		?>
	</div>

	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>



<?php
	require "connection.php";

	if($connection){

		if(isset($_POST['dugmeRegister'])){
			$errors = array();
			$regexFullName = "/^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{2,20})+$/";
			$regexUser = "/^(?=.*[A-z])(?!\s)[A-z\d.?-]{3,25}$/";
			$regexEmail = "/^([A-z][A-z0-9-._]{2,35})\@([A-z]{3,10}\.[a-z]{2,5}(.[a-z]{2,5})?)$/";
			$regexPassword = "/^(?=.*[a-z])(?=.*\d)(?=.*[A-Z]).{3,30}$/";

			$fullName = $_POST['fullName'];
			$username = $_POST["usernameRegister"];
			$email = $_POST["emailRegister"];
			$password = $_POST["passwordRegister"];
			$passwordConfirm = $_POST["passwordConfirm"];

			if(!preg_match($regexFullName,$fullName)){
				array_push($errors,'ime nije u dobrom formatu');
			}
			if(!preg_match($regexUser,$username)){
				array_push($errors,'username nije u dobrom formatu');
			}
			if(!preg_match($regexEmail,$email)){
				array_push($errors,'email nije u dobrom formatu');
			}
			if(!preg_match($regexPassword,$password)){
				array_push($errors,'password has to contain one lc letter, uc letter and a number');
			}
			if($password!=$passwordConfirm){
				array_push($errors,"passwords don't match");
			}

			if(count($errors)!=0){
				header("Location: register.php?register=invalid&name=$fullName&email=$email&user=$username");
			}
			else{
				$selectQuery = $connection->prepare("SELECT username,email FROM user WHERE username=:user OR email=:email");
				$selectQuery->bindParam(":user",$username);
				$selectQuery->bindParam(":email",$email);
				$selectQuery->execute();
				$selectResult= $selectQuery->fetchAll();

				if(count($selectResult)>0){
					foreach($selectResult as $element){
						if($element['username']==$username){
							header("Location: register.php?register=user&name=$fullName&email=$email&user=$username");
							exit();
						}
						if($element['email']==$email){
							header("Location: register.php?register=email&name=$fullName&email=$email&user=$username");
							exit();
						}
					}
				}
				else{
					$insertQuery = $connection->prepare("INSERT INTO user(fullName,username,password,email) VALUES (:ime,:user,:pass,:email)");
					$insertQuery->bindParam(":ime", $fullName);
					$insertQuery->bindParam(":user", $username);
					$insertQuery->bindParam(":pass", md5($password));
					$insertQuery->bindParam(":email", $email);
					$insertQuery->execute();

					if($insertQuery->rowCount()==1){
						$_SESSION['username'] = $username;
						$_SESSION['role'] = 2;
						header('Location: index.php');
					}
					else{
						echo "<div class='error'><p>Registration failed.</p></div>";
					}
				}
			}
		}
	}
	else{
		echo "<h1>Connection with the database failed.</h1>";
	}
?>