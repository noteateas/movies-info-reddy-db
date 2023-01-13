<?php
	$user="root";
	$pass="";
	$connection = new PDO("mysql:host=localhost;dbname=movies",$user,$pass);
	$connection-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>