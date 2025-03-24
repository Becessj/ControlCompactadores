<?php
    require_once 'model_conexion.php';
    class Modelo_Repuesto extends conexionBD{
        public function Listar_Repuesto(){
            $c = conexionBD::conexionPDO();
            $sql = "SELECT 
                    P.PRODUCTO, 
                    P.DESCRIPCION, 
                    I.UNIDAD, 
                    I.SALDO_ACTUAL
                FROM 
                    [MEDIO_AMBIENTE].[dbo].[PRODUCTO] P
                JOIN 
                    [MEDIO_AMBIENTE].[dbo].[INVENTARIO_PRODUCTO] I 
                    ON P.PRODUCTO = I.PRODUCTO
                WHERE 
                    P.PRODUCTO LIKE 'A%' OR P.PRODUCTO LIKE 'H%'
                ORDER BY 
                    P.PRODUCTO";
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> execute();
            $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();

        }
        public function Listar_Repuestos($id_mantenimiento) {
            $c = conexionBD::conexionPDO();
            $sql = "SELECT rm.ID, p.DESCRIPCION, rm.CANTIDAD, rm.FECHA_USO
                    FROM REPUESTOS_MANTENIMIENTO rm
                    JOIN PRODUCTO p ON rm.PRODUCTO = p.PRODUCTO
                    WHERE rm.ID_MANTENIMIENTO = ?";
            $query = $c->prepare($sql);
            $query->execute([$id_mantenimiento]);
            return json_encode(["data" => $query->fetchAll(PDO::FETCH_ASSOC)]);
        }
    
        public function Registrar_Repuestos_Todos($id_mantenimiento, $repuestos,$id_compactador) {
            try {
                $c = conexionBD::conexionPDO();
                $c->beginTransaction();
        
                $sql = "INSERT INTO REPUESTOS_MANTENIMIENTO (ID_MANTENIMIENTO, PRODUCTO, CANTIDAD, FECHA_USO,ID_COMPACTADOR) 
                        VALUES (?, ?, ?, ?,?)";
                $query = $c->prepare($sql);
        
                foreach ($repuestos as $repuesto) {
                    $fecha_uso = $repuesto['fecha']; // Obtener la fecha desde el JSON
                    $query->execute([$id_mantenimiento, $repuesto['producto'], $repuesto['cantidad'], $fecha_uso,$id_compactador]);
                }
        
                $c->commit();
                return true;
            } catch (Exception $e) {
                $c->rollBack();
                return false;
            }
        }
        

        public function EliminarRepuesto($id_repuesto) {
            try {
                $c = conexionBD::conexionPDO();
                $sql = "DELETE FROM REPUESTOS_MANTENIMIENTO WHERE ID = ?";
                $query = $c->prepare($sql);
                $query->execute([$id_repuesto]);
        
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
        
        public function Listar_Productos() {
            $c = conexionBD::conexionPDO();
            $sql = "SELECT 
                    P.PRODUCTO, 
                    P.DESCRIPCION, 
                    I.UNIDAD, 
                    I.SALDO_ACTUAL
                FROM 
                    [MEDIO_AMBIENTE].[dbo].[PRODUCTO] P
                JOIN 
                    [MEDIO_AMBIENTE].[dbo].[INVENTARIO_PRODUCTO] I 
                    ON P.PRODUCTO = I.PRODUCTO
                WHERE 
                    P.PRODUCTO LIKE 'A%' OR P.PRODUCTO LIKE 'H%'
                ORDER BY 
                    P.PRODUCTO"; // Solo productos activos
            $query = $c->prepare($sql);
            $query->execute();
            return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
        }
        public function Obtener_Frecuencia_Cambios($id_compactador) {
            $c = conexionBD::conexionPDO();
            $sql = "SELECT 
                        rm.PRODUCTO,
                        p.DESCRIPCION AS NOMBRE_PRODUCTO,
                        CONCAT(
                            COUNT(rm.ID), 
                            ' ', 
                            CASE WHEN COUNT(rm.ID) = 1 THEN 'vez' ELSE 'veces' END
                        ) AS FRECUENCIA_CAMBIO, -- Manejo del singular y plural
                        MAX(rm.FECHA_USO) AS ULTIMO_USO,
                        ic.DESCRIPCION AS NOMBRE_COMPACTADOR,
                        SUM(rm.CANTIDAD) AS TOTAL_CANTIDAD, -- SUMA DE LAS CANTIDADES
                        ic.MARCA,
                        ic.MODELO,
                        ic.ESTADO
                    FROM repuestos_mantenimiento rm
                    INNER JOIN inventario_compactadores ic 
                        ON rm.ID_COMPACTADOR = ic.ID_COMPACTADOR
                    INNER JOIN PRODUCTO p
                        ON rm.PRODUCTO = p.PRODUCTO
                    WHERE ic.ID_COMPACTADOR = ?
                    GROUP BY rm.PRODUCTO, p.DESCRIPCION, ic.DESCRIPCION, ic.MARCA, ic.MODELO, ic.ESTADO
                    ORDER BY COUNT(rm.ID) DESC; -- ORDENAR POR FRECUENCIA DE CAMBIO
                    ";
            
            $query = $c->prepare($sql);
            $query->execute([$id_compactador]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        
      
    }
?>