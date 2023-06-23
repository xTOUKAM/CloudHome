<?php
    $com_admin = isset($_SESSION['com_admin']) ? (int)$_SESSION['com_admin'] : 0;
    $com_mail = isset($_SESSION['com_mail']);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/header.css">
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    </head>
    <body>
        <!-- Création de la barre de navigation -->
        <div>
            <ul class="tab">
                <li><a class="a-header-footer" href="<?php echo getRelativePath('../../index.php'); ?>"><i class="lni lni-home"></i></a></li>
                <?php
                if ($com_admin === 1) {
                    echo '<li><a class="a-header-footer" href="' . getRelativePath('../admin/') . '"><i class="lni lni-laptop"></i></a></li>';
                }
                ?>
                <li><a class="a-header-footer" href="<?php echo getRelativePath('../user/login.php'); ?>"><i class="lni lni-user"></i></a></li>
                <?php if ($com_mail != "") { ?>
                    <li><a class="a-header-footer" href="<?php echo getRelativePath('../user/upload.php') ?>"><i class="lni lni-image"></i></a></li>
                <?php } ?>
                <li><a class="a-header-footer" href="<?php echo getRelativePath('../others/mail.php'); ?>"><i class="lni lni-hand"></i></a></li>
            </ul>
        </div>
        <!-- Insertion des scripts -->
        <script src="../assets/js/inc.js"></script>

        <?php
        // Fonction pour obtenir le chemin relatif en fonction de l'URI actuelle
        function getRelativePath($target) {
            $baseDir = str_replace('\\', '/', __DIR__);
            $rootDir = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
            $relativePath = str_replace($rootDir, '', $baseDir);
            return $relativePath . '/' . $target;
        }
        ?>
    </body>
</html>
