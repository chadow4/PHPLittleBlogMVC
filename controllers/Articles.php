<?php

class Articles extends Controller
{
    #route http://localhost/articles/
    public function index()
    {
        $this->loadModel('Article');
        $articles = $this->Article->getAll();
        $this->render('index', compact('articles'));
    }

    #route http://localhost/articles/show/:slug
    public function show(string $slug)
    {
        // recupération de l'article avec son auteur
        $this->loadModel('Article');
        $article = $this->Article->findBySlug($slug);
        if (!$article) {
            echo "Ce slug ne correspond à aucun article";
            return false;
        }

        // recupération des commentaires de l'article avec leurs auteurs
        $this->loadModel('Comment');
        $article['comments'] = $this->Comment->getCommentsByArticle($article['id']);

        $this->render('show', ['article' => $article]);
    }

    #route http://localhost/articles/add
    public function add()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /mvc/articles");
        }

        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['slug'])) {
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $slug = htmlspecialchars($_POST['slug']);
            $this->loadModel('Article');
            $this->Article->addArticle($title, $content, $slug);
            header("Location: /mvc/articles");
        }
        $this->render('add', []);
    }

}