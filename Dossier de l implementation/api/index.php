<?php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT . 'config/Model.php');
require_once(ROOT . 'config/Controller.php');

$params = explode('/', $_GET['p']);

if ($params[0] != "")
 {
    $controller = ucfirst($params[0]);
    
    $action = isset($params[1]) ? $params[1] : 'index';

  
    if (file_exists(ROOT . 'controllers/' . $controller . '.php')) {
    }
    require_once(ROOT . 'controllers/' . $controller . '.php');



    // On instancie le contrôleur
    $controller = new $controller();

    if (method_exists($controller, $action)) 
    {
        unset($params[0]);
        unset($params[1]);

        call_user_func_array([$controller, $action], $params);
        
    } else
     {
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
    
} else
 {
  
    require_once(ROOT . 'controllers/App.php');

    $controller = new App();

    $controller->index();
}