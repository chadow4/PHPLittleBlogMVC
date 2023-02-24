<?php

class Comments extends Controller
{

    #route http://localhost/comments/add/:id_article
    public function add()
    {
        if (isset($_POST['content']) && isset($_POST['article_id']) && isset($_POST['article_slug'])) {
            var_dump($_POST['content']);
            var_dump($_POST['article_id']);
            var_dump($_POST['article_slug']);
            $content = htmlspecialchars($_POST['content']);
            $article_id = $_POST['article_id'];
            $article_slug = $_POST['article_slug'];
            $this->loadModel('Comment');
            $this->Comment->addComment($content, $article_id);
            $page = "/mvc/articles/show/" . $article_slug . "#comments";
            header("Refresh: 0; url=$page");
        }
    }

}