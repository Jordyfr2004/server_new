<?php
require_once "interfaces.php";

class Candidato implements Registrable {
    public $nombre;
    public $propuestas;
    public $afiliacion;

    public function __construct($nombre, $propuestas, $afiliacion) {
        $this->nombre = $nombre;
        $this->propuestas = $propuestas;
        $this->afiliacion = $afiliacion;
    }

    public function registrar() {
        echo "✅ Candidato '{$this->nombre}' registrado con afiliación '{$this->afiliacion}'.\n";
    }
}

