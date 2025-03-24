<?php
    require '../../model/model_cuenta.php';
    $MU = new Modelo_Cuenta(); //Instanciamos
    $agno = $_POST['agno']; 
    $generador = $_POST['generador']; 
    $fraccionar = $_POST['fraccionar']; 
    $periodoini = $_POST['periodoini']; 
    $periodofin = $_POST['periodofin']; 
    $gastoadm = $_POST['gastoadm']; 
    $clave = $_POST['clave']; 
    $usuario = $_POST['usuario']; 
    $error = $_POST['error']; 
    $nroerror = $_POST['nroerror']; 
/*     $agno = '2023'; 
    $generador = 'LIMPPU'; 
    $fraccionar = 'N'; 
    $periodoini = '2023-01'; 
    $periodofin = '2023-12'; 
    $gastoadm = 0; 
    $clave = 999; 
    $usuario = 'RES000162'; 
    $error = ''; 
    $nroerror = '';  */
    $consulta = $MU ->Btn_Generar_Deuda($agno,$generador,$fraccionar,$periodoini,$periodofin,$gastoadm,$clave,$usuario,$error,$nroerror);
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
