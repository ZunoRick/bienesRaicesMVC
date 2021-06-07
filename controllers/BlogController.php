<?php 

namespace Controllers;

use Model\EntradaBlog;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

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

    public static function crear(Router $router){
        $entrada = new EntradaBlog();
        $errores = EntradaBlog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $entrada = new EntradaBlog($_POST['entrada']);
            
            //Valida si se subio una imagen, de lo contrario toma una imagen predeterminada
            if ($_FILES['entrada']['tmp_name']['imagen']) {
                //Generar un nombre único
                $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";
                $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800,600);
                $entrada->setImagen($nombreImagen);
            } else{
                $nombreImagen = "ImagenBlog.jpg";
                $image = Image::make("../src/img/blog3.jpg")->fit(800,600);
                $entrada->setImagen($nombreImagen);
            }

            $errores = $entrada->validar();
            
            //Revisar que el arreglo de errores esté vacío
            if (empty($errores)) {
                //Crear una carpeta
                if (!is_dir(CARPETA_IMAGENES_BLOG)) {
                    mkdir(CARPETA_IMAGENES_BLOG);
                }
    
                //Guarda en la base de datos
                $entrada->guardar();
                
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES_BLOG . $nombreImagen);
            } 
        }

        $router->render('blog/crear', [
            'errores' => $errores,
            'entrada' => $entrada
        ]);
    }   

    public static function actualizar(){
        echo "Desde Actualizar";
    }   
}