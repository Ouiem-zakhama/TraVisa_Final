<?php

require_once '../Controller/voyageC.php';

if (isset($_POST['updateIdVoy'], $_POST['updateTitre'], $_POST['updateDes'], $_POST['updateDateDebut'], $_POST['updateDateFin'], $_POST['updatePrix'], $_POST['updateDescription'], $_POST['updateMotivation'], $_POST['updateMoyenTransport'])) {
    // Extract the form data
    $idVoy = $_POST['updateIdVoy'];
    $titre = $_POST['updateTitre'];
    $idDes = $_POST['updateDes'];
    $dateDebut = $_POST['updateDateDebut'];
    $dateFin = $_POST['updateDateFin'];
    $prix = $_POST['updatePrix'];
    $description = $_POST['updateDescription'];
    $motivation = $_POST['updateMotivation'];
    $moyenTransport = $_POST['updateMoyenTransport'];

    $voyageC = new voyageC();

    $result = $voyageC->updateVoyage($idVoy, $titre, $idDes, $dateDebut, $dateFin, $prix, $description, $motivation, $moyenTransport);
    if ($result) {
        header('Location: backoffice.php');
        exit(); 
    } else {
        echo "Failed to update the voyage.";
    } 
} else {
    echo "Voyage ID not provided or invalid.";
}
?>
