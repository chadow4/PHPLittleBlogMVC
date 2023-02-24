<?php

class Authuser extends Model
{
    public function __construct()
    {
        $this->table = "users";
        $this->getConnection();
    }

    public function registerUser(string $pseudo, string $email, string $password)
    {
        $query = $this->_connexion->prepare('SELECT * FROM users where pseudo = :pseudo');
        $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->_connexion->prepare('INSERT INTO users (pseudo,email,password) VALUES(:pseudo, :email, :password)');
        $query->bindParam(':pseudo', $pseudo);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $passwordHash);
        return $query->execute();

    }

    public function loginUser(string $pseudo, string $password)
    {
        $query = $this->_connexion->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
        $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return (!$user) ? false : (password_verify($password, $user['password']) ?
            (session_start() && ($_SESSION['user_id'] = $user['id']) && true) : false);

    }
}