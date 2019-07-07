<?php
	if(session_status() === PHP_SESSION_ACTIVE)
	{
		session_destroy();
	}
	
	session_start();
	
	$_SESSION['server_name'] = 'localhost';
	$_SESSION['username'] = 'root';
	$_SESSION['password'] = '';
	$_SESSION['dbname'] = 'synapse_test';
	
	$conn = new mysqli($_SESSION['server_name'], $_SESSION['username'], $_SESSION['password']);
	
	// Check connection
	if ($conn->connect_error) 
	{
		die('Connection failed: ' . $conn->connect_error . '<br>');
	} 
	else
	{
		//drop the database
		$sql = 'DROP DATABASE ' . $_SESSION['dbname'];
		if ($conn->query($sql) === FALSE)
		{
			echo 'Database already dropped<br>';
		}
		
		//recreate the db and tables
		$sql = 'CREATE DATABASE ' . $_SESSION['dbname'];
		if ($conn->query($sql) === FALSE)
		{
			echo 'Database already created<br>';
		}
		
		/**********************************************************
		*Create tables
		**********************************************************/
		mysqli_select_db($conn, $_SESSION['dbname']);
		
		//create items table
		$sql = 'CREATE TABLE `items` (
		 `id` int(11) NOT NULL AUTO_INCREMENT,
		 `name` varchar(32) NOT NULL,
		 `type` varchar(32) NOT NULL,
		 PRIMARY KEY (`id`),
		 UNIQUE KEY `id` (`id`)
		)';

		if ($conn->query($sql) === FALSE) 
		{
			die('Error creating table "items": ' . $conn->error . '<br>');
		}
		
		//create enemies table
		$sql = 'CREATE TABLE `enemies` (
		 `id` int(11) NOT NULL AUTO_INCREMENT,
		 `name` varchar(32) NOT NULL,
		 `attack` int(11) NOT NULL,
		 `health` int(11) NOT NULL,
		 PRIMARY KEY (`id`),
		 UNIQUE KEY `id` (`id`)
		)';

		if ($conn->query($sql) === FALSE) 
		{
			die('Error creating table "enemies": ' . $conn->error . '<br>');
		}
		
		//create map cells table
		$sql = 'CREATE TABLE `cells` (
		 `id` int(11) NOT NULL AUTO_INCREMENT,
		 `x_pos` int(11) NOT NULL,
		 `y_pos` int(11) NOT NULL,
		 `enemy_id` int(11) NOT NULL,
		 `item_id` int(11) NOT NULL,
		 PRIMARY KEY (`id`),
		 UNIQUE KEY `id` (`id`)
		)';

		if ($conn->query($sql) === FALSE) 
		{
			die('Error creating table "cells": ' . $conn->error . '<br>');
		}

		//create some temporary enemies
		$sql = "INSERT INTO enemies (name, attack, health)
		VALUES ('goblin', '1', '2'), ('ork', '2', '3'), ('sorceror', '3', '2');";
	
		if ($conn->query($sql) === FALSE) 
		{
			echo "Error: " . $sql . "<br>" . $conn->error . '<br>';
		}
		
		//create some temporary items
		$sql = "INSERT INTO items (name, type)
		VALUES ('potion', 'HEAL'), ('sword', 'ATTACK_BOOST'), ('shield', 'DEFENSE_BOOST');";
		
		if ($conn->query($sql) === FALSE) 
		{
			echo "Error: " . $sql . "<br>" . $conn->error . '<br>';
		}
		
		//create some cells
		$sql = "INSERT INTO cells (x_pos, y_pos, enemy_id, item_id)
		VALUES ('0', '0', '0', '0'), ('0', '1', '0', '3'), ('0', '2', '1', '1'), " . 
				"('1', '0', '0', '0'), ('1', '1', '0', '0'), ('1', '2', '0', '0'), " . 
				"('2', '0', '0', '0'), ('2', '1', '2', '0'), ('2', '2', '0', '0');";
		
		if ($conn->query($sql) === FALSE) 
		{
			echo "Error: " . $sql . "<br>" . $conn->error . '<br>';
		}
		
		//For the initial purpose, the game map is 3x3
		//set exit cell
		$_SESSION['exit_cell_x'] = 2;
		$_SESSION['exit_cell_y'] = 2;
		
		//set start current cell
		$_SESSION['previous_cell_x'] = -1;
		$_SESSION['previous_cell_y'] = -1;
		
		$_SESSION['current_cell_x'] = 0;
		$_SESSION['current_cell_y'] = 0;
		
		unset($_SESSION['current_enemy_health']);
	}
?>