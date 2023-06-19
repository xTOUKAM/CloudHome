<?php
// Connexion à la base de données
require_once("../config/bdd.php");

// On vérifie que le compte est un administrateur
require_once("../sql/verifAdmin.php");

// Pagination - Nombre de comptes par page
$comptesParPage = 2;

// Page actuelle
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $comptesParPage;

// Requête pour récupérer le nombre total de comptes
$countReq = $bdd->prepare("SELECT COUNT(*) AS total FROM compte");
$countReq->execute();
$totalComptes = $countReq->fetch(PDO::FETCH_ASSOC)['total'];

// Calcul du nombre total de pages
$totalPages = ceil($totalComptes / $comptesParPage);

// Requête pour récupérer les comptes avec une limite et un offset
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM compte WHERE com_mail LIKE '%$search%' OR com_nom LIKE '%$search%' OR com_prenom LIKE '%$search%' OR com_actif LIKE '%$search%'";
    $requete = $bdd->prepare($sql);
    $requete->execute();
    $resultat = $requete->fetchAll();
    // Masquer les numéros de page
    $totalPages = 0;
} else {
    $sql = "SELECT * FROM compte LIMIT :offset, :comptesParPage";
    $requete = $bdd->prepare($sql);
    $requete->bindParam(':offset', $offset, PDO::PARAM_INT);
    $requete->bindParam(':comptesParPage', $comptesParPage, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/inc.css">
    <style>
        /* Styles CSS pour la pagination */
        .info-first {
            margin-top: 6%;
        }

        .pagination {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination a {
            margin: 0 5px;
            padding: 5px 10px;
            background-color: #f1f1f1;
            text-decoration: none;
            color: #333;
        }

        .pagination a.current {
            background-color: #333;
            color: #fff;
        }
    </style>
    <title>Compte utilisateur | Administration</title>
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
        foreach ($resultat as $compte) { ?>
            <p><strong>Mail : </strong><?= $compte['com_mail'] ?></p>
            <p><strong>Nom : </strong><?= $compte['com_nom'] ?></p>
            <p><strong>Prénom : </strong><?= $compte['com_prenom'] ?></p>

            <?php
            if ($compte['com_actif'] == 0) {
                $etat = "Actif";
            } else {
                $etat = "Inactif";
            }
            ?>
            <p><strong>État du compte : </strong><?= $etat ?></p>
            
            <?php 
            if($compte['com_admin'] == 1) {
                $admin = "Oui";
            } else {
                $admin = "Non";
            } 
            ?>
            
            <p><strong>Administrateur : </strong><?= $admin ?></p>
            
            <?php
            if ($compte['com_actif'] == 0) { 
                if($_SESSION['com_mail'] == $compte['com_mail']) {
                    // On affiche pas le bouton si c'est le compte de l'admin connecté
                } else { ?>
                    <a class="btn-form desactivate" href="/website/src/sql/changeEtat.php?mail=<?= $compte['com_mail'] ?>">Désactiver le compte</a>
                <?php } ?>
            <?php } else { ?>
                <a class="btn-form activate" href="/website/src/sql/changeEtat.php?mail=<?= $compte['com_mail'] ?>">Activer le compte</a>
            <?php } ?>
            <br/>
        <?php } ?>

        <!-- Pagination -->
        <?php if ($totalPages > 0 && empty($_POST['search'])) : ?>
            <div class="pagination">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    $active = ($i == $page) ? 'current' : '';
                    echo "<a href='voirCompte.php?page=$i' class='$active'>$i</a>";
                }
                ?>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <?php include('../includes/footer.php'); ?>
    </footer>
</body>

</html>