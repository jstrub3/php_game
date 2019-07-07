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
		echo '<p>Enemy Found!</p>';
		
		$_SESSION['current_enemy_health'] = 5;
	}
	else
	{
		//next combat turn
		if ($_GET['action'] == 'attack')
		{
			$_SESSION['current_enemy_health'] = $_SESSION['current_enemy_health'] - 2;
		}
		else if ($_GET['action'] == 'use_item')
		{
			
		}
		else if ($_GET['action'] == 'retreat')
		{
			
		}
		
		//Enemy always attacks
		$_SESSION['current_player_health'] = $_SESSION['current_player_health'] - 1;
	}
	
	echo $_SESSION['current_enemy_health'];
	echo sprintf('<li>Enemy Heath:  %d</li>', $_SESSION['current_enemy_health']);
	echo sprintf('<li>Enemy Attack: %d</li>', 1);
	
	
	//Show options:
	// Attack
	// Use Item 'X'
	// Retreat	
	
	echo '<p><a href="./game.php?action=attack">attack</a></p>';
	echo '<p><a href="./game.php?action=use_item">use item</a></p>';
	echo '<p><a href="./game.php?action=retreat">retreat</a></p>';


?>