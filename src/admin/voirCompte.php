<?php
    // Connexion à la base de données
    require_once("../config/bdd.php");

    // On vérifie que le compte est un administrateur
    require_once("../sql/verifAdmin.php");

    // préparation de la requête
    $sql = "SELECT * FROM compte";

    $requete = $bdd->prepare($sql);

    // Exécution de la requête
    $requete->execute();
    $resultat = $requete->fetchAll();    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="../assets/css/inc.css">
    <style>
        .info-first {
            max-height: 750px;
            margin-top: 9%;
            overflow-y : scroll;
        }

        /* Pour les navigateurs Webkit (Chrome, Safari) */
        .info-first::-webkit-scrollbar {
        width: 8px;
        }

        .info-first::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        }

        .info-first::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 4px;
        }

        /* Pour les navigateurs Firefox */
        .info-first {
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
        }

        /* Pour les navigateurs autres que Chrome, Safari et Firefox */
        .info-first {
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
        }

        /* Style supplémentaire pour rendre la scrollbar plus discrète */
        .info-first::-webkit-scrollbar-thumb {
        background-color: #bbb;
        }

        .info-first::-webkit-scrollbar-thumb:hover {
        background-color: #999;
        }

        .info-first::-webkit-scrollbar-track {
        background-color: #f9f9f9;
        }

        .info-first::-webkit-scrollbar-track:hover {
        background-color: #f1f1f1;
        }
    </style>
    <title>Compte utilisateur</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>
    <!-- On affiche les comptes -->
    <div class="info-first">
        <form action="" method="post">
            <h1>Panel Administrateur</h1>
            <input class="inp-form" type="text" name="search" placeholder="Rechercher un compte">
            <input class="inp-form" type="submit" value="Rechercher">
            <br />
        </form>
        <?php 
            if(isset($_POST['search'])) {
                $search = $_POST['search'];
                $sql = "SELECT * FROM compte WHERE com_mail LIKE '%$search%' OR com_nom LIKE '%$search%' OR com_prenom LIKE '%$search%' OR com_actif LIKE '%$search%'";
                $requete = $bdd->prepare($sql);
                $requete->execute();
                $resultat = $requete->fetchAll();
            }
        ?>
        <?php
            foreach ($resultat as $compte) { ?>
            <p><strong>Mail : </strong><?= $compte['com_mail'] ?></p>
            <p><strong>Nom : </strong><?= $compte['com_nom'] ?></p>
            <p><strong>Prénom : </strong><?= $compte['com_prenom'] ?></p>
            
            <?php
            if($compte['com_actif'] == 0) {
                $etat = "Actif";
            } else {
                $etat = "Inactif";
            }
            ?>
            <p><strong>état du compte : </strong><?= $etat ?></p>

            <?php 
            if($compte['com_actif'] == 0) { ?>
                <a class="btn-form desactivate"href="/website/src/sql/changeEtat.php?mail=<?= $compte['com_mail'] ?>">Désactiver le compte</a>
            <?php } else { ?>
                <a class="btn-form activate"href="/website/src/sql/changeEtat.php?mail=<?= $compte['com_mail'] ?>">Activer le compte</a>
            <?php } ?>
            <br/>
        <?php } ?>
    </div>

    <footer>
        <?php include('../includes/footer.php'); ?>
    </footer>
</body>
</html>
