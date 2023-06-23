<?php
    // Connexion à la base de données
    require('../config/bdd.php');

    // On inclut le fichier de traduction
    require('../config/language.php');

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
        <title><?php echo getTranslation("Administrateur"); ?> | Panel</title>
    </head>
    <body>
        <?php include('../includes/header.php'); ?>

        <div class="info-first">
            <h1><?php echo getTranslation("Panel administrateur") ?></h1>
            <p><?php echo getTranslation("Bonjour") ?> <?= $resultat['com_prenom'] ?> <?= $resultat['com_nom'] ?></p>
            <p><?php echo getTranslation("Vous êtes connecté en tant qu'administrateur"); ?></p>
            <a class="btn-form" href="../admin/voirCompte.php"><?php echo getTranslation("Voir les comptes"); ?></a>
            <a class="btn-form" href="../user/destroySession.php"><?php echo getTranslation("Déconnexion"); ?></a>
        </div>
    </body>

    <footer>
        <?php include('../includes/footer.php'); ?>
    </footer>
</html>