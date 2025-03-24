<?php
require '../../Model/model_compactador.php';

header('Content-Type: application/json'); // Asegurar que el navegador interprete JSON

$MC = new Modelo_Compactador();
$consulta = $MC->combo_categoria();

echo json_encode($consulta);
?>
