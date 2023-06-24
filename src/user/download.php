<?php
    // On démarre la session PHP
    session_start();

    // On vérifie que l'utilisateur est connecté
    if(!isset($_SESSION["com_mail"])) {
        header("Location: ../index.php");
    }

    // On récupère les informations du compte client
    $nom = $_SESSION["com_nom"];
    $prenom = $_SESSION["com_prenom"];
    $id = $_SESSION["com_id"];

    // On inclut les fichiers de traduction
    require("../config/language.php");

    // On inclut le fichier de connexion à la base de données
    require_once("../config/bdd.php");

    // On recherche si dans le dossier uploads il y a un dossier avec le nom de l'utilisateur, le prénom et l'id 
    $dossier = "../uploads/$nom-$prenom-$id";

    // On vérifie si le dossier existe
    function myDir($dossier) {
        if (file_exists($dossier)) {
            // On ouvre le dossier
            $ouverture = opendir($dossier);

            // On lit le contenu du dossier
            while ($fichier = readdir($ouverture)) {
                // On vérifie que le fichier n'est pas un dossier
                if ($fichier != "." && $fichier != "..") {
                    echo "<div class='image-container'>
                            <img class='small-image' src='$dossier/$fichier' alt='$fichier' onclick='openImage(\"$dossier/$fichier\")' />
                            <a class='download-button' href='$dossier/$fichier' download><i class='lni lni-download'></i></a>
                        </div>";
                }
            }

            // On ferme le dossier
            closedir($ouverture);
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/inc.css">
    <style>
        .folder-container {
            position: relative;
            display: inline-block;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .folder-icon {
            font-size: 40px;
        }

        .folder-name {
            font-weight: bold;
            text-align: center;
            margin-top: 5px;
        }

        .folder-container:hover .folder-icon {
            transform: scale(1.1);
        }

        .folder-container:hover .folder-name {
            margin-top: 0;
        }

        /* Styles for the popup */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-content {
            background-color: #fff;
            font-family: 'Montserrat', sans-serif;
            text-transform: uppercase;
            text
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .popup-content h2 {
            color: #444;
            text-align: center;
            margin-bottom: 20px;
            margin-top: 20px;
            margin-left: 50px;
            margin-right: 50px;
        }

        .image-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .small-image {
            width: 100px;
            height: 50px;
            object-fit: cover;
            margin-right: 30px;
            margin-left: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .download-button {
            display: block;
            text-align: center;
            margin-top: 5px;
            font-size: 18px;
            text-decoration: none;
            color: #000;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
            z-index: 1;
        }
    </style>
    <title><?php echo getTranslation("Mes documents"); ?></title>
    <script>
        function openPopup() {
            var popupOverlay = document.getElementById("popupOverlay");
            popupOverlay.style.display = "flex";
        }

        function closePopup() {
            var popupOverlay = document.getElementById("popupOverlay");
            popupOverlay.style.display = "none";
        }

        function openImage(imageUrl) {
            var popupOverlay = document.getElementById("popupOverlay");
            var popupContent = document.getElementById("popupContent");
            popupContent.innerHTML = "<img class='large-image' src='" + imageUrl + "' />";
            popupOverlay.style.display = "flex";
        }
    </script>
</head>
<body>
    <!-- On inclut le header -->
    <?php require_once("../includes/header.php"); ?>

    <!-- On affiche les images dans un container -->
    <div class="info-first">
        <h1><?php echo getTranslation("Voici vos fichiers !"); ?></h1>
        <div class="folder-container" onclick="openPopup();">
            <div class="folder-icon"><i class="lni lni-folder"></i></div>
        </div>
        <div class="folder-name"><?php echo getTranslation("Mes documents"); ?></div>
    </div>

    <!-- Popup -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-content" id="popupContent">
            <div class="popup-close" onclick="closePopup()"><i class="lni lni-close"></i></div>
            <h2><?php echo $nom . "-" . $prenom . "-" . $id; ?></h2>
            <?php myDir($dossier); ?>
        </div>
    </div>

    <footer>
        <!-- On inclut le footer -->
        <?php require_once("../includes/footer.php"); ?>
    </footer>
</body>
</html>
