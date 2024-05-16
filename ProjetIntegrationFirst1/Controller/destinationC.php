<?php
require_once '../../config.php';

class destinationC {
    public function list_Destination1()
    {
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare("SELECT * FROM `destination`");
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
            return array();
        }
    }
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
            $tableHTML .= '<th>Category</th>';
            $tableHTML .= '<th>Purpose</th>';
            $tableHTML .= '<th>Climate</th>';
            $tableHTML .= '</tr>';
            $tableHTML .= '</thead>';
            $tableHTML .= '<tbody>';
    
            foreach ($result as $row) {
                $tableHTML .= '<tr>';
            
                    $tableHTML .= '<td>' . $row['id_des'] . '</td>';
                    $tableHTML .= '<td>' . $row['nom_ville'] . '</td>';
                    $tableHTML .= '<td>' . $row['description_detaillee'] . '</td>';
                    $tableHTML .= '<td>' . $row['coordonneesGPS'] . '</td>';
                    $tableHTML .= '<td>' . $row['pays'] . '</td>';
                    $tableHTML .= '<td>' . $row['langueParlee'] . '</td>';
                    $tableHTML .= '<td>' . $row['categorie'] . '</td>';
                    $tableHTML .= '<td>' . $row['motivations'] . '</td>';
                    $tableHTML .= '<td>' . $row['climat'] . '</td>';
                    $tableHTML .= '<td><button class="btn btn-danger btn-delete-des" data-id-Des="' . $row['id_des'] . '">Delete</button></td>';
                    $tableHTML .= '<td><button class="btn btn-primary btn-update-Des" data-id-Des="' . $row['id_des'] .'" data-nom-ville="' . htmlspecialchars($row['nom_ville']) .'" data-description-detaillee="' . $row['description_detaillee'] . '" data-coordonneesGPS="' . $row['coordonneesGPS'] .'" data-pays="' . htmlspecialchars($row['pays']) . '" data-langueParlee="' . htmlspecialchars($row['langueParlee']) .'" data-categorie="' . htmlspecialchars($row['categorie']) .  '" data-motivations="' . $row['motivations'] . '" data-climat="' . $row['climat'] . '">Update</button></td>';
            
            
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

    public function deleteDestination($id_des) {
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare("DELETE FROM destination WHERE id_des = :id_des");
            $query->bindParam(':id_des', $id_des);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error deleting Destination: ' . $e->getMessage());
            return false;
        }
    }

    public function updateDestination($id_des,$nom_ville,$description_detaillee,$coordonneesGPS,$pays,$langueParlee,$categorie,$motivations,$climat) {
        $conn = config::getConnexion();
        try {
            // Prepare SQL statement to update Destination data
            $query = $conn->prepare("UPDATE destination SET nom_ville = :nom_ville, description_detaillee = :description_detaillee, coordonneesGPS = :coordonneesGPS, pays = :pays, langueParlee = :langueParlee, categorie = :categorie, motivations = :motivations, climat = :climat WHERE id_des = :id_des");

            // Bind parameters
            $query->bindParam(':id_des', $id_des);
            $query->bindParam(':nom_ville', $nom_ville);
            $query->bindParam(':description_detaillee', $description_detaillee);
            $query->bindParam(':coordonneesGPS', $coordonneesGPS);
            $query->bindParam(':pays', $pays);
            $query->bindParam(':langueParlee', $langueParlee);
            $query->bindParam(':categorie', $categorie);
            $query->bindParam(':motivations', $motivations);
            $query->bindParam(':climat', $climat);

            // Execute the query
            $query->execute();

            // Return true if update was successful
            return true;
        } catch (PDOException $e) {
            // Log and return false if update fails
            error_log('Error updating Destination: ' . $e->getMessage());
            return false;
        }
    }
    public function addDestination($idDes_Des, $nom_ville, $description_detaillee, $coordonneesGPS, $pays, $langueParlee, $categorie, $motivations, $climat) {
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare("INSERT INTO destination (id_des, nom_ville, description_detaillee, coordonneesGPS, pays, langueParlee, categorie, motivations, climat) VALUES (:id_des, :nom_ville, :description_detaillee, :coordonneesGPS, :pays, :langueParlee, :categorie, :motivations, :climat)");
            
            // Bind parameters
            $query->bindParam(':id_des', $idDes_Des);
            $query->bindParam(':nom_ville', $nom_ville);
            $query->bindParam(':description_detaillee', $description_detaillee);
            $query->bindParam(':coordonneesGPS', $coordonneesGPS);
            $query->bindParam(':pays', $pays);
            $query->bindParam(':langueParlee', $langueParlee);
            $query->bindParam(':categorie', $categorie);
            $query->bindParam(':motivations', $motivations);
            $query->bindParam(':climat', $climat);
    
            // Execute the query
            $query->execute();
            
            // Check if insertion was successful
            if ($query->rowCount() > 0) {
                return true; // Destination added successfully
            } else {
                return false; // Failed to add destination
                echo "ajoityfncjjsbbdjksb";
            }
        } catch (PDOException $e) {
            // Log the error or display a meaningful message
            echo"Error adding destination: " . $e->getMessage();
            return false; // Failed to add destination
            
        }
        
    }
    
}

?>