<?php
require '../../model/model_mantenimiento.php';

$MU = new Modelo_Mantenimiento();
header('Content-Type: application/json');
echo json_encode($MU->Listar_Eventos());
?>
