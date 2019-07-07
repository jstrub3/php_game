
<?php
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}   

	//Check the session 'current_cell' variables against
	// the known edges of the map, only allow links for 
	// valid movement
	
	if ( $_SESSION['current_cell_x'] > 0)
	{
		// can move left	
		echo '<p><a href="./game.php?action=move_left">move left</a></p>';
	}
	
	if ( $_SESSION['current_cell_x'] < 3)
	{
		// can move right
		echo '<p><a href="./game.php?action=move_right">move right</a></p>';
	}
	
	if ( $_SESSION['current_cell_y'] > 0)
	{
		// can move up
		echo '<p><a href="./game.php?action=move_up">move up</a></p>';
	}
	
	if ( $_SESSION['current_cell_y'] < 3)
	{
		// can move down
		echo '<p><a href="./game.php?action=move_down">move down</a></p>';
	}
?>