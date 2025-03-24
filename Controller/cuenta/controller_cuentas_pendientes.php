<?php
    require '../../model/model_cuenta.php';
    $MU = new Modelo_Cuenta(); //Instanciamos
    $resp = $_POST['resp']; 
/*     $resp = '00071878'; */
    $consulta = $MU ->Listar_Cuentas_Pendientes($resp);
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
