<h2>New Game</h2>

<?php
	if(session_status() === PHP_SESSION_ACTIVE)
	{
		session_destroy();
	}
	
	session_start();
	
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'synapse_test';
	
	$conn = new mysqli($servername, $username, $password);
	
	// Check connection
	if ($conn->connect_error) {
		die('Connection failed: ' . $conn->connect_error . '<br>');
	} 
	else
	{
		//drop the database
		$sql = 'DROP DATABASE ' . $dbname;
		if ($conn->query($sql) === TRUE)
		{
			echo 'Database dropped successfully<br>';
		}
		else
		{
			echo 'Database already dropped<br>';
		}
		
		//recreate the db and tables
		$sql = 'CREATE DATABASE ' . $dbname;
		if ($conn->query($sql) === TRUE)
		{
			echo 'Database created successfully<br>';
			
		}
		else
		{
			echo 'Database already created<br>';
		}
		
		mysqli_select_db($conn, $dbname);
		/**********************************************************
		*Create tables
		**********************************************************/
		
		//create items table
		$sql = 'CREATE TABLE `items` (
		 `id` int(11) NOT NULL,
		 `name` varchar(32) NOT NULL,
		 `type` int(11) NOT NULL,
		 PRIMARY KEY (`id`),
		 UNIQUE KEY `id` (`id`)
		)';

		if ($conn->query($sql) === TRUE) {
			echo 'Table "items" created successfully<br>';
		} else 
		{
			die('Error creating table "items": ' . $conn->error . '<br>');
		}
		
		//create inventory table
		$sql = 'CREATE TABLE `inventory` (
		 `id` int(11) NOT NULL,
		 `item_id` int(11) NOT NULL,
		 `count` int(11) NOT NULL,	 
		 PRIMARY KEY (`id`),
		 UNIQUE KEY `id` (`id`)
		)';

		if ($conn->query($sql) === TRUE) {
			echo 'Table "inventory" created successfully<br>';
		} else 
		{
			die('Error creating table "inventory": ' . $conn->error . '<br>');
		}
		
		//create enemies table
		$sql = 'CREATE TABLE `enemies` (
		 `id` int(11) NOT NULL,
		 `name` varchar(32) NOT NULL,
		 `attack` int(11) NOT NULL,
		 `health` int(11) NOT NULL,
		 PRIMARY KEY (`id`),
		 UNIQUE KEY `id` (`id`)
		)';

		if ($conn->query($sql) === TRUE) {
			echo 'Table "enemies" created successfully<br>';
		} else 
		{
			die('Error creating table "enemies": ' . $conn->error . '<br>');
		}
		
		//create map cells table
		$sql = 'CREATE TABLE `cells` (
		 `id` int(11) NOT NULL,
		 `x_pos` int(11) NOT NULL,
		 `y_pos` int(11) NOT NULL,
		 `enemy_id` int(11) NOT NULL,
		 `item_id` int(11) NOT NULL,
		 PRIMARY KEY (`id`),
		 UNIQUE KEY `id` (`id`)
		)';

		if ($conn->query($sql) === TRUE) {
			echo 'Table "cells" created successfully<br>';
		} else 
		{
			die('Error creating table "cells": ' . $conn->error . '<br>');
		}

		//create some temporary enemies
		
		//create some temporary items
		
		//create character inventory
		
		//create some cells
		
		
		
	
		//For the initial purpose, the game map is 3x3
		//set exit cell
		$_SESSION['exit_cell_x'] = 2;
		$_SESSION['exit_cell_y'] = 2;
		
		//set start current cell
		$_SESSION['previous_cell_x'] = -1;
		$_SESSION['previous_cell_y'] = -1;
		
		$_SESSION['current_cell_x'] = 0;
		$_SESSION['current_cell_y'] = 0;
		
		$_SESSION['current_player_health'] = 5;
		$_SESSION['current_player_attack'] = 2;
		$_SESSION['current_player_item'] = 'none';
		
		unset($_SESSION['current_enemy_health']);
		
		//game states:
		/*idle - player selects movement to available cells
		**combat - player selects to use items, attack, or retreat.
		**dead - player can only go to home page.
		**exit - player can only go to home page.
		*/
		
		include_once 'character_view.php';
		include_once 'map_view.php';
		include_once 'navigation.php';
	} 

?>