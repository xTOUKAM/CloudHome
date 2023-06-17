<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="src/assets/css/inc.css">
    <title>Accueil</title>
</head>
<body>
    <?php
        require_once('src/includes/header.php');
    ?>
    <div class="container">
        <?php 
            if(isset($_SESSION['com_mail'])) {
                echo("<h2>Bonjour " . $_SESSION['com_nom'] . "</h2>");
            } else {
                echo("<h2>Bonjour visiteur</h2>");
            }
        ?>
    </div>
    
    <footer>
        <?php
            require_once('src/includes/footer.php');
        ?>
    </footer>
    <!-- Insertion des scripts -->
    <script src="src/assets/js/inc.js"></script>
    <script src="src/assets/js/darkMode.js"></script>
</body>
</html>