<?php

class Authusers extends Controller
{

    #route http://localhost/authusers/register

    public function register()
    {
        $error = null;
        if(isset($_SESSION['user_id'])) {
            header("Location: /mvc/articles");
        }
        if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])) {
            $pseudo = $_POST['pseudo'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $this->loadModel('Authuser');
            $this->Authuser->registerUser($pseudo, $email, $password) ? header("Location: /mvc/authusers/login")
                && exit() : $error = "Erreur lors de l'inscription";

        }
        $this->render('register', ['error' => $error]);
    }

    #route http://localhost/authusers/login
    public function login()
    {
        if(isset($_SESSION['user_id'])) {
            header("Location: /mvc/articles");
        }
        $error = null;
        if (isset($_POST['pseudo']) && isset($_POST['password'])) {
            $pseudo = $_POST['pseudo'];
            $password = $_POST['password'];
            $this->loadModel('Authuser');
            $this->Authuser->loginUser($pseudo, $password) ? header("Location: /mvc")
                && exit() : $error = "Erreur lors de la connexion";
        }
        $this->render('login', ['error' => $error]);
    }

    public function logout(){
        session_destroy();
        header("Location: /mvc");
    }
}