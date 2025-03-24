<?php
    require '../../model/model_responsable.php';
    $MU = new Modelo_Responsable(); //Instanciamos
    $responsable = strtoupper(htmlspecialchars($_POST['responsable_editar'],ENT_QUOTES,'UTF-8'));
    $apaterno = strtoupper(htmlspecialchars($_POST['apaterno_editar'],ENT_QUOTES,'UTF-8'));
    $amaterno = strtoupper(htmlspecialchars($_POST['amaterno_editar'],ENT_QUOTES,'UTF-8'));
    $nomb = strtoupper(htmlspecialchars($_POST['nomb_editar'],ENT_QUOTES,'UTF-8'));
    $direc = strtoupper(htmlspecialchars($_POST['direc_editar'],ENT_QUOTES,'UTF-8'));
    $ndoc = strtoupper(htmlspecialchars($_POST['ndoc_editar'],ENT_QUOTES,'UTF-8'));
    $tpersona = strtoupper(htmlspecialchars($_POST['tpersona_editar'],ENT_QUOTES,'UTF-8'));
    $usu = strtoupper(htmlspecialchars($_POST['usu_editar'],ENT_QUOTES,'UTF-8'));
    $consulta = $MU ->Modificar_Responsable($responsable,$apaterno,$amaterno,$nomb,$direc,$ndoc,$tpersona,$usu);
    echo $consulta;
?>
