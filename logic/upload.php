<?php
	session_start();
	require "../connection.php";

	if($connection){
		if(isset($_FILES["uploadProfilePhoto"])){
			$fileSize = $_FILES['uploadProfilePhoto']['size'];
			$fileType = $_FILES['uploadProfilePhoto']['type'];

			if($fileSize<2002000){
				if(($fileType=='image/jpeg')||($fileType=='image/jpg')||($fileType=='image/png')){
					$fileName = $_FILES['uploadProfilePhoto']['name'];
					$tmpFolderName = $_FILES['uploadProfilePhoto']['tmp_name'];
					$uploadFolder = '../assets/img/users/';
					$timestamp = time();
					$fileName = $timestamp.$fileName;
					$filePath = $uploadFolder.$fileName;

					$transfer = move_uploaded_file($tmpFolderName, $filePath);
					if($transfer){
						$username = $_SESSION['username'];
						$selectQuery = $connection->prepare("SELECT id FROM user WHERE username=:user");
						$selectQuery->bindParam(":user", $username);
						$selectQuery->execute();
						$selectResult = $selectQuery->fetchAll();

						if(count($selectResult)==1){
							$id = $selectResult[0]['id'];
							$insertQuery = $connection->prepare("INSERT INTO userPhoto(user_id,src,alt) VALUES (:id,:src,:alt)");
							$insertQuery->bindParam(":id",$id);
							$insertQuery->bindParam(":src",$fileName);
							$insertQuery->bindParam(":alt",$username);
							$insertQuery->execute();
							header('Location: ../profile.php');

							if(!$insertQuery){
								echo "Upload failed.";
								exit();
							}

						} else{
							echo "Upload failed.";
							exit();
						}

					} else{
						echo "Upload failed.";
						exit();
					}

				} else{
					echo('type');
					exit();
				}
			} else{ 
				echo("size");
				exit();
				//has to be smaller than 2mb
			}
		}
	} else{
		echo "connection with the database failed.";
	}

?>