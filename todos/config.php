<?php
try{
  	$host = "localhost";
  	$dbname = "todos";
  	$user = "root";
  	$pass = "hahaha";

  	$conn = new PDO ("mysql:host=$host;dbname=$dbname",$user,$pass);
  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
  	echo "Error:" . $e->getMessage();
}