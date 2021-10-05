<?php

	$host = "localhost";
	$user = "root";
	$password = "";
	$db_name = "handicap";

	$connexion = mysqli_connect($host, $user, $password, $db_name);

	if($connexion)
	{
		echo "Connexion a la base de donnée réussi";
	}

	else
	{
		echo "Connexion a la base de donnée échoué";
	}
?>