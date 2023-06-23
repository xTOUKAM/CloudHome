<?php
    // On démarre la session
    session_start();

    // On vérifie si l'utilisateur est connecté
    if(!isset($_SESSION["com_nom"])){
        // Si non, on le redirige vers la page de connexion
        header("Location: ../user/login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/inc.css">
        <link rel="stylesheet" href="../assets/css/upload.css">
        <title>Envoyer des fichiers</title>
    </head>
    <body>
        <?php 
            // On inclut le header du site
            require("../includes/header.php");
        ?>

        <div style ="display: none;"class="popup-container" id="popupContainer">
        <div class="popup">
            <p id="popupMessage">Message de la popup</p>
            <button id="closeButton" type="button">Fermer</button>
        </div>
        </div>

        <div class="drag-area" ondrop="upload_file(e)" ondragover="return false">
            <div class="icon"><i class="lni lni-cloud-upload"></i></div>
            <header>Glissez et déposez pour télécharger le fichier</header>
            <span>OU</span>
            <button>Parcourir</button>
            <input type="file" name="file" id="file" multiple hidden>
        </div>

        <footer>
            <?php 
                // On inclut le footer du site
                require("../includes/footer.php");
            ?>
        </footer>

        <script src="../assets/js/upload-script.js"></script>
    </body>
</html>