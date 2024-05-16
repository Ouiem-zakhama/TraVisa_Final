<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de récupération de mot de passe</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="#">Récupération du mot de passe utilisateur</a>
        </div>
    </nav>

    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Récupération de mot de passe</div>
                        <div class="card-body">
                            <form action="#" method="POST" name="recover_psw">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Email Adresse</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email_address" class="form-control" name="email" required autofocus>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="recover">Récupération</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php 
    if(isset($_POST["recover"])){
        require '../Controller/loginc.php';
        require '../Model/login.php'; 
        $email = $_POST["email"];

        $l = new loginc();
        $etat = $l->selectemail($email);

        if(!$etat){
            echo "<script>Swal.fire('Adresse email invalide', '', 'error');</script>";
        } else {
            $token = bin2hex(random_bytes(50));
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            require "../View/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';

            // Sender email credentials
            $mail->Username = 'benamoraziz282003@gmail.com'; // Your email
            $mail->Password = 'azertyqsdfgh123456789'; // Your password

            // Sender and recipient email
            $mail->setFrom('benamoraziz282003@gmail.com', 'Password Reset'); // Your email
            $mail->addAddress($_POST["email"]); // Recipient email

            // HTML body
            $mail->isHTML(true);
            $mail->Subject = "Récupération de votre mot de passe";
            $mail->Body = '<b>Cher utilisateur,</b>
                           <h3>Nous avons reçu une demande de réinitialisation de votre mot de passe.</h3>
                           <p>Veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
                           <a href="http://localhost/Projets/TraVisaAziz/View/reset_psw.php">Réinitialiser votre mot de passe</a>
                           <br><br>
                           <p>Cordialement,</p>
                           <b>Programming with Lam</b>';

            if(!$mail->send()){
                echo "<script>Swal.fire('Erreur lors de l\'envoi de l\'email', '', 'error');</script>";
            } else {
                echo "<script>Swal.fire('Ton email a été envoyé avec succès', '', 'success');</script>";
            }
        }
    }
    ?>
</body>
</html>
