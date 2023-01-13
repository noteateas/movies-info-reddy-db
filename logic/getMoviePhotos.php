<?php
	if(isset($_POST['moviePhotos'])){
		require "../connection.php";
		$allMoviePhotosSelectQuery = $connection->prepare("SELECT movie_id,src,alt FROM moviePhoto");
		$allMoviePhotosSelectQuery->execute();
		$allMoviePhotosSelectResult = $allMoviePhotosSelectQuery->fetchAll(PDO::FETCH_ASSOC);

		if($allMoviePhotosSelectResult){
			header("Content-Type: application/json");
			$json = json_encode($allMoviePhotosSelectResult);
			echo $json;
			http_response_code(200);
		} else{
			http_response_code(500);
		}
	}
?>