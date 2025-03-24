<?php
require '../../Model/model_asignacion.php';

$asignacion = new Modelo_Asignacion();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "listar") {
    echo $asignacion->Listar_Asignaciones();
    exit();
}
if ($action === "registrar") {
    $compactadorID = $_POST['compactadorID'];
    $personas = json_decode($_POST['personas'], true); // Convertir JSON a array
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $turno = $_POST['turno'];
    $ruta = $_POST['ruta'];
    $usuario = $_POST['usuario'];
    
    $respuesta = $asignacion->Registrar_Asignacion($compactadorID, $personas, $fechaInicio, $fechaFin, $turno, $ruta, $usuario);
    echo json_encode(["success" => $respuesta]);
}

if ($action === "actualizar_estado") {
    $idAsignacion = $_POST['idAsignacion'];
    $estado = $_POST['estado'];
    $usuario = $_POST['usuario'];
    
    $respuesta = $asignacion->Actualizar_Estado_Asignacion($idAsignacion, $estado, $usuario);
    echo json_encode(["success" => $respuesta]);
}
if ($action === "eliminar") {
    $idAsignacion = $_POST['idAsignacion'];
    
    $respuesta = $asignacion->Eliminar_Asignacion($idAsignacion);
    echo json_encode(["success" => $respuesta]);
}


?>