<?php
    // On inclut le fichier de connexion à la base de données
    require_once("../config/bdd.php");

    // Requête SQL
    $sql = "SELECT com_mail, com_mdp, com_id FROM compte";

    // Préparation de la requête
    $stmt = $bdd->prepare($sql);

    // Récupération des données du formulaire
    $com_mail = $_POST["email"];
    $mdp = $_POST["password"];

    function verifCompte($com_mail, $mdp, $bdd) {
        // Requête SQL
        $sql = "SELECT * FROM compte WHERE com_mail = :com_mail AND com_mdp = :mdp";

        // Préparation de la requête
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':com_mail', $com_mail);
        $stmt->bindValue(':mdp', $mdp);
        $stmt->execute();

        foreach($stmt as $ligne) {
            echo($ligne["com_mail"]);

            // On démarre la session
            session_start();

            // On enregistre les paramètres de notre visiteur comme variables de session
            $_SESSION['com_admin'] = $ligne["com_admin"];
            $_SESSION['com_mail'] = $ligne["com_mail"];
            $_SESSION['com_mdp'] = $ligne["com_mdp"];
            $_SESSION['com_nom'] = $ligne["com_nom"];
            $_SESSION['com_prenom'] = $ligne["com_prenom"];
            $_SESSION['com_id'] = $ligne["com_id"];

            // On redirige notre visiteur vers une page de notre section membre
            header('Location: /website/index.php');
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

    <?php
        if($stmt->rowCount() == 0) {
            echo("<div class='info-first' style='align-items: center'>");
            echo("<h1 style='color: red'>Erreur de connexion</h1>");
            echo("<br>");
            echo("<a class=\"btn-form\" href='/website/src/user/login.php'>Retour à la page de connexion</a>");
            echo("</div>");
        }
    ?>
    
    <!-- Footer -->
    <footer>
        <?php
            require("../includes/footer.php");
        ?>
    </footer>
</body>
</html>