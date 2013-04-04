<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Joonaksen Drinkkiarkisto</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
	<body>
		<div id="paasisalto">
			<div id="otsikko"> Drinkkiarkisto </div>
			<div id="sisalto">
				<div id="sivupalkki">
				<?php
				include 'sidebar.php'

				?>
				</div>
				
				<div id="main">
				<?php

					if (isset($_GET['page'])) {
						if ($_GET['page'] === "login")
							include 'login.php';
						if ($_GET['page'] === "logout")
							include 'logout.php';
						if ($_GET['page'] === "register")
							include 'register.php';							
					}
					else {
						echo "<h4><p>Tervetuloa Joonaksen drinkkiarkistoon!</p></h4>";
						include 'cocktails.php';
					}

				?>
				</div>  
			</div>
		</div>
	</body>
</html>