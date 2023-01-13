<?php
	require "../connection.php";
	if($connection){
		if(isset($_POST['deleteMovieSubmit'])){
			$errors = array();

			$movieId = $_POST['movieSelect'];
			$directorId = $_POST['idDeleteDirector'];

			if($directorId == 0){
				array_push($errors,'Director not chosen.');
			}
			if($movieId==0){
				array_push($errors,'Movie not chosen.');
			}


			if(count($errors)==0){
				//movie check

				$selectQueryId = $connection->prepare("SELECT * FROM movie m INNER JOIN movie_crew mc ON m.id = mc.movie_id INNER JOIN crew c ON mc.crew_id = c.id WHERE movie_id=:movieId AND c.id = :directorId");
				$selectQueryId->bindParam(":movieId",$movieId);
				$selectQueryId->bindParam(":directorId",$directorId);
				$selectQueryId->execute();
				$selectResultId = $selectQueryId->rowCount();


				if(($selectResultId==1)||($selectResultName==1)){
					//movie delete
					$deleteMovie = $connection->prepare("DELETE m FROM movie m INNER JOIN movie_crew mc ON m.id = mc.movie_id INNER JOIN crew c ON mc.crew_id = c.id WHERE movie_id=:movieId AND c.id = :directorId");
					$deleteMovie->bindParam(":movieId",$movieId);
					$deleteMovie->bindParam(":directorId",$directorId);
					$deleteMovie->execute();
					if($deleteMovie){
						header('Location: ../controlPanel.php?del=success');
					}
				} else{
					header('Location: ../controlPanel.php?del=nomatch');
				}
			}
			else{
				header('Location: ../controlPanel.php?del=invalid');
			}
		}
		
	} else{
		echo "server unavailable";
	}

?>