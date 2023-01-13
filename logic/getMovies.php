<?php

	//if(isset($_POST['movies'])){
		require "../connection.php";

		$allMoviesSelectQuery = $connection->prepare("SELECT * FROM movie");
		$allMoviesSelectQuery->execute();
		$allMoviesSelectResult = $allMoviesSelectQuery->fetchAll(PDO::FETCH_ASSOC);


		if($allMoviesSelectResult){
			$json = json_encode($allMoviesSelectResult,JSON_UNESCAPED_UNICODE);
			json_last_error();
			header("Content-Type: application/json");
			echo $json;
			http_response_code(200);
		} else{
			http_response_code(500);
		}
	//}
?>