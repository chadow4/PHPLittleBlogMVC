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

    #route http://localhost/articles/lire/slug
    public function lire(string $slug)
    {
        $this->loadModel('Article');
        $article = $this->Article->findBySlug($slug);
        if ($article) {
            $this->render('lire', compact('article'));
        } else {
            echo "Ce slug ne correspond à aucun article";
        }
    }

    #route http:localhost/articles/add
    public function add()
    {
        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['slug'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $slug = $_POST['slug'];
            $this->loadModel('Article');
            $this->Article->addArticle($title, $content, $slug);
            echo "nouvel utilisateur";
        }
        $this->render('add', []);
    }

}