<?php 

namespace Model;

class EntradaBlog extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'blog';
    protected static $columnaBD = ['id', 'titulo', 'summary', 'imagen', 'contenido', 'fecha', 'autor'];

    public $id;
    public $titulo;
    public $summary;
    public $imagen;
    public $contenido;
    public $fecha;
    public $autor;
    public $tipo = 'Entrada';
}