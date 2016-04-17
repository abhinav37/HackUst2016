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
        <li class="active"><a href="companyProfile.php">Company Profiles</a></li>
        <li><a href="AboutUs.php">About Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
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
        <!--User Console-->
        <div class="col-md-12">
           <div class="row">
                <div class="col-md-12  text-center">
                    <h2>Listed Companies</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                        <span id="search-icon" class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                        <input type="text" class="form-control block" id="search" placeholder="Search">
                        </div>
                    <div class="col-md-3">
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">               
                <div class="col-md-12 text-center">
                <?php
                    echo "<table class=\"table table-bordered table-hover table-striped\">\n"; 
                    echo "<thead>\n"; 
                    echo "<tr>\n"; 
                    echo "<th>Company Name</th>\n"; 
                    echo "<th>Information</th>\n"; 
                    echo "<th>Odds</th>\n"; 
                    echo "</tr>\n"; 
                    echo "</thead>\n";
                    $query = "select * from `startup`";
                    $res = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($res);
                    for($x = 1; $x <= $count; $x++){
                        $number = $x;
                        $query = "select * from `startup` WHERE `startupID` = \"$number\"";
                        $result= mysqli_query($conn, $query) or die ('Failed to query');
                        $startup= mysqli_fetch_array($result); 
                        echo "<tbody class=\"text-left\">\n"; 
                        echo "<tr class=\"companyTile\">\n"; 
                        echo "<td> <img class=\"img-thumbnail\" src=\"../Images/".$startup['logo']."\" alt><span>".$startup['name']."</span></td>\n"; 
                        echo "<td>".$startup['about']."</td>\n"; 
                        echo "<td class=\"odds\" id=\"".$x."\"></td>\n";
			            echo "<input id=\"startupID\" type=\"hidden\" value=".$x.">"; 
                        echo "</tr>\n"; 
                       }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>  
<!--Script for Table-->
<script>
        function getOdds(startupID) {
        var url = "getOdds.php"; // the script where you handle the form input.
        $.ajax({
			   type: "GET",
			   url: url,
			   data: {startupID: startupID},
			   success: function(data)
			   {
                   console.log(data);
                   console.log(startupID);
			       var test = $('#' + startupID);
                   test.html(data);
    	       }
		});
    }
    
    $(document).ready(function(){
        $('tbody tr').each(function (i, row) {
            var $row = $(row),
                $startupID = $row.find('#startupID');
                getOdds($startupID.val());  
        });
    });

    $("#search").on("keyup", function() {
    var value = $(this).val();
    $("table tr ").each(function(index) {
        if (index !== 0) {
            $row = $(this);
            var id = $row.find("span").text();
            if (id.indexOf(value) !== 0) {
                $row.hide();
            }
            else {
                $row.show();
            }
        }
    });
});
	$(".companyTile").on("click", function() {
		var x = $(this).find("#startupID").val();
		window.location.replace("profile.php?startupID="+x);
	});
        </script>
</html>
