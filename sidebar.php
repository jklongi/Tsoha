<?php

session_start();

//kirjautuneet
if(isset($_SESSION['kayttaja'])) {

	echo "<br/> ";
	echo "<a href=\"/index.php\">Etusivu</a>" . "<br/>";
    echo "<a href=\"/index.php?page=logout\">Kirjaudu ulos</a>";

}

//kirjautumattomat
else {
	echo "<br/> ";
	echo "<a href=\"/index.php\">Etusivu</a>" . "<br/>";
    echo "<a href=\"/index.php?page=login\">Kirjaudu </a>" . "<br/>";
	echo "<a href=\"/index.php?page=register\">Rekisteröidy</a>" . "<br />";
}

//ylläpito
if(isset($_SESSION['admin']) && ($_SESSION['admin'])==1) { 
	echo "<br/> ";
	echo "<br/> ";
	echo "<a href=\"/index.php?page=addcocktail\">Lisää drinkki</a>" . "<br />";
	echo "<a href=\"/index.php?page=addingredient\">Lisää raaka-aine</a>" . "<br />";
	echo "<a href=\"/index.php?page=deleteingredient\">Poista raaka-aine</a>" . "<br />";
	echo "<a href=\"/index.php?page=users\">Kayttajat</a>";
}
    
    
?>
