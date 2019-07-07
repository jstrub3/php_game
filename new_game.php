<h2>New Game</h2>

<?php
	include_once 'initialize_game.php';
		
	//game states:
	/*idle - player selects movement to available cells
	**combat - player selects to use items, attack, or retreat.
	**dead - player can only go to home page.
	**exit - player can only go to home page.
	*/
	
	include_once 'character_view.php';
	include_once 'map_view.php';
	include_once 'navigation.php';
?>