<?php
//ingresar el comando en la terminal para ejecutar      php index.php
require_once "Eleccion.php";
require_once "Candidato.php";
require_once "Votante.php";
require_once "funciones.php";

// === Registro de elección ===
echo "=== Registro de Elección ===\n";
$nombreEleccion = readline("Nombre de la elección: ");
$tipoEleccion = readline("Tipo de elección: ");
$fecha = readline("Fecha de inicio (YYYY-MM-DD): ");
$horaInicio = readline("Hora de inicio (HH:MM): ");
$fechaFin = readline("Fecha de fin (YYYY-MM-DD): ");
$horaFin = readline("Hora de fin (HH:MM): ");
$descripcion = readline("Descripción: ");
$votosPorPersona = (int)readline("Número de votos por persona: ");
$tiposPermitidos = readline("Tipos de votos permitidos (separados por coma): ");
$tipos = array_map("trim", explode(",", $tiposPermitidos));

// Combinar fecha y hora
$fechaHoraInicio = "$fecha $horaInicio";
$fechaHoraFin = "$fechaFin $horaFin";

// Crear reglas
$reglas = [
    "votos_por_persona" => $votosPorPersona,
    "tipos_permitidos" => $tipos
];

// Crear elección
$eleccion = new Eleccion(
    $nombreEleccion,
    $tipoEleccion,
    $fechaHoraInicio,
    $fechaHoraFin,
    $descripcion,
    $reglas
);
$eleccion->registrar();

// === Registro de múltiples candidatos ===
echo "\n=== Registro de Candidatos ===\n";
$numCandidatos = (int)readline("¿Cuántos candidatos desea registrar?: ");
$candidatos = [];

for ($i = 1; $i <= $numCandidatos; $i++) {
    echo "\n--- Candidato #$i ---\n";
    $nombreCandidato = readline("Nombre del candidato: ");
    $propuestasRaw = readline("Propuestas (separadas por coma): ");
    $propuestas = array_map("trim", explode(",", $propuestasRaw));
    $afiliacion = readline("Afiliación política: ");

    $candidato = new Candidato($nombreCandidato, $propuestas, $afiliacion);
    $candidatos[] = $candidato;
    ejecutarRegistro($candidato, fn($c) => $c->registrar());
}

// === Registro de votante ===
echo "\n=== Registro de Votante ===\n";
$nombreVotante = readline("Nombre del votante: ");
$cedula = readline("Cédula: ");

$votante = new Votante($nombreVotante, $cedula);
ejecutarRegistro($votante, fn($v) => $v->registrar());

// Simulación async/await
echo "\n=== Simulación de guardado (async) ===\n";
async(function () {
    yield promesaRegistro("Guardando elección en la base de datos");
    yield promesaRegistro("Guardando candidatos");
    yield promesaRegistro("Guardando votantes");
});


