<!DOCTYPE html>
<html>
	<?php
		include("database.php");
		if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) { 
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$nimi= mysql_real_escape_string($_POST['nimi']);
				$alkoholi = mysql_real_escape_string($_POST['alkoholi']);
				$yksikko = mysql_real_escape_string($_POST['yksikko']);
				if($nimi == NULL  || $alkoholi == NULL  || $yksikko == NULL){
							echo "Mitään ei saa jättää tyhjäksi!";
							die();
				}
				$insert = mysqli_query($connection, "
							INSERT INTO ainekset
							(nimi, alkoholiprosentti, yksikko)
							VALUES 
							('$nimi', '$alkoholi', '$yksikko');
							") or die ('Lisäys ei onnistunut');

				echo "Lisäys onnistui!<br />";
			
			}
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
				echo "<td><a href=\"index.php?page=allingredients&id=".$ainesID."\">Poista</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			
			?>
			<body>
				<h4>Lisää raaka-aine</h4>
				<form action ="index.php?page=allingredients" method = "post" >
					<label>Nimi</label><br /><input type="text" name = "nimi" /><br />
					<label>Alkoholiprosenti</label><br /><input type="text" name = "alkoholi"/><br />
					<label>Yksikkö</label><br /><input type="text" name = "yksikko"/><br />
					<label></label><input type="submit" value="Lisää" />
				</form>	
			</body>

			
			
		<?php
		echo "<br/><br/>";
		}
	?>
</html>