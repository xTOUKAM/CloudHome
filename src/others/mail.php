<?php
    session_start();

    $prenom = isset($_SESSION['com_prenom']) ? $_SESSION['com_prenom'] : "visiteur";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/SMTP.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/Exception.php';

    if (isset($_POST['submit'])) {
        $to = "houllegatte.tom@gmail.com";
        $subject = "Mail de " . $prenom . " | CloudHome";
        $message = $_POST['message'];

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'votre adresse mail';
            $mail->Password = 'votre clé d\'application';

            $mail->setFrom($_POST['email']);
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            $message = "Mail envoyé";
        } catch (Exception $e) {
            $message = "Erreur lors de l'envoi du mail : " . $mail->ErrorInfo;
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire de contact</title>
        <link rel="stylesheet" href="../assets/css/inc.css">
    </head>

    <body>
        <?php include '../includes/header.php'; ?>
        
        <div class="container">
            <div class="form-container sign-in-container">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h1>Formulaire de contact</h1>
                    <input class="inp-form" type="email" id="email" name="email" placeholder="Adresse mail" required />
                    <textarea class="inp-form" id="message" name="message" placeholder="Message" required></textarea>
                    <input type="submit" name="submit" value="Envoyer" class="btn-form">
                    <p><?php $message ?></p>
                </form>
            </div>
        </div>
        
        <footer>
            <?php include '../includes/footer.php'; ?>
        </footer>
    </body>
</html>
