<?php
require '../../Model/model_combustible.php';

$combustible = new Modelo_Combustible();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "listar") {
    echo $combustible->Listar_Combustible();
    exit();
}

if ($action === "registrar") {
    $id_compactador = strtoupper(trim($_POST['id_compactador'])); 
    $fecha = $_POST['fecha'];
    $litros = $_POST['litros'];
    $precio = $_POST['precio'];
    $boleta = strtoupper(trim($_POST['boleta'])); 
    $total = $_POST['total'];

    $respuesta = $combustible->Registrar_Combustible($id_compactador, $fecha, $litros, $precio, $boleta,$total);
    echo json_encode(["success" => $respuesta]);
}

if ($action === "editar") {
    $id_combustible = $_POST['id_combustible'];
    $fecha = $_POST['fecha'];
    $litros = $_POST['litros'];
    $precio = $_POST['precio'];
    $total = $_POST['total'];
    $boleta = $_POST['boleta'];
    $estatus = $_POST['estatus'];

    $respuesta = $combustible->Editar_Combustible($id_combustible, $fecha, $litros, $precio,$total, $boleta,$estatus);
    
    if ($respuesta) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
if ($action === "consumo_mensual") {
    $respuesta = $combustible->Combustible_Mensual();
    if ($respuesta) {
        echo json_encode(["success" => true, "data" => json_decode($respuesta, true)]);
    } else {
        echo json_encode(["success" => false]);
    }
}


?>
