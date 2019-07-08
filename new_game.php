<h2>New Game</h2>

<?php
	include_once 'initialize_game.php';

	//Set our player stats
	$_SESSION['current_player_health'] = $_GET['health'];
	$_SESSION['current_player_attack'] = $_GET['attack'];
	$_SESSION['current_player_defense'] = $_GET['defense'];
	$_SESSION['current_player_items'] = [];
		
	//game states:
	/*idle - player selects movement to available cells
	**combat - player selects to use items, attack, or retreat.
	**dead - player can only go to home page.
	**exit - player can only go to home page.
	*/
	
	include_once 'navigation.php';
	include_once 'character_view.php';
	include_once 'map_view.php';
?>