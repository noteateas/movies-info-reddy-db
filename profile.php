<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('Location: 403.php');
		exit();
	}
	
	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['username']);
	}

	include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
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
	
	<div id="profile">
		<div class="wrapper">
			<div id="profileSummary">
				<div id="profileInfo">
					<div id="profilePhoto">
						<?php
							if($connection){
								$username = $_SESSION['username'];
								$regexUser = "/^(?=.*[A-z])(?!\s)[A-z\d.?-]{3,25}$/";

								if(preg_match($regexUser,$username)){
									$selectQueryUN=$connection->prepare("SELECT * FROM user WHERE username=:user");
									$selectQueryUN->bindParam(":user", $username);
									$selectQueryUN->execute();
									$selectResultUN = $selectQueryUN->fetch();

									$userId=$selectResultUN['id'];
									
									$selectQueryPP = $connection->prepare("SELECT src,alt FROM userphoto WHERE user_id=:id");
									$selectQueryPP->bindParam(":id",$userId);
									$selectQueryPP->execute();
									$selectResultPP = $selectQueryPP->fetchAll();

									if(count($selectResultPP)==1){
										echo "<img src='assets/img/users/{$selectResultPP['0']['src']}' alt='{$selectResultPP['0']['alt']}'/>";
									} else{
										echo "<div id='uploadPhotoBlock'><label for='uploadProfilePhoto'>upload photo</label>
												<input type='file' name='uploadProfilePhoto' id='uploadProfilePhoto'/>
											</div>";
											if(isset($_GET['upl'])){
												$err = $_GET['upl'];
												if($err=='size'){
													echo "Image has to be smaller than 2MB.";
												} else if($_GET['type']){
													echo "Image extension has to be jpg, jpeg or png.";
												}
											}
									}
								}
							} else{ echo "connection with the database failed";}
						?>
					</div>
					<?php echo "<h3>{$selectResultUN['fullName']}</h3>";?>
				</div>
				<div id="profileStats">
					<ul>
						<li id="statsReviews">
							<?php
								$reviewSelectQuery = $connection->prepare("SELECT * FROM review WHERE user_id=:id");
								$reviewSelectQuery->bindParam(":id",$userId);
								$reviewSelectQuery->execute();
								$reviewSelectResult = $reviewSelectQuery->fetchAll();
								if(count($reviewSelectResult)>0){
									$reviewsCount = count($reviewSelectResult);
									echo "<p>{$reviewsCount}</p>";
								} else{
									echo "<p>0</p>";
								}
								echo "<span>reviews</span>";
							?>
						</li>
						<li id="statsWatchlist">
							<?php
								$watchlistSelectQuery = $connection->prepare("SELECT * FROM `user_movie(watchlist)` WHERE user_id=:id");
								$watchlistSelectQuery->bindParam(":id",$userId);
								$watchlistSelectQuery->execute();
								$watchlistSelectResult = $watchlistSelectQuery->fetchAll();
								if(count($watchlistSelectResult)>0){
									$watchlistCount = count($watchlistSelectResult);
									echo "<p>{$watchlistCount}</p>";
								} else{
									echo "<p>0</p>";
								}
								echo "<span>in watchlist</span>";
							?>
						</li>
					</ul>
				</div>
			</div>
			<div id="profileContent">
				<!--<div id="favoriteMovies">
					<ul>
						<li>moviefave1<img src="" alt="" /></li>
						<li>moviefave2<img src="" alt="" /></li>
						<li>moviefave3<img src="" alt="" /></li>
					</ul>
				</div>-->
				<div id="contentDetails">
					<div id="watchlistList">
						<h2>Your watchlist</h2>
						<?php
							if(count($watchlistSelectResult)>0){

								$moviePhotoSelectQuery = $connection->prepare("SELECT * FROM moviephoto ");
								$moviePhotoSelectQuery->execute();
								$moviePhotoSelectResult = $moviePhotoSelectQuery->fetchAll();

								foreach($watchlistSelectResult as $movieWatchlist){
									$movieId = $movieWatchlist['movie_id'];

									foreach($moviePhotoSelectResult as $photo){
										if($photo['movie_id']==$movieId){
											$src = $photo['src'];
											$alt = $photo['alt'];
										}
									}
									echo "<div class='movie' data-id='{$movieId}'>
											<img src='assets/img/movies/{$src}' alt='{$alt}'/>
										</div>";

								}
								
							} else{
								echo "<div><p>You have no movies in your watchlist.</p></div>";
							}
						?>
					</div>
					<div id="reviewsList">
					<h2>Your reviews</h2>
						<?php
							if(count($reviewSelectResult)>0){
								include "reviewContent.php";
								review_info($connection,$reviewSelectResult);
							} else{
								echo "<div><p>You haven't written any reviews yet.</p></div>";
							}

						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include "footer.php"; ?>

	<script src="assets/js/jquery.js"></script>
	<script  src="assets/js/main.js"></script>
</body>
</html>

