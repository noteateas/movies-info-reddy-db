<?php

	session_start();
	require "connection.php";
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("Refresh:0; url=index.php");
	}

	//$datum = '2020-12-28';
	//echo `<h1>`.gmdate("Y M D",mktime($datum)).`</h1>`;
	//echo `<h1>`.getdate().`</h1>`;
	/*$datum = getdate(mktime(0,0,0,6,3,2020));
	$danasnjiDan = $datum['wday'];
	echo $danasnjiDan;*/

	/*$futuredate = strtotime("+45 days");
	echo date("F d, Y", $futuredate); // May 31, 2018 */

	/*setcookie("user[ime]","Teodora",time()+3600); 
	setcookie("user[prezime]","Nedeljković",time()+3600);
	setcookie("user[pol]","zenski",time()+3600);
	foreach($_COOKIE["user"] as $indeks=>$vrednost){
		echo $indeks." je ".$vrednost."<br>";
	}*/ 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Reddy - Home Page</title>
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
		
		<?php include "header.php"; ?>

		<div id="posterTitle">
			<h1>Keep track of every movie ever made.</h1>
			<?php
				if(!isset($_SESSION['username'])){
					echo '<div><a href="register.php" class="register">Get started - Register now!</a></div>';
				}
			?>
		</div>
	</div>

	<div id="highlights">
		<div class="wrapper">
			<h2>WE LET YOU...</h2>
			<div id="highlightsBlock">
				<a href="movies.php" class="highlight watched">
					<span class="icons icon-watched"></span>
					<p>Track films you've watched.</p>
				</a>
				<a href="watchlist.php" class="highlight seen">
					<span class="icons icon-seen"></span>
					<p>Save those you want to see.</p>
				</a>
				<a href="reviews.php" class="highlight reviewed">
					<span class="icons icon-reviewed"></span>
					<p>Tell your friends what's good.</p>
				</a>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="wrapper">
			<div id="reviews">
				<div class="title">
					<h2><a href="reviews.php">REVIEWS</a></h2>
					<p><i class="fas fa-angle-right"></i>&nbsp;&nbsp;newest this week</p>
				</div>
				<hr/>
				<div id="reviewBlock">
					<?php 
						include "reviewContent.php";
						review_top($connection,3);
					?>
				</div>
			</div>
			<div id="topReviewers">
				<h2>TOP REVIEWERS</h2>
				<hr/>
				<div id="topReviewersBlock">
					<?php include "logic/topReviewers.php" ?>
				</div>
			</div>
		</div>
	</div>

	<div id="survey">
		<div class="wrapper">
			<div id="surveyBlock">
				<?php
					if(isset($_SESSION['username'])){
						$username = $_SESSION['username'];

						$userSelect = $connection->prepare("SELECT id FROM user WHERE username=:user");
						$userSelect->bindParam(":user",$username);
						$userSelect->execute();
						$userSelectResult = $userSelect->fetch();
						$userId = $userSelectResult['id'];

						$checkSelect = $connection->prepare("SELECT user_id FROM surveyanswer WHERE user_id=:userId");
						$checkSelect->bindParam(":userId",$userId);
						$checkSelect->execute();
						$checkResult = $checkSelect->fetchAll();

						if(count($checkResult)>0){
							echo "<h1 style='color:white; font-size:17px;'>Thank you for participating in the survey.</h1>";
						} else{
							echo "<p>Be a part of our survey <a href='survey.php'>here</a>!</p>";
						}
					} else{
						echo "<p>Sign in to take part in our survey!</p>";
					}
				?>
			</div>
		</div>
	</div>

	<div id="news">
		<div class="wrapper">
			<div class="title">
				<p><i class="fas fa-angle-right"></i>&nbsp;&nbsp;RECENT NEWS</p>
				<hr/>
			</div>
			<div id="newsBlock">
				<div class="news">
        			<a href="#"><img src="assets/img/news/1.jpg" alt=""/></a>
        			<div>
        				<a href="#"><h3>Milking It</h3></a>
        				<p>We talk to American filmmaker Kelly Reichardt about her new film, First Cow.</p>
        			</div>
        		</div>
        		<div class="news">
        			<a href="#"><img src="assets/img/news/2.jpg" alt=""/></a>
        			<div>
        				<a href="#"><h3>Life in Film: Levan Akin</h3></a>
        				<p>The writer/director of And Then We Danced talks masculinity and queer love stories.</p>
        			</div>
        		</div>
        		<div class="news">
        			<a href="#"><img src="assets/img/news/3.jpg" alt=""/></a>
        			<div>
        				<a href="#"><h3>Portrait of a Lady on Fire</h3></a>
        				<p>We sit down with one of the leading women of Céline Sciamma’s Portrait of a Lady on Fire.</p>
        			</div>
        		</div>
			</div>
		</div>
	</div>

	<?php include "footer.php"; ?>

	<div id="signInBlock">
		<div class="formClose close">
			<span></span>
			<span></span>
		</div>
		<form method="POST" action="signin.php" id="formSignIn" onsubmit="return proveraSignIn()">
			<div><h4>Sign In</h4></div>
			<div><input type="text" name="usernameSignIn" id="usernameSignIn" placeholder="Username"/></div>
			<div><input type="password" name="passwordSignIn" id="passwordSignIn" placeholder="Password"/></div>
			<div id="dugmeSignInBlock"><input type="submit" name="dugmeSignIn" id="dugmeSignIn" value="Continue"></div>
		</form>
	</div>
	<div id="registerBlock">
		<div class="formClose close">
			<span></span>
			<span></span>
		</div>
		<form method="POST" action="register.php" id="formRegister" onsubmit="return proveraRegister()">
			<div><h4>Create An Account</h4></div>
			<div><input type="text" name="fullName" id="fullName" placeholder="Full Name"/></div>
			<div><input type="text" name="usernameRegister" id="usernameRegister" placeholder="Username"/></div>
			<div><input type="email" name="emailRegister" id="emailRegister" placeholder="Email"/></div>
			<div><input type="password" name="passwordRegister" id="passwordRegister" placeholder="Password"/></div>
			<div><input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password"/></div>
			<div><input type="submit" name="dugmeRegister" id="dugmeRegister" value="Continue"></div>
		</form>
	</div>

	<script src="assets/js/jquery.js"></script>
	<script  src="assets/js/main.js"></script>
</body>
</html>