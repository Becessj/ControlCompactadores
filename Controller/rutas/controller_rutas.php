<?php
require '../../Model/model_rutas.php';

$ruta = new Modelo_Rutas();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "listar") {
    echo $ruta->Listar_Rutas();
    exit();
}

if ($action === "registrar") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    echo $ruta->Registrar_Ruta($nombre, $descripcion, $estado);
    exit();
}
if ($action === "editar") {
    $id_ruta = $_POST['id_ruta'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    echo $ruta->Editar_Ruta($id_ruta, $nombre, $descripcion, $estado);
    exit();
}

?>
