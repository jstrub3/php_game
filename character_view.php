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
	echo sprintf('<li>Item:   %s</li>', $_SESSION['current_player_item']);
	echo '</ul>';
?>