<?php
    // Connexion à la base de données
    require_once("../config/bdd.php");

    // On vérifie que le compte est un administrateur
    require_once("./verifAdmin.php");

    // préparation de la requête
    $mail = $_GET['mail'];

    $sql = "SELECT com_actif FROM compte WHERE com_mail = :mail";
    $requete = $bdd->prepare($sql);

    // Exécution de la requête
    $requete->execute(array(':mail' => $mail));
    $resultat = $requete->fetch();

    // Si le compte est actif, on le désactive
    if ($resultat['com_actif'] == 0) {
        $sql = "UPDATE compte SET com_actif = 1 WHERE com_mail = :mail";
        $requete = $bdd->prepare($sql);
        $requete->execute(array(':mail' => $mail));
        echo "<hr/> Désactivation réussie<br/>";
        echo "<p> Vous allez être redirigé vers la page d'accueil";
        echo "<meta http-equiv='refresh' content='3; URL=/website/src/admin/'>";
    } else {
        // Si le compte est désactivé, on l'active
        $sql = "UPDATE compte SET com_actif = 0 WHERE com_mail = :mail";
        $requete = $bdd->prepare($sql);
        $requete->execute(array(':mail' => $mail));
        echo "<hr/> Activation réussie<br/>";
        echo "<p> Vous allez être redirigé vers la page d'accueil";
        echo "<meta http-equiv='refresh' content='3; URL=/website/src/admin/'>";
    }

    // Redirection vers la page d'accueil
    header("Location: /website/src/admin/");

?>