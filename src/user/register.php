<?php 
    require("../config/language.php");
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel=stylesheet href="../assets/css/inc.css">
        <title><?php echo getTranslation("Enregistrement") ?></title>
    </head>
    
    <body>
        <?php
            require("../includes/header.php");
        ?>
        <div class="container">
            <div class="form-container sign-in-container">
                <form method="POST" action="../sql/post_inscription.php">
                    <h1><?php echo getTranslation("Créer un compte") ?></h1>
                    <input class="inp-form" type="text" id="prenom" name="prenom" placeholder="<?php echo getTranslation("Prénom") ?>" />
                    <input class="inp-form" type="text" id="nom" name="nom" placeholder="<?php echo getTranslation("Nom") ?>" />
                    <input class="inp-form" type="email" id="email" name="email" placeholder="<?php echo getTranslation("Adresse mail") ?>" />
                    <input class="inp-form" type="password" id="password" name="password" placeholder="<?php echo getTranslation("Mot de passe") ?>" />
                    <input class="inp-form" type="password" id="confirm_password" name="confirm_password" placeholder="<?php echo getTranslation("Confirmer le mot de passe") ?>" />
                    <button type="submit" class="btn-form"><?php echo getTranslation("Créer un compte") ?></button>
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