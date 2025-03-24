<?php
require '../../Model/model_cargo.php';

// 💡 Verifica que la variable es una instancia de la clase
$cargo = new Modelo_Cargo();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "listar") {
    echo $cargo->Listar_Cargos();
    exit();
}

if ($action === "registrar") {
    $persona = $_POST['persona'];
    $cargoNombre = $_POST['cargo'];
    $area = $_POST['area'];
    $fecha_inicio = $_POST['fechaInicio'];
    $fecha_fin = $_POST['fechaFin'];
    $usuario_crea = $_POST['usuario_crea'];

    // Verificar si existen las variables antes de usarlas (para evitar errores Undefined index)
    $brevete = isset($_POST['brevete']) ? $_POST['brevete'] : null;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
    $fecha_vencimiento = isset($_POST['fechaVencimiento']) ? $_POST['fechaVencimiento'] : null;

    // Si el cargo NO es "CONDUCTOR", aseguramos que estos valores sean NULL
    if (strtoupper($cargoNombre) !== "CONDUCTOR") {
        $brevete = null;
        $categoria = null;
        $fecha_vencimiento = null;
    }

    // Ejecutar el registro del cargo
    $respuesta = $cargo->Registrar_Cargo($persona, $cargoNombre, $area, $fecha_inicio, $fecha_fin, $brevete, $categoria, $fecha_vencimiento, $usuario_crea);

    echo json_encode(["success" => $respuesta]);
}

if ($action === "editar") {
    $id_cargo = $_POST['id_cargo'];
    $cargoNombre = $_POST['cargo'];
    $area = $_POST['area'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $estado = $_POST['estado'];

    // Verificar si los datos adicionales de "CONDUCTOR" están presentes
    $brevete = isset($_POST['brevete']) ? $_POST['brevete'] : null;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
    $fecha_vencimiento = isset($_POST['fecha_vencimiento']) ? $_POST['fecha_vencimiento'] : null;

    // Si el cargo NO es "CONDUCTOR", forzar valores nulos para evitar datos residuales
    if (strtoupper($cargoNombre) !== "CONDUCTOR") {
        $brevete = null;
        $categoria = null;
        $fecha_vencimiento = null;
    }

    $respuesta = $cargo->Editar_Cargo($id_cargo, $cargoNombre, $area, $fecha_inicio, $fecha_fin, $estado, $brevete, $categoria, $fecha_vencimiento);

    echo json_encode(["success" => $respuesta]);
}


?>
