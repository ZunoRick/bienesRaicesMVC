<?php

namespace Model;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnaBD = ['id', 'nombre', 'apellido', 'telefono', 'email'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $tipo = 'Vendedor';

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
    }

    public function validar(){
        if (!$this->nombre)
            self::$errores[] = "El nombre es obligatorio";

        if (!$this->apellido)
            self::$errores[] = "El apellido es obligatorio";

        if (!$this->telefono)
            self::$errores[] = "El teléfono es obligatorio";

        if ($this->telefono)
            $this->telefono = (str_replace(' ', '', $this->telefono));
        
        if (!$this->email)
            self::$errores[] = "El correo es obligatorio";

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            self::$errores[] = "El correo no es válido";

        if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "Formato de teléfono no válido";
        }

        return self::$errores;
    }
}
