<?php
    require_once("../config/bdd.php");
        
    if (isset($_GET["com_mail"])) {
        if (is_numeric($_GET["com_mail"])) {
            $mail = $_GET["com_mail"];
            $requete = "SELECT * FROM compte WHERE com_mail = $mail";
            $resultat = $connexion->query($requete);
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
    }

    if (isset($_POST["com_prenom"])) {
        if (empty($_POST["com_prenom"])) {
            $prenom_message = "Ce champs doit être complété.";
        } elseif (!preg_match("/^[[:alpha:]ÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇàâäéèêëïîôöùûüÿç\-\s]+$/i", $_POST["com_prenom"])) {
            $prenom_message = "Ce champs doit contenir que des lettres.";
        } else {
            $prenom = htmlspecialchars($_POST["com_prenom"]);
        }
    }
    if (isset($_POST["com_nom"])) {
        if (empty($_POST["com_nom"])) {
            $nom_message = "Ce champs doit être complété.";
        } elseif (!preg_match("/^[[:alpha:]ÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇàâäéèêëïîôöùûüÿç\-\s]+$/i", $_POST["com_nom"])) {
            $nom_message = "Ce champs doit contenir que des lettres.";
        }
        $nom = htmlspecialchars($_POST["com_nom"]);
    }
    if (isset($_POST["com_mail"])) {
        if (empty($_POST["com_mail"])) {
            $mail_message = "Ce champs doit être complété.";
        } elseif (!preg_match("/^[a-zA-Z.]+@[a-zA-Z]+\.[a-zA-Z]+$/i", $_POST["mail"])) {
            $mail_message = "Entrez une adresse mail valide. Exemple : \"toto@mail.com\"";
        } else {
            $mail = htmlspecialchars(strtolower($_POST["com_mail"]));
        }
    }

    if (isset($prenom) && isset($nom) && isset($mail) && isset($password)) {
        $requete = "UPDATE compte SET com_nom = '$nom', com_prenom = '$prenom', com_mail = '$mail', com_mdp = '$password'";
        $connexion->exec($requete);
        // Revenir à la page précédente
        header("Location: /website/");
    }
?>

<?php
    if (!isset($mail)) {
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel=stylesheet href="../assets/css/inc.css">
        <title>Modifier compte</title>
    </head>
    <body>
        <?php
            require("../includes/header.php");
        ?>
        <div class="container">
        </div>
            <div class="form-container sign-in-container">
                <form method="POST" action="">
                    <h1>Modifier compte</h1>
                    <input class="inp-form" type="text" id="prenom" name="prenom" placeholder="Prénom" value="<?php echo $prenom; ?>" />
                    <input class="inp-form" type="text" id="nom" name="nom" placeholder="Nom" value="<?php echo $nom; ?>" />
                    <input class="inp-form" type="email" id="mail" name="mail" placeholder="Adresse mail" value="<?php echo $mail; ?>" />
                    <input class="inp-form" type="password" id="password" name="password" placeholder="Mot de passe" value="<?php echo $password; ?>" />
                    <button type="submit" class="btn-form">Modifier</button>
                </form>
            </div>
        </div>
        <footer>
            <?php
                require("../includes/footer.php");
            ?>
        </footer>
    <?php
        } else {
            echo "<p>Erreur : aucun compte sélectionné.</p>";
        }
    ?>
    </body>
</html>
