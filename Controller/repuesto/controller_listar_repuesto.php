<?php
    require '../../model/model_repuestos.php';
    $MU = new Modelo_Repuesto(); //Instanciamos
    $consulta = $MU->Listar_Repuesto();
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
