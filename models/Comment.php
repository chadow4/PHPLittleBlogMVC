<?php

class Comment extends Model
{
    public function __construct()
    {
        $this->table = "comments";
        $this->getConnection();
    }

    public function addComment(string $content, string $article_id)
    {
        $query = $this->_connexion->prepare('INSERT INTO comments (content,author_id,article_id) VALUES(:content,:author_id,:article_id)');
        $query->bindParam(':content', $content);
        $query->bindParam(':author_id', $_SESSION['user_id']);
        $query->bindParam(':article_id', $article_id);
        return $query->execute();
    }

    public function getCommentsByArticle($article_id)
    {
        $sql = "SELECT comments.content, comments.date, users.pseudo AS author
        FROM comments
        INNER JOIN users ON users.id = comments.author_id
        WHERE comments.article_id = :article_id";
        $query = $this->_connexion->prepare($sql);
        $query->bindParam(':article_id', $article_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}