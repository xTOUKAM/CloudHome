<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel=stylesheet href="../assets/css/inc.css">
        <title>Se connecter</title>
    </head>
    
    <body>
        <?php
            require("../includes/header.php");
        ?>
        <!-- On vérifie si l'utilisateur est connecté -->
        <?php
            if(isset($_SESSION["com_mail"])) {
                header("Location: /website/src/user/info.php");
            }
        ?>
        <div class="container">
            <div class="form-container sign-in-container">
                <form method="POST" action="/website/src/sql/post_seconnecter.php">
                    <h1>Se connecter</h1>
                    <input class="inp-form" type="email" id="email" name="email" placeholder="Adresse mail" />
                    <input class="inp-form" type="password" id="password" name="password" placeholder="Mot de passe" />
                    <button type="submit" class="btn-form">Se connecter</button>
                    <a class="a-form" href="/website/src/user/register.php">Pas encore inscrit ?</a>
                </form>
            </div>
        </div>
        <footer>
            <?php
                require("../includes/footer.php");
            ?>
        </footer>
    </body>
</html>