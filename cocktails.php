<!DOCTYPE html>
<html>
	<br />
	<?php
	include("database.php");
		echo "Hae drinkkejä hakusanoilla tai tyypin mukaan.";
	?>
	<body>
		<form action ="index.php?=pagecocktails.php" method = "post" >
			<input type="text" name = "sanahaku" />
			<input type="submit" name="submit" value="Hae" /> <br/ >
			<label>Drinkki</label><input type="checkbox" value="Yes" name = "drinkki" />
			<label>Shotti</label><input type="checkbox" value="Yes" name = "shotti"/>
			<label>Alkoholiton</label><input type="checkbox" value="Yes" name = "alkoholiton" /
			<label>Kuuma juoma</label><input type="checkbox" value="Yes" name = "kuuma" />
		</form>
	</body>
	<br/>
	<?php
		if (isset($_POST['submit']))
			{
				$hakusana = mysql_real_escape_string($_POST['sanahaku']);
				
				if(isset($_POST['shotti'])){
					$tyyppi = "Shotti";
				}
				$tulokset = mysqli_query($connection ,"
					SELECT 	*
					FROM 	drinkki
					WHERE drinkkinimi LIKE '%$hakusana%'
					ORDER BY drinkkinimi ASC
				"
				) or die('Kysely ei onnistunut');
				
				$maara = mysqli_num_rows($tulokset);
				
				echo "Hakuehdoilla löytyi $maara tulosta: <br/><br/>";
				
				while ($rivi = mysqli_fetch_assoc($tulokset)) {
					$linkinnimi = $rivi["drinkkinimi"];
					$linkID = $rivi["drinkkiID"];
					echo "<a href=\"index.php?cocktailid=".$linkID."\">$linkinnimi</a>";
					echo " ";
					echo $rivi["tyyppi"];
					echo "<br/>";
				}

			} else{
				
				include("display.php");
			}
	?>
</html>