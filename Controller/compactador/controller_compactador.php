<?php
require '../../Model/model_compactador.php';

$compactador = new Modelo_Compactador();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "listar") {
    echo $compactador->Listar_Compactadores();
    exit();
}
if ($action === "registrar") {
    $codigo = strtoupper(trim($_POST['placa'])); // Convertir a mayúsculas y eliminar espacios
    $descripcion = strtoupper(trim($_POST['descripcion']));
    $marca = strtoupper(trim($_POST['marca']));
    $modelo = strtoupper(trim($_POST['modelo']));

    // Verificar si la placa ya está registrada
    if ($compactador->Existe_Compactador($codigo)) {
        echo json_encode(["success" => false, "duplicado" => true]);
    } else {
        $respuesta = $compactador->Registrar_Compactador($codigo, $descripcion, $marca, $modelo);
        echo json_encode(["success" => $respuesta]);
    }
}

if ($action === "editar") {
    $id = $_POST['id'];
    $descripcion = strtoupper(trim($_POST['descripcion']));
    $marca = strtoupper(trim($_POST['marca']));
    $modelo = strtoupper(trim($_POST['modelo']));
    $estado = strtoupper(trim($_POST['estatus']));

    $respuesta = $compactador->Editar_Compactador($id, $descripcion, $marca, $modelo, $estado);
    
    if ($respuesta) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
if ($action === "total_compactadores") {
    $respuesta = $compactador->Total_Compactadores();
    if ($respuesta) {
        echo json_encode(["success" => true, "data" => json_decode($respuesta, true)]);
    } else {
        echo json_encode(["success" => false]);
    }
}

?>
