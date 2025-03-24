<?php
require '../../Model/model_documento.php';

$documento = new Modelo_Documento();
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === "listar_documentos") {
    $id_compactador = $_POST['id_compactador'];
    echo $documento->Listar_Documentos($id_compactador);
}
if ($action === "registrar") {
    $id_compactador = $_POST['id_compactador'];
    $tipo_documento = strtoupper(trim($_POST['tipo_documento']));
    $fecha_expiracion = trim($_POST['txt_fecha_expiracion']); // La fecha de expiración

    // 🔥 Extraer el año de expiración
    $anioExpiracion = date("Y", strtotime($fecha_expiracion));

    // Verificar si hay un archivo
    if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(["success" => false, "error" => "No se pudo cargar el archivo."]);
        exit();
    }

    $archivo = $_FILES['archivo'];
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION); // Obtiene la extensión del archivo
    $nombreArchivo = "{$id_compactador}-{$anioExpiracion}-{$tipo_documento}.{$extension}"; // Genera el nuevo nombre
    $rutaCarpeta = __DIR__ . "/uploads/";

    // 🔥 Asegurar que la carpeta uploads existe
    if (!is_dir($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0777, true);
    }

    $rutaDestino = $rutaCarpeta . $nombreArchivo;

    // Verificar si el archivo ya existe en la base de datos
    $validacion = $documento->Registrar_Documento($id_compactador, $tipo_documento, $nombreArchivo, $fecha_expiracion);

    if (!$validacion["success"]) {
        echo json_encode(["success" => false, "error" => $validacion["error"]]);
        exit();
    }

    // Mover el archivo al directorio de almacenamiento
    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Error al mover el archivo."]);
    }
}

if ($action === "eliminar_documento") {
    $id_documento = $_POST['id_documento'];
    echo json_encode(["success" => $documento->Eliminar_Documento($id_documento)]);
}


?>
