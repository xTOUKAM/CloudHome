<?php
    // Les différentes variables de connexion à la base de données PhPMyAdmin
    $host = "database";
    $dbname = "panel";
    $username = "root";
    $password = "dev";

    // Connexion à la base de données
    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
?>