<!DOCTYPE html>
<html>
	<?php
	include("database.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$tunnus = array_map('mysql_real_escape_string', $_POST);
			$tunnus['salasana'] = ($tunnus['salasana']);
			//session_register($tunnus['kayttaja']);
			
		
			$kayttaja = $tunnus['kayttaja'];
			$salasana = $tunnus['salasana'];
			

			$query = mysqli_query($connection ,"
				SELECT 	*
				FROM 	kayttajat
				WHERE 	kayttaja = '$kayttaja'
				AND 	salasana = '$salasana'
			"
			) or die('Kysely ei onnistunut');
			
			$rivi = mysqli_fetch_row($query);
			$maara = mysqli_num_rows($query);
			
			if ($maara == 1) {
				session_start();
				$_SESSION['nimi'] = $rivi[1];	
				$_SESSION['kayttaja'] = $rivi[0];
				$_SESSION['admin'] = $rivi[4];
				header("location: /index.php");
			}
				
			else {
				echo "Väärä käyttäjätunnus tai salasana!";
			}
		}
	?>
	<body>
		<h1>Kirjaudu sisään:</h1>
		<form action ="index.php?page=login" method = "post" >
			<label>Tunnus</label><input type="text" name = "kayttaja" /><br />
			<label>Salasana</label><input type="password" name = "salasana"/><br />
			<label></label><input type="submit" value="Kirjaudu" />
		</form>
	</body>
</html>
