<?php
	session_start();
	$_SESSION = array();
	session_destroy();
	header("Location: site_connexion.php");
?>