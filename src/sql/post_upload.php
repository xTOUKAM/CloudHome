<?php
    // On démarre une session
    session_start();

    // On inclut la connexion à la base
    require_once("../config/bdd.php");

    // On créé plusieurs variables pour le nom et le prénom
    $nom = $_SESSION['com_nom'];
    $prenom = $_SESSION['com_prenom'];

    if(isset($_FILES['file'])) {
        $arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];

        // On vérifie les types de fichiers autorisés
        if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
            echo "false";
            return;
        }

        // On crée un dossier "uploads" s'il n'existe pas dans uploads
        if (!file_exists('../uploads')) {
            mkdir('../uploads', 0777, true);
        }

        // On crée un dossier pour le membre s'il n'existe pas
        if (!is_dir("../uploads/".$nom."-".$prenom)) {
            mkdir("../uploads/".$nom."-".$prenom, 0777, true);
        }

        $uploaded_files = [];
        
        // On boucle sur les fichiers téléchargés
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $filename = time().'_'.$_FILES['file']['name'][$key];
            $destination = '../uploads/'.$nom.'-'.$prenom.'/'.$filename;
    
            // On déplace le fichier dans le dossier du membre
            if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $destination)) {
                $uploaded_files[] = $destination;
            }
        }
    
        echo json_encode($uploaded_files);
    }
?>