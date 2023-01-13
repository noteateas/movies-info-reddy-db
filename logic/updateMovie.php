<?php
	require "../connection.php";
	if($connection){
		if(isset($_POST['updateMovieSubmit'])){
			$errors = array();

			$title = $_POST['titleUpdate'];
			$movieId = $_POST['updateMovieId'];
			$year = $_POST['yearUpdate'];
			$synopsis = $_POST['synopsisUpdate'];
			$length = $_POST['lengthUpdate'];
			$genres = $_POST['genreListUpdate'];
			$movieId = $_POST['movieSelectUpdate'];

			$regexTitle = "/^[A-z0-9\s\!\?\.\,\:\=\+\-\'\"\*]{1,100}$/";
			$regexYear = "/^([1][8-9][0-9]{2})|([2][0-9]{3})$/";
			$regexLength = "/^[0-9]{1,3}$/";
			$regexSynopsis = "/^.{10,600}$/";



			if(!(preg_match($regexTitle,$title))){
				array_push($errors,'Title not in right format');
			}
			if(!(preg_match($regexYear,$year))){
				array_push($errors,'Year not in right format');
			}
			if(!(preg_match($regexSynopsis,$synopsis))){
				array_push($errors,'Synopsis not in right format');
			}
			if(!(preg_match($regexLength,$length))){
				array_push($errors,'Length not in right format');
			}
			if($movieId==0){
				array_push($errors,'Movie not chosen.');
			}
			foreach ($genres as $genre) {
				if($genre==0){
					array_push($errors,'Genre must be chosen');
				}
			}


			if(count($errors)==0){
				//movie update
				$updateQuery = $connection->prepare("UPDATE movie SET title=:title, year=:year, length=:length,synopsis=:synopsis WHERE id=:movieId");
				$updateQuery->bindParam(":movieId",$movieId);
				$updateQuery->bindParam(":title",$title);
				$updateQuery->bindParam(":year",$year);
				$updateQuery->bindParam(":length",$length);
				$updateQuery->bindParam(":synopsis",$synopsis);
				$updateQuery->execute();
				$updateResult = $updateQuery->rowCount();

					$deleteGenre = $connection->prepare("DELETE FROM movie_genre WHERE movie_id=:movieId");
					$deleteGenre->bindParam(":movieId",$movieId);
					$deleteGenre->execute();
					$deleteGenreResult = $deleteGenre->rowCount();

					foreach ($genres as $genre){
						$genreId = $genre;
						$insertGenre = $connection->prepare("INSERT INTO movie_genre(genre_id,movie_id) VALUES(:genreId,:movieId)");
						$insertGenre->bindParam(":movieId",$movieId);
						$insertGenre->bindParam(":genreId",$genreId);
						$insertGenre->execute();
						$insertGenreResult = $insertGenre->rowCount();
					}

					header('Location: ../controlPanel.php?up=success');
					exit();

			}
			else{
				header('Location: ../controlPanel.php?up=invalid');
				exit();
			}
		}
		
	} else{
		echo "server unavailable";
	}

?>