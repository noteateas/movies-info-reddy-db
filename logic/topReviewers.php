<?php
	if($connection){

		$reviewsSelectQuery = $connection->prepare("SELECT user_id,COUNT(*) AS 'reviewsTotal' FROM review GROUP BY user_id ORDER BY reviewsTotal DESC LIMIT 8");
		$reviewsSelectQuery->execute();
		$reviewsSelectResult = $reviewsSelectQuery->fetchAll();

		if(count($reviewsSelectResult)>0){
			foreach ($reviewsSelectResult as $review) {
				$reviewsTotal = $review['reviewsTotal'];

				$userId = $review['user_id'];
				$usernameSelectQuery = $connection->prepare("SELECT username FROM user WHERE id=:userId");
				$usernameSelectQuery->bindParam(":userId",$userId);
				$usernameSelectQuery->execute();
				$usernameSelectResult= $usernameSelectQuery->fetch();

				if($usernameSelectResult){
					$username = $usernameSelectResult['username'];
					$userPhotoSelectQuery = $connection->prepare("SELECT src,alt FROM userPhoto WHERE user_id = :userid");
					$userPhotoSelectQuery->bindParam(":userid",$userId);
					$userPhotoSelectQuery->execute();
					$userPhotoSelectResult = $userPhotoSelectQuery->fetch();

					if($userPhotoSelectResult){
						$src = $userPhotoSelectResult['src'];
						$alt = $userPhotoSelectResult['alt'];

						echo "<div class='userIcon'>
								<div id='userIconPhoto'><img src='assets/img/users/{$src}' alt='{$alt}'/></div>
								<div>
									<h5>{$username}</h5>
									<p>{$reviewsTotal}&nbsp;";
									if($reviewsTotal==1){ echo "review";} else{ echo "reviews";}
									echo "</p>
								</div>
							</div>";

					} else{
						echo "<div class='userIcon'>
								<div id='userIconPhoto'></div>
								<div>
									<h5>{$username}</h5>
									<p>{$reviewsTotal}&nbsp;";
									if($reviewsTotal==1){ echo "review";} else{ echo "reviews";}
									echo "</p>
								</div>
							</div>";
					}
				}
			}
		}

	} else{
		echo "Server currently unavailable.";
	}
?>

