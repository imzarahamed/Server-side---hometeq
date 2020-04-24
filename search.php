<?php
include("db.php");
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
$output='';
		if(isset($_POST['search'])) {
			$search = $_POST['search'];
			$search2 = preg_replace("#[^0-9a-z]#i","",$search);
			
			$SQL="SELECT * FROM event WHERE eventName LIKE '%$search2%' OR eventDesc LIKE '%$search2%'";
			$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());			
			
			
			$count = mysqli_num_rows($exeSQL);
			if($count == 0){
				$output = 'There was no search results !';
			}else{
				echo "<table style='border: 0px'>";
				while($row = mysqli_fetch_array($exeSQL)){
					$EventName = $row['eventName'];
					$EventDescription = $row['eventDesc'];
					
					$output = $row['EventName']." ".$EventDescription;
					$outPId=$EventDescription;
					$pic=$row['eventPicName'];
					
						echo "<tr>";
						echo "<td style='border: 0px'>";
						//display the small image whose name is contained in the array
						echo "<a href=prodbuy.php?u_prod_id=".$row['eventId'].">";
						echo "<img src=images/".$row['eventPicName']." height=200 width=200>";
						echo "</a>";
						echo "</td>";
						echo "<td style='border: 0px'>";
						echo "<p><h5>".$row['EventName']."</h5>"; //display product name as contained in the array
						echo "<p><h6>".$row['eventDesc']."</h6>"; //display product description as contained in the array
						echo "</td>";
						echo "</tr>";
				}
				echo "</table>";
			}				
			

		}
		if(!(isset($_POST['search']))){
			echo "<form action=search.php method=POST>";
				echo "<input type='text' name='search' placeholder='Search'>";
				echo "<button type='submit' name='submit' value='Search'>Search</button>";
			echo "</form>";
		}		
?>
