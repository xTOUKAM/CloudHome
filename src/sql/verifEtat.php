<?php

    // Connexion à la base de données
    require('../config/bdd.php');

    // On inclut le fichier de traduction
    require_once("../config/language.php");

    // Préparation de la requête
    $req = $bdd->prepare('SELECT * FROM compte WHERE com_mail = :mail');
    
    // Récupération des données du formulaire
    $com_mail = $_POST["email"] ?? "";

    // Exécution de la requête
    $req->execute(array(
        'mail' => $com_mail
    ));

    // Récupération des données de la requête
    $resultat = $req->fetch() ?? [];

    // On vérifie que l'utilisateur est actif ou inactif avec un système de booléen si c'est 1 c'est inactif on ne le connecte pas et si c'est 0 c'est actif 
    if(isset($resultat['com_actif']) && $resultat['com_actif'] == 1) {
        $compte = getTranslation("Votre compte a été désactivé par un administrateur"); ?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel=stylesheet href="../assets/css/inc.css">
                <title><?php echo getTranslation("Compte inactif"); ?></title>
            </head>
            <body>
                <?php
                    require("../includes/header.php");
                ?>
                <div class="info-first" style="align-items: center">
                    <h1 style='color: red'><?php echo getTranslation("Erreur de connexion"); ?></h1>
                    <p><?php echo $compte ?></p>
                    <a class="btn-form" href='/'><?php echo getTranslation("Retour à la page d'accueil"); ?></a>
                </div>
                <footer>
                    <?php
                        require("../includes/footer.php");
                    ?>
                </footer>
            </body>
        </html>

        <?php exit();
    }
?>
