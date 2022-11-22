<?php
    echo"<br>";
    include "connectdb.php";
    include "index.php";

    // 1. connection to the db.
        $query = "SELECT * from login";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $list = $stmt->fetchall();

    /* 2. check the username..
         a. If Exists - return to the main page and display error
         b. Else - Insert query
    */

    if(isset($_REQUEST["signup"])){
        $email = $_REQUEST["email"];
        $name = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $cpassword = $_REQUEST["cpassword"];
        
        //checks whether all details are provided
        if(!empty($email) && !empty($name) && !empty($password) && !empty($cpassword)){

            //checks whether password and confirmed password are same
            if(strcmp($password,$cpassword)==0){
                $password = md5($password);   //encrypting password using md5 algorithm
                $sqlu = "SELECT * from login WHERE username='".$name."'";
                $stmtu=$con->prepare($sqlu);
                $stmtu->execute();
                $resultu=$stmtu->fetchall();
				
				$sqle = "SELECT * from login WHERE email='".$email."'";
                $stmte=$con->prepare($sqle);
                $stmte->execute();
                $resulte=$stmte->fetchall();
        
                //Checks for existense of the username
                if(count($resultu)>0){
                    $msg = "Username already exists.";
				} else if(count($resulte)>0) {
					$msg = "E-mail already exists.";
				} else {
                    $sql = "INSERT into login set username='".$name."', password='".$password."', email='".$email."'";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();
                    header("Location:index.php?er=9"); 
                }
            } 
            else {
                $msg = "Wrong Password Confirmation!!";
            }

        } 
        else {
            $msg = "Please provide all the details!";
        }
    }

    /*
    3. Return to the login.php file
    */
    
?>

<html>
	<head>
		<title>Sign Up Page</title>
		<style type = "text/css">
			body {
				font-family: Arial, OpenSans, sans-serif;
				font-size: 14px;
			}	
			label {
				font-weight: bold;
				width: 100px;
				font-size: 16px;
			}
			table {
				border: 1px solid #bbb;
				border-radius: 5px;
				width: 50%;
				margin-left: auto;
				margin-right: auto;
				justify-content: center;
			}
			table td , th{
				vertical-align: middle;
				text-align: center;
			}
		</style>
	</head>
   
	<body bgcolor = "#FFFFFF">
		<table>
			<br>
			<form action="sign_up_page.php">
				<h1 align=center>Sign Up..</h1>
				
				<tr>
					<th style="width: 30%"><label for="email">Email : </label></th>
					<td style="padding:5px;"><input type="text" name="email" id="email" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"><br><br></td>
				</tr>
				<tr>
					<th style="width: 30%"><label for="user">Username : </label></th>
					<td style="padding:5px;"><input type="text" name="username" id="username" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"><br><br></td>
				</tr>
				<tr>
					<th style="width: 30%"><label for="password">Password : </label></th>
					<td style="padding:5px;"><input type="password" name="password" id="password" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"><br><br></td>
				</tr>
				<tr>
					<th style="width: 30%"><label for="cpassword">Confirm Password : </label></th>
					<td style="padding:5px;"><input type="password" name="cpassword" id="cpassword" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"><br><br></td>
				</tr>
				<tr><td colspan=2><input type="submit" name="signup" value="Sign Up" style="background-color: #04AA6D; color: white; font-size: 18px; font-weight: bold; padding: 12px 16px; margin: 8px 0; border: none; cursor: pointer; width: 60%;"></td></tr>
				<tr><td colspan=2><h4 align=center style="color:red; font-size:15px; align:center;"><?php echo $msg; ?></h4></td></tr>
				<tr><td colspan=2 style="text-align: left; padding-left: 35px;">Do You Already have an account?   <a href='sign_in_page.php'><b>SIGN IN</b></a></td></tr>

			</form>
		</table>
	</body>
</html>