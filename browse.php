<?php
session_start(); 
if (!isset($_SESSION['login_user'])){
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
    <head><title>Browse Matches</title>
        <link rel="stylesheet" href="BrowseStyle1.css">
    </head>
    <body>
        <div id = "navBar">
            <div id="site-name">Football Battles</div>
            <ul>
                <li><a id="navbar-text" href="homePage.php">Home</a></li>
                <li><a id="current-page-text" href="browse.php">Browse</a></li>
            </ul>
            <img id="profile-icon" src="profile-icon-white.png">
        </div>
        <div class = "homeImage">
            <img src="Images/Browsebg.png">
        </div>
        <div id = "contentContainer">
            <div class="content-bar">
                <p class="contentHeader">Find Matches:</p>
            </div>
            <div class="all-content">
                <!--<div id="dummy"></div>-->
                <div class="content">
                    <?php
                    require 'config.php';
                    $con = mysqli_connect($server, $user, $password, $database);
                    if(!$con)
                        die("Could not connect to the server. " .mysqli_connect_error());
                        $team = strip_tags(addslashes($_SESSION['team']));
                    $sql = "SELECT matches.matchid, utable.team as teamhost FROM login utable, matches Where matches.userhost = utable.username AND utable.team != '".$team."' AND matches.userguest IS NULL";
                    $result = mysqli_query($con, $sql);
                    
                    while ($row = mysqli_fetch_row($result)){
                        echo "<div class='workspace-container'>";
                        echo "<a class='workspace' href='bookMatch.php?match=$row[0]'>";
                            echo "<div id='host-team'>$row[1]</div>";
                            echo "<div id='vs'>VS</div>";
                            echo "<div id='guest-team'>???</div>";
                        echo "</a>";
                        echo "</div>";
                    }
                    mysqli_close($con);
                    ?>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footer-list">
                <div class="footer-list-element"><p>Support</p>
                    <ul class="list-sub">
                        <li><a href="privavy"></a><p id="link">Privacy & Security</p></li>
                        <li><a href="privavy"></a><p id="link">Terms of Service</p></li>
                    </ul>
                </div>
                <div class="footer-list-element"><p>Follow us</p>
                    <ul class="list-sub">
                        <li>
                            <a href="twitter"><p id="link">twitter</p>
                            </a>
                        </li>
                        <li>
                            <a href="Instagram"><p id="link">Instagram</p>
                            </a>
                        </li>
                        <li>
                            <a href="facebook"><p id="link">facebook</p>
                            </a>
                        </li>
                        <li>
                            <a href="pintrest"><p id="link">pintrest</p>
                            </a>
                        </li>
                        <li>
                            <a href="youtube"><p id="link">youtube</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>