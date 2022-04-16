<?php
session_start(); 
if (!isset($_SESSION['login_user'])){// Check if the user has logged in. Checks if the variable is not empty
	header("Location: index.php");
}
// set the variables to the variables stored in the session and use strip_tags and addshlashes to the variable for security
$team = strip_tags(addslashes($_SESSION['team']));
$name = strip_tags(addslashes($_SESSION['login_user']))
?>
<html>
    <head><title>Home Page</title>
        <link rel="stylesheet" href="homePageStyle1.css">
    </head>
    <body>
        <div id = "navBar">
            <div id="site-name">Football Battles</div>
            <ul>
                <li><a id="current-page-text" href="homePage.php">Home</a></li>
                <li><a id="navbar-text" href="browse.php">Browse</a></li>
            </ul>
            <a id="logout" href="logout.php">Logout</a>
        </div>
        <div class = "homeImage">
            <img src="Images/Homebg.png">
            <div class="bgText">Compete<br> and Win</div>
        </div>
        <div class="search-container">
            <div class="search-bar">
                <div class="username">
                    <p>Username</p>
                    <div id="small-text-user"><?php echo "$name";?></div>
                </div>
                <div id="line"></div>
                <div class="team">
                    <p>Team</p>
                    <div id="small-text-team"><?php echo "$team";?></div>
                </div>
            </div>
        </div>
        <?php
        if ($_SESSION['team']){// If the session team is not empty
        echo "<div id = 'contentContainer'>";
            echo "<div class='content-bar'>";
                echo "<p class='contentHeader'>Your Matches:</p>";
                echo "<div class='button-container'>";
                    echo "<a id='add-teammate' href='addTeammate.php'><p>Add Teammates +</p></a>";
                    echo "<a id='add-button' href='add_match.php'><p>Add Match +</p></a>";
                echo "</div>";
            echo "</div>";
            echo "<div class='all-content'>";
                echo "<div class='content'>";
                    
                    require 'config.php';
                    $con = mysqli_connect($server, $user, $password, $database);
                    if(!$con)
                        die("Could not connect to the server. " .mysqli_connect_error());
                    $sql = "SELECT matches.matchid, utable.team as teamhost, gtable.team as teamguest FROM login utable, login gtable, matches Where matches.userhost = utable.username AND matches.userguest = gtable.username AND (utable.team = '".$team."' OR gtable.team = '".$team."')";
                    $result = mysqli_query($con, $sql);
                    echo "<form action='homePage.php' method='post'>";
                    while ($row = mysqli_fetch_row($result)){
                        echo "<div class='workspace-container'>";
                        echo "<a class='workspace' href='matchInfo.php?match=$row[0]'>";
                            echo "<div id='host-team'>$row[1]</div>";
                            echo "<div id='vs'>VS</div>";
                            echo "<div id='guest-team'>$row[2]</div>";
                        echo "</a>";
                        echo "</div>";
                    }
                    echo "</form>";
                    mysqli_close($con);
                    
                echo "</div>";
            echo "</div>";
        echo "</div>";
        }
        else{
            echo "<div id = 'contentContainer'>";
                echo "<div class='create-team'>";
                    echo "<img src='Images/tshirt.jpeg'>";
                    echo "<p>You can't create or join any match unless you create a team or let someone add you to their team</p>";
                    echo "<a id='create-team-button' href='createTeam.php'><p>Create Team</p></a>";
                echo "</div>";
            echo "</div>";
        }
        ?>
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
                            <a href="twitter"><p id="link">twitter</p></a>
                        </li>
                        <li>
                            <a href="Instagram"><p id="link">Instagram</p></a>
                        </li>
                        <li>
                            <a href="facebook"><p id="link">facebook</p></a>
                        </li>
                        <li>
                            <a href="pintrest"><p id="link">pintrest</p></a>
                        </li>
                        <li>
                            <a href="youtube"><p id="link">youtube</p></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>