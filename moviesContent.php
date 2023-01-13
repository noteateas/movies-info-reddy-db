<?php
	require "connection.php";

	if($connection){

		include "movieInfo.php";

		$allMoviesSelectQuery = $connection->prepare("SELECT * FROM movie");
		$allMoviesSelectQuery->execute();
		$allMoviesSelectResult = $allMoviesSelectQuery->fetchAll();

		$totalMovies = count($allMoviesSelectResult);
		$perPage = 16;
		$pagesInTotal = ceil($totalMovies/$perPage);
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		} else{
			$page = 1;
		}
		$offset = ($page-1)*$perPage;

		if(count($allMoviesSelectResult)>0){
			$moviesSelectQuery = $connection->prepare("SELECT * FROM movie LIMIT :perPage OFFSET :offset");
			$moviesSelectQuery->bindParam(":perPage", $perPage, PDO::PARAM_INT);
			$moviesSelectQuery->bindParam(":offset", $offset, PDO::PARAM_INT);
			$moviesSelectQuery->execute();
			$moviesSelectResult = $moviesSelectQuery->fetchAll();

			$moviePhotoSelectQuery = $connection->prepare("SELECT * FROM moviephoto");
			$moviePhotoSelectQuery->execute();
			$moviePhotoSelectResult = $moviePhotoSelectQuery->fetchAll();

			foreach ($moviesSelectResult as $movie) {
				$movieId = $movie['id'];

				foreach ($moviePhotoSelectResult as $photo) {
					$photoMovieId = $photo['movie_id'];
					if($photoMovieId==$movieId){
						$src = $photo['src'];
						$alt = $photo['alt'];
					break;
					}
				}
				echo "<div class='movie' data-id='{$movieId}'>
						<img src='assets/img/movies/{$src}' alt='{$alt}'/>
					</div>";

			}
			$i = 0;
			$thisPage = $_SERVER['PHP_SELF'];

			echo "<div class='pagination'>";
			for ($i=1; $i<= $pagesInTotal; $i++) {
				echo "<a href='{$thisPage}?page={$i}'>{$i}</a>";
			}
			echo "</div>";	
		}
	else{
		echo "Server currently unavailable.";
		}
	}
?>

