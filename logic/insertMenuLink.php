<?php
	require "../connection.php";
	if($connection){
		if(isset($_POST['insertMenuLinkSubmit'])){
			$errors = array();

			$regexTitle = "/^[A-z0-9\s\.\,\-\'\"\*\/\:]{1,100}$/";
			$regexLevel = "/^[\d]{1,3}$/";

			$name = $_POST['nameMenu'];
			$link = $_POST['linkMenu'];
			$level = $_POST['levelMenu'];
			$type = $_POST['typeSelect'];
			$parentId = $_POST['menuSelect'];

			if(!preg_match($regexTitle,$name)){
				array_push($errors,'name not in right format');
			}
			if(!preg_match($regexTitle,$link)){
				array_push($errors,'link not in right format');
			}
			if(!preg_match($regexLevel,$level)){
				array_push($errors,'level not in right format');
			}
			if($type == '0'){
				array_push($errors,'type has to be selected');	
			}
			if($parentId == 0){
				$parentId = NULL;
			}

			if(count($errors)==0){

				$insertMenuLink = $connection->prepare("INSERT INTO navigation (name,link,level,type,parent_id) VALUES(:name,:link,:level,:type,:parentId)");
				$insertMenuLink->bindParam(":name",$name);
				$insertMenuLink->bindParam(":link",$link);
				$insertMenuLink->bindParam(":level",$level);
				$insertMenuLink->bindParam(":type",$type);
				$insertMenuLink->bindParam(":parentId",$parentId);
				$insertMenuLink->execute();

				//header('Location: ../controlPanel.php?menu=success');
				
			} else{
				header('Location: ../controlPanel.php?menu=invalid');
			}

		header('Location: ../controlPanel.php');
		}
		
	} else{
		echo "server unavailable";
	}

?>