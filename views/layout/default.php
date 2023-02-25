<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BLOG JULIEN INSA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap');

    *{
        font-family: 'Tilt Warp', cursive;
    }

    html{
        scroll-behavior: smooth;
    }

    header {
        background: #136c72;
        font-family: "Roboto", sans-serif;
    }

    .logo {
        text-decoration: none;
        color: #fff;
        font-size: 2rem;
        font-weight: bold;
    }

    .nav__link {
        list-style: none;
    }

    .nav__link {
        color: #fff;
        text-decoration: none;
        text-transform: uppercase;
    }

    .nav__link:hover {
        opacity: 0.75;
    }

    .nav__link--button {
        background: #fff;
        color: #136c72;
        padding: 0.5em 1em;
        border-radius: 10rem;
    }

    .nav__list--primary, .nav__list {
        /* IMPORTANT!!!: it will make element centralized */
        margin: 0 auto;
        font-weight: bold;
    }

    .nav__item {
        list-style: none;
    }


</style>
<header class="row align-items-center py-3 m-0">
    <div class="col col-12 col-lg-4 text-center">
        <a class="logo" href="/mvc">BLOG JULIEN INSA</a>
    </div>
    <ul class="mt-3 mt-lg-0 col-12 col-lg-4 d-flex align-items-center justify-content-center gap-5 nav__list nav__list--primary">
        <li class="nav__item"><a href="/mvc" class="nav__link">Accueil</a></li>
        <li class="nav__item"><a href="/mvc/articles" class="nav__link">Liste articles</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav__item"><a href="/mvc/articles/add" class="nav__link">Ajouter article</a></li>
        <?php endif; ?>
    </ul>
    <ul class="mt-3 mt-lg-0 col-12 col-lg-4 d-flex align-items-center justify-content-center gap-5 nav__list">
        <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav__item"><a href="/mvc/authusers/logout" class="nav__link nav__link--button">Déconnexion</a>
            </li>
        <?php else: ?>
            <li class="nav__item"><a href="/mvc/authusers/login" class="nav__link">Connexion</a></li>
            <li class="nav__item"><a href="/mvc/authusers/register" class="nav__link nav__link--button">Inscription</a>
            </li>
        <?php endif; ?>
    </ul>

</header>

<main class="container-fluid mt-5 col-12">
    <?= $content ?>
</main>
<footer>
    <p class="text-center">Copyright 2022</p>
</footer>
</body>
</html>
