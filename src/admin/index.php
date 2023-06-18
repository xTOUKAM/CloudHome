<?php
    // Connexion à la base de données
    require('../config/bdd.php');

    // On vérifie que l'utilisateur est bien un administrateur
    require('../sql/verifAdmin.php');

    // On récupère les informations de l'utilisateur
    $mail = $_SESSION['com_mail'];
    $req = $bdd->prepare('SELECT * FROM compte WHERE com_mail = :mail');

    $req->execute(array(
        'mail' => $mail
    ));

    $resultat = $req->fetch();

?>

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel=stylesheet href="../assets/css/inc.css">
        <title>Administrateur | Panel</title>
    </head>
    <body>
        <?php include('../includes/header.php'); ?>

        <div class="info-first">
            <h1>Panel Administrateur</h1>
            <p>Bonjour <?= $resultat['com_prenom'] ?> <?= $resultat['com_nom'] ?></p>
            <p>Vous êtes connecté en tant qu'administrateur</p>
            <a class="btn-form" href="/website/src/user/destroySession.php">Déconnexion</a>
        </div>
    </body>

    <footer>
        <?php include('../includes/footer.php'); ?>
    </footer>
</html>