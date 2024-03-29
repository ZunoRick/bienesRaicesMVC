<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        //Muestra Mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        $urlId = $_GET['id'] ?? null;

        $router->render('propiedades/admin',[
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado,
            'urlId' => $urlId
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            /* Crea una nueva instancia */
            $propiedad = new Propiedad($_POST['propiedad']);
    
            /** Subida de archivos **/
            //Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";
    
            /*Setear la imagen*/
            //Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
    
            /*Validar */
            $errores = $propiedad->validar();
            
            //Revisar que el arreglo de errores esté vacío
            if (empty($errores)) {
                //Crear una carpeta
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
    
                //Guarda en la base de datos
                $propiedad->guardar();
                
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }   
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/public/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if (!$propiedad) {
            header('Location: /public/admin');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Asignar los atributos
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
    
            $errores = $propiedad->validar();
            //Revisar que el arreglo de errores esté vacío
            if (empty($errores)) {
                
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    
                    //Generar un nombre único
                    $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";
    
                    //Realiza un resize a la imagen con intervention
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
    
                    /*Setear la imagen*/
                    $propiedad->setImagen($nombreImagen);
    
                    //Guarda la imagen en el servidor
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
    
                $propiedad->guardar();
            }   
        }

        $router->render('propiedades/actualizar',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            //Validar ID
            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}