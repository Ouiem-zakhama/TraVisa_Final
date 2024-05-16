<?php
require_once '../../config.php' ;
class userC {
    public function ListUsers(){
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare("SELECT * FROM user");
            $query->execute();
            $result = $query->fetchAll();
            $tableHTML = '<table class="table" id="UserTable">';
            $tableHTML .= '<thead>';
            $tableHTML .= '<tr>';
            $tableHTML .= '<th>ID</th>';
            $tableHTML .= '<th>Nom</th>';
            $tableHTML .= '<th>Prenom</th>';
            $tableHTML .= '<th>Email</th>';
            $tableHTML .= '<th>Password</th>';
            $tableHTML .= '<th>NumTel</th>';
            $tableHTML .= '<th>Role</th>';
            $tableHTML .= '</tr>';
            $tableHTML .= '</thead>';
            $tableHTML .= '<tbody>';
            
            
        foreach ($result as $row) {
            $tableHTML .= '<tr>';
                $tableHTML .= '<td>'.$row['id_user'].'</td>';
                $tableHTML .= '<td>'.$row['nom'].'</td>';
                $tableHTML .= '<td>'.$row['prenom'].'</td>';
                $tableHTML .= '<td>'.$row['email'].'</td>';
                $tableHTML .= '<td>'.$row['password'].'</td>';
                $tableHTML .= '<td>'.$row['numTel'].'</td>';
                $tableHTML .= '<td>'.$row['role'].'</td>';
            $tableHTML .= '<td><button class="btn btn-danger btn-delete" data-id="' . $row['id_user'] . '">Delete</button></td>';
            $tableHTML .= '<td><button class="btn btn-primary btn-update" data-id="' . $row['id_user'] . '" data-name="' . htmlspecialchars($row['nom']) . '" data-prenom="' . htmlspecialchars($row['prenom']) . '" data-email="' . htmlspecialchars($row['email']) . '" data-password="' . htmlspecialchars($row['password']) . '" data-numTel="' . htmlspecialchars($row['numTel']) . '" data-role="' . htmlspecialchars($row['role']) . '">Update</button></td>';
    
            $tableHTML .= '</tr>';
            }
            
            $tableHTML .= '</tbody>';
            $tableHTML .= '</table>';
            
            return $tableHTML;
        } catch ( Exeption $e) {
            die ('Error : ' . $e->getMessage());
            return '' ;
        }
    }
    public function addUser2($id_user,$nom,$prenom,$email,$password,$numTel,$role){
        $conn = config::getConnexion();
    try {

        /**Préparer l'instruction */
        $requette = $conn->prepare("INSERT INTO user(id_user,nom,prenom,email,password,numTel,role) VALUES (:id_user,:nom,:prenom,:email,:password,:numTel,:role)");

        //**********************bind pour associer des valeurs spécifiques à chaque paramètre de la requête préparée*************
        $requette->bindParam(':id_user', $id_user);
        $requette->bindParam(':nom', $nom);
        $requette->bindParam(':prenom', $prenom);
        $requette->bindParam(':email', $email);
        $requette->bindParam(':password', $password);
        $requette->bindParam(':numTel', $numTel);
        $requette->bindParam(':role', $role);
        $requette->execute();

        } catch (PDOException $e) {
        echo 'echec de ajout:' . $e->getMessage();
        }
    }
    public function addUser1($id_user,$nom,$prenom,$email,$password,$numTel,$role){
        $conn = config::getConnexion();
    try {

        /**Préparer l'instruction */
        $requette = $conn->prepare("INSERT INTO user(id_user,nom,prenom,email,password,numTel,role) VALUES (:id_user,:nom,:prenom,:email,:password,:numTel,:role)");

        //**********************bind pour associer des valeurs spécifiques à chaque paramètre de la requête préparée*************
        $requette->bindParam(':id_user', $id_user);
        $requette->bindParam(':nom', $nom);
        $requette->bindParam(':prenom', $prenom);
        $requette->bindParam(':email', $email);
        $requette->bindParam(':password', $password);
        $requette->bindParam(':numTel', $numTel);
        $requette->bindParam(':role', $role);
        $requette->execute();
        if ($requette->rowCount() > 0) {
            return true; // Voyage added successfully
        } else {
            return false; // Failed to add voyage
        }
        } catch (PDOException $e) {
        echo 'echec de ajout:' . $e->getMessage();
        return false;
        }
    }
    public function deleteUser($userId) {
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare("DELETE FROM user WHERE id_user = :id_user");
            $query->bindParam(':id_user', $userId);
            $query->execute();
            return true; // Deletion successful
        } catch (PDOException $e) {
            return false; // Deletion failed
        }
    }
    
    public function updateUser($userId, $updateName, $updatePrenom, $updateEmail, $updatePassword, $updateNumTel, $updateRole) {
        $conn = config::getConnexion();
        try {
            // Prepare SQL statement to update user data
            $query = $conn->prepare("UPDATE user SET nom = :nom, prenom = :prenom, email = :email, password = :password, numTel = :numTel, role = :role WHERE id_user = :id_user");

            // Bind parameters
            $query->bindParam(':id_user', $userId);
            $query->bindParam(':nom', $updateName);
            $query->bindParam(':prenom', $updatePrenom);
            $query->bindParam(':email', $updateEmail);
            $query->bindParam(':password', $updatePassword);
            $query->bindParam(':numTel', $updateNumTel);
            $query->bindParam(':role', $updateRole);

            // Execute the query
$query->execute();

echo $query->rowCount() . ' enregistrements mis à jour avec succès';

        } catch (PDOException $e) {
            // Log the error message
            die('Error updating user: ' . $e->getMessage());
        
        }
        
    }


    public function userExists($email, $password) {
         // Get database connection
         $conn = Config::getConnexion();
        try {
            // Prepare SQL statement
            $query = $conn->prepare("SELECT * FROM user WHERE email = :email AND password = :password");
            
            // Bind parameters
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            
            // Execute query
            $query->execute();
            
            // Fetch user data
            $user = $query->fetch(PDO::FETCH_ASSOC);
            
            return $user; // Return user data if found
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null; // Return null if an error occurs
        }
    }
    
    public function getUserName($email) {
        $conn = Config::getConnexion();
        try {
            $query = $conn->prepare("SELECT name FROM users WHERE email = :email");
            $query->bindParam(':email', $email);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['name'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function generateRoleStatistics() {
        $conn = config::getConnexion();
        try {
            // Count of Users by Role
            $query = $conn->prepare("SELECT role, COUNT(*) as user_count FROM user GROUP BY role");
            $query->execute();
            $userCountByRole = $query->fetchAll();
    
            // Percentage Distribution of Users by Role
            $query = $conn->prepare("SELECT role, COUNT(*) * 100.0 / (SELECT COUNT(*) FROM user) as percentage FROM user GROUP BY role");
            $query->execute();
            $percentageDistributionByRole = $query->fetchAll();
    
            // Role-based Aggregations
            $query = $conn->prepare("SELECT role, SUM(numTel) as total_phone_numbers FROM user GROUP BY role");
            $query->execute();
            $roleAggregations = $query->fetchAll();
    
            // Role-based Comparison
            $query = $conn->prepare("SELECT role, AVG(numTel) as avg_numTel FROM user GROUP BY role");
            $query->execute();
            $roleComparisons = $query->fetchAll();
    
            // Return the statistics
            return array(
                'user_count_by_role' => $userCountByRole,
                'percentage_distribution_by_role' => $percentageDistributionByRole,
                'role_aggregations' => $roleAggregations,
                'role_comparisons' => $roleComparisons
            );
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }
    
    public function logOperation($operation, $item_id) {
        $sql = "INSERT INTO crud_log (operation, item_id) VALUES (:operation, :item_id)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':operation', $operation);
            $query->bindParam(':item_id', $item_id);
            $query->execute();
            echo $query->rowCount() . " record logged successfully <br>";
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function fetchLogEntries() {
        try {
            $db = config::getConnexion();
            $stmt = $db->query("SELECT * FROM crud_log ORDER BY timestamp DESC");
            $log_entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $log_entries;
        } catch(PDOException $e) {
            echo "Error fetching log entries: " . $e->getMessage();
            return false;
        }
    }

}

?>