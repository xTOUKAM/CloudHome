<?php
    session_start();
    require_once("../config/bdd.php");
    $connexion = null;
    session_destroy();
    header("Location: /");
?>