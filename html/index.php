<?php
session_start();
include_once "dbconnect.php";
if(isset($_SESSION['userID']))
    header("Location: home.php");
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
      <a class="navbar-brand" href="index.php">BetNvest</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
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
        <li><a href="#" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Login Box-->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div id="loginDiv" class="loginmodal-container">
            <h1>Login to Your Account</h1><br>
            <form id="loginForm" role="form" class="form text-center">
                <input type="text" name="user" placeholder="Username">
                <input type="password" name="pass" placeholder="Password">
                <label class="radio-inline"><input type="radio" name="loginType" value="bettor">Bettor</label>
                <label class="radio-inline"><input type="radio" name="loginType" value="startup">Start-Up</label>
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
        <div id="regDiv" class="loginmodal-container">
            <h1>Register Account</h1><br>
            <label class="radio-inline"><input checked="checked" type="radio" name="registerType" value="bettor">Bettor</label>
            <label class="radio-inline"><input type="radio" name="registerType" value="startup">Start-Up</label>
            <form id="signupForm">
            <input type="text" name="name" placeholder="Company Name" required>
            <input type="text" name="about" placeholder="About" required>
            <input type="text" name="evaluation" placeholder="Evaluation" required>
            <input type="text" name="annualProfit" placeholder="Annual Profit" required>
            <input type="text" name="activeUsers" placeholder="Estimated active users" required>
            <input type="text" name="user" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>

            <input type="submit" name="login" class="login loginmodal-submit" value="Register">
            </form> 

            <form id="registerForm">
            <input type="text" name="fName" placeholder="First Name" required>
            <input type="text" name="lName" placeholder="Last Name" required>
            <input type="text" name="user" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>
            <input type="submit" name="login" class="login loginmodal-submit" value="Register">
            </form> 

        </div>
    </div>
 </div>
 <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Register Account</h1><br>
            <form id="signupForm" name="signupForm" value="signupForm">
            <input type="text" name="name" placeholder="Company Name" required>
            <input type="text" name="about" placeholder="About" required>
            <input type="text" name="evaluation" placeholder="Evaluation" required>
            <input type="text" name="annualProfit" placeholder="Annual Profit" required>
            <input type="text" name="activeUsers" placeholder="Estimated active users" required>

            <input type="submit" name="login" class="login loginmodal-submit" value="Register">
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
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Current Bets</h4>
                        <table class="table table-bordered table-striped">                         
                            <tbody class="text-left">
                                <?php
									$query = "select * from `bets`";
									$res = mysqli_query($conn, $query);
									$count = mysqli_num_rows($res);
									for($x = $count; $x >= $count-4; $x--){
									$number = $x;
									$query = "select * from `bets` WHERE `betID` = \"$number\"";
									$result= mysqli_query($conn, $query) or die ('Failed to query');
									$bet= mysqli_fetch_array($result);
									$startID = $bet['startupID'];
									$query = "select * from `startup` WHERE `startupID` = \"$startID\"";
									$result= mysqli_query($conn, $query) or die ('Failed to query');
									$startupBet= mysqli_fetch_array($result);  									
									echo "<tr></tr><td> A $".$bet['amount']." was made on ".$startupBet['name']." Company at ".$bet['time']."</td></tr>\n";                    
								}
                                ?>
							</tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <h4>Hot Startups</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
								 <th>StartUp Name</th>
                                <th>Number of Bets</th>
                                <th>Value of Bets</th>
                            </tr>
                                </thead>
                                <tbody>
								<?php
									$query = "SELECT startupID, COUNT(*) as count, SUM(amount) as sumOf FROM bets GROUP BY startupID ORDER BY count DESC";
									$result = mysqli_query($conn, $query);
									for($x = 0; $x <= 5; $x++){
										$row= mysqli_fetch_assoc($result);
										
										$startID = $row['startupID'];
										$qu = "select * from `startup` WHERE `startupID` = \"$startID\"";
										$re= mysqli_query($conn, $qu) or die ('Failed to query');
										$startupBet= mysqli_fetch_array($re); 
									
									echo "<tr><td>".$startupBet['name']."</td><td>".$row['count']."</td><td>".$row['sumOf']."</td></tr>";
									}
								?>
                            </tbody>
                         </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row well">
               <?php
                    $query = "select * from `startup`";
                    $res = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($res);
                    $unique = [];
                    if($count > 15)
                    {
                        $y = 15;
                    }
                    else {
                        $y = $count;
                    }
                    for($x = 1; $x <= $y; $x++){
                        //add query to find max
                        $number = rand(1, $count);
                        while(in_array($number, $unique))
                            $number = rand(1, $count);
                        array_push($unique, $number);    
                        $query = "select * from `startup` WHERE `startupID` = \"$number\"";
                        $result= mysqli_query($conn, $query) or die ('Failed to query');
                        $startup= mysqli_fetch_array($result);
                        echo "<div class=\"col-md-4 col-sm-6 col-xs-12\">\n";
                        echo "<div class=\"media companyTile\">\n";
                        echo "<input id=\"startupID\" type=\"hidden\" value=".$number.">";  
                        echo "  <div class=\"media-left\">\n"; 
                        echo "    <a href=\"#\">\n"; 
                        echo "      <img class=\"img-thumbnail\" src=\"../Images/".$startup['logo']."\" alt>\n"; 
                        echo "    </a>\n"; 
                        echo "  </div>\n"; 
                        echo "  <div class=\"media-body\">\n"; 
                        echo "    <h4 class=\"media-heading\">".$startup['name']."</h4>\n"; 
                        echo "<p>".$startup['about']."</p>";
                        echo "  </div>\n"; 
                        echo "</div>\n";
                        echo "</div>\n";
                       }
                ?>

        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</body>  

<script>
console.log("Hello from the other side");

$(document).ready(function(){
	$("#registerForm").hide();
	$("#signupForm").show();
	
    $("input[name$='registerType']").click(function() {
        var test = $(this).val();
        if(test!="bettor"){
			$("#registerForm").hide();
			$("#signupForm").show();
		}else{
			$("#registerForm").show();
			$("#signupForm").hide();
		}
    }); 
    $("#loginForm").submit(function(e) {
        var url = "login.php"; // the script where you handle the form input.
		var url = "login.php"; // the script where you handle the form input.
		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#loginForm").serialize(), // serializes the form's elements.
			   success: function(data)
			   {
				   alert(data);     
                    window.location.replace("home.php");
    	        }
		});
		e.preventDefault(); // avoid to execute the actual submit of the form.
	});

    $("#registerForm").submit(function(e) {
    var url = "register.php"; // the script where you handle the form input.
    $.ajax({
         type: "POST",
         url: url,
         data: $("#registerForm").serialize(), // serializes the form's elements.
         success: function(data)
         {
           alert(data);
           window.location.replace("redirect.php");
         }
       });
    e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    $("#signupForm").submit(function(e) {
    var url = "register2.php"; // the script where you handle the form input.
    $.ajax({
         type: "POST",
         url: url,
         data: $("#signupForm").serialize(), // serializes the form's elements.
         success: function(data)
         {
           alert(data);
           window.location.replace("redirect.php");
         }
       });
    e.preventDefault(); // avoid to execute the actual submit of the form.
    });    
});

$(".companyTile").on("click", function() {
	var x = $(this).find("#startupID").val();
	window.location.replace("profile.php?startupID="+x);
});
</script>
    
</html>
