# Mini Blog MVC en PHP sans framework

<br>

<div align="center">
  <img src="https://i0.wp.com/leblogducodeur.fr/wp-content/uploads/2019/06/creer-un-blog-avec-php.jpg?fit=300%2C168&ssl=1" alt="Logo de votre site">
</div>

<br>

## Présentation du projet 

Ce projet est un petit blog développé en PHP selon l'architecture MVC (Modèle-Vue-Contrôleur). Le but principal de ce projet était de recréer le principe d'un mini-framework en PHP en utilisant seulement du code "vanilla", sans faire appel à un framework existant.

Le développement du projet a été réalisé sans l'utilisation d'un framework, ce qui a permis de mieux comprendre le fonctionnement interne d'un mini-framework et de mieux appréhender les concepts de base en PHP. L'architecture MVC a été utilisée pour organiser le code de manière structurée, ce qui permet une meilleure maintenabilité et évolutivité du projet.

> Dans ce projet, le CSS n'a pas était ma priorité, il es donc très minime :)

## Structure de fichiers

La structure de fichiers du projet est la suivante :

```js

|--- app
|    |--- Controller.php
|    |--- Model.php
|
|--- controllers
|    |--- Articles.php
|    |--- Authusers.php
|    |--- Comments.php
|    |--- Home.php
|
|--- models
|    |--- Article.php
|    |--- Authuser.php
|    |--- Comment.php
|
|--- views
|    |--- articles
|    |    |--- add.php
|    |    |--- index.php
|    |    |--- show.php
|    |
|    |--- authusers
|    |    |--- login.php
|    |    |--- register.php
|    |
|    |--- home
|    |    |--- index.php
|    |
|    |--- layout
|    |    |--- default.php
|
|--- index.php (router)
|
|--- .htaccess

```

- Le dossier app contient les fichiers de base de l'application, le controller.php et le model.php, qui fournissent des fonctionnalités communes aux contrôleurs et aux modèles.
- Le dossier controllers contient les contrôleurs, qui sont responsables de la logique de l'application.
- Le dossier models contient les modèles, qui représentent les données de l'application.
- Le dossier views contient les fichiers de vue, qui affichent les données à l'utilisateur. Les vues sont organisées en dossiers correspondant aux contrôleurs.
- Le dossier layout contient le fichier de mise en page default.php, qui définit la structure de base des pages de l'application.
- Le fichier index.php à la racine fait office de routeur il est le point d'entrée de l'application.
- Le fichier .htaccess est utilisé pour configurer le serveur web.

## Fonctionnalités 

- Afficher une page d'accueil 
- Afficher une page avec la liste des articles.
- Afficher un article individuel avec ses détails.
- Ajouter un nouvel article en utilisant un formulaire.
- Afficher un formulaire de connexion et d'inscription pour les utilisateurs.
- Authentifier un utilisateur avec son nom d'utilisateur et son mot de passe.
- Enregistrer un nouvel utilisateur en utilisant un formulaire.
- Afficher les commentaires pour un article donné.
- Ajouter un nouveau commentaire en utilisant un formulaire.

## Installation 

1. Cloner ce dépôt sur votre ordinateur.
2. Mettre à jour les informations de connexion à la base de données dans le fichier Model.php 
```php
    private $host = "localhost";
    private $db_name = "blog";
    private $username = "root";
    private $password = "";
```
3. Configurer votre serveur web pour qu'il pointe vers le dossier router.
4. Lancer l'application en accédant à l'URL de votre serveur web.
