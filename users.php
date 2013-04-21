<!DOCTYPE html>
<html>
	<?php
		include("database.php");
		if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) {
		
			if (isset($_GET['id'])){
				$poistettava = $_GET['id'];
				$kayttaja = mysqli_query($connection ,"
				DELETE
				FROM 	kayttajat
				WHERE kayttajaID = '$poistettava'
				"
				) or die('Kysely ei onnistunut');
				$kommentit = mysqli_query($connection ,"
				DELETE
				FROM 	kommentti
				WHERE kayttajaID = '$poistettava'
				"
				) or die('Kysely ei onnistunut');
				echo "Käyttäjä poistettu onnistuneesti!";
			}
			if (isset($_GET['yllapitaja'])){
				$vaihdettava = $_GET['yllapitaja'];
				$nykyinen = mysqli_query($connection, "
				SELECT * 
				FROM kayttajat 
				WHERE kayttajaID = '$vaihdettava'");
                $rivi = mysqli_fetch_row($nykyinen);
				if($rivi[4] == 0){
					$uusi = 1;
				} else {
					$uusi = 0;
				}
				
				$vaihto = mysqli_query($connection ,"
				UPDATE kayttajat
				SET admin = $uusi
				WHERE kayttajaID = '$vaihdettava'
				"
				) or die('Kysely ei onnistunut');
			}
		
			$kayttajat = mysqli_query($connection ,"
				SELECT 	*
				FROM 	kayttajat
			"
			) or die('Kysely ei onnistunut');
			
			echo "<br /><br />";
			echo "<table border=1>";
			echo "<tr>";
			echo "<td>Id</td>";
			echo "<td>Tunnus</td>";
			echo "<td>Email</td>";
			echo "<td>Admin</td>";
			echo "</tr>";
			
			while ($rivi = mysqli_fetch_assoc($kayttajat)) {
				$kayttajaID = $rivi["kayttajaID"];
				$tunnus = $rivi["kayttaja"];
				$email = $rivi["email"];
				$admin = $rivi["admin"];
				if($admin == 1){
					$oikeus = "kyllä";
				} else {
					$oikeus = "ei";
				}
				echo "<tr>";
				echo "<td>$kayttajaID</td>";
				echo "<td>$tunnus</td>";
				echo "<td>$email</td>";
				echo "<td><a href=\"index.php?page=users&yllapitaja=".$kayttajaID."\">$oikeus</a></td>";
				echo "<td><a href=\"index.php?page=users&id=".$kayttajaID."\">Poista</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			
			echo "<br /><br />";

		}
	?>
</html>