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
        $sql = "SELECT articles.id, articles.title, articles.content, articles.slug, users.pseudo AS article_author_pseudo, 
        comments.content AS comment_content, comments.date AS comment_date, comment_user.pseudo AS comment_author_pseudo 
        FROM " . $this->table . " INNER JOIN users ON articles.author_id = users.id 
        LEFT JOIN comments ON articles.author_id = users.id
        LEFT JOIN users AS comment_user ON comments.author_id = comment_user.id
        WHERE `slug`='" . $slug . "'" .
            "ORDER BY comments.date DESC";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
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