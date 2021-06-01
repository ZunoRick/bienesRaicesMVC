<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router){
        $router -> render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $router -> render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router){
        $id = validarORedireccionar('/public/');
        $propiedad = Propiedad::find($id);
        
        if (is_null($propiedad))
            header("Location: /public/propiedades");

        $router ->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router){
        $router -> render('paginas/blog', []);
    }

    public static function entrada(){
        echo "Desde entrada";
    }

    public static function contacto(){
        echo "Desde contacto";
    }
}