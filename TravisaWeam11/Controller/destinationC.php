<?php
require_once '../config.php';
class destinationC {
    public function list_Destination(){
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare("SELECT * FROM destination");
            $query->execute();
            $result = $query->fetchAll();
            $tableHTML = '<table class="table">';
            $tableHTML .= '<thead>';
            $tableHTML .= '<tr>';
            $tableHTML .= '<th>ID_Des</th>';
            $tableHTML .= '<th>Destination Name</th>';
            $tableHTML .= '<th>Description Details</th>';
            $tableHTML .= '<th>GPS</th>';
            $tableHTML .= '<th>Country</th>';
            $tableHTML .= '<th>language</th>';
            $tableHTML .= '<th>Motivation</th>';
            $tableHTML .= '<th>Category</th>';
            $tableHTML .= '<th>Climate</th>';
            $tableHTML .= '</tr>';
            $tableHTML .= '</thead>';
            $tableHTML .= '<tbody>';
    
    
foreach ($result as $row) {
$tableHTML .= '<tr>';

    $tableHTML .= '<td>' . $row['id_des'] . '</td>';
    $tableHTML .= '<td>' . $row['nom_ville'] . '</td>';
    $tableHTML .= '<td>' . $row['description_detaille'] . '</td>';
    $tableHTML .= '<td>' . $row['GPS'] . '</td>';
    $tableHTML .= '<td>' . $row['pays'] . '</td>';
    $tableHTML .= '<td>' . $row['langue'] . '</td>';
    $tableHTML .= '<td>' . $row['motivmotivation_destinationation'] . '</td>';
    $tableHTML .= '<td>' . $row['catégorie_destination'] . '</td>';
    $tableHTML .= '<td>' . $row['climat'] . '</td>';
    $tableHTML .= '<td><button class="btn btn-danger btn-supprimer" data-id="' . $row['id_des'] . '">Supprimer</button></td>';
    $tableHTML .= '<td><button class="btn btn-primary" data-id="' . $row['id_des'] . '">Modifier</button></td>';
    $tableHTML .= '</tr>';
                  }
    
    $tableHTML .= '</tbody>';
    $tableHTML .= '</table>';
    
    return $tableHTML;
        } catch (Exeption $e) {
            die('Error : ' . $e->getMessage());
            return "";
        }
        
    }
}

?>