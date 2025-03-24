<?php
require '../../Model/model_asistencia.php';

$action = $_POST['action'];
$asistencia = new Modelo_Asistencia();

if ($action === "registrar_entrada") {
    $id_asignacion = $_POST['id_asignacion'];
    $persona = $_POST['persona'];
    $firma_entrada = base64_decode($_POST['firma_entrada']);
    
    $response = $asistencia->Registrar_Entrada($id_asignacion, $persona, $firma_entrada);
    echo json_encode($response);
} 

elseif ($action === "registrar_salida") {
    $id_asistencia = $_POST['id_asistencia'];
    $firma_salida = base64_decode($_POST['firma_salida']);

    $response = $asistencia->Registrar_Salida($id_asistencia, $firma_salida);
    echo json_encode($response);
}

elseif ($action === "listar_asistencia") {
    $response = $asistencia->Listar_Asistencia();
    echo json_encode(["data" => $response]);
}

?>
