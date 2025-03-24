<?php
require_once 'model_conexion.php';

class Modelo_Compactador extends conexionBD {

    public function Existe_Compactador($codigo) {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT COUNT(*) AS total FROM INVENTARIO_COMPACTADORES WHERE CODIGO = ?";
        $query = $c->prepare($sql);
        $query->execute([$codigo]);
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] > 0; // Devuelve true si ya existe, false si no
    }
    
    public function Listar_Compactadores() {
        $c = conexionBD::conexionPDO();
        $sql = "WITH DocumentosCompactadores AS (
                    SELECT 
                        IC.ID_COMPACTADOR,
                        COUNT(DC.ID_DOCUMENTO) AS TOTAL_DOCUMENTOS,
                        SUM(CASE WHEN DC.FECHA_EXPIRACION >= CAST(GETDATE() AS DATE) THEN 1 ELSE 0 END) AS DOCUMENTOS_VIGENTES,
                        SUM(CASE WHEN DC.FECHA_EXPIRACION < CAST(GETDATE() AS DATE) THEN 1 ELSE 0 END) AS DOCUMENTOS_VENCIDOS
                    FROM INVENTARIO_COMPACTADORES IC
                    LEFT JOIN DOCUMENTOS_COMPACTADOR DC ON IC.ID_COMPACTADOR = DC.ID_COMPACTADOR
                    GROUP BY IC.ID_COMPACTADOR
                )
                SELECT 
                    IC.ID_COMPACTADOR,
                    IC.CODIGO,
                    IC.DESCRIPCION,
                    IC.MARCA,
                    IC.MODELO,
                    IC.ESTADO,
                    CASE 
                        WHEN COALESCE(DC.DOCUMENTOS_VIGENTES, 0) = 3 AND COALESCE(DC.TOTAL_DOCUMENTOS, 0) >= 3 THEN 'AL DÍA'
                        WHEN COALESCE(DC.DOCUMENTOS_VIGENTES, 0) < 3 AND COALESCE(DC.DOCUMENTOS_VENCIDOS, 0) = 0 AND COALESCE(DC.TOTAL_DOCUMENTOS, 0) > 0 THEN 'INCOMPLETO'
                        WHEN COALESCE(DC.DOCUMENTOS_VENCIDOS, 0) > 0 THEN 'VENCIDO'
                        ELSE 'SIN DOCUMENTOS'
                    END AS ESTADO_DOCUMENTOS
                FROM INVENTARIO_COMPACTADORES IC
                LEFT JOIN DocumentosCompactadores DC ON IC.ID_COMPACTADOR = DC.ID_COMPACTADOR
                ORDER BY IC.ID_COMPACTADOR DESC;";

        $query = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        // ✅ Asegurar que siempre se devuelve un JSON válido
        echo json_encode(["data" => $resultado], JSON_UNESCAPED_UNICODE);
    }

    public function Registrar_Compactador($codigo, $descripcion, $marca, $modelo) {
        $c = conexionBD::conexionPDO();
        $sql = "INSERT INTO INVENTARIO_COMPACTADORES (CODIGO, DESCRIPCION, MARCA, MODELO, ESTADO) 
                VALUES (?, ?, ?, ?, 'ACTIVO')";
        $query = $c->prepare($sql);
        return $query->execute([$codigo, $descripcion, $marca, $modelo]);
    }

    public function Editar_Compactador($id, $descripcion, $marca, $modelo, $estado) {
        try {
            $c = conexionBD::conexionPDO();
            $sql = "UPDATE INVENTARIO_COMPACTADORES 
                    SET DESCRIPCION=?, MARCA=?, MODELO=?, ESTADO=? 
                    WHERE ID_COMPACTADOR=?";
            $query = $c->prepare($sql);
            $resultado = $query->execute([$descripcion, $marca, $modelo, $estado, $id]);
            
            return $resultado; // Devuelve true si se ejecutó correctamente, false si hubo error.
        } catch (Exception $e) {
            return false; // Si hay error, devolver false
        }
    }
    

    public function Eliminar_Compactador($id) {
        $c = conexionBD::conexionPDO();
        $sql = "DELETE FROM INVENTARIO_COMPACTADORES WHERE ID_COMPACTADOR=?";
        $query = $c->prepare($sql);
        return $query->execute([$id]);
    }
    public function Registrar_Combustible($compactadorID, $fecha, $litros) {
        $c = conexionBD::conexionPDO();
        $sql = "INSERT INTO Combustible (CompactadorID, Fecha, Litros) VALUES (?, ?, ?)";
        $query = $c->prepare($sql);
        return $query->execute([$compactadorID, $fecha, $litros]);
    }

    public function Registrar_Mantenimiento($compactadorID, $tipo, $fecha, $descripcion) {
        $c = conexionBD::conexionPDO();
        $sql = "INSERT INTO Mantenimiento (CompactadorID, Tipo, Fecha, Descripcion) VALUES (?, ?, ?, ?)";
        $query = $c->prepare($sql);
        return $query->execute([$compactadorID, $tipo, $fecha, $descripcion]);
    }

    public function combo_placa(){
        $c = conexionBD::conexionPDO();
        $sql = "SELECT ID_COMPACTADOR, CODIGO FROM INVENTARIO_COMPACTADORES ORDER BY CODIGO ASC";
        $arreglo = array();
        $query = $c -> prepare($sql);
        $query -> execute();
        $resultado = $query -> fetchAll();
        foreach($resultado as $resp){
            $arreglo[] = $resp;
        }
        return $arreglo;
        conexionBD::cerrar_conexion();

    }
     public function combo_categoria() {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT ID, CATEGORIA FROM CATEGORIAS ORDER BY 1 ASC";
        $query = $c->prepare($sql);
        $query->execute();
    
        return $query->fetchAll(PDO::FETCH_ASSOC); // Retorna los datos como array asociativo
    }
    public function Total_Compactadores() {
        $c = conexionBD::conexionPDO();
        $sql = "  SELECT COUNT(*) AS TOTAL_COMPACTADORES
                FROM INVENTARIO_COMPACTADORES
                WHERE ESTADO = 'ACTIVO';";
        $query = $c->prepare($sql);
        $query->execute();
        return json_encode($query->fetchAll(PDO::FETCH_ASSOC)); // Devuelve la cantidad total
    }
    

}
?>
