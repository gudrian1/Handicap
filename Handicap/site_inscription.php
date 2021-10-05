<?php
	require "init_bdd.php";

	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$mail = $_POST['mail'];
	$mdp = $_POST['motdepasse'];
	$mdp_hashed = password_hash($mdp, PASSWORD_DEFAULT);
	$tel = $_POST['tel'];

	$sql = "select * from membre where Prenom = '$prenom' ";

	$resultat = mysqli_query($connexion, $sql);
	if(mysqli_num_rows($resultat)>0)
	{
		echo "<br>Identifiant existant";
	}

	else
	{
		$sql = "INSERT INTO membre (Nom, Prenom, mail, mdp, tel) VALUES ('$nom','$prenom','$mail','$mdp_hashed','$tel')";
		if(mysqli_query($connexion, $sql))
		{
			echo "<br>Inscrit avec succès";
		}

		else
		{
			echo "<br>Erreur d'inscription";
		}
	}

	echo "<br><a href='index.html'>Retour à la page d'inscription</a>";
	echo "<br>";
	echo $mdp;
	echo "<br>";
	echo $mdp_hashed;
	mysqli_close($connexion);
?>