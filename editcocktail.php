<!DOCTYPE html>
<html>
	<?php
		if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) { 
		include("database.php");
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$ainesID = $_POST['ainekset'];
				$maara= $_POST['maara'];
				$id = $_GET['id'];	
				
				
				$insert = mysqli_query($connection, "
						INSERT INTO raaka_ainekset
						(drinkkiID, ainesID, maara)
						VALUES 
						('$id', '$ainesID', '$maara');
						") or die ('Lisäys ei onnistunut, samaa raaka-ainetta ei voi laittaa uudelleen');

				echo "Lisäys onnistui!<br />";
				header("location: /index.php?page=editcocktail&id=".$id."");

			}
	
			if (isset($_GET['id'])){
				echo "<br /><br />";
				$id = $_GET['id'];
				$perustiedot = mysqli_query($connection ,"
						SELECT 	*
						FROM 	drinkki
						WHERE drinkkiID = $id
					"
				) or die('Perustiedot Kysely ei onnistunut');
				
				$rivi = mysqli_fetch_row($perustiedot);
				$maara = mysqli_num_rows($perustiedot);
					
				echo "Nimi: $rivi[1] <br/>Tyyppi: $rivi[2]<br/>Lasi: $rivi[3] <br/>Lisaaja: $rivi[4]<br/>";
					
				$ainekset = mysqli_query($connection ,"
						
					SELECT 	*
					FROM 	raaka_ainekset
					WHERE drinkkiID = $id		
				"
				) or die('Ainekset Kysely ei onnistunut');

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
					$ohjeet = $aineet["yksikko"];
					echo "$ainesnimi $maara $yksikko";
					echo ", ";
				}
				echo "<br/> ";
				echo "<br/> ";
				echo "$rivi[5] ";
				echo "<br/> ";
				echo "<br/> ";
				
			}
	}		
	?>
	<body>
			<form action ="" method = "post">
			<p>
					Raaka-aineet: <br />
					<select name="ainekset">
						<?php
							include("database.php");
							$ainekset = mysqli_query($connection ,"
								
								SELECT 	*
								FROM 	ainekset
								ORDER BY nimi
							"
							) or die('Form Kysely ei onnistunut');
							$ainesArray = array();
							while ($aine= mysqli_fetch_array($ainekset)) {
								$ainesID = $aine['ainesID'];
								$ainesArray[] = $row['nimi'];   
								$aines = $aine["nimi"];
								$yksikko = $aine["yksikko"];
								?>
								<option value="<?php echo "$ainesID" ?>"><?php echo "$aines $yksikko" ?></option>
								<?php
								
								
							}

						?>
						<input type="text" name = "maara" placeholder="Määrä"/>
					</select>
				</p>
				<?php
				echo "Etkö löytänyt raaka-ainetta? ";
				echo "<a href=\"/index.php?page=allingredients\">Lisää uusi raaka-aine</a><br/>";
				?>
		
			

				<label></label><input type="submit" value="Lisää Raaka-aine" />
	
			</form>
	</body>
</html>