<?php
	require "init_bdd.php";

	$mail = $_POST['mail'];
	/*$motdepasse = $_POST['motdepasse'];*/
	$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

	$sql = "SELECT * FROM `membre` WHERE `mail`='$mail' and `mpd`='$mdp' ";

	$resultat = mysqli_query($connexion, $sql);

	if(!mysqli_num_rows($resultat)>0)
	{
		echo "<br>Erreur de connexion au compte utilisateur";
	}

	else
	{
		echo "<br>Connecté avec succés au compte utilisateur";
	}

	echo "<br><a href='site_connexion.html'>Retour à la page de connexion</a>";
	mysqli_close($connexion);
?>