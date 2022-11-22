<!--?php
    $servername = "localhost";
	$username = "root";
	$password = "";
	$db = "olympic_login";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?-->

<?php
    $server = "localhost:3306";
    $user = "root";
    $dbpass = "";
    $db = "olympic_login";
    
	try{
		$con = new PDO("mysql:host=$server; dbname=$db; charset=UTF8", "$user", "$dbpass");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("Connection Failed: ". $e);
    }
?>