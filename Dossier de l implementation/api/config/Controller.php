<?php
abstract class Controller{
    /**
     * Afficher une vue
     *
     * @param string $fichier
     * @param array $data
     * @return void
     */
    public function render(string $fichier, array $data = []){
     
        extract($data);

        ob_start();

        // On génère la vue
        require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$fichier.'.php');
   
        // On stocke le contenu dans $content
        $content = ob_get_clean();
        

        // On fabrique le "template"
        require_once(ROOT.'views/layout/default.php');
    
    }

    /**
     * Permet de charger un modèle
     *
     * @param string $model
     * @return void
     */
    public function loadModel(string $model){
        require_once(ROOT.'Models/'.$model.'.php');
        $this->$model = new $model();
    }

    public function getModel(string $model){
        require_once(ROOT.'Models/'.$model.'.php');
        return new $model();
    }
}