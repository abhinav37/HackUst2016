<?php
session_start();
include_once 'dbconnect.php';
$userID = $_SESSION['userID'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
 <nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">BetNvest</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="companyProfile.php">Company Profiles</a></li>
        <li><a href="AboutUs.php">About Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <form class="navbar-form navbar-left" role="search">
          <!-- Define a button to toggle the search area -->
          <!-- Create your entire search form -->
          <div id="search-form" class="form-group">
            <div class="input-group">
              <span id="search-icon" class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
              <input type="text" class="form-control" placeholder="Search">
            </div>
          </div>
          </form>
        </li>
       <?php
            if(isset($_SESSION['userID'])){
                echo "<li class=\"dropdown\">\n"; 
                echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">". $username ."<span class=\"caret\"></span></a>\n"; 
                echo "<ul class=\"dropdown-menu\">\n"; 
                echo "<li><a href=\"#\">Portfolio</a></li>\n"; 
                echo "<li role=\"separator\" class=\"divider\"></li>\n"; 
                echo "<li><a href=\"userConsole.php\">Profile</a></li>\n"; 
                echo "<li><a href=\"logout.php\">Logout</a></li>\n"; 
                echo "</ul>\n"; 
                echo "</li>\n";
            }else
                echo "<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#login-modal\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>\n"; 
        ?>
      </ul>
    </div>
  </div>
</nav><div class="container-fluid" id="ticker">
        <marquee>
        <?php
            $query = "select * from `startup`";
            $result= mysqli_query($conn, $query) or die ('Failed to query');
            echo "<p>";
            while($startup = mysqli_fetch_row($result)) {
                //var_dump($startup);
                echo "<span class=\"tickerName\">" . $startup[1] .": </span><span class=\"tickerValue\">" . $startup[10] . " </span> &nbsp; &nbsp ";
            }
            echo "</p>";
        ?>           
        </marquee>
    </div>

<div class="container">
    <div class="row">
        <!--User Console-->
        <div class="col-md-12">
           <div class="row">
                <div class="col-md-12  text-center">
                    <h2>User Portfolio</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                      <table class="table table-bordered table-striped">
                            <thead>
                 <th>StartUp Name</th>
                                <th>About the Company</th>
                                <th>Your Odds</th>
                            </tr>
                            </thead>
                            <tbody>                          
     
                                </thead>
                                <tbody>
                <?php
                  $query = "SELECT startupID FROM bets WHERE userID = '$userID'";
                  $result = mysqli_query($conn, $query);
                  while($row =  mysqli_fetch_assoc($result)) {
                    $startID = $row['startupID'];
                    $qu = "select * from `startup` WHERE `startupID` = \"$startID\"";
                    $re= mysqli_query($conn, $qu) or die ('Failed to query');
                    $startupBet= mysqli_fetch_array($re);                   
                    echo "<tr><td>".$startupBet['name']."</td><td>".$startupBet['about']."</td><td>".$startupBet['odds']."</td></tr>";
                  }
                ?>
                            </tbody>
                         </table>
                </div>
            </div>
        </div>
    </div>


</div>

</body>  
    
</html>
