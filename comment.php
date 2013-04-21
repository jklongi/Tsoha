<!DOCTYPE html>
<html>
	<?php
	$drink = array_map('mysql_real_escape_string', $_GET);
	$drinkID = $drink['cocktailid'];
	if (isset($_POST['komment'])){
		$kommentti = mysql_real_escape_string($_POST['kommentti']); 
		$nimi = $_SESSION['kayttaja'];
		if($kommentti == NULL){
			echo "Kirjoitit tyhjän kommentin";
			die();
		}
		$insert = mysqli_query($connection, "
					INSERT INTO kommentti
					(kayttajaID, drinkkiID, kommentti)
					VALUES 
					('$nimi', '$drinkID', '$kommentti');
					") or die ('Lisäys ei onnistunut');
		echo "Kiitos kommentista!<br />";
	}
	
	
	$tulokset = mysqli_query($connection ,"
		SELECT *
		FROM 	kommentti
		WHERE drinkkiID = '$drinkID'
		ORDER BY kommenttiID DESC LIMIT 30
	"
	) or die('Kysely ei onnistunut');
	?>
	<TEXTAREA background-color: lightyellow style="resize:none; background-color:#FFEE79" ROWS = 7 COLS = 60 name = "kommentit" readonly ><?php
	while ($rivi = mysqli_fetch_assoc($tulokset)) {
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
		echo "\n";
		echo "-------------------------------";
		echo "\n";
	}
	?></TEXTAREA>
	<?php
		if(isset($_SESSION['kayttaja'])) {
	?>
			<h5>Lisää kommentti</h5>
			<form action = "" method = "post" >
				<label><?php echo("{$_SESSION['nimi']}:");?></label><br />
				<TEXTAREA style="resize:none" ROWS = 3 COLS = 30 name = "kommentti"></TEXTAREA><br />
				<label></label><input type="submit" name = "komment" value="Lisää" />
			</form>	
		</body>
	<?php
		}
	?>
</html>