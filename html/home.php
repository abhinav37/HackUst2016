<?php
session_start();
if(!isset($_SESSION['userID']))
	header("Location: index.php");
else{
    $username = $_SESSION['username'];
    include_once 'dbconnect.php';
}
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
            }
        ?>
      </ul>
    </div>
  </div>
</nav>
    <div class="container-fluid" id="ticker">
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
                  for($x = 0; $x < 5; $x++){
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
        <footer>
        <h3><a href="Terms.php">Terms and Conditons</a></h3>
        </footer>
</body>  

<script>
console.log("Hello from the other side");
$(document).ready(function(){
	$("#loginForm").submit(function(e) {
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
    ("#signupForm").submit(function(e) {
    var url = "registerStartup.php"; // the script where you handle the form input.
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