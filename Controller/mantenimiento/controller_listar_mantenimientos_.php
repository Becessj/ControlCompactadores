<?php
    require '../../model/model_mantenimiento.php';
    $MU = new Modelo_Mantenimiento(); //Instanciamos
    $consulta = $MU ->Listar_Mantenimiento();
    if($consulta){
        echo json_encode($consulta);
    }else{
        echo '{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }
?>
