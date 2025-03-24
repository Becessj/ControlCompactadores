<?php
require '../../Model/model_repuestos.php';

$repuesto = new Modelo_Repuesto();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "listar") {
    echo $repuesto->Listar_Repuestos($_POST['id_mantenimiento']);
    exit();
}

if ($action === "listar_productos") {
    echo $repuesto->Listar_Productos();
    exit();
}
if ($action === "registrar_todos") {
    $id_mantenimiento = $_POST['id_mantenimiento'];
    $id_compactador = $_POST['id_compactador'];
    $repuestos = json_decode($_POST['repuestos'], true);

    $success = $repuesto->Registrar_Repuestos_Todos($id_mantenimiento, $repuestos,$id_compactador);
    echo json_encode(["success" => $success]);
}


if ($action === "eliminar") {
    $id_repuesto = $_POST['id_repuesto'];
    $success = $repuesto->EliminarRepuesto($id_repuesto);
    echo json_encode(["success" => $success]);
}
if ($action === "frecuencia_repuestos") {
    $id_compactador = $_POST['id_compactador'];
    $frecuencia = $repuesto->Obtener_Frecuencia_Cambios($id_compactador); // Corrección aquí
    echo json_encode($frecuencia);
}

?>
