<?php
require '../../Model/model_reportes.php';

$reporte = new Modelo_Reporte();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "listar_consumo_combustible") {
    echo $reporte->Listar_Consumo_Combustible();
    exit();
}
if ($action === "listar_repuestos_compactador") {
    echo $reporte->Listar_Repuestos_Compactador();
    exit();
}
if ($action === "listar_consumo_repuestos_tiempo") {
    echo $reporte->Listar_Consumo_Repuestos_Tiempo();
    exit();
}
if ($action === "listar_mantenimientos_tipo_por_fecha") {
    $mes = isset($_POST['mes']) ? $_POST['mes'] : date('m');
    $anio = isset($_POST['anio']) ? $_POST['anio'] : date('Y');
    echo $reporte->Listar_Mantenimientos_Tipo_Por_Fecha($mes, $anio);
    exit();
}
if ($action === "listar_documentos_proximos_a_expirar") {
    echo $reporte->Listar_Documentos_Proximos_A_Expirar();
    exit();
}
if ($action === "listar_compactadores_documentacion") {
    echo $reporte->Listar_Compactadores_Documentacion();
    exit();
}
?>
