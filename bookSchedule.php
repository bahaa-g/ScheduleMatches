<?php
    session_start(); 
    if (!isset($_SESSION['login_user'])){
    	header("Location: index.php");
    }

    if (!empty($_POST['matchid'])) {
        require 'config.php';
        $con = mysqli_connect($server, $user, $password, $database);
        if(!$con)
            die("Could not connect to the server. " .mysqli_connect_error());
        
        $matchid= strip_tags(addslashes($_POST['matchid']));
        
        $sql = "UPDATE matches SET userguest = '".$_SESSION['login_user']."' WHERE matchid = '".$matchid."' AND userguest IS NULL";
    
        $result=mysqli_query($con,$sql);
    	$rows = mysqli_affected_rows($con);
    	if ($rows == 1) {
    		echo $_SESSION['team'];
    	}
    
        mysqli_close($con);
    }
?>