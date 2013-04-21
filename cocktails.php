<!DOCTYPE html>
<html>
	<br />
	<?php
	include("database.php");
		echo "Hae drinkkejä hakusanoilla tai tyypin mukaan.";
	?>
	<body>
		<form action ="index.php?=pagecocktails.php" method = "post" >
			<input type="search" name = "sanahaku" />
			<input type="submit" name="submit" value="Hae" /> <br/ >
			<label>Drinkki</label><input type="checkbox" value="Yes" name = "drinkki" />
			<label>Shotti</label><input type="checkbox" value="Yes" name = "shotti"/>
			<label>Alkoholiton</label><input type="checkbox" value="Yes" name = "alkoholiton" /
			<label>Kuuma juoma</label><input type="checkbox" value="Yes" name = "kuuma" />
		</form>
	</body>
	<br/>
	<?php
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

				if(is_null($drink) && is_null($shotti)&& is_null($alkoholiton) && is_null($kuuma)){
					$tulokset = mysqli_query($connection ,"
						SELECT 	*
						FROM 	drinkki
						WHERE drinkkinimi LIKE '%$hakusana%'
						ORDER BY drinkkinimi ASC
					"
					) ;
				} else {
					$tulokset = mysqli_query($connection ,"
						SELECT 	*
						FROM 	drinkki
						WHERE drinkkinimi LIKE '%$hakusana%'
						AND tyyppi = '$shotti' OR tyyppi = '$alkoholiton'
						OR tyyppi = '$kuuma' OR tyyppi = '$drink'
						ORDER BY drinkkinimi ASC
					"
					) or die('Kysely ei onnistunut');
				}
				$maara = mysqli_num_rows($tulokset);
				
				echo "Hakuehdoilla löytyi $maara tulosta: <br/><br/>";
				
				while ($rivi = mysqli_fetch_assoc($tulokset)) {
					$linkinnimi = $rivi["drinkkinimi"];
					$linkID = $rivi["drinkkiID"];
					echo "<a href=\"index.php?cocktailid=".$linkID."\">$linkinnimi</a>";
					echo " ";
					echo $rivi["tyyppi"];
					echo " ";
					if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) {
						echo "<a href=\"index.php?delid=".$linkID."\">Poista</a>";
					}
					echo "<br/>";
				}

			} else{
				
				include("display.php");
				if (isset($_GET['cocktailid'])){
					include("comment.php");
				}
			}
	?>
</html>