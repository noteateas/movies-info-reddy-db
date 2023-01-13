<?php
	if($connection){
		function review_structure($text,$maxlength,$username,$movieTitle,$src,$alt,$datePosted){
				echo "<div class='review'>
						<div>
							<img src='assets/img/movies/{$src}' alt='{$alt}'/>
						</div>
						<div>
							<h4>{$movieTitle}</h4>
							<a id='name' href='#'>{$username}</a>
							<p id='text'>";
													
						if(strlen($text)>$maxlength){
							$initialText = substr($text,0,$maxlength);
							$textMore = substr($text,$maxlength, strlen($text));
							echo "{$initialText}<span class='more-text'>{$textMore}</span>
								<a href='#' class='showMore'>...see more</a>";
						} else{
							echo $text;
						}

					echo "</p>
							<p id='time'>{$datePosted}</p>
						</div>
					</div>";
		}
		function review_info($connection,$reviewsArray){
				foreach($reviewsArray as $review){
					$maxlength=290;
					$userId = $review['user_id'];
					$movieId = $review['movie_id'];
					$text = $review['text'];
					$datePosted = $review['date_posted'];
					$datePosted = date('d M Y',strtotime($datePosted));

					$userSelectQuery = $connection->prepare("SELECT username FROM user WHERE id=:user_id");
					$userSelectQuery->bindParam(":user_id",$userId);
					$userSelectQuery->execute();
					$userSelectResult= $userSelectQuery->fetch();

					$username = $userSelectResult['username'];

					$movieSelectQuery = $connection->prepare("SELECT m.title, mp.src, mp.alt FROM review r INNER JOIN movie m ON r.movie_id=m.id INNER JOIN moviephoto mp ON m.id=mp.movie_id WHERE r.movie_id=:movieId");
					$movieSelectQuery->bindParam(":movieId",$movieId);
					$movieSelectQuery->execute();
					$movieSelectResult = $movieSelectQuery->fetch();

					$movieTitle = $movieSelectResult['title'];
					$src = $movieSelectResult['src'];
					$alt = $movieSelectResult['alt'];

					review_structure($text,$maxlength,$username,$movieTitle,$src,$alt,$datePosted);
				}
		}

		function review_pages($connection){
			$allReviewsSelectQuery = $connection->prepare("SELECT * FROM review");
			$allReviewsSelectQuery->execute();
			$allReviewsSelectResult = $allReviewsSelectQuery->fetchAll();

			$totalReviews = count($allReviewsSelectResult);
			$perPage = 4;
			$pagesInTotal = ceil($totalReviews/$perPage);
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			} else{
				$page = 1;
			}
			$offset = ($page-1)*$perPage;

			$reviewsSelectQuery = $connection->prepare("SELECT * FROM review ORDER BY date_posted DESC LIMIT :perPage OFFSET :offset");
			$reviewsSelectQuery->bindParam(":perPage", $perPage, PDO::PARAM_INT);
			$reviewsSelectQuery->bindParam(":offset", $offset, PDO::PARAM_INT);
			$reviewsSelectQuery->execute();
			$reviewsSelectResult = $reviewsSelectQuery->fetchAll();

			if(count($reviewsSelectResult)>0){
				review_info($connection,$reviewsSelectResult);
			}

			$i = 0;
			$thisPage = $_SERVER['PHP_SELF'];

			echo "<div class='pagination'>";
			for ($i=1; $i<= $pagesInTotal; $i++) {
				echo "<a href='{$thisPage}?page={$i}'>{$i}</a>";
			}
			echo "</div>";
		}
		function review_top($connection,$howManyReviews){

			$reviewsSelectQuery = $connection->prepare("SELECT * FROM review ORDER BY date_posted DESC LIMIT :howManyReviews");
			$reviewsSelectQuery->bindParam(":howManyReviews", $howManyReviews, PDO::PARAM_INT);
			$reviewsSelectQuery->execute();
			$reviewsSelectResult = $reviewsSelectQuery->fetchAll();

			if(count($reviewsSelectResult)>0){
				review_info($connection,$reviewsSelectResult);
			}
		}


		function reviewed_movies_top($connection,$howManyReviews){
			$movieSelectQuery = $connection->prepare("SELECT DISTINCT src, alt FROM review r  INNER JOIN moviephoto mp ON mp.movie_id = r.movie_id ORDER BY date_posted DESC LIMIT :howManyReviews");
			$movieSelectQuery->bindParam(":howManyReviews", $howManyReviews, PDO::PARAM_INT);
			$movieSelectQuery->execute();
			$movieSelectResult = $movieSelectQuery->fetchAll();


			if(count($movieSelectResult)>0){
				reviewed_movies_structure($connection,$movieSelectResult);
			}
		}
		function reviewed_movies_structure($connection,$movieSelectResult){
			foreach($movieSelectResult as $movieReview){
				$src = $movieReview['src'];
				$alt = $movieReview['alt'];
				echo "
					<img src='assets/img/movies/{$src}' alt='{$alt}'/>
				";
			}
			
		}
		
	} else{
		echo "<p>Server unavailable. Try again later.</p>";
	}
?>