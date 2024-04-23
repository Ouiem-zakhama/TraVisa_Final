<?php
require_once '../config.php' ;
class userC {
    public function ListUsers(){
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare("SELECT * FROM user");
            $query->execute();
            $result = $query->fetchAll();
            $tableHTML = '<table class="table">';
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
        try {
            // Get database connection
            $conn = Config::getConnexion();
            
            // Prepare SQL statement
            $query = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
            
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
    
    

}

?>