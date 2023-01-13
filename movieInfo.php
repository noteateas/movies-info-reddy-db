<?php
require "connection.php";

if(isset($_POST['info'])){
			$movieId = $_POST['id'];
			$moviesSelectQuery = $connection->prepare("SELECT * FROM movie WHERE id=:id");
			$moviesSelectQuery->bindParam(":id",$movieId);
			$moviesSelectQuery->execute();
			$moviesSelectResult = $moviesSelectQuery->fetch();

			if($moviesSelectResult){
				$moviePhotoSelectQuery = $connection->prepare("SELECT src,alt FROM moviephoto WHERE movie_id=:id");
				$moviePhotoSelectQuery->bindParam(":id",$movieId);
				$moviePhotoSelectQuery->execute();
				$moviePhotoSelectResult = $moviePhotoSelectQuery->fetch();

				$genreSelectQuery = $connection->prepare("SELECT g.name FROM movie m INNER JOIN movie_genre mg ON m.id=mg.movie_id INNER JOIN genre g ON mg.genre_id=g.id WHERE m.id=:id");
				$genreSelectQuery->bindParam(":id",$movieId);
				$genreSelectQuery->execute();
				$genreSelectResult = $genreSelectQuery->fetchAll();

				if($moviePhotoSelectResult&&$genreSelectResult){
					$title = $moviesSelectResult['title'];
					$year = $moviesSelectResult['year'];
					$length = $moviesSelectResult['length'];
					$synopsis = $moviesSelectResult['synopsis'];

					$src = $moviePhotoSelectResult['src'];
					$alt = $moviePhotoSelectResult['alt'];


					echo "<div class='infoMovie'>
							<div class='close' id='infoClose'>
								<span></span>
								<span></span>
							</div>
							<div id='infoDesc'>
								<h2>{$title}&nbsp;&nbsp;&nbsp;&nbsp;{$year}</h2>
								<p>{$synopsis}<br/><br/>{$length}&nbsp;min</p>
								<div class='watchlistIcon' id='addToWatchlist'><p>Add to your watchlist</p></div><br/>
								 <div id='genresBlock'><ul><p>Genres</p><hr/>";

					foreach ($genreSelectResult as $genre) {
						$genreName = $genre['name'];
						echo "<li>{$genreName}</li>";
					}
					echo "</ul></div>";
					$crewSelectQuery = $connection->prepare("SELECT c.fullName, mr.name AS 'role' FROM crew c INNER JOIN movie_crew mc ON c.id = mc.crew_id INNER JOIN crew_movieroles cmr ON mc.crew_id = cmr.crew_id INNER JOIN movieroles mr ON cmr.movieRoles_id = mr.id WHERE mc.movie_id = :id");
					$crewSelectQuery->bindParam(":id",$movieId);
					$crewSelectQuery->execute();

					$crewSelectResult = $crewSelectQuery->fetchAll();

					if(count($crewSelectResult)>0){
						echo "<div class='crewBlock'>";
						foreach ($crewSelectResult as $crewMember) {
							$crewName = $crewMember['fullName']; 
							$crewRole = $crewMember['role'];

							if($crewRole=='director'){
								echo "<ul id='directorsInfo'>
										<p>Director<hr/></p>
										<li>{$crewName}</li>
									  </ul>";
							}
							if($crewRole=='writer'){
								echo "<ul id='writersInfo'>
										<p>Writer<hr/></p>
										<li>{$crewName}</li>
									  </ul>";
							}
							if($crewRole=='producer'){
								echo "<ul id='producersInfo'>
										<p>Producer<hr/></p>
										<li>{$crewName}</li>
									  </ul>";
							}
							if($crewRole=='editor'){
								echo "<ul id='editorsInfo'>
										<p>Editor<hr/></p>
										<li>{$crewName}</li>
									  </ul>";
							}
							if($crewRole=='cinematographer'){
								echo "<ul id='cinematographersInfo'>
										<p>Cinematographer<hr/></p>
										<li>{$crewName}</li>
									  </ul>";
							}
						}
						echo "</div>";				
					}
					echo "</div>
						<div id='infoPhoto'><img src='assets/img/movies/{$src}' alt='{$alt}'/></div>
						</div>";
				}
			}
			
			exit();
		}

?>