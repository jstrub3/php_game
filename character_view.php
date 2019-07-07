<?php
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}   

	echo '<h3>Character Stats:</h3>';
	echo '<ul>';
	echo sprintf('<li>Heath:   %d</li>', $_SESSION['current_player_health']);
	echo sprintf('<li>Attack:  %d</li>', $_SESSION['current_player_attack']);
	echo sprintf('<li>Defense: %d</li>', $_SESSION['current_player_defense']);
	
	$_SESSION['current_player_items'] = [];
	array_push($_SESSION['current_player_items'], 'SWORD', 'POTION', 'SHIELD');
	
	if ( isset($_SESSION['current_player_items']) )
	{
		for ($i = 0; $i < count($_SESSION['current_player_items']); $i++) 
		{
			echo sprintf('<li>Item: %s</li>', $_SESSION['current_player_items'][$i]);
		}
	}
	
	echo '</ul>';
	
	
?>