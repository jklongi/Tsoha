<!DOCTYPE html>
<html>
	<?php
	if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) { 
	
		include("database.php");
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
		?>
		<body>
			<h1>Lisää raaka-aine</h1>
			<form action ="index.php?page=addingredient" method = "post" >
				<label>Nimi</label><br /><input type="text" name = "nimi" /><br />
				<label>Alkoholiprosenti</label><br /><input type="text" name = "alkoholi"/><br />
				<label>Yksikkö</label><br /><input type="text" name = "yksikko"/><br />
				<label></label><input type="submit" value="Lisää" />
			</form>	
		</body>
	<?php
	}
	?>
</html>