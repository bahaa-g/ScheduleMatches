<?php
 require 'config.php';
 session_start();session_destroy();
 session_start();
if($_POST["regname"] && $_POST["regemail"] && $_POST["regpass1"] && $_POST["regpass2"])
{
	if($_POST["regpass1"] == $_POST["regpass2"])
	{
        $conn=  mysqli_connect($server, $user, $password, $database) or
        die("can't connect to database");
    
        $sql="insert into login values ('$_POST[regname]', unhex(sha2('$_POST[regpass1]', 256)), '$_POST[regemail]', null)";
        $result=mysqli_query($conn,$sql);	
        if (mysqli_affected_rows($conn) > 0) {
            print "<h1>you have registered sucessfully</h1>";
            print "<a href='index.php'>go to login page</a>";
    	}
    }
    else
	    print "passwords doesnt match";
}
else 
    print"invaild input data";
?>