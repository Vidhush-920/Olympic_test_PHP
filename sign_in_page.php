<?php
	include "connectdb.php";
	echo "<br>";
	$msg = " ";

    if(isset($_REQUEST["signin"])){
        $name = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $password = md5($password);
    

        $sql = "SELECT * from login WHERE username='".$name."'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchall();
        
        //check whether username exists
        if(count($result) > 0){
            $sql = "SELECT password from login WHERE username='".$name."'";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            //$result=$stmt->fetch(PDO::FETCH_ASSOC);
            $result = $stmt->fetchcolumn();

            //checks whether password is correct.
            if(strcmp($password,$result)==0){
                header("Location:index.php?er=6"); //directs to user account
            }
            else {
                $msg = "Incorrect Password";
            }
            

        } else {
			/*echo "User not Found..!";
			header("Location:sign_in_page.php");
			echo "<button href='sign_up_page.php'><b>Sign Up?</b></button>";*/
            $msg = "User not found";
        }
    }
?>

<html>
	<head>
		<title>Sign In Page</title>
		<style type = "text/css">
			body {
				font-family: Arial, OpenSans, sans-serif;
				font-size: 14px;
			}	
			label {
				font-weight: bold;
				width: 100px;
				font-size: 18px;
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
			<form action="sign_in_page.php">
				<h1 align=center>Sign In..</h1>
				
				<tr>
					<th style="width: 25%"><label for="user">   Username : </label></th>
					<td style="padding:5px;"><input type="text" name="username" id="username" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></td>
				</tr>
				<tr>
					<th style="width: 25%"><label for="password">   Password : </label></th>
					<td style="padding:5px;"><input type="password" name="password" id="password" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></td>
				</tr>
				<tr><td colspan=2><input type="submit" name="signin" value="Sign In" style="background-color: #04AA6D; color: white; font-size: 18px; font-weight: bold; padding: 12px 16px; margin: 8px 0; border: none; cursor: pointer; width: 60%;"></td></tr>
				<tr><td colspan=2><h4 align=center style="color:red; font-size:15px; align:center;"><?php echo $msg; ?></h4></td></tr>
				<tr><td colspan=2 style="text-align: left; padding-left: 35px;">Don't You have an account?   <a href='sign_up_page.php'><b>SIGN UP</b></a></td></tr>
			</form>
			
		</table>
	</body>
</html>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
<!--   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM login WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: main.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>-->
