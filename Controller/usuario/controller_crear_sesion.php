<?php
    session_start();
    require '../../model/model_usuario.php';
    $MU = new Modelo_Usuario(); //Instanciamos
    $usuario = htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $rol = htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');
    $tipo = htmlspecialchars($_POST['tipo'],ENT_QUOTES,'UTF-8');
    $clave = htmlspecialchars($_POST['clave'],ENT_QUOTES,'UTF-8');
    $_SESSION['S_ID'] = $usuario;
    $_SESSION['S_NOMBRE'] = $nombre;
    $_SESSION['S_ROL'] = $rol;
    $_SESSION['S_TIPO'] = $tipo;
    $_SESSION['S_CLAVE'] = $clave;
?>