<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="assets/css/inc.css">
    <title>Accueil</title>
</head>
<body>
    <?php
        require_once('includes/header.php');
    ?>
    <div class="info-first">
        <?php 
            if(isset($_SESSION['com_mail'])) {
                echo("<h2>Bonjour " . $_SESSION['com_prenom'] . "</h2>");
            } else {
                echo("<h2>Bonjour visiteur</h2>");
            }
        ?>
    </div>
    
    <footer>
        <?php
            require_once('includes/footer.php');
        ?>
    </footer>
    <!-- Insertion des scripts -->
    <script src="assets/js/inc.js"></script>
    <script src="assets/js/darkMode.js"></script>
</body>
</html>