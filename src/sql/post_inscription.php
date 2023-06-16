<?php
    // On inclut le fichier de connexion à la base de données
    require_once("../config/bdd.php");

    // On initialise les variables
    $prenom = "";
    $nom = "";
    $email = "";
    $password = "";

    if(isset($_POST["prenom"]) && !empty($_POST["prenom"]) && isset($_POST["nom"]) && !empty($_POST["nom"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"])) {
        $prenom = htmlspecialchars($_POST["prenom"]);
        $nom = htmlspecialchars($_POST["nom"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        echo "<PRE>";
        echo $prenom . "<br>" . $nom . "<br>" . $email . "<br>" . $password . "<br>";
        echo "</PRE>";

        // On vérifie si l'utilisateur existe dans la base de données
        $check = $bdd->prepare("SELECT com_nom, com_prenom, com_mail, com_mdp FROM compte WHERE com_mail = ?");
        $check->execute([$email]);
        $data = $check->fetch();
        $row = $check->rowCount();

        // Si la requête renvoie un 0 alors l'utilisateur n'existe pas dans la base de données
        if($row == 0){ 
            $stm = $bdd->prepare("INSERT INTO compte(com_nom, com_prenom, com_mail, com_mdp) VALUES (?, ?, ?, ?)");
            $stm->execute([$prenom, $nom, $email, $password]);
            header("Location: ../index.php?reg_err=success");
            die();
        } else {
            header("Location: ../index.php?reg_err=email");
            die();
        }
    }