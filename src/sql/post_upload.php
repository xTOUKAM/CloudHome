<?php
    // On démarre une session
    session_start();

    // On inclut le fichier de langue
    require_once("../config/language.php");

    // On inclut la connexion à la base
    require_once("../config/bdd.php");

    // On créé plusieurs variables pour le nom et le prénom
    $nom = $_SESSION['com_nom'];
    $prenom = $_SESSION['com_prenom'];
    $id = $_SESSION['com_id'];

    // On vérifie les types de fichiers autorisés
    $arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];

    // On vérifie si un fichier a été envoyé
    if(isset($_FILES['file'])) {
        if(!(in_array($_FILES['file']['type'], $arr_file_types))) {
            echo getTranslation("Erreur : Seuls les fichiers PNG, GIF, JPG et JPEG sont autorisés.");
            return;
        }

        // On crée un dossier "uploads" s'il n'existe pas dans src/uploads
        if (!file_exists('../uploads')) {
            mkdir('../uploads', 0777);
        }

        // On crée un dossier pour le membre s'il n'existe pas
        if (!is_dir("../uploads/".$nom."-".$prenom."-".$id)) {
            mkdir("../uploads/".$nom."-".$prenom."-".$id, 0777);
            chmod("../uploads/".$nom."-".$prenom."-".$id, 0777);
        }

        $filename = time().'_'.$_FILES['file']['name'];

        // On déplace le ou les fichiers dans le dossier uploads
        move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/'.$nom."-".$prenom."-".$id.'/'.$filename);

        echo '../uploads/'.$nom."-".$prenom."-".$id.'/'.$filename;
        die;
    }
?>