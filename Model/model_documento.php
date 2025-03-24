<?php
require_once 'model_conexion.php';

class Modelo_Documento extends conexionBD {
    public function Listar_Documentos($id_compactador) {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT * FROM DOCUMENTOS_COMPACTADOR WHERE ID_COMPACTADOR = ? ORDER BY FECHA_EXPIRACION desc;";
        $query = $c->prepare($sql);
        $query->execute([$id_compactador]);
        return json_encode(["data" => $query->fetchAll(PDO::FETCH_ASSOC)]);
    }
    public function Registrar_Documento($id_compactador, $tipo_documento, $nombre_archivo, $fecha_expiracion) {
        $c = conexionBD::conexionPDO();
    
        // 🔎 **Verificar si el documento ya existe**
        $sql_check = "SELECT COUNT(*) AS total FROM DOCUMENTOS_COMPACTADOR WHERE NOMBRE_ARCHIVO = ?";
        $query_check = $c->prepare($sql_check);
        $query_check->execute([$nombre_archivo]);
        $resultado = $query_check->fetch(PDO::FETCH_ASSOC);
    
        // 📛 **Si el archivo ya existe, evitar la inserción**
        if ($resultado['total'] > 0) {
            return ["success" => false, "error" => "El archivo ya existe en la base de datos."];
        }
    
        // 📌 **Insertar nuevo documento si no existe**
        $sql_insert = "INSERT INTO DOCUMENTOS_COMPACTADOR 
                       (ID_COMPACTADOR, TIPO_DOCUMENTO, NOMBRE_ARCHIVO, FECHA_CARGA, FECHA_EXPIRACION) 
                       VALUES (?, ?, ?, GETDATE(), ?)";
        $query_insert = $c->prepare($sql_insert);
        
        $resultado_insert = $query_insert->execute([$id_compactador, $tipo_documento, $nombre_archivo, $fecha_expiracion]);
    
        return ["success" => $resultado_insert];
    }
    public function Eliminar_Documento($id_documento) {
        $c = conexionBD::conexionPDO();
        $sql = "DELETE FROM DOCUMENTOS_COMPACTADOR WHERE ID_DOCUMENTO=?";
        $query = $c->prepare($sql);
        return $query->execute([$id_documento]);
    }
    
    
    
}
?>
