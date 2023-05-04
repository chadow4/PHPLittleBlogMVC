<?php

class Authuser extends Model
{
    public function __construct()
    {
        $this->table = "users";
        $this->getConnection(); // Récupère la connexion à la base de données depuis le parent "Model"
    }

    # Fonction pour enregistrer un utilisateur
    public function registerUser(string $pseudo, string $email, string $password)
    {
        // Vérifier si l'utilisateur existe déjà dans la base de données
        $query = $this->_connexion->prepare('SELECT * FROM users where pseudo = :pseudo');
        $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'e-mail est valide et s'il n'est pas déjà utilisé
        if ($user || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false; // Si l'utilisateur existe déjà ou si l'e-mail n'est pas valide, retourner "false"
        }

        // Hacher le mot de passe avant de l'insérer dans la base de données
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insérer les informations de l'utilisateur dans la base de données
        $query = $this->_connexion->prepare('INSERT INTO users (pseudo,email,password) VALUES(:pseudo, :email, :password)');
        $query->bindParam(':pseudo', $pseudo);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $passwordHash);
        return $query->execute(); // Retourner "true" si l'insertion a réussi, sinon retourner "false"
    }

    # Fonction pour connecter un utilisateur
    public function loginUser(string $pseudo, string $password)
    {
        // Récupérer les informations de l'utilisateur correspondant au pseudo fourni
        $query = $this->_connexion->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
        $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            return false; // Si l'utilisateur n'existe pas, retourner "false"
        }
        // Vérifier si le mot de passe fourni correspond à celui stocké dans la base de données
        return password_verify($password, $user['password']) && session_start() && ($_SESSION['user_id'] = $user['id']);
        // Si le mot de passe est correct, démarrer la session et stocker l'ID de l'utilisateur dans la variable de session "user_id". Retourner "true" si tout s'est bien passé, sinon retourner "false".
    }
}
