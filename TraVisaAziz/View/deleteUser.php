<?php
// deleteUser.php

require_once '../Controller/userC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $userController = new userC();
    $userController->deleteUser($userId);
    // Optionally, you can redirect back to the page after deletion
    header("Location: BackOffice.php");
    exit();
}
?>