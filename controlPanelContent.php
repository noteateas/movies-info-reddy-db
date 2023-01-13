<?php
	//try{
		function get_movies($connection){
			$allMoviesSelectQuery = $connection->prepare("SELECT * FROM movie");
			$allMoviesSelectQuery->execute();
			$allMoviesSelectResult = $allMoviesSelectQuery->fetchAll();

			return count($allMoviesSelectResult);
		}
		function get_reviews($connection){
			$allReviewsSelectQuery = $connection->prepare("SELECT * FROM review");
			$allReviewsSelectQuery->execute();
			$allReviewsSelectResult = $allReviewsSelectQuery->fetchAll();

			return count($allReviewsSelectResult);
		}
		function get_users($connection){
			$allUsersSelectQuery = $connection->prepare("SELECT * FROM user");
			$allUsersSelectQuery->execute();
			$allUsersSelectResult = $allUsersSelectQuery->fetchAll();

			return count($allUsersSelectResult);
		}

		function stats_structure($connection){
			$totalMovies = get_movies($connection);
			$totalReviews = get_reviews($connection);
			$totalUsers = get_users($connection);

			echo "
				<div class='stats'><p>{$totalUsers} users</p></div>
				<div class='stats'><p>{$totalReviews} reviews</p></div>
				<div class='stats'><p>{$totalMovies} movies</p></div>
			";
		}
		
		//throw new Exception("Server not available.\n Try again later.");

	/*}catch (Exception $e) {
		echo $e->getMessage();
	}*/

?>