<?php
include '../Controller/userC.php';

define('role','client');
$user=new userC();
$id_aleatoire = mt_rand(1111, 9999);

$user->addUser2($id_aleatoire,$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['password'],$_POST['numTel'],role);

header('Location: ../View/HomePage.html');

?>