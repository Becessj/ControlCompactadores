<?php
require '../../Model/model_empleado.php';

$empleado = new Modelo_Empleado();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "registrar") {
    $ap = strtoupper(trim($_POST['ap']));
    $am = strtoupper(trim($_POST['am']));
    $nombres = strtoupper(trim($_POST['nombres']));
    $nombreCompleto = strtoupper(trim($_POST['nombreCompleto']));
    $direccion = $_POST['direccion'];
    $tipo_doc = $_POST['tipo_doc'];
    $nro_doc = $_POST['nro_doc'];
    $tipo_persona = $_POST['tipo_persona'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $usuario_crea = $_POST['usuario_crea'];
    $respuesta = $empleado->Registrar_Empleado($ap, $am, $nombres, $nombreCompleto, $direccion, $tipo_doc, 
                                               $nro_doc, $tipo_persona, $celular, $email, $usuario_crea);
    
    echo json_encode(["success" => $respuesta]);
}


// 🔹 Editar un empleado
if ($action === "editar") {
    $persona = $_POST['persona'];
    $ap = $_POST['ap'];
    $am = $_POST['am'];
    $nombres = $_POST['nombres'];
    $nombreCompleto = trim("$ap $am $nombres");
    $direccion = $_POST['direccion'];
    $tipo_doc = $_POST['tipo_doc'];
    $nro_doc = $_POST['nro_doc'];
    $tipo_persona = $_POST['tipo_persona'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $usuario_modifica = $_POST['usuario_modifica'];

    $respuesta = $empleado->Editar_Empleado($persona, $ap, $am, $nombres, $nombreCompleto, $direccion, $tipo_doc, 
                                            $nro_doc, $tipo_persona, $celular, $email, $usuario_modifica);

    echo json_encode(["success" => $respuesta]);
}
if ($action === "personas_mensual") {
    $respuesta = $empleado->Personas_Mensual();
    if ($respuesta) {
        echo json_encode(["success" => true, "data" => json_decode($respuesta, true)]);
    } else {
        echo json_encode(["success" => false]);
    }
}


?>
