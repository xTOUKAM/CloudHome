<?php
    // Fonction pour trouver le chemin relatif !
    // On créer une fonction qui traduit les mots
    function getTranslation($key) {
        $lang = "en-EN";
        $file = "lang/" . strtolower($lang) . ".php";

        if(file_exists($file)) {
            $translations = include $file;
            return isset($translations[$key]) ? $translations[$key] : $key;
        }

        return $key;
    }
?>