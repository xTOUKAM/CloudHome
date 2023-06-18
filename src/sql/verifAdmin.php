<?php
    session_start();

    $mail = $_SESSION['com_mail'];

    // Connexion à la base de données
    require('../config/bdd.php');
    
    // Préparation de la requête
    $req = $bdd->prepare('SELECT * FROM compte WHERE com_mail = :mail');
    $req->execute(array(
        'mail' => $mail
    ));
    $resultat = $req->fetch();

    // On vérifie que l'utilisateur est bien un administrateur
    if($resultat['com_admin'] == 0){
        header('Location: /website/');
    }
?>