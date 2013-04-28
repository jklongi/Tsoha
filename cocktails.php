<!DOCTYPE html>
<html>
	<br />
	<?php
	include("database.php");
		echo "Hae drinkkejä hakusanoilla tai tyypin mukaan.";
	?>
	<body>
		<form action ="index.php?=pagecocktails.php" method = "post">
			<input type="search" name = "sanahaku"  />
			<input type="submit" name="submit" value="Hae" /> <br/ >
			<label>Drinkki</label><input type="checkbox" value="Yes" name = "drinkki" />
			<label>Shotti</label><input type="checkbox" value="Yes" name = "shotti"/>
			<label>Alkoholiton</label><input type="checkbox" value="Yes" name = "alkoholiton" /
			<label>Kuuma juoma</label><input type="checkbox" value="Yes" name = "kuuma" />
			<label>Booli</label><input type="checkbox" value="Yes" name = "booli" />
		</form>
	</body>
	<br/>
	<?php	
		if (isset($_POST['submit']))
			{
				$hakusana = mysql_real_escape_string($_POST['sanahaku']);
				
				if(isset($_POST['shotti'])){
					$shotti = "Shotti";
				} else{
					$shotti = NULL;
				}
				if(isset($_POST['drinkki'])){
					$drink = "Drinkki";
				} else{
					$drink= NULL;
				}
				if(isset($_POST['alkoholiton'])){
					$alkoholiton = "Alkoholiton";
				} else{
					$alkoholiton = NULL;
				}
				if(isset($_POST['kuuma'])){
					$kuuma = "Kuuma";
				} else{
					$kuuma = NULL;
				}
				if(isset($_POST['booli'])){
					$booli = "Booli";
				} else{
					$booli = NULL;
				}
				//Jos mitään ei valittu, pelkkä sanahaku
				if(is_null($drink) && is_null($shotti)&& is_null($alkoholiton) && is_null($kuuma) && is_null($booli)){
					$tulokset = mysqli_query($connection ,"
						SELECT 	*
						FROM 	drinkki
						WHERE drinkkinimi LIKE '%$hakusana%'
						ORDER BY drinkkinimi ASC
					"
					) ;
				} else {
				//Mikäli valittiin jotain, molemmat
					$tulokset = mysqli_query($connection ,"
						SELECT 	*
						FROM 	drinkki
						WHERE drinkkinimi LIKE '%$hakusana%'
						AND tyyppi = '$shotti' OR tyyppi = '$alkoholiton'
						OR tyyppi = '$kuuma' OR tyyppi = '$drink' OR tyyppi = '$booli'
						ORDER BY drinkkinimi ASC
					"
					) or die('Kysely ei onnistunut');
				}
				$maara = mysqli_num_rows($tulokset);
				
				echo "Hakuehdoilla löytyi $maara tulosta: <br/><br/>";
				//Jokaiselle tulokselle linkki omalla id:llä
				while ($rivi = mysqli_fetch_assoc($tulokset)) {
					$linkinnimi = $rivi["drinkkinimi"];
					$linkID = $rivi["drinkkiID"];
					echo "<a href=\"index.php?cocktailid=".$linkID."\">$linkinnimi</a>";
					echo " ";
					echo $rivi["tyyppi"];
					echo " ";
					echo "<br/>";
				}

			} else{
			//näytetään tyhjää, mikälie ei haun avulla ole valittu drinkkiä
				include("display.php");
				if (isset($_GET['cocktailid'])){
				//jos ollaan jonkin drinkin tiedoissa, näytetään sen kommentit
					include("comment.php");
				}
			}
	?>
</html>