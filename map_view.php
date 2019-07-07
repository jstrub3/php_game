
<?php
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}   

	echo '<table border="4">';

	$rows = 3;
	$cols = 3;
	for ($x = 0; $x <= $cols; $x++) {
		echo '<tr>';
		for ($y = 0; $y <= $rows; $y++) {
			if ( $_SESSION['current_cell_x'] == $y && $_SESSION['current_cell_y'] == $x)
			{
			echo sprintf('<td style="min-width:25px" align="center"> %s </td>', 'x');
			}
			else
			{
			echo sprintf('<td style="min-width:25px" align="center"> %s </td>', $x + $y);
			}
		}
		echo '</tr>';
	}
	echo '</table>';
?>