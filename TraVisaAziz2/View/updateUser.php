<?php
require_once '../Controller/userC.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $userId = $_POST['userId'];
    $updateName = $_POST['updateName'];
    $updatePrenom = $_POST['updatePrenom'];
    $updateEmail = $_POST['updateEmail'];
    $updatePassword = $_POST['updatePassword'];
    $updateNumTel = $_POST['updateNumTel'];
    $updateRole = $_POST['updateRole'];


    $userController = new userC();

    $updateResult = $userController->updateUser($userId, $updateName, $updatePrenom, $updateEmail, $updatePassword, $updateNumTel, $updateRole);


        header("Location: BackOffice.php");
      
}
?>
