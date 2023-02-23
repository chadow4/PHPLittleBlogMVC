<?php

class Article extends Model
{
    public function __construct()
    {
        $this->table = "articles";
        $this->getConnection();
    }

    public function findBySlug(string $slug)
    {
        $sql = "SELECT articles.title, articles.content, users.pseudo AS article_author_pseudo  
        FROM " . $this->table . " INNER JOIN users ON articles.author_id = users.id 
        WHERE `slug`='" . $slug . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function addArticle(string $title, string $content, string $slug)
    {
        $sql = "INSERT INTO " . $this->table . " (title, content, slug,author_id) VALUES(:title, :content, :slug,:author_id)";
        $query = $this->_connexion->prepare($sql);
        $query->bindParam(':title', $title);
        $query->bindParam(':content', $content);
        $query->bindParam(':slug', $slug);
        $query->bindParam(':author_id', $_SESSION['user_id']);
        $query->execute();
    }

}