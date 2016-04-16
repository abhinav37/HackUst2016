<?php
    include_once 'dbconnect.php';
    session_start();
    if(isset($_SESSION['userID']))
        $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>  
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
      <a class="navbar-brand" href="#">BetNvest</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="companyProfile.php">Company Profiles</a></li>
        <li class="active"><a href="AboutUs.php">About Us</a></li>
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
                echo "<li><a href=\"#\">Profile</a></li>\n"; 
                echo "<li><a href=\"#\">Logout</a></li>\n"; 
                echo "</ul>\n"; 
                echo "</li>\n";
            }else
                echo "<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#login-modal\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>\n"; 
        ?>
      </ul>
    </div>
  </div>
</nav>
<!--Login Box-->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Login to Your Account</h1><br>
            <form role="form" class="form text-center">
                <input type="text" name="user" placeholder="Username">
                <input type="password" name="pass" placeholder="Password">
                <label class="radio-inline"><input type="radio" name="loginType" value="">Better</label>
                <label class="radio-inline"><input type="radio" name="loginType" value="">Start-Up</label>
                <input type="submit" name="login" class="login loginmodal-submit" value="Login">            
            </form>
            <div class="login-help">
            <a href="#" data-toggle="modal" data-target="#register-modal">Register</a> - <a href="#">Forgot Password</a>
            </div>
        </div>
    </div>
</div>
 <!--Registration-->
 <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Login to Your Account</h1><br>
            <form>
            <input type="text" name="fName" placeholder="First Name" required>
            <input type="text" name="lName" placeholder="Last Name" required>
            <input type="text" name="user" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>
            <input type="submit" name="login" class="login loginmodal-submit" value="Login">
            </form>            
        </div>
    </div>
 </div>
    <div class="container-fluid" id="ticker">
        <marquee>
        <?php
            $query = "select * from `startup`";
            $result= mysqli_query($conn, $query) or die ('Failed to query');
            echo "<p>";
            while($startup = mysqli_fetch_row($result)) {
                //var_dump($startup);
                echo "<span class=\"tickerName\">" . $startup[1] .": </span><span class=\"tickerValue\">" . $startup[7] . " </span> &nbsp; &nbsp ";
            }
            echo "</p>";
        ?>           
        </marquee>
    </div>

    <div class="container">
        <div class="about">
            <div class="row">
                <div class="col-md-12 well">
                    <div class="row">
        
                        <div class="col-md-6">
                        <h1>About Us</h1>
                        <p>We code a sometimes ......and play cod except aman who only wants to play cod on the playstation thats it i guess</p>
                     
                        </div>
                        <div class="col-md-6">
                        <img src="../css/images/about.jpg" class="img-rounded" alt="Cinque Terre" width="400" height="400">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>  
    
</html>