<!DOCTYPE html>
<html>
	<?php
	include("database.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$tunnus1 = $_POST['tunnus'];
			$salasana1 = $_POST['salasana'];
			$vsalasana1 = $_POST['vsalasana'];
			$email1 = $_POST['email'];
			if($salasana1 == $vsalasana1){
				$tunnus = mysql_real_escape_string($_POST['tunnus']);
				$salasana = mysql_real_escape_string($_POST['salasana']);
				$vsalasana = mysql_real_escape_string($_POST['vsalasana']);
				$email = mysql_real_escape_string($_POST['email']);
				
				if($tunnus == NULL){
					echo "Täytithän tähdellä merkityt kentät?";
					die();
				}
				if($salasana == NULL){
					echo "Täytithän tähdellä merkityt kentät?";
					die();
				}
				
				$insert = mysqli_query($connection, "
					INSERT INTO kayttajat
					(kayttaja, salasana, email, admin)
					VALUES 
					('$tunnus', '$salasana', '$email', '0');
					") or die ('Lisäys ei onnistunut');

					echo "Rekisteröityminen onnistui!<br />";
					echo "Voit nyt kirjautua sisään.";
					
					
			} else {
				echo "Salasanat eivät täsmää!";
			}
		}
	?>
	<body>
		<h1>Rekisteröidy:</h1>
		<h5>Täytä ainakin tähdellä merkityt kentät</h5>
		<form action ="index.php?page=register" method = "post" >
			<label>Tunnus*</label><input type="text" name = "tunnus" /><br />
			<label>Email</label><input type="text" name = "email"/><br />
			<label>Salasana*</label><input type="password" name = "salasana"/><br />
			<label>Vahvista Salasana*</label><input type="password" name = "vsalasana"/><br />
			<label></label><input type="submit" value="Rekisteröidy" />
		</form>
	</body>
</html>