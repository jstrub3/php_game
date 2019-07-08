<html>
<body>
<h1 style="color: #5e9ca0;">PHP Game</h1>
<h2 style="color: #2e6c80;">Game Objective:</h2>
<p>The player will move around the map one cell at a time.&nbsp; Each cell will contain one of the following:</p>
<ul>
<li>Enemy - will be engaged in turn based combat.</li>
<li>Item - can be used for specific effects during combat.</li>
<li>Exit - the exit of the map, reaching this will signal winning the game.</li>
<li>Nothing.</li>
</ul>
<h2 style="color: #2e6c80;">Items</h2>
<ul>
<li>shield - increase defense by 1</li>
<li>sword - increases attack by 2</li>
<li>potion - heals player for 2.</li>
</ul>
<h3>Items are used in order of pick up.</h3>


<h2 style="color: #2e6c80;">Initial Character Stats:</h2>

<form action="./new_game.php">
  Attack:  <input type="text" name="attack" class="form-control" value="5"> (Amount of enemy health reduced per attack)<br>
  Health:  <input type="text" name="health" class="form-control" value="20"> (Maximum health of player)<br>
  Defense: <input type="text" name="defense" class="form-control" value="2"> (Reduces enemy attack amount)<br>
  <input type="submit" value="Start New Game" method="get">
</form>

</html>
</body>