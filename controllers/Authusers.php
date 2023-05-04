<?php

class Authusers extends Controller
{
    # Route: http://localhost/authusers/register
    # Affiche le formulaire d'inscription et crée un nouvel utilisateur dans la base de données si les données du formulaire sont valides
    public function register()
    {
        $error = null;

        // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
        if(isset($_SESSION['user_id'])) {
            header("Location: /mvc/articles");
        }

        // Traitement des données du formulaire d'inscription
        if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])) {
            $this->loadModel('Authuser');
            $this->Authuser->registerUser($_POST['pseudo'],  $_POST['email'], $_POST['password'])
                ? header("Location: /".APP."/authusers/login") && exit()
                : $error = "Erreur lors de l'inscription";
        }

        // Affichage de la page d'inscription avec une éventuelle erreur
        $this->render('register', ['error' => $error]);
    }

    # Route: http://localhost/authusers/login
    # Affiche le formulaire de connexion et connecte l'utilisateur si les informations sont valides
    public function login()
    {
        // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
        if(isset($_SESSION['user_id'])) {
            header("Location: /".APP."/articles");
        }

        $error = null;

        // Traitement des données du formulaire de connexion
        if (isset($_POST['pseudo']) && isset($_POST['password'])) {
            $pseudo = $_POST['pseudo'];
            $password = $_POST['password'];
            $this->loadModel('Authuser');
            $this->Authuser->loginUser($pseudo, $password)
                ? header("Location: /".APP) && exit()
                : $error = "Erreur lors de la connexion";
        }

        // Affichage de la page de connexion avec une éventuelle erreur
        $this->render('login', ['error' => $error]);
    }

    # Route: non définie dans le code mais possible avec http://localhost/authusers/logout
    # Déconnecte l'utilisateur en détruisant la session et redirige vers la page d'accueil
    public function logout(){
        session_destroy();
        header("Location: /".APP);
    }
}
