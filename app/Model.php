<?php

abstract class Model
{
    // Propriétés pour stocker les informations de connexion à la base de données
    private $host = "localhost";
    private $db_name = "blog";
    private $username = "root";
    private $password = "";

    // Propriété pour stocker la connexion PDO à la base de données
    protected $_connexion;

    // Propriété pour stocker le nom de la table liée à ce modèle
    public $table;

    # Méthode pour établir une connexion à la base de données
    public function getConnection()
    {
        $this->_connexion = null;
        try {
            $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // On configure l'encodage des caractères pour éviter les problèmes d'affichage
            $this->_connexion->exec("set names utf8");
        } catch (PDOException $exception) {
            // En cas d'erreur, on affiche un message d'erreur
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    # Méthode pour récupérer un enregistrement de la table en fonction de son identifiant
    public function getOne(string $id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        // On récupère le premier enregistrement correspondant à la requête
        return $query->fetch();
    }

    # Méthode pour récupérer tous les enregistrements de la table
    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        // On récupère tous les enregistrements correspondant à la requête
        return $query->fetchAll();
    }

}
