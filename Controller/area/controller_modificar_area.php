<?php
    require '../../model/model_area.php';
    $MU = new Modelo_Area(); //Instanciamos
    $area = strtoupper(htmlspecialchars($_POST['area'],ENT_QUOTES,'UTF-8'));
    $estatus = strtoupper(htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8'));
    $consulta = $MU ->Modificar_Area($area,$estatus);
    echo $consulta;
  



?>
