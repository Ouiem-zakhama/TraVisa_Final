<?php
require_once '../../Controller/userC.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userModel = new userC();
    if ($userModel->userExists($email, $password)) {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $userModel->getUserName($email); // Set the session variable with the user's name
        header('Location: HomePage.php');
        exit();
    } else {
        header('Location: login.php?error=incorrect_credentials');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>