<?php

class Comment extends Model
{
    public function __construct()
    {
        $this->table = "comments";
        $this->getConnection();
    }

    public function addComment(string $content,string $article_id)
    {
        $query = $this->_connexion->prepare('INSERT INTO comments (content,author_id,article_id) VALUES(:content,:author_id,:article_id)');
        $query->bindParam(':content', $content);
        $query->bindParam(':author_id', $_SESSION['user_id']);
        $query->bindParam(':article_id', $article_id);
        return $query->execute();
    }
}