<?php
session_start(); 
if (!isset($_SESSION['login_user'])){
	header("Location: index.php");
}
?>
<HTML>
<BODY>

<center>
<h3>Add Match Request</h3>

<form method="POST" action="add_match.php">
<table height="180">
<tr>
<td>Region</td>
<td>
    <select id="list" name="district">
    <option value="Akkar">Akkar</option>
    <option value="Baalbek">Baalbek</option>
    <option value="Hermel">Hermel</option>
    <option value="Beirut">Beirut</option>
    <option value="Rashaya">Rashaya</option>
    <option value="Western">Western Beqaa</option>
    <option value="Zahle">Zahle</option>
    <option value="Byblos">Byblos</option>
    <option value="Keserwan">Keserwan</option>
    <option value="Aley">Aley</option>
    <option value="view">Baabda</option>
    <option value="Chouf">Chouf</option>
    <option value="Matn">Matn</option>
    </select></td></tr>
<tr>
<td>Location</td><td><input type="text" name="location" size="20" required></td></tr>
<tr>
<td>Date Time</td><td><input type="datetime-local" name="datetimelocal" size="20" required></td></tr>
<tr>
<td><input type="submit" name="AddMatch"></td><td><input type="reset" name="Reset"></td></tr>
</Table>

</form>
</center>

<?php 
if ($_SESSION['login_user'])

if (!empty($_POST['district']) && !empty($_POST['location']) && !empty($_POST['datetimelocal'])) {
    $district = strip_tags(addslashes($_POST['district']));
    $location = strip_tags(addslashes($_POST['location']));
    $datetimelocal = strip_tags(addslashes($_POST['datetimelocal']));
    
    require 'config.php';
    $con = mysqli_connect($server, $user, $password, $database);
    if(!$con)
        die("Could not connect to the server. " .mysqli_connect_error());

$dbI = mysqli_query($con, "INSERT INTO matches VALUES(DEFAULT, '".$_SESSION['login_user']."', null, '$district', '$location', '$datetimelocal')");

mysqli_close($con);
}
?>

</body>
</html>
</form>