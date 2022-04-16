<?php
session_start(); 
if (!isset($_SESSION['login_user'])){
	header("Location: index.php");
}
?>
<HTML>
<BODY>

<center>
<h3>Add a user to your team</h3>

<form method="POST" action="addTeammate.php">
<table height="100">
<td>Add User</td><td><input type="text" name="adduser" size="20" required></td></tr>
<tr>
<td><input type="submit" name="AddMatch"></td><td><input type="reset" name="Reset"></td></tr>
</Table>

</form>
</center>

<?php 
if ($_SESSION['login_user'])

if (!empty($_POST['adduser'])) {
    $adduser = strip_tags(addslashes($_POST['adduser']));
    
    require 'config.php';
    $con = mysqli_connect($server, $user, $password, $database);
    if(!$con)
        die("Could not connect to the server. " .mysqli_connect_error());
    
    $dbI = mysqli_query($con, "UPDATE login SET team = '".$_SESSION['team']."' WHERE username = '".$adduser."' AND team IS NULL");

    mysqli_close($con);
}
?>

</body>
</html>
</form>