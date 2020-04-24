<?php
session_start();
include("db.php");
$pagename="Sign Up";       //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";//Call in stylesheet
echo "<title>".$pagename."</title>";//display name of the page as window title
echo "<body>";
include ("headfile.html");//include headerlayoutfile
echo "<h4>".$pagename."</h4>";//display name of thepageon the web page

echo "<form action=signup_process.php method=POST>";
	echo "*First Name			<input type=text id=fname name=fname <br><br>";
	echo "*Last Name    		<input type=text id=lname name=lname <br><br>";
	echo "*Address     			<input type=text id=address name=address <br><br>";
	echo "*Postcode    			<input type=text id=postcode name=postcode <br><br>";
	echo "*Tel No      			<input type=text id=tel name=tel <br><br>";
	echo "*Email Address		<input type=text id=email name=email <br><br>";
	echo "*Password    			<input type=text id=pass name=pass <br><br>";
	echo "*Confirm Password		<input type=text id=conpass name=conpass <br><br>";
	echo "<input type=submit name=signup value='Sign Up'>";
	echo "<input type=reset name=clearform value='Clear Form'>";
	
echo "</form>";
	//pass the product id to the next page basket.php as a hidden value
	//echo "<input type=hidden name=user_id value=".$userid.">";
include("footfile.html");//include head layout
echo "</body>";
?>