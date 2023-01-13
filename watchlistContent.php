<?php
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];

		$userSelectQuery = $connection->prepare("SELECT id FROM user WHERE username=:user");
		$userSelectQuery->bindParam(":user", $username);
		$userSelectQuery->execute();
		$userSelectResult = $userSelectQuery->fetchAll();

		if(count($userSelectResult)==1){
			$userId = $userSelectResult[0]['id'];

			$watchlistSelectQuery = $connection->prepare("SELECT * FROM `user_movie(watchlist)` WHERE user_id=:user");
			$watchlistSelectQuery->bindParam(":user",$userId);
			$watchlistSelectQuery->execute();
			$watchlistSelectResult = $watchlistSelectQuery->fetchAll();
							
			if(count($watchlistSelectResult)==0){
				echo "<div id='watchlistEmpty'>
						<h4>HOW TO ADD</h4>
						<p>Add films you want to see to your watchlist from the
					 icon on each film poster. Click <a href='movies.php'>here</a> to choose movies!</p>
					</div>";
			} else{
				echo "<h2>YOUR WATCHLIST</h2>";
				foreach($watchlistSelectResult as $movie){
					$movieId = $movie['movie_id'];
					$moviePhotoSelectQuery = $connection->prepare("SELECT src,alt FROM moviePhoto WHERE movie_id=:id");
					$moviePhotoSelectQuery->bindParam(":id",$movieId);
					$moviePhotoSelectQuery->execute();
					$moviePhotoSelectResult = $moviePhotoSelectQuery->fetch();
					$src = $moviePhotoSelectResult['src'];
					$alt = $moviePhotoSelectResult['alt'];

					echo "<div class='watchlistMovie' data-id='{$movieId}'>
							<div class='watchlistPhoto' data-id='{$movieId}'>
								<img src='assets/img/movies/{$src}' alt='{$alt}'/>
							</div>
							<div class='remove'>
								<div class='removeFromWatchlist close' data-id='{$movieId}'><span></span><span></span></div>
								<p>&nbsp;remove from watchlist</p>
							</div>
						</div>";
					}
				}
			}
		} else{
		echo "<div id='watchlistEmpty'>
				<h4>HOW TO ADD</h4>
				<p><a href='signin.php'>Sign in </a> or <a href='register.php'>register </a> to add movies to your watchlist!</p>
			</div>";
	}
?>