<?php

function getConnection(){
	$servername = "172.16.1.2";
	$username = "web";
	$password = "xxx";
	//connexion à la base de donnée
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=WTdb", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    }
	catch(PDOException $e)
	    {
	    echo "Connection failed: " . $e->getMessage();
	    }
	return $conn;

} 

?>
