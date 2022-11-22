<?php

	function function_alert($message) {
    
		// Display the alert box 
		echo "<script>alert('$message');</script>";
	}

    if(isset($_REQUEST["er"])){
        $error = $_REQUEST["er"];

        if($error==1)
            echo "Username already exists.....!";
        if($error==2)
            echo "Username does not exist.....!";
        if($error==3)
            echo "User not found...!";
        if($error==4)
            echo "Incorrect Password...!";
        if($error==6)
			function_alert("Welcome to your account...");
            header("Location:home.php");
        if($error==9){
            function_alert("Registration successful... Now you can login to the system.");
            header("Location:sign_in_page.php");
        }   
    }
?>