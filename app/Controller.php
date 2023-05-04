<?php

abstract class Controller
{
    // Méthode permettant de charger un modèle
    public function loadModel(string $model)
    {
        require_once(ROOT . 'models/' . $model . '.php');
        // On crée une nouvelle instance du modèle et on la stocke dans une propriété de l'objet courant
        $this->$model = new $model();
    }

    // Méthode permettant de générer une vue en utilisant un template par défaut
    public function render(string $vue, array $data = [])
    {
        extract($data);

        // On démarre le buffer de sortie pour éviter d'afficher le contenu immédiatement
        ob_start();

        // On génère la vue en incluant le fichier PHP correspondant
        require_once(ROOT . 'views/' . strtolower(get_class($this)) . '/' . $vue . '.php');

        // On stocke le contenu dans $content
        $content = ob_get_clean();

        // On fabrique le "template" en incluant le fichier de layout par défaut
        require_once(ROOT . 'views/layout/default.php');
    }
}
