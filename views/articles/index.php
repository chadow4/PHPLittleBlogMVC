<div class="row flex-column">
    <div class="m-auto col-12 col-md-8 col-lg-6">
        <h1 class="text-center fw-bold">Liste des articles :</h1>
        <?php foreach ($articles as $article): ?>
            <div class="card p-3 my-3 rounded">
                <a href="/mvc/articles/show/<?= $article['slug'] ?>"><?= $article['title'] ?></a>

                <p><?= substr($article['content'], 0, 255) ?>...</p>
            </div>

        <?php endforeach ?>
    </div>
</div>


