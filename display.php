<!DOCTYPE html>
<html>
	<?php
			if (isset($_GET['cocktailid'])){
			
				$drink = array_map('mysql_real_escape_string', $_GET);
                $drinkID = $drink['cocktailid'];
				
				$perustiedot = mysqli_query($connection ,"
					SELECT 	*
					FROM 	drinkki
					WHERE drinkkiID = $drinkID
				"
				) or die('Kysely ei onnistunut');
				$rivi = mysqli_fetch_row($perustiedot);
				$maara = mysqli_num_rows($perustiedot);
				
				echo "Drinkki: $rivi[1] <br/>Tyyppi: $rivi[2]<br/>Lasi: $rivi[3] <br/>Lisaaja: $rivi[4]<br/>";
				
				$ainekset = mysqli_query($connection ,"
					
					SELECT 	*
					FROM 	raaka_ainekset
					WHERE drinkkiID = $drinkID		
				"
				) or die('Kysely ei onnistunut');

				echo "Ainekset: ";
				while ($raaka_ainekset = mysqli_fetch_array($ainekset)) {
					$tulokset = mysqli_query($connection, "
					SELECT * 
					FROM ainekset 
					WHERE ainesID = '{$raaka_ainekset['ainesID']}'"
					) or die('Kysely ei onnistunut') ;
					$aineet = mysqli_fetch_array($tulokset);
					
					$maara = $raaka_ainekset["maara"];
					$ainesnimi = $aineet["nimi"];
					$yksikko = $aineet["yksikko"];
					echo "$ainesnimi $maara $yksikko";
					echo ", ";
				}
				
				// while ($tuloslista = mysqli_fetch_assoc($ainekset)) {
					// $ainesnimi = $tuloslista["nimi"];
					// $yksikko = $tuloslista["yksikko"];
					// $maara = $maarat["maara"];
		
					// echo "$ainesnimi $maara $yksikko";
					// echo ", ";
				// }

			}
	?>
	<body>

	</body>
</html>
