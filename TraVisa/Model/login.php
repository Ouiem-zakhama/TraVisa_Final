<?php

class Login
{
    private $userNom;
    private $userPrenom;
    private $email;
    private $mdp;

    // Constructor
    public function __construct()
    {
        // Optional: You can initialize attributes here if needed
    }

    // Setter for userNom
    public function setUserNom($userNom)
    {
        $this->userNom = $userNom;
    }

    // Getter for userNom
    public function getUserNom()
    {
        return $this->userNom;
    }

    // Setter for userPrenom
    public function setUserPrenom($userPrenom)
    {
        $this->userPrenom = $userPrenom;
    }

    // Getter for userPrenom
    public function getUserPrenom()
    {
        return $this->userPrenom;
    }

    // Setter for email
    public function setEmail($email)
    {
        $this->email = $email;
    }

    // Getter for email
    public function getEmail()
    {
        return $this->email;
    }

    // Setter for mdp (password)
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    // Getter for mdp (password)
    public function getMdp()
    {
        return $this->mdp;
    }

    // Other setters and getters for additional attributes can be added as needed
}

?>
