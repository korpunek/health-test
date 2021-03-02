<?php

$_SESSION["numer"] = "";
$_SESSION["nazwa"] = "";			

// usuwanie wszystkich zmiennych z $_SESSION
$_SESSION = array();

// unset($_SESSION['nazwa_zmiennej']);

session_destroy();

header("Location: index.html");
		
?>