<?php
session_start();
include("db.php");
$pagename="Sign Up Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

if(isset($_POST['signup'])){
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$address=$_POST['address'];
	$postcode=$_POST['postcode'];
	$tel=$_POST['tel'];
	$email=$_POST['email'];
	$password=$_POST['pass'];
	$conpass=$_POST['conpass'];
	
	//validation of inputs
	$Valid =true;
	if($Valid == true){
		if ($password !== $conpass){
			echo "The 2 passwords are not matching \n<br>
			Make sure you enter them correctly<br><br>";
			echo "GO back to <a href=signup.php>SignUp</a>"; 
		}
		
		if (!preg_match("/^[a-zA-Z0-9]+@[a-zA-Z0-9_-]+\.[a-zA-Z0-9_-]/", $email)){
			echo "Invalid email \n<br>
			Make sure you enter a valid email address<br><br>";
			echo "GO back to <a href=signup.php>SignUp</a>"; 
		}
		
		if (!mysqli_query($conn,"INSERT INTO users (userEmail) VALUES ($email)")) {
			$test=mysqli_errno($conn);
			if($test==1062){
				echo "Email already in use<br>";
				echo "You may be already registered or try another email address<br><br>";
				echo "Go back to <a href=signup.php>sign up";
			}
		}
		
		
		if (empty($fname)or empty($lname)or empty($address)or empty($postcode)or empty($tel)or empty($email)or empty($password)or empty($conpass)){
			echo "Your signup from is incomplete and all fields are mandatory \n
			Make sure you provide all the required details";
			echo "GO back to <a href=signup.php>SignUp</a>"; 
		}
	//echo "You have successfully signed up as a hometeq Customer";
	}
		
	
	
	//$SQL ="INSERT INTO users(userFName, userSName, userAddress, userPostCode, postTelNo) values ('$fname', '$lname')";
	$SQL ="INSERT INTO users(userFName, userSName, userAddress, userPostCode, postTelNo, userEmail, userPassword) values ('$fname', '$lname', '$address', '$postcode', '$tel', '$email', '$password')";
	$exeSQL=mysqli_query($conn, $SQL);
	$SESSION['fname'] = $fname;
	mysqli_close($conn); // Closing Connection with Server
}	
include("footfile.html"); //include head layout
echo "</body>";
?>