<?php
session_start(); 
if (!isset($_SESSION['login_user'])){
	header("Location: index.php");
}
?>
<HTML>
<BODY>

<center>
<h3>Create Your Own Team</h3>

<form method="POST" action="createTeam.php">
<table height="100">
<td>Team Name</td><td><input type="text" name="teamName" size="20" required></td></tr>
<tr>
<td><input type="submit" name="CreateTeam"></td><td><input type="reset" name="Reset"></td></tr>
</Table>

</form>
</center>

<?php 
if ($_SESSION['login_user'])

if (!empty($_POST['teamName'])) {
    require 'config.php';
    $con = mysqli_connect($server, $user, $password, $database);
    if(!$con)
        die("Could not connect to the server. " .mysqli_connect_error());
    
    $teamName = strip_tags(addslashes($_POST['teamName']));
    
    $sql = "UPDATE login SET team = '".$teamName."' WHERE username = '".$_SESSION['login_user']."' AND team IS NULL";

    $result=mysqli_query($con,$sql);
	$rows = mysqli_affected_rows($con);
	if ($rows == 1) { // 1 row affected
		$_SESSION['team']=$teamName;
		echo "team created successfully";
	}

    mysqli_close($con);
}
?>

</body>
</html>
</form>