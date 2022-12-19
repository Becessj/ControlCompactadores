<?php
    require '../../model/model_usuario.php';
    $MU = new Modelo_Usuario(); //Instanciamos
    $nomb = strtoupper(htmlspecialchars($_POST['nomb'],ENT_QUOTES,'UTF-8'));
    $direc = strtoupper(htmlspecialchars($_POST['direc'],ENT_QUOTES,'UTF-8'));
    $usu = strtoupper(htmlspecialchars($_POST['usu'],ENT_QUOTES,'UTF-8'));
    $con = strtoupper(htmlspecialchars($_POST['con'],ENT_QUOTES,'UTF-8'));
    $rol = strtoupper(htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8'));
    $est = strtoupper(htmlspecialchars($_POST['est'],ENT_QUOTES,'UTF-8'));
    $consulta = $MU ->Modificar_Usuario($nomb,$direc,$usu,$con,$rol,$est);
    echo $consulta;
  



?>
