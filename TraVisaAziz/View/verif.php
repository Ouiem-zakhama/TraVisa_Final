<?php
include_once '../Controller/userC.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userModel = new userC();
    if ($userModel->userExists($email, $password)) {
        header('Location: ../View/HomePage.html');
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
