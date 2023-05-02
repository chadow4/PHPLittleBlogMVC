<div class="row">
    <div class="card my-0 my-md-5 p-3 p-md-5 col-12 col-md-8 m-auto">
        <h1 class="fw-lighter text-decoration-underline"><?= $article['title'] ?></h1>
        <p class="mt-3"><?= $article['content'] ?></p>
        <hr>
        <p class="fw-bold">rédigé par: <?= $article['author'] ?></p>
    </div>
</div>

<?php if (isset($_SESSION['user_id'])) : ?>
    <div class="row mb-5">
        <h3 class="text-center fw-bold">Ajouter un commentaire</h3>
        <form class="form col-12 col-md-4 m-auto d-flex flex-column" method="post" action="/mvc/comments/add">
            <input type="hidden" name="article_id" value="<?= $article['id']; ?>">
            <input type="hidden" name="article_slug" value="<?= $article['slug']; ?>">
            <div class="form-group">
                <label class="form-label" for="content"></label>
                <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary col-5 m-auto mt-3 w-25">Envoyer</button>
        </form>
    </div>

<?php else: ?>
    <div class="alert alert-info m-auto col col-md-5 col-lg-3 mb-5 text-center p-x-0" role="alert">
        Vous devez être connecté afin de mettre un commentaire !
    </div>
<?php endif; ?>

<h2 id="comments" class="text-center">Liste des commentaires
    (<?= !empty($article['comments']) ? sizeof($article['comments']) : 0 ?>
    ) : </h2>
<?php if (!empty($article['comments'])): ?>
<div class="d-flex my-5 justify-content-center align-items-center flex-column">
    <?php foreach ($article['comments'] as $comment): ?>
        <div class="card col-12 col-md-8 col-lg-4 my-2 p-4 shadow-lg">
            <p class="m-0 text-primary fw-bold"><?= $comment['author'] ?></p>
            <span><?= $comment['date'] ?></span>
            <hr>
            <p class="m-0"><?= $comment['content'] ?></p>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
