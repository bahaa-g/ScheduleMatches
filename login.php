<?php
require "config.php";
session_start();
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}else{
		$username=$_POST['username'];
		$pass=$_POST['password'];		
		$username = strip_tags(addslashes($username));
		$pass = strip_tags(addslashes($pass));
		$con= mysqli_connect($server, $user, $password, $database);
		$sql="select * from login where password= unhex(sha2('".$pass."', 256)) AND username='".$username."'";
		$result=mysqli_query($con,$sql);
		$rows=mysqli_num_rows($result);//count the rows
		if ($rows == 1) { // 1 row found
			$_SESSION['login_user']=$username; // Session to store username
			$res = mysqli_fetch_array($result);
			$_SESSION['team']=$res['team'];// Session to store user's team recieved from the database
			header("location: homePage.php"); // Redirect to the home page
		} else {
			$error = "Username or Password is invalid";
		}
		mysqli_close($con); // Close Connection
	}
}
?>
