<?php
	require "login.php"; // Includes Login Script
?>

<html>
<head>
<title>Login</title>
</head>
<body>
<div id="main">
<div id="login">
<h2>Login Form</h2>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<label>UserName :</label>
<input id="name" name="username" placeholder="username" type="text">
<label>Password :</label>
<input id="password" name="password" placeholder="**********" type="password">
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>
<A Href="registerForm.php"> Sign up </A>
</body>
</html>