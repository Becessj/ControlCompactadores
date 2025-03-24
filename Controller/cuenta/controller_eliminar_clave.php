<?php
    require '../../model/model_cuenta.php';
    $MU = new Modelo_Cuenta(); //Instanciamos
    $clave = 2221152;
    
/*     $clave = 12344; 
     */
    $consulta = $MU->Eliminar_Clave($clave);
    echo json_encode($consulta);
?>
