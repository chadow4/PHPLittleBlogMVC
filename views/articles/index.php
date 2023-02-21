<div class="row flex-column">
    <a class="btn btn-primary rounded class mb-5 m-auto col-8 col-md-4 col-lg-2" href="/articles/add">Ajouter un
        article</a>

    <div class="m-auto col-12 col-md-8 col-lg-6">
        <h2 class="text-center">Liste des articles :</h2>
        <?php foreach ($articles as $article): ?>

            <hr>
            <a href="/articles/lire/<?= $article['slug'] ?>"><?= $article['title'] ?></a>

            <p>Contenu : <?= $article['content'] ?></p>


        <?php endforeach ?>
        <hr>
    </div>


</div>

