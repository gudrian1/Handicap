<?php
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=handicap', 'root', '');
    $message = "Déja membre? <a href=\"site_connexion.php\">Se connecter</a>";

    if(isset($_POST['forminscription']))
    {
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $mail = htmlspecialchars($_POST['mail']);
            $motdepasse = sha1($_POST['motdepasse']);
            $tel = htmlspecialchars($_POST['tel']);

        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['motdepasse']) AND !empty($_POST['tel']))
        {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            {
                $reqmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                if($mailexist == 0)
                {
                    $insertmbr = $bdd->prepare("INSERT INTO membre(Nom, Prenom, mail, mdp, tel) VALUES(?, ?, ?, ?, ?)");
                    $insertmbr->execute(array($nom, $prenom, $mail, $motdepasse, $tel));
                    $message = "Votre compte à bien été créer ! Vous pouvez maintenant vous connecter <a href=site_connexion.php>ici</a>";
                }

                else
                {
                    $message = "Mail déja utilisée !";
                }
            }

            else
            {
                $message = "Votre adresse mail n'est pas valide !";
            }
        }

        else
        {
            $message = "Tous les champs doivent être complétés !";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
        <title>Aide mobilité - Inscription</title>
    </head>

    <body>
        <form method="post" action="">
            <div class="container">
                <h2>Inscription</h2>
                <h5>Veillez à bien mettre vos coordonnées :</h5>
                <input type="text" placeholder="Nom" id="nom" name="nom"  value="<?php if(isset($nom)){echo $nom;}?>"> <br>
                <input type="text" placeholder="Prenom" id="prenom" name="prenom" value="<?php if(isset($prenom)){echo $prenom;}?>">  <br>
                <input type="email" placeholder="Mail" id="mail" name="mail" value="<?php if(isset($mail)){echo $mail;}?>">
                <input type="password" placeholder="Mot de passe" id="motdepasse" name="motdepasse">
                <input type="tel" placeholder="Téléphone" name="tel" id="tel" Pattern="^[0-9]{10}" size="10" maxlength="10" value="<?php if(isset($tel)){echo $tel;}?>"> <br> <br>
                <button name="forminscription" id="forminscription">S'inscrire</button><br><br>
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