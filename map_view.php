
<?php
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}   

	//query the sql cells stored and construct an html table
	$conn = new mysqli($_SESSION['server_name'], $_SESSION['username'], $_SESSION['password']);
	if ($conn->connect_error) 
	{
		die('Connection failed: ' . $conn->connect_error . '<br>');
	} 
	else
	{
		mysqli_select_db($conn, $_SESSION['dbname']);
	}
	
	mysqli_select_db($conn, $_SESSION['dbname']);
	$sql = "SELECT x_pos, y_pos, enemy_id, item_id FROM cells";
	$result = $conn->query($sql);

	$rowArr = array();
	if ($result->num_rows > 0) 
	{
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			$rowArr[$row["x_pos"]][$row["y_pos"]] = $row;
		}
	} else 
	{
		die("Cell query results empty");
	}
		
	if ($result->num_rows > 0) 
	{
		echo '<table border="4">';	
		
		for ($y = 0; $y < count($rowArr); $y++) 
		{
			echo '<tr style="height:50px">';
			for ($x = 0; $x < count($rowArr[$y]); $x++) 
			{
				if ( $_SESSION['current_cell_x'] == $rowArr[$x][$y]["x_pos"] && $_SESSION['current_cell_y'] == $rowArr[$x][$y]["y_pos"])
				{
					echo sprintf('<td style="min-width:50px" align="center"> %s </td>', 'here');
				}
				else
				{
					echo sprintf('<td style="min-width:50px" align="center">  </td>', $rowArr[$x][$y]["enemy_id"] . ', ' . $rowArr[$x][$y]["item_id"]);
					//echo sprintf('<td style="min-width:50px" align="center"> %s </td>', $rowArr[$x][$y]["enemy_id"] . ', ' . $rowArr[$x][$y]["item_id"]);
				}
			}
			echo '</tr>';
		}
		echo '</table>';
	}
?>