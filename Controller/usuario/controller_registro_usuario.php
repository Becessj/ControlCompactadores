<?php
    require '../../model/model_usuario.php';
    $MU = new Modelo_Usuario(); //Instanciamos
    $nomb = strtoupper(htmlspecialchars($_POST['nomb'],ENT_QUOTES,'UTF-8'));
    $apaterno = strtoupper(htmlspecialchars($_POST['apaterno'],ENT_QUOTES,'UTF-8'));
    $amaterno = strtoupper(htmlspecialchars($_POST['amaterno'],ENT_QUOTES,'UTF-8'));
    $nombrecompleto =  $nomb. ' ' .$apaterno. ' '.$amaterno;
    $direc = strtoupper(htmlspecialchars($_POST['direc'],ENT_QUOTES,'UTF-8'));
    $usu = strtoupper(htmlspecialchars($_POST['usu'],ENT_QUOTES,'UTF-8'));
    $con = strtoupper(htmlspecialchars($_POST['con'],ENT_QUOTES,'UTF-8'));
    $ida = strtoupper(htmlspecialchars($_POST['ida'],ENT_QUOTES,'UTF-8'));
    $rol = strtoupper(htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8'));
    $consulta = $MU ->Registrar_Usuario($nombrecompleto,$usu,$con,$direc,$ida,$rol);
    echo $consulta;
  



?>
