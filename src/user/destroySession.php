<?php
    session_start();
    require_once("../config/bdd.php");
    $connexion = null;
    session_destroy();
    echo "<hr/> Déconnexion réussie<br/>";
    echo "<p> Vous allez être redirigé vers la page d'accueil";
    header("Location: /website/");
?>