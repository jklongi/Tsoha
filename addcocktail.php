<!DOCTYPE html>
<html>
	<?php
	if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) { 
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){



		
		}
		?>
		<body>
			<script type="text/javascript">
			function add_field(){
				document.getElementById('text').innerHTML += "<select name='ainekset[]'/>";
				document.getElementById('text').innerHTML += "<input type='text' name='maara' />";
			}
			</script>
			<h1>Lisää drinkki</h1>
			
			<form action ="index.php?page=addcocktail" method = "post">
				<label>Nimi</label><input type="text" name = "nimi" />
				<p>
					Tyyppi 
					<select name="tyyppi">
						<option value="alkoholiton">Alkoholiton</option>
						<option value="booli">Booli</option>
						<option value="drinkki">Drinkki</option>
						<option value="kuuma">Kuuma juoma</option>
						<option value="shotti">Shotti</option>
					</select>
				</p>
				<p>
					Lasi 
					<select name="lasi">
					  <option value="aromilasi">Aromilasi</option>
					  <option value="boolimalja">Boolimalja</option>
					  <option value="collinslasi">Collinslasi</option>
					  <option value="highball">Highball-lasi</option>
					  <option value="hurricanelasi">Hurricanelasi</option>
					  <option value="Irishcoffee">Irish coffee -lasi</option>
					  <option value="likoorilasi">Liköörilasi</option>
					  <option value="kuohuviinilasi">Kuohuviinilasi</option>
					  <option value="margaritalasi">Margaritalasi</option>
					  <option value="martinilasi">Martinilasi</option>
					  <option value="oldfashioned">Old fashioned -lasi</option>
					  <option value="olutlasi">Olutlasi</option>
					  <option value="ontherocks">On the rocks -lasi</option>
					  <option value="shottilasi">Shottilasi</option>
					  <option value="Totilasi">Totilasi</option>
					  <option value="valkoviinilasi">Valkoviinilasi</option>
					  <option value="muu">Muu</option>
					</select>
				</p>
				<label>Ohjeet: </label><br/><TEXTAREA style="resize:none" ROWS = 3 COLS = 30 name = "ohjeet"></TEXTAREA><br />


				<p>
					Raaka-aineet: <br />
					<select name="ainekset[]">
						<?php
							include("database.php");
							$ainekset = mysqli_query($connection ,"
								
								SELECT 	*
								FROM 	ainekset
							"
							) or die('Kysely ei onnistunut');

							while ($aine= mysqli_fetch_array($ainekset)) {
								$aines = $aine["nimi"];
								$yksikko = $aine["yksikko"];
								?>
								<option value="aine[]"><?php echo "$aines $yksikko" ?></option>
								<?php
								
								
							}

						?>
						<input type="text" name = "maara" placeholder="Määrä"/>
					</select>
					<input type="button" name = "uusi" onClick="add_field()" value = "Lisää" />
					<div id = "text" >

					</div>
				</p>
				<?php
				echo "Etkö löytänyt raaka-ainetta? ";
				echo "<a href=\"/index.php?page=addingredient\">Lisää raaka-aine</a><br/>";
				?>
				
				<label></label><input type="submit" value="Lisää Drinkki" />
	
			</form>
		</body>
	<?php
	}
	?>
</html>