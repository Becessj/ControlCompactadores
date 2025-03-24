<?php
require_once 'model_conexion.php';

class Modelo_Combustible extends conexionBD {



    public function Registrar_Combustible($id_compactador, $fecha, $litros, $precio, $boleta,$total) {
        try {
            $c = conexionBD::conexionPDO();
            $sql = "INSERT INTO COMBUSTIBLE (ID_COMPACTADOR, FECHA_CARGA, CANTIDAD_LITROS, PRECIO_LITRO, BOLETA,TOTAL) 
                VALUES (?, ?, ?, ?, ?,?)";
            $query = $c->prepare($sql);
            return $query->execute([$id_compactador, $fecha, $litros, $precio, $boleta,$total]);
        } catch (Exception $e) {
            return false; // Enviar false en caso de error
        }
    }

    public function Listar_Combustible() {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT C.ID_COMBUSTIBLE, C.ID_COMPACTADOR, IC.CODIGO AS COMPACTADOR, C.FECHA_CARGA, 
       C.CANTIDAD_LITROS, C.PRECIO_LITRO, C.BOLETA, C.TOTAL, C.ESTADO
            FROM COMBUSTIBLE C
            JOIN INVENTARIO_COMPACTADORES IC ON C.ID_COMPACTADOR = IC.ID_COMPACTADOR
            ORDER BY ID_COMBUSTIBLE DESC;
            ";
        $query = $c->prepare($sql);
        $query->execute();
        return json_encode(["data" => $query->fetchAll(PDO::FETCH_ASSOC)]);
    }

       // ✅ Editar un registro de combustible existente
       public function Editar_Combustible($id_combustible, $fecha, $litros, $precio, $total, $boleta,$estatus) {
        try {
            $c = conexionBD::conexionPDO();
            $sql = "UPDATE COMBUSTIBLE 
                    SET FECHA_CARGA = ?, CANTIDAD_LITROS = ?, PRECIO_LITRO = ?, TOTAL = ?, BOLETA = ?, ESTADO = ?
                    WHERE ID_COMBUSTIBLE = ?";
            $query = $c->prepare($sql);
            return $query->execute([$fecha, $litros, $precio, $total, $boleta,$estatus, $id_combustible]);
        } catch (Exception $e) {
            return false; // Enviar false en caso de error
        }
    }
    public function Combustible_Mensual() {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT 
                    SUM(CANTIDAD_LITROS) AS TOTAL_LITROS,
                    SUM(TOTAL) AS GASTO_TOTAL
                FROM COMBUSTIBLE
                WHERE 
                    MONTH(FECHA_CARGA) = MONTH(GETDATE()) 
                    AND YEAR(FECHA_CARGA) = YEAR(GETDATE())
                    AND ESTADO = 'ACTIVO';
            ";
        $query = $c->prepare($sql);
        $query->execute();
        return json_encode($query->fetchAll(PDO::FETCH_ASSOC)); // Elimina el nivel extra de "data"
    }
    
}
?>
