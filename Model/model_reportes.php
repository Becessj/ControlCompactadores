<?php
require_once 'model_conexion.php';

class Modelo_Reporte extends conexionBD {
    public function Listar_Consumo_Combustible() {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT 
                    IC.CODIGO, 
                    SUM(C.CANTIDAD_LITROS) AS TOTAL_LITROS, 
                    'ACTIVO' AS ESTADO
                FROM COMBUSTIBLE C
                INNER JOIN INVENTARIO_COMPACTADORES IC ON C.ID_COMPACTADOR = IC.ID_COMPACTADOR
                GROUP BY IC.CODIGO";
        
        $query = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($resultado);
    }
    public function Listar_Repuestos_Compactador() {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT 
                    IC.CODIGO AS COMPACTADOR, 
                    SUM(RM.CANTIDAD) AS TOTAL_REPUESTOS
                FROM REPUESTOS_MANTENIMIENTO RM
                INNER JOIN INVENTARIO_COMPACTADORES IC ON RM.ID_COMPACTADOR = IC.ID_COMPACTADOR
                GROUP BY IC.CODIGO";
        
        $query = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($resultado);
    }
    public function Listar_Consumo_Repuestos_Tiempo() {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT 
                    CONVERT(VARCHAR, RM.FECHA_USO, 23) AS FECHA,
                    SUM(RM.CANTIDAD) AS TOTAL_REPUESTOS
                FROM REPUESTOS_MANTENIMIENTO RM
                GROUP BY CONVERT(VARCHAR, RM.FECHA_USO, 23)
                ORDER BY FECHA ASC";
        
        $query = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($resultado);
    }
    public function Listar_Mantenimientos_Tipo_Por_Fecha($mes, $anio) {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT 
                    TIPO, 
                    COUNT(*) AS TOTAL_MANTENIMIENTOS
                FROM MANTENIMIENTOS
                WHERE MONTH(FECHA_PROGRAMADA) = ? AND YEAR(FECHA) = ?
                GROUP BY TIPO";
        
        $query = $c->prepare($sql);
        $query->execute([$mes, $anio]);
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($resultado);
    }
    public function Listar_Documentos_Proximos_A_Expirar() {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT 
                    IC.CODIGO AS COMPACTADOR,
                    FORMAT(DC.FECHA_EXPIRACION, 'yyyy-MM') AS MES_EXPIRACION,
                    COUNT(*) AS TOTAL_DOCUMENTOS
                FROM DOCUMENTOS_COMPACTADOR DC
                INNER JOIN INVENTARIO_COMPACTADORES IC ON DC.ID_COMPACTADOR = IC.ID_COMPACTADOR
                WHERE DC.FECHA_EXPIRACION >= GETDATE()
                AND DC.FECHA_EXPIRACION <= DATEADD(MONTH, 6, GETDATE())
                GROUP BY IC.CODIGO, FORMAT(DC.FECHA_EXPIRACION, 'yyyy-MM')
                ORDER BY MES_EXPIRACION ASC, IC.CODIGO ASC";
        
        $query = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($resultado);
    }
    public function Listar_Compactadores_Documentacion() {
        $c = conexionBD::conexionPDO();
        $sql = "WITH DocumentosCompactadores AS (
                    SELECT 
                        IC.ID_COMPACTADOR,
                        IC.CODIGO AS COMPACTADOR,
                        COUNT(DC.ID_DOCUMENTO) AS TOTAL_DOCUMENTOS,
                        SUM(CASE WHEN DC.FECHA_EXPIRACION >= CAST(GETDATE() AS DATE) THEN 1 ELSE 0 END) AS DOCUMENTOS_VIGENTES,
                        SUM(CASE WHEN DC.FECHA_EXPIRACION < CAST(GETDATE() AS DATE) THEN 1 ELSE 0 END) AS DOCUMENTOS_VENCIDOS
                    FROM DOCUMENTOS_COMPACTADOR DC
                    INNER JOIN INVENTARIO_COMPACTADORES IC ON DC.ID_COMPACTADOR = IC.ID_COMPACTADOR
                    GROUP BY IC.ID_COMPACTADOR, IC.CODIGO
                )
                SELECT 
                    IC.COMPACTADOR,
                    CASE 
                        WHEN DOCUMENTOS_VIGENTES = 3 AND TOTAL_DOCUMENTOS >= 3 THEN 'AL DÍA'
                        WHEN DOCUMENTOS_VIGENTES < 3 AND DOCUMENTOS_VENCIDOS = 0 THEN 'INCOMPLETO'
                        WHEN DOCUMENTOS_VENCIDOS > 0 AND DOCUMENTOS_VIGENTES < 3 THEN 'VENCIDO'
                    END AS ESTADO
                FROM DocumentosCompactadores IC;;
            ";

        $query = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($resultado);
    }
}
?>
