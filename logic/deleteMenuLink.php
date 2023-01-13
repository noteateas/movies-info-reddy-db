<?php
	require "../connection.php";
	if($connection){
		if(isset($_POST['deleteMenuLinkSubmit'])){
			$errors = array();

			$menuId = $_POST['menuDelSelect'];
	
			if($menuId == 0){
				array_push($errors, "menu link not chosen");
			}

			if(count($errors)==0){

				$deleteMenuLink = $connection->prepare("DELETE FROM navigation WHERE id = :menuId");
				$deleteMenuLink->bindParam(":menuId",$menuId);
				$deleteMenuLink->execute();

				header('Location: ../controlPanel.php?delme=success');
				
			} else{
				header('Location: ../controlPanel.php?delme=invalid');
			}

		header('Location: ../controlPanel.php');
		}
		
	} else{
		echo "server unavailable";
	}

?>