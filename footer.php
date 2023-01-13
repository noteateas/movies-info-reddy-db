<?php
	if(isset($connection)){
		echo "<div id='footer'>
			<div id='rowFirst'>";
			function submenu($parent_id,$level,$connection){
				$menuSelectQuery= $connection->prepare("SELECT * FROM navigation WHERE parent_id=:parent_id");
				$menuSelectQuery->bindParam(":parent_id",$parent_id);
				$menuSelectQuery->execute();
				$menuSelectResult = $menuSelectQuery->fetchAll();

				if(count($menuSelectResult)>0){
					echo "<ul>"; 
				}
				foreach($menuSelectResult as $menu){
					$id = $menu['id'];
					$link = $menu['link'];
					$name = $menu['name'];
					$level = $menu['level'];

					echo "<li><a href='${link}'>{$name}</a>";
					submenu($id , $level+1,$connection);
					echo "</li>";
				}
				if(count($menuSelectResult)>0){
					echo "</ul>";
				}
			}
		$mainMenuSelectQuery = $connection->prepare("SELECT * FROM navigation WHERE type='footer' AND parent_id IS NULL");
		$mainMenuSelectQuery->execute();
		$mainMenuSelectResult = $mainMenuSelectQuery->fetchAll();

		echo "<ul>";
		foreach($mainMenuSelectResult as $menu){
			$id = $menu['id'];
			$link = $menu['link'];
			$name = $menu['name'];
			$level = $menu['level'];

			echo "<li><h4>{$name}</h4>";
			submenu($id, $level+1,$connection);
			echo "</li>";
		}
		echo "</ul>
			</div>
				<div><p>Created by Teodora Nedeljkovic, 2020 &copy;</p></div>
		</div>";
	}
?>