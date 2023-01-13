<?php

	if(isset($_POST['directors'])){
		require "../connection.php";

		$allDirectorsSelectQuery = $connection->prepare("SELECT c.fullname,c.id FROM crew c INNER JOIN crew_movieroles cmr ON c.id=cmr.crew_id INNER JOIN movieroles mr ON cmr.movieRoles_id=mr.id WHERE mr.name='director'");
		$allDirectorsSelectQuery->execute();
		$allDirectorsSelectResult = $allDirectorsSelectQuery->fetchAll(PDO::FETCH_ASSOC);

		if($allDirectorsSelectResult){
			header("Content-Type: application/json");
			$json = json_encode($allDirectorsSelectResult,JSON_UNESCAPED_UNICODE);
			echo $json;
			http_response_code(200);
		} else{
			http_response_code(500);
		}
	}
?>