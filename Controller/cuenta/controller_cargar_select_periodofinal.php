<?php
    require '../../model/model_cuenta.php';
    $MU = new Modelo_Cuenta(); //Instanciamos
    $consulta = $MU->Cargar_Select_Todos_Periodos();
    echo json_encode($consulta);
?>
