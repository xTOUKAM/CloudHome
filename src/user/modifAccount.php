<?php
    session_start();

    require("../config/language.php");
    require_once("../config/bdd.php");
        
    if (isset($_GET["mail"]) && !empty($_GET["mail"])) {
        $mail = $_GET["mail"];
        $requete = "SELECT * FROM compte WHERE com_mail = '$mail'";
        $resultat = $bdd->query($requete);
        $ligne = $resultat->fetch(PDO::FETCH_ASSOC);

        if (!empty($ligne)) {
            $prenom = $ligne["com_prenom"];
            $nom = $ligne["com_nom"];
            $mail = $ligne["com_mail"];
            $password = $ligne["com_mdp"];
        } else {
            unset($mail);
        }
    }

    if (isset($_POST["com_prenom"])) {
        if (empty($_POST["com_prenom"])) {
            $prenom_message = "Ce champ doit être complété.";
        } elseif (!preg_match("/^[[:alpha:]ÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇàâäéèêëïîôöùûüÿç\-\s]+$/i", $_POST["com_prenom"])) {
            $prenom_message = "Ce champ doit contenir uniquement des lettres.";
        } else {
            $prenom = htmlspecialchars($_POST["com_prenom"]);
        }
    }
    if (isset($_POST["com_nom"])) {
        if (empty($_POST["com_nom"])) {
            $nom_message = "Ce champ doit être complété.";
        } elseif (!preg_match("/^[[:alpha:]ÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇàâäéèêëïîôöùûüÿç\-\s]+$/i", $_POST["com_nom"])) {
            $nom_message = "Ce champ doit contenir uniquement des lettres.";
        } else {
            $nom = htmlspecialchars($_POST["com_nom"]);
        }
    }
    if (isset($_POST["com_mail"])) {
        if (empty($_POST["com_mail"])) {
            $mail_message = "Ce champ doit être complété.";
        } elseif (!preg_match("/^[a-zA-Z.]+@[a-zA-Z]+\.[a-zA-Z]+$/i", $_POST["com_mail"])) {
            $mail_message = "Entrez une adresse e-mail valide. Exemple : \"toto@mail.com\"";
        } else {
            $mail = htmlspecialchars(strtolower($_POST["com_mail"]));
        }
    }

    if (isset($_POST["com_mdp"])) {
        if (empty($_POST["com_mdp"])) {
            $motDePasse_message = "Ce champs doit être complété.";
        } else {
            $motDePasse = $_POST["com_mdp"];
        }
    }

    if (isset($_POST["com_mdp2"])) {
        if (empty($_POST["com_mdp2"])) {
            $motDePasseVerif_message = "Ce champs doit être complété.";
        } elseif ($_POST["com_mdp2"] != $_POST["com_mdp"]) {
            $motDePasseVerif_message = "Les mots de passe doivent correspondre.";
        }
    }


    if (isset($prenom) && isset($nom) && isset($mail) && isset($password)) {
        $requete = "UPDATE compte SET com_nom = '$nom', com_prenom = '$prenom', com_mail = '$mail', com_mdp = '$password' WHERE com_mail = '$mail'";
        $bdd->exec($requete);
    }

    if (isset($_SESSION['com_mail']) && $_SESSION['com_mail'] != $mail) {
        header("Location: ../user/login.php");
    }
?>

<?php if (isset($mail) == $_SESSION['com_mail']) : ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/inc.css">
        <title><?php echo getTranslation("Modifier compte") ?></title>
    </head>
    <body>
        <?php require("../includes/header.php"); ?>
        <div class="container">
            <div class="form-container sign-in-container">
                <form method="POST" action="">
                    <h1><?php echo getTranslation("Modifier mon compte") ?></h1>
                    <input class="inp-form" type="text" id="com_prenom" name="com_prenom" placeholder="<?php echo getTranslation("Prénom") ?>" value="<?php echo $prenom; ?>" />
                    <input class="inp-form" type="text" id="com_nom" name="com_nom" placeholder="<?php echo getTranslation("Nom") ?>" value="<?php echo $nom; ?>" />
                    <input class="inp-form" type="password" id="com_mdp" name="com_mdp" placeholder="<?php echo getTranslation("Mot de passe") ?>"/>
                    <input class="inp-form" type="password" id="com_mdp2" name="com_mdp2" placeholder="<?php echo getTranslation("Confirmation du mot de passe") ?>"/>
                    <?php 
                        if (isset($prenom_message)) {
                            echo "<p class='error-message'>$prenom_message</p>";
                        }
                        if (isset($nom_message)) {
                            echo "<p class='error-message'>$nom_message</p>";
                        }
                        if (isset($mail_message)) {
                            echo "<p class='error-message'>$mail_message</p>";
                        }
                        if (isset($motDePasse_message)) {
                            echo "<p class='error-message'>$motDePasse_message</p>";
                        }
                        if (isset($motDePasseVerif_message)) {
                            echo "<p class='error-message'>$motDePasseVerif_message</p>";
                        }
                    ?>
                    <button type="submit" class="btn-form"><?php echo getTranslation("Modifier") ?></button>
                </form>
            </div>
        </div>
        <footer>
            <?php require("../includes/footer.php"); ?>
        </footer>
    </body>
    </html>
<?php else : ?>
    <p>Erreur : aucun compte sélectionné.</p>
<?php endif; ?>
