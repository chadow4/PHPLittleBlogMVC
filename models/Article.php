<?php

require_once('./models/Article.php');
class Article extends Model
{
    public function __construct()
    {
        $this->table = "articles";
        $this->getConnection();
    }
    public function findBySlug(string $slug)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE `slug`='" . $slug . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function addArticle(string $title, string $content, string $slug)
    {
        $sql = "INSERT INTO " . $this->table . " (title, content, slug) VALUES(:title, :content, :slug)";
        $query = $this->_connexion->prepare($sql);
        $query->bindParam(':title', $title);
        $query->bindParam(':content', $content);
        $query->bindParam(':slug', $slug);
        $query->execute();
    }

}