<?php
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=handicap', 'root', '');
    $message = "Pas membre? <a href=index.php>S'inscrire</a>";

    if(isset($_POST['formconnexion']))
    {
            $mailconnect = htmlspecialchars($_POST['mailconnect']);
            $mdpconnect = sha1($_POST['mdpconnect']);

            if(!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect']))
            {
                $requser = $bdd->prepare("SELECT * FROM membre WHERE mail = ? AND mdp = ?");
                $requser->execute(array($mailconnect, $mdpconnect));
                $userexist = $requser->rowCount();
                if($userexist == 1)
                {
                    $userinfo = $requser->fetch();
                    $_SESSION['id'] = $userinfo['id'];
                    $_SESSION['Nom'] = $userinfo['Nom'];
                    $_SESSION['Prenom'] = $userinfo['Prenom'];
                    $_SESSION['mail'] = $userinfo['mail'];
                    $_SESSION['tel'] = $userinfo['tel'];
                    header("Location: profil.php?id=".$_SESSION['id']);
                }

                else
                {
                    $message = "Mail ou mot de passe incorrect !<br> <br>Pas membre? <a href=index.php>S'inscrire</a>";
                }
            }

            else
            {
                $message = "Tous les champs doivent être complétés !<br> <br>Pas membre? <a href=index.php>S'inscrire</a>";
            }
    }
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <title>Aide mobilité - Connexion</title>
    </head>

    <body>
        <form method="POST" action="">
            <div class="container">
                <h2>Connexion</h2>
                <input type="email" placeholder="Votre mail" id="mailconnect" name="mailconnect"  value="<?php if(isset($mailconnect)){echo $mailconnect;}?>"> <br>
                <input type="password" placeholder="Votre mot de passe" id="mdpconnect" name="mdpconnect"><br>
                <button name="formconnexion" id="formconnexion">Se conneter</button><br><br>
                <?php
                    if(isset($message))
                    {
                        echo '<font color="white">'.$message."</font>";
                    }
                ?>
            </div>
        </form>
    </body>
</html>