<?php
    // Connexion à la base de données
    require_once("../config/bdd.php");

    // On vérifie que le compte est un administrateur
    require_once("../sql/verifAdmin.php");

    if(isset($_GET["com_mail"])) {
        $mail = $_GET["com_mail"];
        $sql = "SELECT * FROM compte WHERE com_mail = :mail";
        $requete = $bdd->prepare($sql);
        $requete->bindParam(':mail', $mail);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $com_prenom = $resultat["com_prenom"];
        $com_nom = $resultat["com_nom"];
        $com_mail = $resultat["com_mail"];
    }

    if(isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["mail"])) {
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $mail = $_POST["mail"];
        $sql = "UPDATE compte SET com_prenom = :prenom, com_nom = :nom, com_mail = :mail WHERE com_mail = :mail";
        $requete = $bdd->prepare($sql);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':mail', $mail);
        $requete->execute();

        header("Location: voirCompte.php");
    }

?>
<?php
    if(isset($mail)) {
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
            <div class="form-container sign-in-container">
                <form action="modifUser.php" method="post">
                    <h1>Modifier compte</h1>
                    <input class="inp-form" type="text" name="prenom" placeholder="Prénom" value="<?php echo $com_prenom; ?>" required>
                    <input class="inp-form" type="text" name="nom" placeholder="Nom" value="<?php echo $com_nom; ?>" required>
                    <input class="inp-form" type="email" name="mail" placeholder="Email" value="<?php echo $mail; ?>" required>
                    <button class="btn-form" type="submit">Modifier</button>
                </form>
            </div>
        </div>
        <footer>
            <?php
                require("../includes/footer.php");
            ?>
        </footer>
    </body>
</html>

<?php } else { ?>
    <p>Aucun client sélectionné</p>
<?php } ?>
