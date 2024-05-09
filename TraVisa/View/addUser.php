<?php

require_once '../Controller/userC.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userId = $_POST['addUserId'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $numTel = $_POST['numTel'];
    $role = $_POST['role'];

    // Create an instance of the userC class
    $userController = new userC();

    // Call the addUser function and check if user was added successfully
    if ($userController->addUser1($userId, $nom, $prenom, $email, $password, $numTel, $role)) {
        // User added successfully
        header("Location: BackOffice.php");
        exit();
    } else {
        // Failed to add user
        echo "Failed to add user!";
    }
} 
?>
