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
		
		//handle the actions
		switch ($action)
		{
			case 'move_left':
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
		
		include_once 'character_view.php';
		include_once 'map_view.php';

		if (($_SESSION['current_cell_y'] + $_SESSION['current_cell_x']) % 2 == 0)
		{
			show_navigation();
		}
		else
		{
			//if this cell has an enemy
			show_combat();
		}
	}

	function show_navigation() {
		include_once 'navigation.php';
	}

	function show_combat() {
		include_once 'combat.php';
	}
	
	function show_win() {
	   //include_once 'game_win.php';
	}
	
	function show_lose() {
	   //include_once 'game_lose.php';
	}
?>

</html>
</body>