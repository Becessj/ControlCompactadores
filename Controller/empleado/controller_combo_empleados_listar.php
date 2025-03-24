<?php
require '../../Model/model_empleado.php';

$MC = new Modelo_Empleado();
$consulta = $MC->combo_empleado();

echo json_encode($consulta);
?>
