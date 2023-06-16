<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel=stylesheet href="../assets/css/inc.css">
        <title>Enregistrement</title>
    </head>
    
    <body>
        <?php
            require("../includes/header.php");
        ?>
        <div class="container">
            <div class="form-container sign-in-container">
                <form method="POST" action="">
                    <h1>Créer un compte</h1>
                    <input class="inp-form" type="text" placeholder="Prénom" />
                    <input class="inp-form" type="email" placeholder="Nom" />
                    <input class="inp-form" type="email" placeholder="Adresse mail" />
                    <input class="inp-form" type="password" placeholder="Mot de passe" />
                    <button class="btn-form">Créer un compte</button>
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