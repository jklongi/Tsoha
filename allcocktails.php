<!DOCTYPE html>
<html>
	<?php
		include("database.php");
		if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) {
		//drinkin poisto id=jotain avulla
		if (isset($_GET['delid'])){
				$poistettava = $_GET['delid'];
				$drinkki = mysqli_query($connection ,"
				DELETE
				FROM 	drinkki
				WHERE drinkkiID = '$poistettava'
				"
				) or die('Kysely ei onnistunut');
				echo "Drinkki poistettu onnistuneesti!";
		}
		
			$drinkit = mysqli_query($connection ,"
				SELECT 	*
				FROM 	drinkki
			"
			) or die('Kysely ei onnistunut');
			//taulukko jossa kaikki drinkit ja niiden tiedot
			echo "<br /><br />";
			echo "<table border=1>";
			echo "<tr>";
			echo "<td>Id</td>";
			echo "<td>Nimi</td>";
			echo "<td>Tyyppi</td>";
			echo "<td>Lasi</td>";
			echo "</tr>";
			
			while ($rivi = mysqli_fetch_assoc($drinkit)) {
				$id = $rivi["drinkkiID"];
				$ainekset = mysqli_query($connection ,"
					
					SELECT 	*
					FROM 	raaka_ainekset
					WHERE drinkkiID = $id		
				"
				) or die('Kysely ei onnistunut');
				
				$nimi = $rivi["drinkkinimi"];
				$tyyppi = $rivi["tyyppi"];
				$lasi = $rivi["lasi"];
				echo "<tr>";
				echo "<td>$id</td>";
				echo "<td>$nimi</td>";
				echo "<td>$tyyppi</td>";
				echo "<td>$lasi</td>";
				echo "<td><a href=\"index.php?page=editcocktail&id=".$id."\">Raaka-aineet</a></td>";
				echo "<td><a href=\"index.php?page=allcocktails&delid=".$id."\">Poista</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			
			echo "<br /><br />";

		}
	?>
</html>