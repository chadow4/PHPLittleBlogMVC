

<div class="row mb-5">
    <h1 class="text-center fw-bold">Ajouter un article</h1>
    <form class="form col-12 col-md-6 col-lg-3 m-auto d-flex flex-column" method="post" action="/mvc/articles/add">
        <div class="form-group">
            <label for="title">Titre:</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="content">Contenu</label>
            <textarea class="form-control" id="content" name="content" rows="4"></textarea>
        </div>
        <div class=" form-group">
            <label for="slug">Slug :</label>
            <input type="text" class="form-control" name="slug" id="slug" required>
        </div>
        <button type="submit" class="btn btn-primary col-5 m-auto mt-3">Envoyer</button>
    </form>
</div>
