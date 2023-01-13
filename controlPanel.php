<?php
	session_start();
	require "connection.php";
	if(!isset($_SESSION['username'])||($_SESSION['role']!=1)){
		header('Location: 403.php');
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Control Panel</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"/>
	<meta charset="utf-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<meta name="author" content=" Teodora Nedeljković"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" href="assets/img/favicon.ico"/>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
	
	<?php include "header.php"; ?>

	<div id="controlPanel">
		<div class="wrapper">
			<?php include "controlPanelContent.php"; ?>
			<h2>statistics</h2>
			<hr/>
			<div id="statsBlock">
				<?php stats_structure($connection); ?>
			</div>
			<h2>edit</h2>
			<hr/>
			<div id="editBlock">




				<h3 id="updateMovie">Update a Movie</h3>
				<div class="editForm" id="updateMovieBlock">
					<div>
						<h4>Update a Movie</h4>
						<div class="close formClose" id="updateMovieBlockClose">
							<span></span>
							<span></span>
						</div>
						<form action="logic/updateMovie.php" method="POST"  name="formUpdateMovie" onsubmit="return proveraUpdateMovie()">
							<div><select id="movieSelectUpdate" name="movieSelectUpdate">
								<option value='0'>Movies</option>
								<?php 
									$moviesSelectQuery = $connection->prepare("SELECT * FROM movie");
									$moviesSelectQuery->execute();
									$moviesSelectResult = $moviesSelectQuery->fetchAll();

									foreach ($moviesSelectResult as $movie) {
										$title = $movie['title'];
										$id = $movie['id'];
										echo "<option value='{$id}'>{$title}</option>";
									}
								?>
							</select></div>
							<div><input type="text" name="titleUpdate" placeholder="Title" id="titleUpdate"/></div>
							<div><input type="text" name="yearUpdate" placeholder="Year" id="yearUpdate"/></div>
							<div><input type="text" name="lengthUpdate" placeholder="Length in minutes" id="lengthUpdate"/></div>
							<div><textarea placeholder="Synopsis" name="synopsisUpdate" id="synopsisUpdate"></textarea></div>
							<div><select id="genreListUpdate" name="genreListUpdate[]" multiple size="4">
								<option value='0'>Choose Genre</option>
								<?php 
									$genresSelectQuery = $connection->prepare("SELECT * FROM genre");
									$genresSelectQuery->execute();
									$genresSelectResult = $genresSelectQuery->fetchAll();

									foreach ($genresSelectResult as $genre) {
										$name = $genre['name'];
										$id = $genre['id'];
										echo "<option value='{$id}'>{$name}</option>";
									}
								?>

							</select></div>
							<div><input type="submit" name="updateMovieSubmit" id="updateMovieSubmit"></div>
							<div class="errorsBlock" id="errorsBlockUpdate">
							
							</div>
						</form>
					</div>
				</div>






				<h3 id="insertMovie">Insert a Movie</h3>
				<div class="editForm" id="insertMovieBlock">
					<div>
						<h4>Insert a Movie</h4>
						<div class="close formClose" id="insertMovieBlockClose">
							<span></span>
							<span></span>
						</div>
						<form action="logic/insertMovie.php" method="POST"  name="formInsertMovie" onsubmit="return proveraEditMovie('titleInsert','yearInsert','lengthInsert','synopsisInsert','photoMovieInsert','genreListInsert')" enctype="multipart/form-data">
							<div><input type="text" name="titleInsert" placeholder="Title" id="titleInsert"/></div>
							<div><input type="text" name="yearInsert" placeholder="Year" id="yearInsert"/></div>
							<div><input type="text" name="lengthInsert" placeholder="Length in minutes" id="lengthInsert"/></div>
							<div><textarea placeholder="Synopsis" name="synopsisInsert" id="synopsisInsert"></textarea></div>
							<div><input type="file" name="photoMovieInsert" id="photoMovieInsert"/></div>
							<div><select id="genreListInsert" name="genreListInsert[]" multiple size="4">
								<option value='0'>Choose Genre</option>
								<?php 
									$genresSelectQuery = $connection->prepare("SELECT * FROM genre");
									$genresSelectQuery->execute();
									$genresSelectResult = $genresSelectQuery->fetchAll();

									foreach ($genresSelectResult as $genre) {
										$name = $genre['name'];
										$id = $genre['id'];
										echo "<option value='{$id}'>{$name}</option>";
									}
								?>
							</select></div>
							<div><input type="submit" name="insertMovieSubmit" id="insertMovieSubmit"></div>
						</form>
						<div class="errorsBlock" id="errorsBlockInsert">
							
						</div>
					</div>
				</div>





				<h3 id="deleteMovie">Delete a Movie</h3>
				<div class="editForm" id="deleteMovieBlock">
					<div>
						<h4>Delete a Movie</h4>
						<div class="close formClose" id="deleteMovieBlockClose">
							<span></span>
							<span></span>
						</div>
						<form action="logic/deleteMovie.php" method="POST"  name="formDeleteMovie" onsubmit="return proveraDeleteMovie()" autocomplete="off">
							<div><p style='font-size: 11px;'>Please choose one of the director suggestions as you type.</p></div>
							<div><select id="movieSelect" name="movieSelect">
								<option value='0'>Movies</option>
								<?php 
									$moviesSelectQuery = $connection->prepare("SELECT * FROM movie");
									$moviesSelectQuery->execute();
									$moviesSelectResult = $moviesSelectQuery->fetchAll();

									foreach ($moviesSelectResult as $movie) {
										$title = $movie['title'];
										$id = $movie['id'];
										echo "<option value='{$id}'>{$title}</option>";
									}
								?>
							</select></div>
							<div class="autocompleteBlockHolder">
								<input type="text" name="directorDelete" placeholder="Director" id="directorDelete" class="autocomplete autocompleteDirectors"/>
								<div class="autocompleteBlock" style='display:none;'></div>
								<input type="hidden" name="idDeleteDirector" id="idDeleteDirector"/>
							</div>
							<div><input type="submit" name="deleteMovieSubmit" id="deleteMovieSubmit"></div>
						</form>
						<div class="errorsBlock" id="errorsBlockDelete">
							<?php
								if(isset($_GET['del'])){
									$msg = $_GET['del'];
									if($msg=='nomatch'){
										echo "<div class='error'><p>Movie and director don't match.</p></div>";
									} else if(($msg=='invalid')){
										echo "<div class='error'><p>Invalid format.</p></div>";
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<!--<h2>survey</h2>
			<hr/>
			<div id="editBlock">
				<h3>Add a question</h3>
				<div class="editForm" id="addQuestionBlock"></div>

				<h3>Add a possible answer</h3>
				<div class="editForm" id="addAnswer"></div>
			</div>-->
			<h2>menu</h2>
			<hr/>
			<div id="editBlock">
				<h3 id="insertMenuLink">Add a menu link</h3>
				<div class="editForm" id="addMenuLinkBlock">
					<div class="close formClose" id="addMenuLinkBlockClose">
							<span></span>
							<span></span>
						</div>
					<form action="logic/insertMenuLink.php" method="POST"  name="formMenuLink" onsubmit="return proveraAddMenuLink()">
	
						<div><input type="text" id="nameMenu" name="nameMenu" placeholder="Name"/></div>
						<div><input type="text" id="linkMenu" name="linkMenu" placeholder="Link"/></div>
						<div><input type="text" id="levelMenu" name="levelMenu" placeholder="Level"/></div>
						<div>
							<select id="typeSelect" name="typeSelect">
								<option value='0'>Type options</option>
									<?php 
										$typeSelectQuery = $connection->prepare("SELECT DISTINCT type FROM navigation");
										$typeSelectQuery->execute();
										$typeSelectResult = $typeSelectQuery->fetchAll();

										foreach ($typeSelectResult as $type) {
											$title = $type['type'];
											echo "<option value='{$title}'>{$title}</option>";
										}
									?>
							</select>
						</div>
						<div><p style="font-size: 11px;">If the new menu link has a parent category, please select one of the following.</p></div>
						<div>
							<select id="menuSelect" name="menuSelect">
								<option value='0'>Menu options</option>
									<?php 
										$menuSelectQuery = $connection->prepare("SELECT * FROM navigation");
										$menuSelectQuery->execute();
										$menuSelectResult = $menuSelectQuery->fetchAll();

										foreach ($menuSelectResult as $menu) {
											$name = $menu['name'];
											$id = $menu['id'];
											echo "<option value='{$id}'>{$name}</option>";
										}
									?>
							</select>
						</div>
						<div class="errorsBlock" id="errorsBlockMenuLink">
							
						</div>
						<div><input type="submit" name="insertMenuLinkSubmit"></div>
					</form>
				</div>

				<h3 id="deleteMenuLink">Delete a menu link</h3>
				<div class="editForm" id="deleteMenuLinkBlock">
					<div class="close formClose" id="deleteMenuLinkBlockClose">
							<span></span>
							<span></span>
						</div>
					<form action="logic/deleteMenuLink.php" method="POST"  name="formMenuLink" onsubmit="return proveraDeleteMenuLink()">

						<div><p style="font-size: 11px;">Choose which menu link you would like to delete.</p></div>
						<div>
							<select id="menuDelSelect" name="menuDelSelect">
								<option value='0'>Menu options</option>
									<?php 
										$menuSelectQuery = $connection->prepare("SELECT * FROM navigation");
										$menuSelectQuery->execute();
										$menuSelectResult = $menuSelectQuery->fetchAll();

										foreach ($menuSelectResult as $menu) {
											$name = $menu['name'];
											$id = $menu['id'];
											echo "<option value='{$id}'>{$name}</option>";
										}
									?>
							</select>
						</div>
						<div class="errorsBlock" id="errorsBlockDeleteMenuLink">
							
						</div>
						<div><input type="submit" name="deleteMenuLinkSubmit"></div>
					</form>
				</div>
			</div>

			<h2>users</h2>
			<hr/>
			<div id="editBlock">
				<h3 id="deleteUser">Delete a user</h3>
				<div class="editForm" id="deleteUserBlock">
					<div class="close formClose" id="deleteUserBlockClose">
							<span></span>
							<span></span>
						</div>
					<form action="logic/deleteUser.php" method="POST"  name="formDeleteUser" onsubmit="return proveraDeleteUser()">
	
						<div>
							<select id="userSelect" name="userSelect">
								<option value='0'>Users</option>
									<?php 
										$userSelectQuery = $connection->prepare("SELECT * FROM user");
										$userSelectQuery->execute();
										$userSelectResult = $userSelectQuery->fetchAll();

										foreach ($userSelectResult as $user) {
											$username = $user['username'];
											$id = $user['id'];
											echo "<option value='{$id}'>{$username}</option>";
										}
									?>
							</select>
						</div>

						
						<div class="errorsBlock" id="errorsBlockDeleteUser">
							
						</div>
						<div><input type="submit" name="deleteUserSubmit"></div>
					</form>
				</div>
			</div>


			<!--<h2>reviews</h2>
			<hr/>
			<div id="editBlock">
				<h3 id="deleteReview">Delete a review</h3>
				<div class="editForm" id="deleteReviewBlock">
					<div class="close formClose" id="deleteReviewBlockClose">
						<span></span>
						<span></span>
					</div>
					<form action="logic/deleteReview.php" method="POST"  name="formDeleteReview" onsubmit="return proveraDeleteReview()">
	
						<div id="reviewOptionsBlock">
							<?php 
								$reviewSelectQuery = $connection->prepare("SELECT * FROM review r INNER JOIN user u ON r.user_id=u.id");
								$reviewSelectQuery->execute();
								$reviewSelectResult = $reviewSelectQuery->fetchAll();

								$i = 0;
								foreach ($reviewSelectResult as $review) {
									$username = $review['username'];
									$text = $review['text'];
									$id = $review['id'];
									$i = $i + 1;
									echo "<div class='reviewDelete'>{$i}     <p data-review='{$id}'>{$text}</p></div>";
									echo '<div><input type="submit" name="deleteReviewSubmit"></div><hr>';
								}
							?>
						</div>

						
						<div class="errorsBlock" id="errorsBlockDeleteReview">
							
						</div>
					</form>
				</div>
			</div>-->


		</div>
	</div>





	<?php include "footer.php"; ?>

	<div id="signInBlock">
		<div class="formClose close">
			<span></span>
			<span></span>
		</div>
		<form method="POST" action="signin.php" id="formSignIn" onsubmit="return proveraSignIn()">
			<div><h4>Sign In</h4></div>
			<div><input type="text" name="usernameSignIn" id="usernameSignIn" placeholder="Username"/></div>
			<div><input type="password" name="passwordSignIn" id="passwordSignIn" placeholder="Password"/></div>
			<div id="dugmeSignInBlock"><input type="submit" name="dugmeSignIn" id="dugmeSignIn" value="Continue"></div>
		</form>
	</div>
	<div id="registerBlock">
		<div class="formClose close">
			<span></span>
			<span></span>
		</div>
		<form method="POST" action="register.php" id="formRegister" onsubmit="return proveraRegister()">
			<div><h4>Create An Account</h4></div>
			<div><input type="text" name="fullName" id="fullName" placeholder="Full Name"/></div>
			<div><input type="text" name="usernameRegister" id="usernameRegister" placeholder="Username"/></div>
			<div><input type="email" name="emailRegister" id="emailRegister" placeholder="Email"/></div>
			<div><input type="password" name="passwordRegister" id="passwordRegister" placeholder="Password"/></div>
			<div><input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password"/></div>
			<div><input type="submit" name="dugmeRegister" id="dugmeRegister" value="Continue"></div>
		</form>
	</div>
	

	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>