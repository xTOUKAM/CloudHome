<?php
    // On inclut le fichier de connexion à la base de données
    require_once("../config/bdd.php");

    // On inclut le fichier de langue
    require_once("../config/language.php");

    // On initialise les variables
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $admin = 0;

    // On vérifie que les variables ne sont pas vides
    if (isset($_POST["prenom"])) {
        if (empty($_POST["prenom"])) {
            $prenom_message = "Ce champs doit être complété.";
        } elseif (!preg_match("/^[[:alpha:]ÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇàâäéèêëïîôöùûüÿç\-\s]+$/i", $_POST["prenom"])) {
            $prenom_message = "Ce champs doit contenir que des lettres.";
        } else {
            $prenom = htmlspecialchars($_POST["prenom"]);
        }
    }

    if (isset($_POST["nom"])) {
        if (empty($_POST["nom"])) {
            $nom_message = "Ce champs doit être complété.";
        } elseif (!preg_match("/^[[:alpha:]ÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇàâäéèêëïîôöùûüÿç\-\s]+$/i", $_POST["nom"])) {
            $nom_message = "Ce champs doit contenir que des lettres.";
        }
        $nom = htmlspecialchars($_POST["nom"]);
    }

    if (isset($_POST["email"])) {
        if (empty($_POST["email"])) {
            $mail_message = "Ce champs doit être complété.";
        } elseif (!preg_match("/^[a-zA-Z.]+@[a-zA-Z]+\.[a-zA-Z]+$/i", $_POST["email"])) {
            $mail_message = "Entrez une adresse mail valide. Exemple : \"exemple.test@gmail.com\"";
        } else {
            $mail = htmlspecialchars(strtolower($_POST["email"]));
        }
    }

    if (isset($_POST["password"])) {
        if (empty($_POST["password"])) {
            $motDePasse_message = "Ce champs doit être complété.";
        } else {
            $motDePasse = sha1(htmlspecialchars($_POST["password"]));
        }
    }

    if (isset($_POST["confirm_password"])) {
        if (empty($_POST["confirm_password"])) {
            $motDePasseVerif_message = "Ce champs doit être complété.";
        } elseif ($_POST["confirm_password"] != $_POST["password"]) {
            $motDePasseVerif_message = "Les mots de passe doivent correspondre.";
        }
    }

    // On fait un système de vérification pour vérifier que l'utilisateur n'existe pas déjà
    function verifCompteExist($email) {
        global $bdd;
        $req = $bdd->prepare("SELECT * FROM compte WHERE com_mail = :email");
        $req->execute(array(
            "email" => $email
        ));
        $result = $req->fetch();
        return $result;
    }

    if (verifCompteExist($email)) {
        $email_message = "Ce compte existe déjà.";
    }

    // On vérifie que les variables ne sont pas vides
    if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($password) && !empty($confirm_password)) {
        // On prépare la requête
        $req = $bdd->prepare("INSERT INTO compte (com_prenom, com_nom, com_mail, com_mdp, com_admin) VALUES (:prenom, :nom, :email, :password, :admin)");

        // On exécute la requête
        $req->execute(array(
            "prenom" => $prenom,
            "nom" => $nom,
            "email" => $email,
            "password" => sha1($password),
            "admin" => $admin
        ));

        // On créé une variable de session
        session_start();
        $_SESSION["email"] = $email;

        // On redirige l'utilisateur vers la page de connexion
        header("Location: ../user/login.php");
        
    } else {
        echo getTranslation("Les variables ne sont pas renseignées !");
    }
?>