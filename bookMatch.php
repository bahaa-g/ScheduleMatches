<?php
session_start(); 
if (!isset($_SESSION['login_user'])){
	header("Location: index.php");
}
?>
<html>
    <head><title>Book Match</title>
        <link rel="stylesheet" href="bookMatchStyle1.css">
    </head>
    <body>
        <?php
            require 'config.php';
            $con = mysqli_connect($server, $user, $password, $database);
            if(!$con)
                die("Could not connect to the server. " .mysqli_connect_error());
                $matchid = strip_tags(addslashes($_GET['match']));
            $sql = "SELECT matchid, login.team, userguest, district, location, dtime
                    FROM matches, login
                    Where matchid = '".$matchid."' AND login.username = matches.userhost";
            $result = mysqli_query($con, $sql);
        	$rows=mysqli_num_rows($result);
            if ($rows == 1) {
        		$res = mysqli_fetch_array($result);
        		echo "<div class='match-info'>";
        		echo "<ul>";
        		echo "<li>team: $res[1]</li>";
        		echo "<li>guest: <div id='info'></div></li>";
        		echo "<li>region: $res[3]</li>";
        		echo "<li>location: $res[4]</li>";
        		echo "<li>date: $res[5]</li>";
        		echo "</ul>";
        		echo "<button id='book-match' type='button' onclick='loadDoc()'><p>BookMatch</p></button>";
        		echo "</div>";
        	}
        	else{
        	    echo "couldn't load match info";
        	}
            mysqli_close($con);
        ?>
        
<script>

    function loadDoc() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
    
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("info").innerHTML = this.responseText;
        }
    };

    var pid = <?php echo $matchid; ?>;
    xhttp.open("POST", "bookSchedule.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("matchid=" + pid);
}

</script>
        
    </body>
</html>