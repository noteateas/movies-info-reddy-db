<?php
	include "connection.php";
	echo '
			<!DOCTYPE html>
				<html>
				<head>
					<title>Forbidden Access</title>
					<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
					<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"/>
					<meta charset="utf-8"/>
					<meta name="description" content=""/>
					<meta name="keywords" content=""/>
					<meta name="author" content=" Teodora Nedeljković"/>
					<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
					<link rel="shortcut icon" href="img/favicon.ico"/>
				</head>
				<body>';

					include "header.php";

				echo '</body>

				<div style="background-color:white; height: 60vh; display:flex; flex-direction:column; justify-content:center;align-items:center">
					<h1>You do not have permission to be on this page!</h1>
					<p>Click <a href="index.php"style="color: grey">here</a> to return to home page.</p>
				</div>

				<div id="footer">
					<div id="rowFirst">
						<div>
							<ul>
								<li><a href="author.html">Author</a></li>
								<li><a href="docs.pdf">Documentation</a></li>
							</ul>
						</div>
						<div id="social">
							<ul>
								<li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
								<li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
							</ul>
							</div>
					</div>
					<div><p>Created by Teodora Nedeljkovic, 2020 &copy;</p></div>
				</div>
				<script src="assets/js/jquery.js"></script>
				<script src="assets/js/main.js"></script>
			</html>
		';
?>