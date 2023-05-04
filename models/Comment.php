<?php

class Comment extends Model
{
    public function __construct()
    {
        $this->table = "comments";
        $this->getConnection(); // Récupère la connexion à la base de données depuis le parent "Model"
    }

    // Fonction pour ajouter un commentaire à un article
    public function addComment(string $content, string $article_id)
    {
        // Insérer le contenu du commentaire, l'ID de l'auteur et l'ID de l'article dans la base de données
        $query = $this->_connexion->prepare('INSERT INTO comments (content,author_id,article_id) VALUES(:content,:author_id,:article_id)');
        $query->bindParam(':content', $content);
        $query->bindParam(':author_id', $_SESSION['user_id']); // Utiliser l'ID de l'utilisateur stocké dans la variable de session "user_id" comme l'ID de l'auteur du commentaire
        $query->bindParam(':article_id', $article_id);
        return $query->execute(); // Retourner "true" si l'insertion a réussi, sinon retourner "false"
    }

    // Fonction pour récupérer les commentaires d'un article
    public function getCommentsByArticle($article_id)
    {
        // Sélectionner les commentaires associés à l'article et inclure le pseudo de l'auteur et la date de création du commentaire
        $sql = "SELECT comments.content, comments.date, users.pseudo AS author
        FROM comments
        INNER JOIN users ON users.id = comments.author_id
        WHERE comments.article_id = :article_id";
        $query = $this->_connexion->prepare($sql);
        $query->bindParam(':article_id', $article_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC); // Retourner un tableau associatif contenant les informations sur les commentaires récupérés
    }
}
