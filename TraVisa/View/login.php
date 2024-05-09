<?php
session_start();

if (isset($_GET['error']) && $_GET['error'] === 'incorrect_credentials') {
    echo '<p style="color: red;">Incorrect email or password. Please try again.</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style2.css">
    <title>Login</title>
</head>
<body>
    <main class="content">
        <div class="image">
            <img src="../image/Mask group.png" alt="image">
        </div>
        <div class="part">
            <div>
                <h1>Login</h1>
                <h5>Login to your account in seconds</h5>
            </div>
            <div>
                <form id="loginForm" action="../View/verif.php" method="post">
                    <input class="inin" type="email" placeholder="Email Address" name="email" id="email">
                    <div id="emailError" class="error-msg"></div>
                    <br>
                    <input class="inin" type="password" placeholder="Password" name="password" id="password">
                    <div id="passwordError" class="error-msg"></div>
                    <br>
                    <button type="submit" id="loginBtn">Login</button>
                </form>
            </div>
            <div class="forget">
                <input type="checkbox" id="keepLoggedIn"><label for="keepLoggedIn">Keep me logged in</label>
                <a href="recoverpass.php">Forgot password</a>
            </div>
            <div class="signsign">
                <p>Don't have an account?</p>
                <a href="../signup.php">Sign Up</a>
            </div>
            <hr>
            <div>
                <a href=""><img src="../image/Google.png" alt="Google"></a>
                <a href=""><img src="../image/Facebook (1).png" alt="Facebook"></a>
                <a href=""><img src="../image/Instagram.png" alt="Instagram"></a>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            loginForm.addEventListener('submit', function(event) {
                // Validate email
                if (emailInput.value.trim() === '') {
                    event.preventDefault(); // Prevent form submission
                    emailError.textContent = 'Email is required';
                } else {
                    emailError.textContent = ''; // Clear error message
                }

                // Validate password
                if (passwordInput.value.trim() === '') {
                    event.preventDefault(); // Prevent form submission
                    passwordError.textContent = 'Password is required';
                } else {
                    passwordError.textContent = ''; // Clear error message
                }
            });
        });
    </script>
</body>
</html>
<?php
require '../controller/loginc.php'; // Assuming this file contains necessary functions
require_once "autoload.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize the login controller
    $loginController = new loginc();

    // Check if it's a login submission
    if (isset($_POST['submit'])) {
        // Initialize variables
        $user = $_POST['user1'];
        $password = $_POST['mdp1'];

        // Check reCAPTCHA response
        if (isset($_POST["g-recaptcha-response"])) {
            $recaptcha = new \ReCaptcha\ReCaptcha("YOUR_RECAPTCHA_SECRET_KEY");
            $resp = $recaptcha->verify($_POST["g-recaptcha-response"]);

            // If reCAPTCHA verification is successful
            if ($resp->isSuccess()) {
                // Check if user exists
                if ($loginController->checkUserExists($user, $password)) {
                    // Fetch user details
                    $userDetails = $loginController->selectuser($user);
                    
                    // Check if the account is blocked
                    if ($userDetails['bloquage'] == 1) {
                        // Display warning message if account is blocked
                        echo '<script>
                                Swal.fire({
                                    title: "Votre compte est bloqué. Veuillez nous contacter à studygo@gmail.com.",
                                    icon: "warning",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.replace("login.php");
                                    }
                                });
                            </script>';
                    } else {
                        // Redirect user based on their status
                        $redirectPage = ($userDetails['etat'] == 1) ? "backend_1.php" : "userprofile.php";
                        
                        echo '<script>
                                Swal.fire({
                                    position: "block",
                                    icon: "success",
                                    title: "Bonjour Mr. ' . $user . '",
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.replace("' . $redirectPage . '");
                                });
                            </script>';
                    }
                }
            } else {
                // If reCAPTCHA verification fails, display an error message
                echo '<script>
                        Swal.fire({
                            title: "Veuillez passer par le CAPTCHA avant de vous connecter.",
                            icon: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.replace("login.php");
                            }
                        });
                    </script>';
            }
        }

        // Stop further execution after handling the login request
        exit();
    }

    // Check if it's a registration submission
    $userNom = $_POST['userNom'];
    $userPrenom = $_POST['userPrenom'];
    $mdp = $_POST['mdp'];
    $email = $_POST['email'];
    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

    // Check if the email is unique
    if ($loginController->isEmailUnique($email)) {
        // Add account
        $loginController->addaccount($userNom, $userPrenom, $email, $hashedPassword);
    }
}
?>
