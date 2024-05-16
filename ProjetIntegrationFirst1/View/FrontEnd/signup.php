<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style2.css">
    <title>Document</title>
</head>
<body>
    <main class="content">
        <div class="image">
            <img src="../../image/Mask group.png" alt="taswira">
        </div>
        <div class="part">
            <div>
                <h1>Sign in</h1>
                <h5>Create your account in a seconds</h5>
            </div>
            <div>
                <form id="signupForm" action="inscrip.php" method="post">
                    <input class="inin" type="text" placeholder="First Name:" name="nom" id="nom" required >
                    <div id="nomError" class="error-msg"></div>
                    <br>
                    <input class="inin" type="text" placeholder="Last Name:" name="prenom" id="prenom" required >
                    <div id="prenomError" class="error-msg"></div>
                    <br>
                    <input class="inin" type="email" placeholder="Email Address:" name="email" id="email" required >
                    <div id="emailError" class="error-msg"></div>
                    <br>
                    <input class="inin" type="tel" placeholder="Numero:" name="numTel" id="numTel" required>
                    <div id="numTelError" class="error-msg"></div>
                    <br>
                    <input class="inin" type="password" placeholder="Password:" id="password" name="password" >
                    <div id="passwordError" class="error-msg"></div>
                    <br>
                    <input class="inin" type="password" placeholder="Confirm Password:" name="confirmPassword" id="confirmPassword" required >
                    <div id="confirmPasswordError" class="error-msg"></div>
                    <br>
                    <button type="submit" class="submit-btn">Submit</button>

                </form>
            </div>
            <div class="forget">
                <input type="checkbox"><p>I agree to the terms and privacy policy </p>
            </div>
            <div class="signsign">
                <p>Already a member? </p>
                <a href="login.php">Login</a>
            </div>
            <hr>
            <div>
                <a href=""><img src="../image/Google.png" alt=""></a>
                <a href=""><img src="../image/Facebook (1).png" alt=""></a>
                <a href=""><img src="../image/Instagram.png" alt=""></a>
            </div>
        </div>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const signupForm = document.getElementById('signupForm');

        signupForm.addEventListener('submit', function(event) {
            // Prevent the form from submitting initially
            event.preventDefault();

            // Validate form inputs here
            const nom = document.getElementById('nom').value;
            const prenom = document.getElementById('prenom').value;
            const email = document.getElementById('email').value;
            const numTel = document.getElementById('numTel').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Clear all previous error messages
            const errorFields = document.querySelectorAll('.error-msg');
            errorFields.forEach(function(errorField) {
                errorField.textContent = '';
            });

            // Example: Check if the nom field is empty
            if (nom.trim() === '') {
                document.getElementById('nomError').textContent = 'First name is required';
                return; // Exit the function to prevent further validation
            }

            // Validate nom and prenom fields (no numbers, at least two letters)
            const nameRegex = /^[A-Za-z]{2,}$/;
            if (!nameRegex.test(nom)) {
                document.getElementById('nomError').textContent = 'First name must contain only letters and be at least two characters long';
                document.getElementById('nomError').style.color = 'red';
                return;
            }

            if (!nameRegex.test(prenom)) {
                document.getElementById('prenomError').textContent = 'Last name must contain only letters and be at least two characters long';
                return;
            }

            // Validate email format
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                document.getElementById('emailError').textContent = 'Invalid email address format';
                return;
            }

            // Validate numTel (8 digits)
            const numTelRegex = /^[0-9]{8}$/;
            if (!numTelRegex.test(numTel)) {
                document.getElementById('numTelError').textContent = 'Phone number must be 8 digits long';
                return;
            }

            // Validate password length (at least 4 characters)
            if (password.length < 4) {
                document.getElementById('passwordError').textContent = 'Password must be at least 4 characters long';
                return;
            }

            // Validate if password and confirmPassword match
            if (password !== confirmPassword) {
                document.getElementById('confirmPasswordError').textContent = 'Passwords do not match';
                return;
            }

            // If all validations pass, submit the form
            signupForm.submit();
        });
    });
</script>

</body>
</html>
