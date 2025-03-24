<?php
require '../../Model/model_declaracion.php';

$declaracion = new Modelo_Declaracion();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "registrar") {
    // ✅ Capturar datos del formulario
    $chofer = isset($_POST['chofer']) ? strtoupper(trim($_POST['chofer'])) : "";
    $placa = isset($_POST['placa']) ? strtoupper(trim($_POST['placa'])) : "";
    $breve_nro = isset($_POST['breve_nro']) ? strtoupper(trim($_POST['breve_nro'])) : "";
    $dni = isset($_POST['dni']) ? strtoupper(trim($_POST['dni'])) : "";
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
    $ordenanza = isset($_POST['ordenanza']) ? strtoupper(trim($_POST['ordenanza'])) : "";
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : "";
    $hora_ingreso = isset($_POST['hora_ingreso']) ? $_POST['hora_ingreso'] : "";
    $hora_salida = isset($_POST['hora_salida']) ? $_POST['hora_salida'] : "";
    $peso_ingreso = isset($_POST['peso_ingreso']) ? $_POST['peso_ingreso'] : 0;
    $peso_salida = isset($_POST['peso_salida']) ? $_POST['peso_salida'] : 0;
    $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : "";
    $ruta_archivo = "";

    // ✅ Extraer el año de la fecha
    $anioExpiracion = date("Y");

    // ✅ Verificar si hay un archivo
    if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(["success" => false, "error" => "No se pudo cargar el archivo."]);
        exit();
    }

    // 📂 Configuración de almacenamiento
    $archivo = $_FILES['archivo'];
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION); // Obtiene la extensión del archivo
    $nombreArchivo = "{$placa}-{$anioExpiracion}-DECLARACION.{$extension}"; // Genera el nuevo nombre
    
    $rutaCarpeta = __DIR__ . "/uploads/declaracionesjuradas/";

    // ✅ Asegurar que la carpeta `uploads/declaracionesjuradas/` existe
    if (!is_dir($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0777, true);
    }

    $rutaDestino = $rutaCarpeta . $nombreArchivo;

    // 📂 Mover el archivo al directorio de almacenamiento
    if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        echo json_encode(["success" => false, "error" => "Error al mover el archivo."]);
        exit();
    }

    // ✅ Guardar la ruta en la base de datos (relativa para acceso web)
    $rutaGuardada = "Controller/documento/uploads/declaracionesjuradas/" . $nombreArchivo;

    $respuesta = $declaracion->Registrar_Declaracion(
        $chofer, $placa, $breve_nro, $dni, $cantidad, $ordenanza, $fecha, 
        $hora_ingreso, $hora_salida, $peso_ingreso, $peso_salida, 
        $observaciones, $nombreArchivo
    );

    // ✅ Respuesta final
    echo json_encode(["success" => $respuesta]);
}
if ($action === "editar") {
    // ✅ Capturar datos del formulario
    $id = $_POST['id_declaracion'];
    $chofer = isset($_POST['chofer']) ? strtoupper(trim($_POST['chofer'])) : "";
    $placa = isset($_POST['placa']) ? strtoupper(trim($_POST['placa'])) : "";
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : "";
    $hora_ingreso = isset($_POST['hora_ingreso']) ? $_POST['hora_ingreso'] : "";
    $hora_salida = isset($_POST['hora_salida']) ? $_POST['hora_salida'] : "";
    $peso_ingreso = isset($_POST['peso_ingreso']) ? $_POST['peso_ingreso'] : 0;
    $peso_salida = isset($_POST['peso_salida']) ? $_POST['peso_salida'] : 0;
    $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : "";
    $ruta_archivo = isset($_POST['archivo_actual']) ? $_POST['archivo_actual'] : ""; // Mantener el archivo anterior

    // ✅ Extraer el año de la fecha para el nombre del archivo
    $anioExpiracion = date("Y", strtotime($fecha));

    // ✅ Verificar si se subió un nuevo archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $archivo = $_FILES['archivo'];
        $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);

        // 🟢 Crear el nombre del archivo de la misma forma que en `registrar`
        $nombreArchivo = "{$placa}-{$anioExpiracion}-DECLARACION.{$extension}";

        // 📂 Definir la carpeta de destino
        $rutaCarpeta = __DIR__ . "/uploads/declaracionesjuradas/";

        // 🟢 Asegurar que la carpeta existe, si no, crearla
        if (!is_dir($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0777, true);
        }

        // 📂 Ruta final de almacenamiento
        $rutaDestino = $rutaCarpeta . $nombreArchivo;

        // 📂 Mover el archivo a la carpeta de destino
        if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
            echo json_encode(["success" => false, "error" => "Error al mover el archivo."]);
            exit();
        }

        // ✅ Guardar la ruta en la base de datos (relativa para acceso web)
        $ruta_archivo = $nombreArchivo;
    }

    // ✅ Guardar los datos en la base de datos
    $respuesta = $declaracion->Editar_Declaracion(
        $id, $chofer, $placa, $fecha, $hora_ingreso, $hora_salida, 
        $peso_ingreso, $peso_salida, $observaciones, $ruta_archivo
    );

    // ✅ Respuesta final
    echo json_encode(["success" => $respuesta]);
}
if ($action === "listar") {
    echo $declaracion->Listar_Declaraciones();
}
if ($action === "contar_mes_actual") {
    $total = $declaracion->Contar_Declaraciones_MesActual();
    echo json_encode(["total" => $total]);
    exit();
}
if ($action === "contar_entre_fechas") {
    $fecha_inicio = $_POST['inicio'];
    $fecha_fin = $_POST['fin'];
    $total = $declaracion->Contar_Declaraciones_EntreFechas($fecha_inicio, $fecha_fin);
    echo json_encode(["total" => $total]);
    exit();
}


?>
