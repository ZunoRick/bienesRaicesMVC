<?php 

define('TEMPLATES_URL', __DIR__.'/templates');
define('FUNCIONES_URL', __DIR__.'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/public/imagenes/');
define('CARPETA_IMAGENES_BLOG', $_SERVER['DOCUMENT_ROOT'] . '/public/imagenes-blog/');

function incluirTemplate(string $nombre, bool $inicio = false ){
    include TEMPLATES_URL."/${nombre}.php";
}

function estaAutenticado(){
    session_start();
    if (!$_SESSION['login'])
        header('Location: /');
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapa / Sanitizar el HTML
function sane($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar Tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad', 'post'];
    return in_array($tipo, $tipos);
}

//Muestra los mensajes
function mostrarNotificacion($codigo){
    $mensaje = '';
    switch($codigo){
        case 1:
            $mensaje = "Creado correctamente";
            break;
        case 2:
            $mensaje = "Actualizado correctamente";
            break;
        case 3:
            $mensaje = "Eliminado correctamente";
            break; 
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $url){
    //Validar que sea un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id)
        header("Location: ${url}");
    return $id;
}