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
                <a href="">Forgot password</a>
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
