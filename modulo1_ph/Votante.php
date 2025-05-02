<?php
require_once "interfaces.php";

class Votante implements Registrable {
    public $nombre;
    public $cedula;
    public $habilitado;

    public function __construct($nombre, $cedula, $habilitado = true) {
        $this->nombre = $nombre;
        $this->cedula = $cedula;
        $this->habilitado = $habilitado;
    }

    public function registrar() {
        echo "✅ Votante '{$this->nombre}' con cédula '{$this->cedula}' registrado.\n";
    }
}

