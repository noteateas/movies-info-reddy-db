<?php
	
	if($connection){
		if(isset($_POST['submitReview'])){
			if(isset($_SESSION['username'])){

				$username = $_SESSION['username'];
				$movieId = $_POST['movieSelect'];
				$reviewText = $_POST['reviewText'];
				$errors = array();

				$regexText = "/^.{1,1500}$/";

				if(!preg_match($regexText,$reviewText)){
					array_push($errors,'Review not in right format');
				}
				if($movieId==0){
					array_push($errors,'Movie not chosen.');
				}

				if(count($errors)==0){
					$usernameSelectQuery=$connection->prepare("SELECT id FROM user WHERE username=:user");
					$usernameSelectQuery->bindParam(":user", $username);
					$usernameSelectQuery->execute();
					$usernameSelectResult = $usernameSelectQuery->fetch();

					$userId=$usernameSelectResult['id'];

					$insertQuery = $connection->prepare("INSERT INTO review(`user_id`, `movie_id`, `text`) VALUES(:userId, :movieId,:reviewText)");
					$insertQuery->bindParam(":userId",$userId);
					$insertQuery->bindParam(":movieId", $movieId);
					$insertQuery->bindParam(":reviewText", $reviewText);
					$insertQuery->execute();
					
					if($insertQuery){
						header('Location: reviews.php?msg=success');
					}
				}
			}
		}
	} else{
		echo "Server currently unavailable.";
	}

?>