<?php

class Articles extends Controller
{
    # Route: http://localhost/articles/
    # Affiche tous les articles avec une vue index
    public function index()
    {
        $this->loadModel('Article');
        $articles = $this->Article->getAll();
        $this->render('index', compact('articles'));
    }

    # Route: http://localhost/articles/show/:slug
    # Affiche un article spécifique avec ses commentaires avec une vue show
    public function show(string $slug)
    {
        // Récupération de l'article avec son auteur
        $this->loadModel('Article');
        $article = $this->Article->findBySlug($slug);

        if (!$article) {
            echo "Ce slug ne correspond à aucun article";
            return false;
        }

        // Récupération des commentaires de l'article avec leurs auteurs
        $this->loadModel('Comment');
        $article['comments'] = $this->Comment->getCommentsByArticle($article['id']);

        $this->render('show', ['article' => $article]);
    }

    # Route: http://localhost/articles/add
    # Ajoute un nouvel article avec une vue add
    public function add()
    {
        // Vérification de la connexion de l'utilisateur
        if (!isset($_SESSION['user_id'])) {
            header("Location: /".APP."/articles");
        }

        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['slug'])) {
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $slug = htmlspecialchars($_POST['slug']);
            $this->loadModel('Article');
            $this->Article->addArticle($title, $content, $slug);
            header("Location: /".APP."/articles");
        }

        // Affichage du formulaire pour ajouter un article
        $this->render('add', []);
    }
}
