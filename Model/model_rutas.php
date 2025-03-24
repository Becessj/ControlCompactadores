<?php
require_once 'model_conexion.php';

class Modelo_Rutas extends conexionBD {
    
    // ✅ Listar todas las rutas
    public function Listar_Rutas() {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT * FROM RUTAS ORDER BY ID_RUTA DESC";
        $query = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return json_encode(["data" => $resultado], JSON_UNESCAPED_UNICODE);
    }

    // ✅ Registrar nueva ruta
    public function Registrar_Ruta($nombre, $descripcion, $estado) {
        $c = conexionBD::conexionPDO();
        $sql = "INSERT INTO RUTAS (NOMBRE, DESCRIPCION, ESTADO) VALUES (?, ?, ?)";
        $query = $c->prepare($sql);
        $query->bindParam(1, $nombre);
        $query->bindParam(2, $descripcion);
        $query->bindParam(3, $estado);
        $resultado = $query->execute();
        return json_encode(["status" => $resultado ? "success" : "error"]);
    }
    public function Editar_Ruta($id_ruta, $nombre, $descripcion, $estado) {
        $c = conexionBD::conexionPDO();
        $sql = "UPDATE RUTAS SET NOMBRE = ?, DESCRIPCION = ?, ESTADO = ? WHERE ID_RUTA = ?";
        $query = $c->prepare($sql);
        $query->bindParam(1, $nombre);
        $query->bindParam(2, $descripcion);
        $query->bindParam(3, $estado);
        $query->bindParam(4, $id_ruta);
        $resultado = $query->execute();
        return json_encode(["status" => $resultado ? "success" : "error"]);
    }
    
}
?>
