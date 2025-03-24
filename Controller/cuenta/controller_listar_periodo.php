<?php
    require '../../model/model_cuenta.php';
    $MU = new Modelo_Cuenta(); //Instanciamos
    $agno = $_POST['agno1']; 
    $consulta = $MU ->Listar_Periodo($agno);
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
