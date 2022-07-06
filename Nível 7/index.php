<?php

/**
 * Função que irá buscar a classe passada no parametro da url e 
 * irá fazer o require dela.
 */
spl_autoload_register(function($class){
    if (file_exists($class . '.php'))
    {
        require_once $class . '.php';
    }    
});

// coletamos os parametros das Urls vindos na requisição.
$classe = isset($_REQUEST['class']) ? $_REQUEST['class'] : null;
$metodo = isset($_REQUEST['method']) ? $_REQUEST['method'] : null;

if (class_exists($classe))
{
    $pagina = new $classe( $_REQUEST );
    if (!empty($metodo) && method_exists($classe, $metodo))
    {
        $pagina->$metodo( $_REQUEST );
    }
    $pagina->show();
    
}

