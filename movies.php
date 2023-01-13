<?php
	session_start();
	require "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Movies</title>
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
	<?php include "header.php"; ?>

	<div id="movies">
		<div class="wrapper">
			<div id="topMovies">
				<h4>Reddy's</h4>
				<div id="topMoviesBlock">
					
				</div>
				<h4>Choice</h4>
			</div>
			<hr class="marginBorder"/>
			<h4>Browse movies</h4><br><br>
			<!--<div id="manipulateMovies">
				<div id="sortFilterBlock" class="input-field">
					<select name="sort" id="sortMovies" >
						<option value="0">Sort By</option>
						<option value="oldest">Oldest</option>
						<option value="newest">Newest</option>
					</select>
				</div>
			</div>-->
			<div id="moviesBlock">

				<?php include "moviesContent.php"; ?>
				
			</div>
			<div id="infoBlock">
				
			</div>
		</div>
	</div>
	

	<?php include "footer.php"; ?>


	<div id="signInBlock">
		<div class="formClose close">
			<span></span>
			<span></span>
		</div>
		<form method="POST" action="#" id="formSignIn">
			<div><h4>Sign In</h4></div>
			<div><input type="text" name="usernameSignIn" id="usernameSignIn" placeholder="Username"/></div>
			<div><input type="password" name="passwordSignIn" id="passwordSignIn" placeholder="Password"/></div>
			<div><input type="button" name="dugmeSignIn" id="dugmeSignIn" value="Continue"></div>
		</form>
	</div>
	<div id="registerBlock">
		<div class="formClose close">
			<span></span>
			<span></span>
		</div>
		<form method="POST" action="#" id="formRegister">
			<div><h4>Create An Account</h4></div>
			<div><input type="text" name="fullName" id="fullName" placeholder="Full Name"/></div>
			<div><input type="text" name="usernameRegister" id="usernameRegister" placeholder="Username"/></div>
			<div><input type="email" name="emailRegister" id="emailRegister" placeholder="Email"/></div>
			<div><input type="password" name="passwordRegister" id="passwordRegister" placeholder="Password"/></div>
			<div><input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password"/></div>
			<div><input type="button" name="dugmeRegister" id="dugmeRegister" value="Continue"></div>
		</form>
	</div>

	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>