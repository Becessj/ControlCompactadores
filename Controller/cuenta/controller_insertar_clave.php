<?php
    require '../../model/model_cuenta.php';
    $MU = new Modelo_Cuenta(); //Instanciamos
    $clave = htmlspecialchars($_POST['clave_resp'],ENT_QUOTES,'UTF-8');
   // $clave = (int)$_POST['clave_resp']; 
    $respons = $_POST['respons_resp']; 
    $predio = $_POST['predio_resp']; 
    $tipo_resp = $_POST['tipo_resp']; 
    $A = $_POST['A']; 

/*     $clave = 12344; 
    $respons = '61067369'; 
    $predio = 'PUZZZZZZ'; 
    $tipo_resp = 'T1'; 
    $A = 'A';  */
    $consulta = $MU->Insertar_Clave($clave,$respons,$predio,$tipo_resp,$A);
    echo json_encode($consulta);
?>
