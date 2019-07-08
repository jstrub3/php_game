<?php
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}  
	
	//if this is the first instance of seeing this
	// enemy, we have to init the $_SESSION variables
	
	if (!isset($_SESSION['current_enemy_health']))
	{
		//First time seeing the enemy
		
		//query the sql cells for enemy id
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
		$sql = "SELECT enemy_id FROM cells WHERE x_pos='" . $_SESSION['current_cell_x'] . "' AND y_pos='" . $_SESSION['current_cell_y'] . "'";
		$result = $conn->query($sql);
		
		if ($result->num_rows === 0) 
		{
			die('Query for current cell failed: ' . $conn->connect_error . '<br>');
		}
		
		$current_cell = $result->fetch_assoc();

		
		
		$sql = "SELECT name, attack, health FROM enemies WHERE id='" . $current_cell['enemy_id'] . "'";
		$result = $conn->query($sql);
		$enemy = $result->fetch_assoc();
		if ($result->num_rows === 0) 
		{
			die('Query for enemy failed: ' . $conn->connect_error . '<br>');
		}
		
		$_SESSION['current_enemy_health'] = $enemy['health'];
		$_SESSION['current_enemy_attack'] = $enemy['attack'];
		
		echo '<p>Enemy ' . $enemy['name'] . ' Found!</p>';
	}
	else
	{
		//next combat turn
		if ($_GET['action'] == 'attack')
		{
			$_SESSION['current_enemy_health'] = $_SESSION['current_enemy_health'] - $_SESSION['current_player_attack'];
		}
		else if ($_GET['action'] == 'use_item')
		{
			//Use the first item in the list
			switch ($_SESSION['current_player_items'][0])
			{
				case 'shield':
				$_SESSION['current_player_defense'] = $_SESSION['current_player_defense'] + 1;
				break;
				case 'potion':
				$_SESSION['current_player_health'] = $_SESSION['current_player_health'] + 2;
				break;
				case 'sword':
				$_SESSION['current_player_attack'] = $_SESSION['current_player_attack'] + 2;
				break;
			}
			
			//remove this from the item inventory
			array_shift($_SESSION['current_player_items']);
		}
		
		//Enemy always attacks
		$_SESSION['current_player_health'] = $_SESSION['current_player_health'] - min(0, ($_SESSION['current_enemy_attack'] - $_SESSION['current_player_defense']));
	}
	
	//after combat resolves, check player health
	if ( $_SESSION['current_player_health'] <= 0)
	{
		echo 'you are dead!';
	}
	else
	{		
		//if the enemy is dead, remove from the cell sql row
		if ( $_SESSION['current_enemy_health'] <= 0)
		{
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
			
			$sql = "UPDATE cells SET enemy_id='0' WHERE x_pos='" . $_SESSION['current_cell_x'] . "' AND y_pos='" . $_SESSION['current_cell_y'] . "'";
			$result = $conn->query($sql);
			
			echo '<li>Enemy Defeated!</li>';
			
			unset($_SESSION['current_enemy_health']);
			
			include_once('navigation.php');
		}
		else
		{
			//Show enemy stats
			echo sprintf('<li>Enemy Heath:  %d</li>', $_SESSION['current_enemy_health']);
			echo sprintf('<li>Enemy Attack: %d</li>', $_SESSION['current_enemy_attack']);
			
			//Show options:
			// Attack
			// Use Item 'X'
			// Retreat	
			
			echo '<p><a href="./game.php?action=attack">attack</a></p>';
			
			if ( count($_SESSION['current_player_items']) > 0)
			{
				echo '<p><a href="./game.php?action=use_item">use item</a></p>';
			}
		}
	}
?>