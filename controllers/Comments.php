<?php

class Comments extends Controller
{

    # Route http://localhost/comments/add/:id_article
    # Ajoute un nouvel article avec une vue add
    public function add()
    {
        // Vérifier si le contenu et les informations de l'article sont présents dans la requête POST
        if (isset($_POST['content']) && isset($_POST['article_id']) && isset($_POST['article_slug'])) {
            // Récupérer les informations du commentaire et de l'article depuis la requête POST
            $content = htmlspecialchars($_POST['content']);
            $article_id = $_POST['article_id'];
            $article_slug = $_POST['article_slug'];
            // Charger le modèle Comment
            $this->loadModel('Comment');
            // Appeler la méthode addComment pour ajouter le commentaire
            $this->Comment->addComment($content, $article_id);
            // Rediriger l'utilisateur vers la page de l'article où le commentaire a été ajouté
            $page = "/mvc/articles/show/" . $article_slug . "#comments";
            header("Refresh: 0; url=$page");
        }
    }

}