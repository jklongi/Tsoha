<?php
	//Kirjaudutaan ulos poistamalla session muttuujat
	session_unset(); 
    session_destroy();
    header("location: /index.php");
?>