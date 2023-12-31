<?php
    // On démarre la session
    session_start();

    // Vérification de la connexion de l'utilisateur
    if(!isset($_SESSION["com_mail"])) {
        header("Location: ../index.php");
    }

    // On inclut les fichiers de traduction
    require("../config/language.php");

    // On inclut le fichier de connexion à la base de données
    require_once("../config/bdd.php");

    // On initialise la variable email
    $email = $_SESSION["com_mail"];
    
    try {
        // Configuration des options de PDO
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer les informations du compte client
        $sql = "SELECT * FROM compte WHERE com_mail = '$email'";

        // Exécution de la requête SQL
        $resultat = $bdd->query($sql);

        // Récupération des données du compte client
        $ligne = $resultat->fetch();

        // Fermeture du curseur
        $resultat->closeCursor();

        // Récupération des informations du compte client
        $id = $ligne["com_id"];
        $nom = $ligne["com_nom"];
        $prenom = $ligne["com_prenom"];
        $email = $ligne["com_mail"];
        $password = $ligne["com_mdp"];
        $com_admin = $ligne["com_admin"];

        // On vérifie si l'utilisateur est un administrateur
        if($com_admin == 1) {
            $com_admin_message = getTranslation("Administrateur");
        } else {
            $com_admin_message = getTranslation("Utilisateur");
        }
        ?>

        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel=stylesheet href="../assets/css/inc.css">
                <title>Mon compte</title>
            </head>
            <body>
                <?php
                    require("../includes/header.php");
                ?>

                <div class="info-first">
                    <h1><?php echo getTranslation("Informations du compte") ?></h1>
                    <p><strong><?php echo getTranslation("Nom") ?> :</strong> <?php echo $nom; ?></p>
                    <p><strong><?php echo getTranslation("Prénom") ?> :</strong> <?php echo $prenom; ?></p>
                    <p><strong><?php echo getTranslation("Mail") ?> :</strong> <?php echo $email; ?></p>
                    <p><strong><?php echo getTranslation("Type d'utilisateur") ?> :</strong> <?php echo $com_admin_message; ?></p>
                    <button class="btn-form" type="button"><a href="./modifAccount.php?mail=<?php echo $email ?>"><?php echo getTranslation("Modifier les informations du compte") ?></a></button>
                    <!-- Bouton pour détruire la session -->
                    <button class="btn-form" type="button"><a href="./destroySession.php"><?php echo getTranslation("Se déconnecter") ?></a></button>
                </div>
                <footer>
                    <?php
                        require("../includes/footer.php");
                    ?>
                </footer>
            </body>
        </html>

        <?php
    } catch (PDOException $e) {
        die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
?>