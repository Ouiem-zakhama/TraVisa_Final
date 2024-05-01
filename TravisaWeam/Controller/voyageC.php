<?php
require_once '../config.php';

class voyageC{

        public function list_voyage(){
            $conn = config::getConnexion();
            try {
                $query = $conn->prepare("SELECT * FROM voyage");
                $query->execute();
                $result = $query->fetchAll();
                $tableHTML = '<table class="table">';
        $tableHTML .= '<thead>';
        $tableHTML .= '<tr>';
        $tableHTML .= '<th>ID_Voy</th>';
        $tableHTML .= '<th>titre</th>';
        $tableHTML .= '<th>ID_Des</th>';
        $tableHTML .= '<th>Date_Debut</th>';
        $tableHTML .= '<th>Date_Fin</th>';
        $tableHTML .= '<th>Prix</th>';
        $tableHTML .= '<th>Description</th>';
        $tableHTML .= '<th>Motivation</th>';
        $tableHTML .= '<th>Moyen_trasport</th>';
        $tableHTML .= '</tr>';
        $tableHTML .= '</thead>';
        $tableHTML .= '<tbody>';
        
        
    foreach ($result as $row) {
    $tableHTML .= '<tr>';

        $tableHTML .= '<td>' . $row['id_voy'] . '</td>';
        $tableHTML .= '<td>' . $row['titre'] . '</td>';
        $tableHTML .= '<td>' . $row['id_des'] . '</td>';
        $tableHTML .= '<td>' . $row['date_debut'] . '</td>';
        $tableHTML .= '<td>' . $row['date_fin'] . '</td>';
        $tableHTML .= '<td>' . $row['prix'] . '</td>';
        $tableHTML .= '<td>' . $row['description'] . '</td>';
        $tableHTML .= '<td>' . $row['motivation'] . '</td>';
        $tableHTML .= '<td>' . $row['moyen_transport'] . '</td>';
        $tableHTML .= '<td><button class="btn btn-danger btn-delete" data-id="' . $row['id_voy'] . '">Delete</button></td>';
        $tableHTML .= '<td><button class="btn btn-primary btn-update" data-id="' . $row['id_voy'] .'" data-titre="' . htmlspecialchars($row['titre']) .'" data-id_des="' . $row['id_des'] . '" data-prix="' . $row['prix'] .'" data-moyen_transport="' . htmlspecialchars($row['moyen_transport']) . '" data-description="' . htmlspecialchars($row['description']) .'" data-motivation="' . htmlspecialchars($row['motivation']) .  '" data-date_debut="' . $row['date_debut'] . '" data-date_fin="' . $row['date_fin'] . '">Update</button></td>';


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


        public function deleteVoyage($id_voy) {
            $conn = config::getConnexion();
            try {
                $query = $conn->prepare("DELETE FROM voyage WHERE id_voy = :id_voy");
                $query->bindParam(':id_voy', $id_voy);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                error_log('Error deleting voyage: ' . $e->getMessage());
                return false;
            }
        }


    
    public function addVoyage($id_voy, $titre, $id_des, $date_debut, $date_fin, $prix, $description, $motivation, $moyen_transport) {
        $conn = config::getConnexion();
        
        try {
            $query = $conn->prepare("INSERT INTO voyage (id_voy, titre, id_des, date_debut, date_fin, prix, description, motivation, moyen_transport) VALUES (:id_voy, :titre, :id_des, :date_debut, :date_fin, :prix, :description, :motivation, :moyen_transport)");
            // Bind parameters
            $query->bindParam(':id_voy', $id_voy);
            $query->bindParam(':titre', $titre);
            $query->bindParam(':id_des', $id_des);
            $query->bindParam(':date_debut', $date_debut);
            $query->bindParam(':date_fin', $date_fin);
            $query->bindParam(':prix', $prix);
            $query->bindParam(':description', $description);
            $query->bindParam(':motivation', $motivation);
            $query->bindParam(':moyen_transport', $moyen_transport);

            // Execute the query
            $query->execute();
            
            // Check if insertion was successful
            if ($query->rowCount() > 0) {
                return true; // Voyage added successfully
            } else {
                return false; // Failed to add voyage
            }
        } catch (PDOException $e) {
            // Handle any exceptions
            echo "Error: " . $e->getMessage();
            return false; // Failed to add voyage
        }
    }


        public function updateVoyage($id_voy,$titre,$id_des,$date_debut,$date_fin,$prix,$description,$motivation,$moyen_transport) {
            $conn = config::getConnexion();
            try {
                // Prepare SQL statement to update voyage data
                $query = $conn->prepare("UPDATE voyage SET titre = :titre, id_des = :id_des, date_debut = :date_debut, date_fin = :date_fin, prix = :prix, description = :description, motivation = :motivation, moyen_transport = :moyen_transport WHERE id_voy = :id_voy");
    
                // Bind parameters
                $query->bindParam(':id_voy', $id_voy);
                $query->bindParam(':titre', $titre);
                $query->bindParam(':id_des', $id_des);
                $query->bindParam(':date_debut', $date_debut);
                $query->bindParam(':date_fin', $date_fin);
                $query->bindParam(':prix', $prix);
                $query->bindParam(':description', $description);
                $query->bindParam(':motivation', $motivation);
                $query->bindParam(':moyen_transport', $moyen_transport);
    
                // Execute the query
                $query->execute();
    
                // Return true if update was successful
                return true;
            } catch (PDOException $e) {
                // Log and return false if update fails
                error_log('Error updating voyage: ' . $e->getMessage());
                return false;
            }
        }



}


?>