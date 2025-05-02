<?php
require_once "interfaces.php";

class Eleccion implements Registrable, Editable {
    public $nombre;
    public $tipo;
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;
    public $reglas;

    public function __construct($nombre, $tipo, $fecha_inicio, $fecha_fin, $descripcion, $reglas = []) {
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->descripcion = $descripcion;
        $this->reglas = $reglas;
    }

    public function registrar() {
        echo "✅ Elección '{$this->nombre}' registrada con éxito.\n";
    }

    public function editar($datos) {
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
        echo "📝 Elección '{$this->nombre}' actualizada.\n";
    }
}

