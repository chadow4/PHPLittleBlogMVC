<?php

class Article extends Model
{
    public function __construct()
    {
        // Initialise la propriété "table" avec la valeur "articles"
        $this->table = "articles";
        // Initialise la connexion à la base de données en appelant la méthode parent "getConnection"
        $this->getConnection();
    }

    # Retourne un article à partir de son slug
    public function findBySlug(string $slug)
    {
        // Prépare la requête SQL avec une jointure pour récupérer le nom de l'auteur
        $sql = "SELECT articles.id, articles.title, articles.content, articles.slug, users.pseudo AS author 
            FROM " . $this->table . " 
            INNER JOIN users ON articles.author_id = users.id 
            WHERE `slug`=:slug";
        // Utilise la méthode "prepare" de la connexion pour préparer la requête SQL
        $query = $this->_connexion->prepare($sql);
        // Lie le paramètre "slug" à la valeur de la variable $slug
        $query->bindParam(':slug', $slug);
        // Exécute la requête SQL préparée
        $query->execute();
        // Retourne le résultat de la requête sous forme d'un tableau associatif
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    # Ajoute un nouvel article dans la base de données
    public function addArticle(string $title, string $content, string $slug)
    {
        // Prépare la requête SQL pour insérer un nouvel article avec l'ID de l'auteur connecté
        $sql = "INSERT INTO " . $this->table . " (title, content, slug, author_id) VALUES(:title, :content, :slug, :author_id)";
        // Utilise la méthode "prepare" de la connexion pour préparer la requête SQL
        $query = $this->_connexion->prepare($sql);
        $query->bindParam(':title', $title);
        $query->bindParam(':content', $content);
        $query->bindParam(':slug', $slug);
        $query->bindParam(':author_id', $_SESSION['user_id']);
        // Exécute la requête SQL préparée
        $query->execute();
    }
}
