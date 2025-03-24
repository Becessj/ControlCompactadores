<?php
    require '../../model/model_usuario.php';
    $MU = new Modelo_Usuario(); //Instanciamos
    $consulta = $MU->Cargar_Select_Agno();
    echo json_encode($consulta);
?>
