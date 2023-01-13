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

				$watchlistDeleteQuery = $connection->prepare("DELETE FROM `user_movie(watchlist)` WHERE user_id=:user AND movie_id=:movie");
				$watchlistDeleteQuery->bindParam(":user",$userId);
				$watchlistDeleteQuery->bindParam(":movie",$movieId);
				$watchlistDeleteQuery->execute();
				$watchlistDeleteResult = $watchlistDeleteQuery->rowCount();

				if($watchlistDeleteResult>0){
					echo "success";
				} else{
					echo "failed";
				}
			}
		}
	} else{
		echo "not logged in";
	}
?>