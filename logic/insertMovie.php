<?php
	require "../connection.php";
	if($connection){
		if(isset($_POST['insertMovieSubmit'])){
			$errors = array();

			$regexTitle = "/^[A-z0-9\s\!\?\.\,\:\=\+\-\'\"\*]{1,100}$/";
			$regexYear = "/^([1][8-9][0-9]{2})|([2][0-9]{3})$/";
			$regexLength = "/^[0-9]{1,3}$/";
			$regexSynopsis = "/^.{10,600}$/";

			$title = $_POST['titleInsert'];
			$year = $_POST['yearInsert'];
			$length = $_POST['lengthInsert'];
			$synopsis = $_POST['synopsisInsert'];
			$genres = $_POST['genreListInsert'];
			$fileSize = $_FILES['photoMovieInsert']['size'];
			$fileType = $_FILES['photoMovieInsert']['type'];

			if(!preg_match($regexTitle,$title)){
				array_push($errors,'Title not in right format');
			}
			if(!preg_match($regexYear,$year)){
				array_push($errors,'Year not in right format');
			}
			if(!preg_match($regexLength,$length)){
				array_push($errors,'Length not in right format');
			}
			if(!preg_match($regexSynopsis,$synopsis)){
				array_push($errors,'Synopsis not in right format');
			}
			foreach ($genres as $genre) {
				if($genre==0){
					array_push($errors,'Genre must be chosen');
				}
			}
			if(($fileSize>2002000)||($fileType!='image/jpeg')||($fileType!='image/jpg')||($fileType!='image/png')){
				array_push($errors,'Photo must be of extension jpeg, jpg, png and smaller than 2MB.');
			}

			if(count($errors)){
				//file transfer
				$fileName = $_FILES['photoMovieInsert']['name'];
				$tmpFolderName = $_FILES['photoMovieInsert']['tmp_name'];
				$uploadFolder = '../img/movies/';
				$timestamp = time();
				$fileName = $timestamp.$fileName;
				$filePath = $uploadFolder.$fileName;

				$transfer = move_uploaded_file($tmpFolderName, $filePath);

				if($transfer){
					//movie insert
					$insertMovie = $connection->prepare("INSERT INTO movie (title,year,length,synopsis) VALUES(:title,:year,:length,:synopsis)");
					$insertMovie->bindParam(":title",$title);
					$insertMovie->bindParam(":year",$year);
					$insertMovie->bindParam(":length",$length);
					$insertMovie->bindParam(":synopsis",$synopsis);
					$insertMovie->execute();

					$movieId = $connection->lastInsertId();

					//photo insert
					$insertMoviePhoto = $connection->prepare("INSERT INTO moviePhoto (movie_id,src,alt) VALUES(:movieId,:src,:alt)");
					$insertMoviePhoto->bindParam(":movieId",$movieId);
					$insertMoviePhoto->bindParam(":src",$fileName);
					$insertMoviePhoto->bindParam(":alt",$title);
					$insertMoviePhoto->execute();

					//genres insert for the movie
					foreach ($genres as $genre) {
						$insertMovieGenre = $connection->prepare("INSERT INTO movie_genre (movie_id,genre_id) VALUES(:movieId,:genreId)");
						$insertMovieGenre->bindParam(":movieId",$movieId);
						$insertMovieGenre->bindParam(":genreId",$genre);
						$insertMovieGenre->execute();
					}
				}
			}

		header('Location: ../controlPanel.php');
		}
		
	} else{
		echo "server unavailable";
	}

?>