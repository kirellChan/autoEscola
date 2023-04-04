<?php
// credencias de acesso ao BD
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DBNAME','autoEscola');

spl_autoload_register(function($class){
    $pathControllers = 'Controllers/'.$class.'.class.php';
    $pathModels = 'Models/'.$class.'.class.php';
    $pathViews = 'Views/'.$class.'.class.php';
    $pathClass = 'class/'.$class.'.class.php';
    if(file_exists($pathControllers)){
        require_once $pathControllers;
    }elseif (file_exists($pathModels)) {
        require_once $pathModels;
    }elseif (file_exists($pathViews)) {
        require $pathViews;
    }else {
        require $pathClass;
    }
});