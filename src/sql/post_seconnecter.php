<?php
    session_start();

    // On inclut le fichier de connexion à la base de données
    require_once("../config/bdd.php");

    // On vérifie l'état du compte de l'utilisateur
    require_once("./verifEtat.php");

    // Récupération des données du formulaire
    $com_mail = $_POST["email"] ?? "";
    $mdp = $_POST["password"] ?? "";

    // Déclaration de la variable $stmt en dehors de la fonction
    $stmt = null;

    function verifCompte($com_mail, $mdp, $bdd) {
        global $stmt; // Utilisation de la variable $stmt déclarée à l'extérieur de la fonction

        // Requête SQL
        $sql = "SELECT * FROM compte WHERE com_mail = :com_mail AND com_mdp = :mdp";

        // Préparation de la requête
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':com_mail', $com_mail);
        $stmt->bindValue(':mdp', sha1($mdp));
        $stmt->execute();

        if ($stmt !== false) { // Vérifie si la requête s'est exécutée avec succès
            if ($stmt->rowCount() > 0) {
                // Utilisateur trouvé, enregistrement des données de session
                foreach($stmt as $ligne) {

                    // On enregistre les paramètres de notre visiteur comme variables de session
                    $_SESSION['com_admin'] = $ligne["com_admin"];
                    $_SESSION['com_mail'] = $ligne["com_mail"];
                    $_SESSION['com_mdp'] = $ligne["com_mdp"];
                    $_SESSION['com_nom'] = $ligne["com_nom"];
                    $_SESSION['com_prenom'] = $ligne["com_prenom"];
                    $_SESSION['com_id'] = $ligne["com_id"];

                    // On redirige notre visiteur vers une page de notre section membre
                    header('Location: /');
                    exit(); // Terminer le script après la redirection
                }
            } else {
                // Aucun utilisateur trouvé, affichage de l'erreur
                echo("<div class='info-first' style='align-items: center'>");
                echo("<h1 style='color: red'>Erreur de connexion</h1>");
                echo("<br>");
                if ($com_mail == "" || $mdp == "") {
                    echo("<p>Veuillez remplir tous les champs</p>");
                } else {
                    echo("<p>Identifiant ou mot de passe incorrect</p>");
                }
                echo("<a class=\"btn-form\" href='../user/login.php'>Retour à la page de connexion</a>");
                echo("</div>");
            }
        } else {
            // Erreur lors de l'exécution de la requête
            // Afficher un message d'erreur ou effectuer une action appropriée
        }
    }

    verifCompte($com_mail, $mdp, $bdd);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="../assets/css/inc.css">
    <title>Erreur de connexion !</title>
</head>
<body>
    <!-- Header -->
    <?php
        require("../includes/header.php");
    ?>

    <!-- Footer -->
    <footer>
        <?php
            require("../includes/footer.php");
        ?>
    </footer>
</body>
</html>
