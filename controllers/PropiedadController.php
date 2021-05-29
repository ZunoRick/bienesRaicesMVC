<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = null;

        $router->render('propiedades/admin',[
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(){
        echo "Crear Propiedad";
    }

    public static function actualizar(){
        echo "Actualizar Propiedad";
    }
}