<?php
    include_once 'dbconnect.php';
    session_start();
    if(isset($_SESSION['userID']))
        $username = $_SESSION['username'];
    $startupID = $_GET['startupID'];
    $query = "select * from `startup` where `startupID` = \"$startupID\" ";
    $res=mysqli_query($conn, $query) or die ('Failed to query');
    $row=mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="Chart.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/index.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.1/Chart.js"></script>

<script>
    $(document).ready(function(){
        console.log("hello");
        $("#bettingForm").submit(function(e) {
            var url = "addBet.php"; // the script where you handle the form input./f
            $.ajax({
                   type: "POST",
                   url: url,
                   data: $("#bettingForm").serialize(), // serializes the form's elements.
                   success: function(data)
                   {
                       alert(data);
                        var x = $("#startupID").val();
                        window.location.replace("profile.php?startupID="+x);
                    }   
            });
            e.preventDefault(); // avoid to execute the actual submit of the form.
        });
    });
</script>
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
                echo "<li><a href=\"userConsole.php\">Portfolio</a></li>\n"; 
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
 
  <!--Payment Gateway-->
 <div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Enter the amount</h1><br>
            <form name="bettingForm" id="bettingForm">
                <input type="hidden" id="odds" name="odds" value="<?php echo $row['odds']; ?>">
                <input type="hidden" id="startupID" name="startupID" value="<?php echo $startupID; ?>">
                <input type="text" name="amount" id="amount" placeholder="Amount" required>
                <input type="submit" value="Bet!">
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
    <div class ="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="companyProfile.php">Company Profiles</a></li>
            <?php
				echo "<li class=\"active\">". $row['name'] . "</li>";
            ?></li>
        </ol>
    </div>    
    </div>
    <div class="row">
        <!--Company Information div-->
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4  text-center">
                    <div class="row">
                        <div class="col-md-12">
							<?php
                                echo "<img class=\"imageLogo\" src=\"../Images/".$row['logo']."\" alt>";                              
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <?php
                        if(isset($_SESSION['userID']))
                            echo "<button type=\"button\" class=\"btn btn-success btn-block\"  data-toggle=\"modal\" data-target=\"#payment-modal\">Bet!</button>\n";
                        ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 text-center">
                    <div class="col-md-12 col-sd-12">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <?php
                                    echo "<h2>". $row['name'] . "</h2>";
                                ?>
                            </div>
                        </div>
                        <div class="row text-center">
                       
                            <div class="col-xs-6 col-md-6 text-left">Current Odds: 
                                <?php
                                    echo $row['annualProfit'];                              
                                ?>
                            </div>
                            <div class="col-xs-6 col-md-6 text-left">Evaluation: 
                                <?php
                                    echo $row['evaluation'];                              
                                ?>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-md-12">
                                <?php 
                                    echo "<h4>";
                                    echo $row['about'];
                                    echo "</h4>";
                                ?>
                            </div>               
                        </div>
                   </div>
                </div>
            </div>
            <br />
            <!--carosell-->
            <div class="row">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
						<?php 
                                echo '<img src="../Images/' . $row['image1'] .'" />';
                        ?>
                        </div>

                        <div class="item">
							<?php 
								echo '<img src="../Images/' . $row['image2'] .'" />';
							?>	
                        </div>

                        <div class="item">
							<?php 
								echo '<img src="../Images/' . $row['image3'] .'" />';
							?>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>

            </div>
        </div>
        <!--News Div-->
        <div class="col-md-4">
            <div class="col-md-12">
           <div class="row"> 
               
           
               
                 <script type="text/javascript">

            window.onload = function() { 
                init();
            };

            function init() {
                var ctx = $("#myChart").get(0).getContext("2d");

                var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            fillColor: "rgba(220,220,220,0.5)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            data: [65, 59, 90, 81, 56, 55, 40]
                        }
                      
                    ]
                }

                var myNewChart = new Chart(ctx).Line(data);
            }
Chart.defaults.global.responsive = true;
        </script>
        </div>
            <div class="row"> 
            <section>
                <article>
                    <canvas id="myChart" width="400" height="400">
                    </canvas>
                </article>
            </section>
        </div>
                <div class="col-md-12  text-center">
                    <h2>News</h2>
               
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>
					<?php
						$query = "select * from `news` where `startupID` = \"$startupID\" ";
						$result=mysqli_query($conn, $query) or die ('Failed to query');
						while($newsArticle = mysqli_fetch_row($result)) {
							
                            echo "<div class=\"media\">\n"; 
							echo "  <div class=\"media-left\">\n"; 
                            echo '<img src="' . $newsArticle[3] .'" height="45" width="45"/>';
							echo "  </div>\n"; 
							echo "  <div class=\"media-body\">\n"; 
							echo "    <h2 class=\"media-heading\">" . $newsArticle[1] . "</h2>\n"; 
							echo "    <p style=\"font-size:80%;\">" . $newsArticle[2] . "</p>\n"; 
                            echo "    <h style=\"font-size:40%;color:grey;\">" . $newsArticle[4] . "</h>\n"; 
							echo "  </div>\n"; 
							echo "</div>\n";
						}
					?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    </div>


</div>

<script>
    
console.log("Hello from the other side");

$(document).ready(function(){
	$("#registerForm").hide();
	$("#signupForm").show();
	
    $("input[name$='registerType']").click(function() {
        var test = $(this).val();
        if(test=="bettor"){
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
});
</script>

</body>  

</html>
