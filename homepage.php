<html>
<body>
<h1 style="color: #5e9ca0;">Server Side Programming Test</h1>
<h2 style="color: #2e6c80;">Game Objective:</h2>
<p>The player will move around the map one cell at a time.&nbsp; Each cell will contain one of the following:</p>
<ul>
<li>Enemy - will be engaged in turn based combat.</li>
<li>Item - can be used for specific effects during combat.</li>
<li>Exit - the exit of the map, reaching this will signal winning the game.</li>
<li>Nothing.</li>
</ul>

<h2 style="color: #2e6c80;">Initial Character Stats:</h2>

<form action="./new_game.php">
  Attack:  <input type="text" name="attack" class="form-control" value="2"><br>
  Health:  <input type="text" name="health" class="form-control" value="5"><br>
  Defense: <input type="text" name="defense" class="form-control" value="1"><br>
  <input type="submit" value="Start New Game" method="get">
</form>

</html>
</body>