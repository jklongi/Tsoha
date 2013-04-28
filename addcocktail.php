<!DOCTYPE html>
<html>
	<?php
	include("database.php");
	if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) { 
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$nimi= mysql_real_escape_string($_POST['nimi']);
			$tyyppi = mysql_real_escape_string($_POST['tyyppi']);
			$lasi = mysql_real_escape_string($_POST['lasi']);
			$lisaaja = mysql_real_escape_string($_SESSION['nimi']);
			$ohjeet = mysql_real_escape_string($_POST['ohjeet']);

			if($nimi == NULL  || $ohjeet == NULL ){
						echo "Mitään ei saa jättää tyhjäksi!";
						die();
			}
			$insert = mysqli_query($connection, "
						INSERT INTO drinkki
						(drinkkinimi, tyyppi, lasi, lisaaja, ohjeet)
						VALUES 
						('$nimi', '$tyyppi', '$lasi', '$lisaaja', '$ohjeet');
						") or die ('Lisäys ei onnistunut');

			echo "Lisäys onnistui!<br />";
			echo "<h3>";
			echo "Älä unohda lisätä raaka-aineita drinkkiisi <br /><br />";
			//Linkki raaka-aineiden muokkaukseen
			echo"<a href=\"/index.php?page=allcocktails\">Drinkit</a>";
			echo "</h3>";


		
		}
		?>
		<body>
			<h1>Lisää drinkki</h1>
			
			<form action ="index.php?page=addcocktail" method = "post">
				<label>Nimi</label><input type="text" name = "nimi" />
				<p>
					Tyyppi 
					<select name="tyyppi">
						<option value="Alkoholiton">Alkoholiton</option>
						<option value="Booli">Booli</option>
						<option value="Drinkki">Drinkki</option>
						<option value="Kuuma">Kuuma juoma</option>
						<option value="Shotti">Shotti</option>
					</select>
				</p>
				<p>
					Lasi 
					<select name="lasi">
					  <option value="Aromilasi">Aromilasi</option>
					  <option value="Boolimalja">Boolimalja</option>
					  <option value="Collinslasi">Collinslasi</option>
					  <option value="Highball -lasi">Highball-lasi</option>
					  <option value="Hurricanelasi">Hurricanelasi</option>
					  <option value="Irish Coffee -lasi">Irish coffee -lasi</option>
					  <option value="Likoorilasi">Liköörilasi</option>
					  <option value="Kuohuviinilasi">Kuohuviinilasi</option>
					  <option value="Margaritalasi">Margaritalasi</option>
					  <option value="Martinilasi">Martinilasi</option>
					  <option value="Old Fashioned -lasi">Old Fashioned -lasi</option>
					  <option value="Olutlasi">Olutlasi</option>
					  <option value="On the rocks -lasi">On the rocks -lasi</option>
					  <option value="Shottilasi">Shottilasi</option>
					  <option value="Totilasi">Totilasi</option>
					  <option value="Valkoviinilasi">Valkoviinilasi</option>
					  <option value="Muu">Muu</option>
					</select>
				</p>
				<label>Ohjeet: </label><br/><TEXTAREA style="resize:none" ROWS = 5 COLS = 50 name = "ohjeet"></TEXTAREA><br />

				<label></label><input type="submit" value="Lisää Drinkki" />
	
			</form>
		</body>
	<?php
	}
	?>
</html>