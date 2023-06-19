<?php
    $com_admin = isset($_SESSION['com_admin']);
    $com_mail = isset($_SESSION['com_mail']);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel=stylesheet href="../assets/css/header.css">
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    </head>
    <body>
        <!-- Création de la barre de navigation -->
        <div>
            <ul class="tab">
                <li><a class="a-header-footer" href="/website/"><i class="lni lni-home"></i></a></li>
                <?php 
                    if($com_admin == 1 && $_SESSION['com_admin'] == 1){
                        echo '<li><a class="a-header-footer" href="/website/src/admin/"><i class="lni lni-laptop"></i></i></a></li>';
                    }
                ?>
                <li><a class="a-header-footer" href="/website/src/user/login.php"><i class="lni lni-user"></i></a></li>
                <?php 
                    if($com_mail != ""){
                        echo '<li><a class="a-header-footer" href="#"><i class="lni lni-image"></i></a></li>';
                    }
                ?>
                <li><a class="a-header-footer" href="/website/src/others/mail.php"><i class="lni lni-hand"></i></a></li>
            </ul>
        </div>
        <!-- Insertion des scripts -->
        <script src="../assets/js/header.js"></script>
    </body>
</html>