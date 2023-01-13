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
	<title>Sign In</title>
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




	<div id="signInBlock" class="signInRegisterPage">
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
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" id="formSignIn" onsubmit="return proveraSignIn()">
			<div><h4>Sign In</h4></div>
			<?php
				if(isset($_GET['signin'])){
					$user=$_GET['user'];
					echo "<div><input type='text' name='usernameSignIn' id='usernameSignIn' value='{$user}'/></div>";
				} else{
					echo "<div><input type='text' name='usernameSignIn' id='usernameSignIn' placeholder='Username'/></div>";
				}
			?>
			<div><input type="password" name="passwordSignIn" id="passwordSignIn" placeholder="Password"/></div>
			<?php
				if(isset($_GET['signin'])){
					$signInErr = $_GET['signin'];
					if($signInErr=='invalid'){
						echo "<div class='error'><p>data not in right format</p></div>";
					} else if($signInErr=='notexists'){
						echo "<div class='error'><p>username doesn't exist</p></div>";
					} else if($signInErr=='nomatch'){
						echo "<div class='error'><p>username and password don't match</p></div>";
					}
				}
			?>
			<div class="redirectSignInRegister"><p>Don't have an account?</p>&nbsp;<a href="register.php">Register here.</a></div>
			<div id="dugmeSignInBlock"><input type="submit" name="dugmeSignIn" id="dugmeSignIn" value="Continue"></div>
		</form>
		<div class="errorsBlock" id='signInErrorsBlock'></div>

	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>


<?php
	require "connection.php"; 

	if($connection){
		if(isset($_POST['dugmeSignIn'])){
			$errors = array();
			$regexUser = "/^(?=.*[A-z])(?!\s)[A-z\d.?-]{3,25}$/";
			$regexPassword = "/^(?=.*[a-z])(?=.*\d)(?=.*[A-Z]).{3,30}$/";

			$username = $_POST['usernameSignIn'];
			$password = $_POST['passwordSignIn'];

			if(!preg_match($regexUser,$username)){
				array_push($errors,'Username in invalid format');
			}
			if(!preg_match($regexPassword,$password)){
				array_push($errors,'Password in invalid format');
			}

			if(count($errors)!=0){
				header("Location: signin.php?signin=invalid&user=$username");
				exit();
			} else{
				$selectQueryU = $connection->prepare("SELECT * FROM user WHERE username=:user");
				$selectQueryU->bindParam(":user", $username);
				$selectQueryU->execute();
				if($selectQueryU->rowCount()==1){
					$selectQueryP = $connection->prepare("SELECT * FROM user WHERE username=:user AND password=:pass");
					$selectQueryP->bindParam(":user", $username);
					$selectQueryP->bindParam(":pass", md5($password));
					$selectQueryP->execute();
					if($selectQueryP->rowCount()==1){
						session_start();
						$selectResultP = $selectQueryP->fetch();
						$_SESSION['username'] = $username;
						$_SESSION['role'] = $selectResultP['role_id'];
						header('Location: index.php');
						exit();
					} else{
						header("Location: signin.php?signin=nomatch&user=$username");
						exit();
					}
				} else{
					header("Location: signin.php?signin=notexists&user=$username");
					exit();
				}
			}
		}
		http_response_code(200);
	}
	else{
		http_response_code(500);
	}
?>