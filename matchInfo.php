<?php
    session_start(); 
    if (!isset($_SESSION['login_user'])){
    	header("Location: index.php");
    }
    require 'config.php';
    $con = mysqli_connect($server, $user, $password, $database);
    if(!$con)
        die("Could not connect to the server. " .mysqli_connect_error());
        $matchid = strip_tags(addslashes($_GET['match']));
    $sql = "SELECT matchid, userhost, userguest, district, location, dtime
            FROM matches 
            Where matchid = '".$matchid."'";
    $result = mysqli_query($con, $sql);
	$rows=mysqli_num_rows($result);
    if ($rows == 1) {
		$res = mysqli_fetch_array($result);
		echo "$res[1]<br>";
		echo "$res[2]<br>";
		echo "$res[3]<br>";
		echo "$res[4]<br>";
		echo "$res[5]<br>";
	}
    mysqli_close($con);
?>