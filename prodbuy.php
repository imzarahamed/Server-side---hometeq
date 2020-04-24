<?php
include("db.php");
$pagename="A smart buy for a smart home";       //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";//Call in stylesheet
echo "<title>".$pagename."</title>";//display name of the page as window title
echo "<body>";
include ("headfile.html");//include headerlayoutfile
echo "<h4>".$pagename."</h4>";//display name of thepageon the web page

//retrieve the product id passed from previous page using the GET methodand the $_GET superglobal variable
//applied to the query stringu_prod_id
//store the value in a local variable called 
$prodid=$_GET['u_prod_id'];

//display the value of the product id, for debugging purposes
echo "<p>Selected product Id: ".$prodid;



//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL="select prodId, prodName, prodPicNameSmall,prodDescripLong,prodPrice,prodQuantity from Product where prodId=$prodid";
//run SQL query for connected DB or exit and display error message
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());

echo "<table style='border: 0px'>";//create an array of records (2 dimensional variable) called $arrayp.
//populate it with the records retrieved by the SQL query previously executed. 
//Iterate through the array i.e while the end of the array has not been reached, run through it
while ($arrayp=mysqli_fetch_array($exeSQL))
{
	echo "<tr>";
	echo "<td style='border: 0px'>";
	//make the image into an anchor to prodbuy.phpand pass the product id by URL (the id from the array)
	echo "<img src=images/".$arrayp['prodPicNameSmall']." height=400 width=400>";
	echo "</a>";
	echo "</td>";
	echo "<td style='border: 0px'>";
	echo "<p><h5>".$arrayp['prodName']."</h5>";		
	echo "<p><b>".$arrayp['prodDescripLong']."</b>";
	echo "<p><h6><b>$</b>".$arrayp['prodPrice']."</h6>";
	echo "<p>Number left in Stock = ".$arrayp['prodQuantity'];
	$p_quantity=0;
	$count=0;
	echo "<p>Number to be purchased: ";
	//createform made of one text field and one button for user to enter quantity
	//the value entered in theform will be posted to the basket.php to be processed
	echo "<form action=basket.php method=POST>";
	echo "<select name=u_prod_quantity> product quantity";	
	for ($value = 1; $value <= $arrayp['prodQuantity']; $value++) {		
		echo "<option value=$value>".$value."</option><br>";
		$count=$count+1;
	}			
	echo "</select>";
	echo "<input type=submit name=submit value='ADD TO BASKET'>";
	//pass the product id to the next page basket.php as a hidden value
	echo "<input type=hidden name=h_prod_id value=".$prodid.">";
	echo "</form>";
		
	//display product name as contained in the array
	echo "</td>";
	echo "</tr>";
}
echo "</table>";


include("footfile.html");//include head layout
echo "</body>";
?>