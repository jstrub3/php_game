<html>
<body>
<h1 style="color: #5e9ca0;">Server Side Programming Test</h1>

<?php
	//the state will be determined based on the action
	// the player took, passed in as a $_GET variable
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	} 
	
	if ( isset($_GET['action']) )
	{
		$action = $_GET['action'];
		$nav_action = FALSE;
		
		//handle the actions
		switch ($action)
		{
			case 'move_left':
			$nav_action = TRUE;
			$_SESSION['current_cell_x'] = $_SESSION['current_cell_x'] - 1;
			break;
			
			case 'move_right':
			$_SESSION['current_cell_x'] = $_SESSION['current_cell_x'] + 1;
			break;
			
			case 'move_up':
			$_SESSION['current_cell_y'] = $_SESSION['current_cell_y'] - 1;
			break;
			
			case 'move_down':
			$_SESSION['current_cell_y'] = $_SESSION['current_cell_y'] + 1;
			break;
			
			default:
			break;
		}
		
		//Check win condition
		if ( $_SESSION['current_cell_y'] == $_SESSION['exit_cell_y'] && 
			$_SESSION['current_cell_x'] == $_SESSION['exit_cell_x'])
		{
			echo 'Exit reached, you win!';
			echo '<p><a href="./homepage.php">play again?</a></p>';
		}
		else
		{	
			//check items and enemies on this cell
	
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
			$sql = "SELECT enemy_id, enemy_id, item_id FROM cells WHERE x_pos='" . $_SESSION['current_cell_x'] . "' AND y_pos='" . $_SESSION['current_cell_y'] . "'";
			$result = $conn->query($sql);
			
			if ($result->num_rows === 0) 
			{
				die('Query for current cell failed: ' . $conn->connect_error . '<br>');
			}
			
			$current_cell = $result->fetch_assoc();

			//Check for items
			if ($current_cell['item_id'] != 0)
			{
				//Get the item info from the item dba_close
				$sql = "SELECT name FROM items WHERE id='" . $current_cell['item_id'] . "'";
				$result = $conn->query($sql);
				
				if ($result->num_rows === 0) 
				{
					die('Query for item failed: ' . $conn->connect_error . '<br>');
				}
							
				//Add item to character inventory
				$item = $result->fetch_assoc()['name'];
				array_push($_SESSION['current_player_items'], $item);
	
				//Remove item from the cell row
				$sql = "UPDATE cells SET item_id='0' WHERE x_pos='" . $_SESSION['current_cell_x'] . "' AND y_pos='" . $_SESSION['current_cell_y'] . "'";
				$result = $conn->query($sql);
				
				echo 'Found item: ' . $item . '<br>';
			}
			
			//Check for enemies
			if ($current_cell['enemy_id'] == 0)
			{
				show_navigation();
			}
			else
			{
				//if this cell has an enemy
				show_combat();
			}
			
			if ( $_SESSION['current_player_health'] <= 0)
			{
				echo '<p><a href="./homepage.php">play again?</a></p>';
			}
			else
			{
				include_once 'character_view.php';
				include_once 'map_view.php';
			}
		}
	}

	function show_navigation() {
		include_once 'navigation.php';
	}

	function show_combat() {
		include_once 'combat.php';
	}
?>

</html>
</body>