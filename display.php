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
				
				echo "<B>Nimi:</b> $rivi[1] <br/><B>Tyyppi:</B> $rivi[2]<br/><B>Lasi:</B> $rivi[3] <br/><B>Lisääjä:</B> $rivi[4]<br/>";
				
				$ainekset = mysqli_query($connection ,"
					
					SELECT 	*
					FROM 	raaka_ainekset
					WHERE drinkkiID = $drinkID		
				"
				) or die('Kysely ei onnistunut');

				echo "<B>Ainekset:</B> ";
				
				$alkoholi = 0;
				$tilavuus = 0;
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
					$ohjeet = $aineet["yksikko"];
					$prosentti = $aineet["alkoholiprosentti"];
					$alkoholi = $alkoholi + $prosentti * $maara;
					$tilavuus = $tilavuus + $maara;
					
					
					echo "$ainesnimi $maara $yksikko";
					echo ", ";
				}
				$alkoholiprosentti = round($alkoholi / $tilavuus, 2);
				
				echo "<br/>";
				echo "<B>Alkoholipitoisuus:</B> $alkoholiprosentti %";
				echo "<br/><br/> ";
				echo "$rivi[5] ";
				echo "<br/><br/> ";
				
				
				//Ylläpito
				if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) { 
					echo "<a href=\"index.php?page=deletecomment&id=".$drinkID."\">Hallitse kommentteja</a>";
					echo "<br/> ";
				}
			}
	?>
	<body>

	</body>
</html>
