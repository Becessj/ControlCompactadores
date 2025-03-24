<?php
    require '../../model/model_cargo.php';
    $MU = new Modelo_Cargo(); //Instanciamos
    $consulta = $MU ->Listar_Cargos();
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


