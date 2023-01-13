<?php
	require "../connection.php";
	if($connection){
		if(isset($_POST['deleteUserSubmit'])){
			$errors = array();

			$userId = $_POST['userSelect'];

			if($userId == 0){
				array_push($errors,'User not chosen.');
			}

			if(count($errors)==0){

				$delQuery = $connection->prepare("DELETE FROM user WHERE id=:userId");
				$delQuery->bindParam(":userId",$userId);
				$delQuery->execute();
				$delResult = $delQuery->rowCount();
				header('Location: ../controlPanel.php?delUser=success');

			}
			else{
				header('Location: ../controlPanel.php?delUser=invalid');
			}
		}
		
	} else{
		echo "server unavailable";
	}

?>