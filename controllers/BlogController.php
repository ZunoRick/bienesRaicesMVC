<?php 

namespace Controllers;

use Model\EntradaBlog;
use MVC\Router;

class BlogController{
    public static function listar(Router $router){
        $entradas = EntradaBlog::all();
        $resultado = $_GET['resultado'] ?? null;
        $urlId = $_GET['id'] ?? null;

        $router->render('blog/admin',[
            'entradas' => $entradas,
            'resultado' => $resultado,
            'urlId' => $urlId
        ]);
    }
}