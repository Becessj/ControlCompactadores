<?php
require '../../Model/model_compactador.php';

$MC = new Modelo_Compactador();
$consulta = $MC->combo_placa();

echo json_encode($consulta);
?>
