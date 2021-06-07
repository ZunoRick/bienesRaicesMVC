<?php

namespace Model;

class EntradaBlog extends ActiveRecord
{
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

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->summary = $args['summary'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->fecha = date('Y/m/d');
        $this->autor = $args['autor'] ?? '';
    }

    public function validar()
    {
        if (!$this->titulo)
            self::$errores[] = "Debes añadir un titulo";

        if (!$this->summary)
            self::$errores[] = "Debes añadir un resumen";

        if ( strlen($this->summary) > 200)
            self::$errores[] = "El resumen es demasiado largo";

        if (strlen($this->contenido) < 50)
            self::$errores[] = "La entrada del blog debe contener al menos 50 caracteres";

        if (!$this->autor)
            self::$errores[] = "El autor es obligatorio";
            
        return self::$errores;
    }
}
