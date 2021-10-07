<?php
	session_start();
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=handicap', 'root', '');

	if(isset($_GET['id']) AND $_GET['id'] > 0 )
	{
		$getid = intval($_GET['id']);
		$requser = $bdd->prepare('SELECT * FROM membre WHERE id = ?');
		$requser->execute(array($getid));
		$userinfo = $requser->fetch();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<title>Aide mobilité - Profil</title>
	</head>
	<body>

		<div class="container">
                <h2>Bienvenue <?php echo $userinfo['Nom']." ".$userinfo['Prenom'];?> </h2> <br>
                <input type="email" disabled value="<?php echo $userinfo['mail'];?>"> <br>
                <input type="tel" disabled value="<?php echo $userinfo['tel'];?>"> <br>
                <?php
					if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
					{
				?>
					<button  id="logoutbutton">Se déconnecter</button>

					<script type="text/javascript"> document.getElementById("logoutbutton").onclick = function ()
				    	{
				    		location.href = "site_connexion.php";
				    	};
					</script>
				<?php	
					}
				?>
		</div>
	</body>
</html>
<?php
}
?>