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
        $this->loadModel('Article');
        $result = $this->Article->findBySlug($slug);
        if (!$result) {
            echo "Ce slug ne correspond à aucun article";
        }
        $article = array();

        foreach ($result as $row) {
            if (!isset($articles['id'])) {
                $article['id'] = $row['id'];
                $article['title'] = $row['title'];
                $article['slug'] = $row['slug'];
                $article['content'] = $row['content'];
                $article['article_author_pseudo'] = $row['article_author_pseudo'];
            }
            if (isset($row['comment_content'])) {
                $article['comments'][] = array(
                    'comment_content' => $row['comment_content'],
                    'comment_author_pseudo' => $row['comment_author_pseudo'],
                    'comment_date' => $row['comment_date']
                );
            }

        }

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