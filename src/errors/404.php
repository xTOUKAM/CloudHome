<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel=stylesheet href="../assets/css/inc.css">
        <title>Erreur 404 !</title>
    </head>
    <body>
        <?php
            require("../includes/header.php");
        ?>
        <div class="info-first">
        <?php 
            if(isset($_SESSION['com_mail'])) {
                echo("<h2>La page demandée est invalide " . $_SESSION['com_prenom'] . "</h2>");
            } else {
                echo("<h2>La page demandée est invalide visiteur</h2>");
            }
            $redirectUrl = "http://$_SERVER[HTTP_HOST]/website/";
            echo "<p>Redirection vers la page d'accueil</p>";
			echo "<button class=\"btn-form\" onclick=\"window.location.href='$redirectUrl'\">Page d'accueil</button>";
        ?>
    </div>

    <footer>
        <?php
            require("../includes/footer.php")
        ?>
    </body>
</html>