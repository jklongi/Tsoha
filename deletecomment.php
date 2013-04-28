<!DOCTYPE html>
<html>
	<?php
		include("database.php");
		if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) {
				//poistetaan POST commentid=jotain kommentti
				if (isset($_GET['commentid'])){
					$poistettava = $_GET['commentid'];
					$aineet = mysqli_query($connection ,"
					DELETE
					FROM 	kommentti
					WHERE kommenttiID = '$poistettava'
					"
					) or die('Kysely ei onnistunut');
					echo "<br />";
					echo "Kommentti poistettu onnistuneesti!<br/>";

				}
				//näytetään kaikki tietyn drinkin kommentit helpommin luettavassa muodossa(ei textareassa)
				if (isset($_GET['id'])){
					$drinkkiID = $_GET['id'];
					$kommentit = mysqli_query($connection ,"
					SELECT *
					FROM 	kommentti
					WHERE drinkkiID = '$drinkkiID'
					ORDER BY kommenttiID DESC LIMIT 30
					"
					) or die('Kysely ei onnistunut');
					echo "<br /><br />";
					while ($rivi = mysqli_fetch_assoc($kommentit)) {
						$nimiID = $rivi["kayttajaID"];
						$kommenttiID = $rivi["kommenttiID"];
						$kommentti = $rivi["kommentti"];
						$etsinimi = mysqli_query($connection ,"
						SELECT 	*
						FROM 	kayttajat
						WHERE kayttajaID = '$nimiID'
						"
						) or die('Kysely ei onnistunut');
						$tulos = mysqli_fetch_row($etsinimi);
						$nimimerkki = $tulos[1];
						echo"$nimimerkki: ";
						echo "$kommentti ";
						echo "<a href=\"index.php?page=deletecomment&commentid=".$kommenttiID."\">Poista</a>";
						echo "<br/>";
						echo "-------------------------------";
						echo "<br/>";
					}
					echo "</TEXTAREA>";
				}
		}
	?>
</html>