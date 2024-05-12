<?php
if (isset($_GET['id_voy']) && !empty($_GET['id_voy'])) {

    require_once '../Controller/voyageC.php';

    $voyageController = new voyageC();
    $voyageId = $_GET['id_voy'];

    $result = $voyageController->switchEtat($voyageId,"nonsuprime");
        header('Location: backoffice.php');
        exit(); 
    
} else {
    echo "Voyage ID not provided or invalid.";
}
?>
