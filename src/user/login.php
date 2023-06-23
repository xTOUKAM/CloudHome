<?php
    session_start();

    require("../config/language.php");

    // On vérifie si l'utilisateur est connecté
    $comMail = isset($_SESSION["com_mail"]) ? (string)$_SESSION["com_mail"] : "";

    if(!empty($comMail)) {
        header("Location: ../user/info.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel=stylesheet href="../assets/css/inc.css">
        <title><?php echo getTranslation("Se connecter") ?></title>
    </head>
    
    <body>
        <?php
            require("../includes/header.php");
        ?>
        <div class="container">
            <div class="form-container sign-in-container">
                <form method="POST" action="../sql/post_seconnecter.php">
                    <h1><?php echo getTranslation("Se connecter") ?></h1>
                    <input class="inp-form" type="email" id="email" name="email" placeholder="<?php echo getTranslation("Adresse mail") ?>" />
                    <input class="inp-form" type="password" id="password" name="password" placeholder="<?php echo getTranslation("Mot de passe") ?>" />
                    <button type="submit" class="btn-form"><?php echo getTranslation("Se connecter") ?></button>
                    <a class="a-form" href="../user/register.php"><?php echo getTranslation("Pas encore inscrit ?") ?></a>
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