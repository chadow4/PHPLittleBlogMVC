<div class="card col-12 col-md-6 col-lg-4 px-5 pt-5 m-auto">
    <h2 class="text-center fw-bold">Inscription</h2>

    <?php if ($error != null): ?>
        <div class="alert alert-danger col col-6 m-auto" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <div class="row mb-5">
        <form class="form m-auto d-flex flex-column" method="post"
              action="/<?= APP ?>/authusers/register">
            <div class="form-group">
                <label for="pseudo">Pseudo:</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <button type="submit" class="btn btn-primary col-5 m-auto mt-3">Envoyer</button>
        </form>
    </div>
</div>