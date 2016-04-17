<?php
	session_start();
	include_once 'dbconnect.php';
	
	$startupID = $_GET["startupID"];
	
	//get total number of bets
	$query = "select * from `bets`";
    $res = mysqli_query($conn, $query);
    $noOfBets = mysqli_num_rows($res);
	//get total number of companies
	$query = "select * from `startup`";
    $res = mysqli_query($conn, $query);
    $noOfCompanies = mysqli_num_rows($res);
    //find average number of bets on companies
    $averageBets = $noOfBets/$noOfCompanies;
    //find number of bets on a particular company
    $query = "select * from `bets` WHERE `startupID` = \"$startupID\" ";
    $res = mysqli_query($conn, $query);
    $betsOnCompanies = mysqli_num_rows($res);
    //calculate percentage difference
    $percentDiff = 1 + ( ($betsOnCompanies - $averageBets) / $averageBets ) ;         
	//get original odd on company
	$query = "select * from `startup` WHERE `startupID` = \"$startupID\" ";
    $res = mysqli_query($conn, $query);
	$row=mysqli_fetch_array($res);
    if($percentDiff){
	    $newOdd = ($row['odds'])/(1.05*$percentDiff);
    }else 
        $newOdd = 1;
    
    $query = "UPDATE `startup` SET `odds` = \"newOdd\" WHERE `startupID` = \"$startupID\" ";
    $res = mysqli_query($conn, $query) or die ('Failed to query');
	echo $newOdd;
?>