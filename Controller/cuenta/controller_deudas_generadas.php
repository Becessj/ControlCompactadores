<?php
    require '../../model/model_cuenta.php';
    $MU = new Modelo_Cuenta(); //Instanciamos
    $resp = $_POST['resp']; 
    $periodoini = $_POST['periodoini']; 
    $periodofin = $_POST['periodofin']; 
    $predio = $_POST['predio']; 

/*     $resp = 'RES000162'; 
    $periodoini = '2023-01';
    $periodofin = '2023-12'; 
    $predio = 'PUZZZZZZ';  */

    $consulta = $MU ->Listar_Deudas_Generadas($resp,$periodoini,$periodofin,$predio);
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
