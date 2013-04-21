<!DOCTYPE html>
<html>
	<?php
		include("database.php");
		if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) { 
			if (isset($_GET['id'])){
				$poistettava = $_GET['id'];
				$aineet = mysqli_query($connection ,"
				DELETE
				FROM 	ainekset
				WHERE ainesID = '$poistettava'
				"
				) or die('Kysely ei onnistunut');
				echo "<br />";
				echo "Aines poistettu onnistuneesti!";
			}
		
			$ainekset = mysqli_query($connection ,"
				SELECT 	*
				FROM 	ainekset
			"
			) or die('Kysely ei onnistunut');
			
			echo "<br /><br />";
			echo "<table border=1>";
			echo "<tr>";
			echo "<td>Id</td>";
			echo "<td>Nimi</td>";
			echo "<td>Alkoholiprosentti</td>";
			echo "<td>Yksikkö</td>";
			echo "</tr>";
			
			while ($rivi = mysqli_fetch_assoc($ainekset)) {
				$ainesID = $rivi["ainesID"];
				$nimi = $rivi["nimi"];
				$alkoholi = $rivi["alkoholiprosentti"];
				$yksikko = $rivi["yksikko"];
				echo "<tr>";
				echo "<td>$ainesID</td>";
				echo "<td>$nimi</td>";
				echo "<td>$alkoholi</td>";
				echo "<td>$yksikko</td>";
				echo "<td><a href=\"index.php?page=deleteingredient&id=".$ainesID."\">Poista</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			
			echo "<br /><br />";
		}
	?>
</html>