<?php
	if($connection){

		$headerSelectQuery = $connection->prepare("SELECT * FROM navigation WHERE type='header'");
		$headerSelectQuery->execute();
		$headerSelectResult = $headerSelectQuery->fetchAll();

		echo "<div id='header'>
		 		<div class='wrapper'>
		 			<div>
		 				<a href='index.php'><img src='assets/img/logo.png' alt='logo'></a>
		 			</div>
		 			<div>
		 				<ul id='nav'>";
		 				foreach ($headerSelectResult as $menuRow){
							$name = $menuRow['name'];
							$link = $menuRow['link'];
							$level = $menuRow['level'];
							echo "<li><a href='{$link}'>{$name}</a></li>";
						}	
		 		echo "</ul>
		 			<ul id='account'>";

			if((isset($_SESSION['username']))&&(isset($_SESSION['role']))){
				$username = $_SESSION['username'];
				if($_SESSION['role']==1){
					echo "<li></li><li id='user'>{$username}&nbsp;&nbsp;<i class='fas fa-chevron-down'></i>
							<ul id='userNav'>
								<li><a href='controlPanel.php'>Control Panel</a></li>
								<li><a href='profile.php'>Profile</a></li>
								<li><a id='signOut'href='index.php?logout=1'>Sign Out</a></li>
							</ul>
						</li>";

			} else{
					echo "<li></li><li id='user'>{$username}&nbsp;&nbsp;<i class='fas fa-chevron-down'></i>
							<ul id='userNav'>
								<li><a href='profile.php'>Profile</a></li>
								<li><a id='signOut'href='index.php?logout=1'>Sign Out</a></li>
							</ul>
						</li>";
				}
			} else{
				echo "<li></li><li><a class='signIn' href='signin.php'>sign in</a></li>";
			}
			echo "</ul>
				</div>				
			</div>
		</div>";



	} else{
		echo "Server currently unavailable. Try again later.";
	}

		
?>