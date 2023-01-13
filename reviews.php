<?php
	session_start();
	require "connection.php";
	include "logic/addReview.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reviews</title>
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

	
	<div class="content">
		<div class="wrapper">
			<div id="reviews">
				<div>
					<h2>REVIEWS</h2>
					<div id="reviewedMovies">
						<h4>recently reviewed movies</h4>
						<div>
							<?php
								include "reviewContent.php";
								reviewed_movies_top($connection,8);
							?>	
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div id="addReviewLink">
		<?php 
			if(isset($_SESSION['username'])){
				echo "<p id='addReview'>&nbsp;Add your own review here.</p>";
			} else{
				echo "<p><a href='signin.php'>&nbsp;Sign in</a> to add your review.</p>";
			}
		?>
	</div>
	<div class="content">
		<div class="wrapper">
			<div id="reviews">
				<div id="reviewBlock">
					<p><i class="fas fa-angle-right"></i>&nbsp;&nbsp;most recent reviews</p>
					<hr/>
					<?php 
						review_pages($connection);
					?>
				</div>
			</div>
		</div>
	</div>

	<div id="news">
		<div class="wrapper">
			<div class="title">
				<p><i class="fas fa-angle-right"></i>&nbsp;&nbsp;LATEST NEWS</p>
				<hr/>
			</div>
			<div id="newsBlock">
				<div class="news" id="reviewNews">
					<a href="#"><img src="assets/img/news/4.jpg" alt="news"/></a>
					<div>
						<a href="#"><h3>Housing Crisis</h3></a>
						<p>Vivarium director Lorcan Finnegan tells us about his intriguing new film, the horrors of housing, The Quiet Earth, and his experiences with Nathan Barley and Charlie Brooker. </p>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<div id="addReviewBlock">
		<div class="formClose close">
			<span></span>
			<span></span>
		</div>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" name="addReviewForm" onsubmit="return reviewProvera()">
			<h4>Write a review</h4>
			<div>
				<select id="movieSelect" name="movieSelect">
					<option value='0'>Movies</option>
					<?php 
						$moviesSelectQuery = $connection->prepare("SELECT * FROM movie");
						$moviesSelectQuery->execute();
						$moviesSelectResult = $moviesSelectQuery->fetchAll();

						foreach ($moviesSelectResult as $movie) {
							$title = $movie['title'];
							$id = $movie['id'];
							echo "<option value='{$id}'>{$title}</option>";
						}
					?>
				</select>
			</div>
			<div>
				<textarea placeholder="Add a review..." id="reviewText" name="reviewText"></textarea>
			</div>
			<div><input type="submit" name="submitReview" id="submitReview"/></div>
		</form>
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
	<script  src="assets/js/main.js"></script>
</body>
</html>
