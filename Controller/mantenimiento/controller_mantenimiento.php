<?php
require '../../Model/model_mantenimiento.php';

$mantenimiento = new Modelo_Mantenimiento();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "listar") {
    echo $mantenimiento->Listar_Mantenimiento();
    exit();
}
        
if ($action === "registrar") {
    $codigo = strtoupper(trim($_POST['placa'])); 
    $tipo = strtoupper(trim($_POST['tipo']));
    $categoria = strtoupper(trim($_POST['categoria']));
    $fecha = $_POST['fecha']; // No es necesario usar strtoupper en fechas
    $descripcion = trim($_POST['descripcion']);

    $respuesta = $mantenimiento->Registrar_Mantenimiento($codigo, $tipo, $categoria, $fecha, $descripcion);
    
    echo json_encode(["success" => $respuesta]);
}

if ($action === "editar") {
    $id = $_POST['id'];
    $placa = strtoupper(trim($_POST['idplaca']));
    // $tipo = strtoupper(trim($_POST['tipo']));
    $categoria = strtoupper(trim($_POST['idcategoria']));
    $fecha = strtoupper(trim($_POST['fecha']));
    $descripcion = strtoupper(trim($_POST['descripcion']));
    $estatus = strtoupper(trim($_POST['estatus']));

    $respuesta = $mantenimiento->Editar_Mantenimiento($id, $placa, $categoria, $fecha,$descripcion, $estatus);
    
    if ($respuesta) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
if ($action === "mantenimientos_mensual") {
    $respuesta = $mantenimiento->Mantenimientos_Mensual();
    if ($respuesta) {
        echo json_encode(["success" => true, "data" => json_decode($respuesta, true)]);
    } else {
        echo json_encode(["success" => false]);
    }
}


?>
