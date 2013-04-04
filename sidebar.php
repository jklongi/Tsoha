<?php

session_start();

//kirjautuneet
if(isset($_SESSION['kayttaja'])) {

	echo "<br/> ";
	echo "<a href=\"/index.php\">Etusivu</a>" . "<br/>";
    echo "<a href=\"/index.php?page=logout\">Kirjaudu ulos</a>";
}

//kirjautumattomat

else {  //Näkyy kirjautumattomille käyttäjille
	echo "<br/> ";
	echo "<a href=\"/index.php\">Etusivu</a>" . "<br/>";
    echo "<a href=\"/index.php?page=login\">Kirjaudu </a>" . "<br/>";
	echo "<a href=\"/index.php?page=register\">Rekisteröidy</a>";
}

//ylläpito
if(isset($_SESSION['admin'])== 1) {
    echo "olet admin!";
}
    
    
?>
