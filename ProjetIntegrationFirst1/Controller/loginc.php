<?php
// Database configuration file (config.php) assumed to be included here
require_once '../../config.php'; 

class loginc{
// Function to check if a user exists in the database
public function checkUserExists($email, $password) {
    // Get database connection
    $conn = config::getConnexion();
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

// Function to fetch user details by email
public function selectUser($email) {
    $conn = config::getConnexion();
    try {
        $query = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

// Function to check if an email is unique in the database
public function isEmailUnique($email) {
    $conn = config::getConnexion();
    try {
        $query = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $count = $query->fetchColumn();
        return $count == 0; // Return true if email is unique, false otherwise
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Function to add a new user account to the database
public function addAccount($nom, $prenom, $email, $password) {
    $conn = config::getConnexion();
    try {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = $conn->prepare("INSERT INTO user (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)");
        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hashedPassword);
        $query->execute();
        return true; // Return true if the account is added successfully
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; // Return false if an error occurs
    }
}

public function selectemail($email)
{
    $conn = config::getConnexion();
    try {
        $query = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result; // Return user data if found
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null; // Return null if an error occurs
    }
}

}
// Continue with the rest of your code, incorporating these functions as needed
?>
