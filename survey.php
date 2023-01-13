<?php
	session_start();
	if(!(isset($_SESSION['username']))){
		header('Location: 403.php');
		exit();
	}
	require "connection.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Survey</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
	<meta charset="utf-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<meta name="author" content=" Teodora Nedeljković"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" href="assets/img/favicon.ico"/>
</head>
<body>
	<div id="poster">
		
	</div>


	<?php include "footer.php"; ?>


	<div id="signInBlock" class="signInRegisterPage">
		<div id="header">
			<div class="wrapper">
				<div>
					<a href="index.php"><img src="assets/img/logo.png" alt="logo"></a>
				</div>
				<div>
					<ul id="nav">
						<li><a href="movies.php">movies</a></li>
						<li><a href="reviews.php">reviews</a></li>
						<li><a href="watchlist.php">watchlist</a></li>
					</ul>
				</div>
				<div></div>
			</div>
		</div>
		<?php
			$username = $_SESSION['username'];

			$userSelect = $connection->prepare("SELECT id FROM user WHERE username=:user");
			$userSelect->bindParam(":user",$username);
			$userSelect->execute();
			$userSelectResult = $userSelect->fetch();
			$userId = $userSelectResult['id'];

			$checkSelect = $connection->prepare("SELECT user_id FROM surveyanswer WHERE user_id=:userId");
			$checkSelect->bindParam(":userId",$userId);
			$checkSelect->execute();
			$checkResult = $checkSelect->fetchAll();

			if(count($checkResult)>0){
				echo "<h1 style='color:grey; font-size:17px;'>You had already done the quiz! Go back to home page <a href='index.php'>here</a>.</h1>";
				echo "<script type='text/javascript' src='js/jquery.js'></script>
					<script type='text/javascript' src='js/main.js'></script>
				</body>
			</html>";

				exit();
			}
		?>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" name="surveyForm" class="surveyForm" onsubmit="return proveraSurvey()">
			<?php
				$questionsSelectQuery = $connection->prepare("SELECT DISTINCT sqoa.question_id,q.text AS 'question' FROM survey_question_offeredanswer sqoa INNER JOIN question q ON sqoa.question_id=q.id WHERE sqoa.survey_id=1");
				$questionsSelectQuery->execute();
				$questionsSelectResult = $questionsSelectQuery->fetchAll();


				$surveyNameSelectQuery = $connection->prepare("SELECT DISTINCT name FROM survey q WHERE id=1");
				$surveyNameSelectQuery->execute();
				$surveyNameSelectResult = $surveyNameSelectQuery->fetch();
				echo "<h1>{$surveyNameSelectResult['name']}</h1>";


				$count = 0;
				foreach ($questionsSelectResult as $row){
					$question = $row['question'];
					$questionId = $row['question_id'];
					echo "<div><h4>{$question}</h4></div>";
					$offeredAnswersQuery = $connection->prepare("SELECT DISTINCT oa.text FROM survey_question_offeredanswer sqoa INNER JOIN question q ON sqoa.question_id=q.id INNER JOIN offeredanswers oa ON sqoa.offeredanswer_id=oa.id WHERE q.id=:questionId AND sqoa.survey_id=1");
					$offeredAnswersQuery->bindParam(":questionId",$questionId);
					$offeredAnswersQuery->execute();
					$offeredAnswersResult = $offeredAnswersQuery->fetchAll();


					$count = $count+1;
					if(count($offeredAnswersResult) == 0){
						echo "<div><input type='text' name='answer{$count}' id='answer{$count}'/></div>";
					} else{
						foreach ($offeredAnswersResult as $answer){
							$answer = $answer['text'];
							echo "<div><input type='radio' value='{$answer}' class='watchRadio' name='watchRadio' style='height: 15px; width:30px;'/><label><p style='font-size:12px'>{$answer}</p></label></div>";
						}
					}
				}
				echo "<div class='errorsBlock' id='surveyError'>
					</div>"	;
				echo "<div><input type='submit' name='submitSurvey' id='submitSurvey'/></div>";
			?>
		</form>
	</div>

	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>

<?php
	if($connection){
		$radioChoice = $_POST['watchRadio'];
		$textAnswer = $_POST['answer2'];
		$username = $_SESSION['username'];

		$userSelect = $connection->prepare("SELECT id FROM user WHERE username=:user");
		$userSelect->bindParam(":user",$username);
		$userSelect->execute();
		$userSelectResult = $userSelect->fetch();
		$userId = $userSelectResult['id'];

		foreach ($questionsSelectResult as $row){
			$questionId = $row['question_id'];
			$surveyId=1;
			if($questionId==1){

				$insertQuery = $connection->prepare("INSERT INTO `surveyanswer`( `user_id`, `survey_id`, `question_id`, `text`) VALUES (:userId,:surveyId,:questionId,:answer)");
			$insertQuery->bindParam(":userId",$userId);
			$insertQuery->bindParam(":surveyId",$surveyId);
			$insertQuery->bindParam(":questionId",$questionId);
			$insertQuery->bindParam(":answer",$radioChoice);
			$insertQuery->execute();

			} else if($questionId==2){
			$insertQuery = $connection->prepare("INSERT INTO `surveyanswer`( `user_id`, `survey_id`, `question_id`, `text`) VALUES (:userId,:surveyId,:questionId,:answer)");
			$insertQuery->bindParam(":userId",$userId);
			$insertQuery->bindParam(":surveyId",$surveyId);
			$insertQuery->bindParam(":questionId",$questionId);
			$insertQuery->bindParam(":answer",$textAnswer);
			$insertQuery->execute();
			}
		}
		if($insertQuery){
			header('Location: index.php');
		}
	}
?>