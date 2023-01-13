<?php
	session_start();
	require "../connection.php";

	if(isset($_SESSION['username'])){

		if(isset($_POST['id'])){
			$username = $_SESSION['username'];
			$userSelectQuery = $connection->prepare("SELECT id FROM user WHERE username=:user");
			$userSelectQuery->bindParam(":user", $username);
			$userSelectQuery->execute();
			$userSelectResult = $userSelectQuery->fetchAll();

			if(count($userSelectResult)==1){
				$userId = $userSelectResult[0]['id'];
				$movieId = $_POST['id'];

				$watchlistSelectQuery = $connection->prepare("SELECT * FROM `user_movie(watchlist)` WHERE user_id=:user AND movie_id=:movie");
				$watchlistSelectQuery->bindParam(":user",$userId);
				$watchlistSelectQuery->bindParam(":movie",$movieId);
				$watchlistSelectQuery->execute();
				$watchlistSelectResult = $watchlistSelectQuery->fetchAll();

				if(count($watchlistSelectResult)==0){
					
					$insertQuery = $connection->prepare("INSERT INTO `user_movie(watchlist)`(`user_id`, `movie_id`) VALUES (:userId,:movieId)");
					$insertQuery->bindParam(":userId",$userId);
					$insertQuery->bindParam(":movieId",$movieId);
					$insertQuery->execute();

					if($insertQuery){
						echo "success";
					} else{
						echo "failed";
					}

				} else{
					echo "already in watchlist";
				}

			}
		}
		
	} else{
		echo "username ne postoji";
	}
?>