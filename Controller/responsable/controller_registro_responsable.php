<?php
    require '../../model/model_responsable.php';
    $MU = new Modelo_Responsable(); //Instanciamos
    $apaterno = strtoupper(htmlspecialchars($_POST['apaterno'],ENT_QUOTES,'UTF-8'));
    $amaterno = strtoupper(htmlspecialchars($_POST['amaterno'],ENT_QUOTES,'UTF-8'));
    $nomb = strtoupper(htmlspecialchars($_POST['nomb'],ENT_QUOTES,'UTF-8'));
    $direc = strtoupper(htmlspecialchars($_POST['direc'],ENT_QUOTES,'UTF-8'));
    $ndoc = strtoupper(htmlspecialchars($_POST['ndoc'],ENT_QUOTES,'UTF-8'));
    $usu = strtoupper(htmlspecialchars($_POST['usu'],ENT_QUOTES,'UTF-8'));
    $tpersona = strtoupper(htmlspecialchars($_POST['tpersona'],ENT_QUOTES,'UTF-8'));
    $consulta = $MU ->Registrar_Responsable($apaterno,$amaterno,$nomb,$direc,$ndoc,$tpersona,$usu);
    echo $consulta;
  



?>
