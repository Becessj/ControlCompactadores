<?php
require_once 'model_conexion.php';

class Modelo_Declaracion extends conexionBD {

    // 🔹 REGISTRAR DECLARACIÓN JURADA
    public function Registrar_Declaracion($chofer, $placa, $breve_nro, $dni, $cantidad, $ordenanza, $fecha, $hora_ingreso, $hora_salida, $peso_ingreso, $peso_salida, $observaciones, $ruta_archivo) {
        $c = conexionBD::conexionPDO();
        $sql = "INSERT INTO DECLARACIONES_JURADAS 
                (CHOFER, PLACA, BREVE_NRO, DNI, CANTIDAD, ORDENANZA, FECHA, HORA_INGRESO, HORA_SALIDA, PESO_INGRESO, PESO_SALIDA, OBSERVACIONES, RUTA_ARCHIVO) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $c->prepare($sql);
        return $query->execute([$chofer, $placa, $breve_nro, $dni, $cantidad, $ordenanza, $fecha, $hora_ingreso, $hora_salida, $peso_ingreso, $peso_salida, $observaciones, $ruta_archivo]);
    }

    // 🔍 LISTAR DECLARACIONES JURADAS
    public function Listar_Declaraciones() {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT 
                dj.ID_DECLARACION, 
                p.NOMBRE_COMPLETO AS CHOFER,
                ic.ID_COMPACTADOR AS ID_COMPACTADOR,
				 ic.CODIGO AS PLACA,
                p.NRO_DOC AS DNI, 
				dj.HORA_INGRESO,
				dj.HORA_SALIDA,  
				dj.BREVE_NRO, 
				dj.BREVE_NRO, 
                dj.FECHA, 
                dj.PESO_INGRESO, 
                dj.PESO_SALIDA,
				  dj.OBSERVACIONES, 
                (dj.PESO_INGRESO - dj.PESO_SALIDA) AS PESO_NETO, 
                CASE 
                    WHEN (dj.PESO_INGRESO - dj.PESO_SALIDA) <= 0 THEN 'ERROR PESO' 
                    ELSE 'CORRECTO' 
                END AS ESTADO,
                dj.RUTA_ARCHIVO
            FROM DECLARACIONES_JURADAS dj
            LEFT JOIN PERSONA p ON dj.DNI = p.NRO_DOC
            LEFT JOIN INVENTARIO_COMPACTADORES ic ON dj.PLACA = ic.ID_COMPACTADOR
            ORDER BY dj.ID_DECLARACION DESC;
            ";
        $query = $c->prepare($sql);
        $query->execute();
        return json_encode(["data" => $query->fetchAll(PDO::FETCH_ASSOC)]);
    }
    public function Editar_Declaracion($id, $chofer, $placa, $fecha, $hora_ingreso, $hora_salida, $peso_ingreso, $peso_salida, $observaciones, $ruta_archivo) {
        $c = conexionBD::conexionPDO();
        $sql = "UPDATE DECLARACIONES_JURADAS 
                SET CHOFER = ?, PLACA = ?, FECHA = ?, HORA_INGRESO = ?, HORA_SALIDA = ?, 
                    PESO_INGRESO = ?, PESO_SALIDA = ?, OBSERVACIONES = ?, RUTA_ARCHIVO = ? 
                WHERE ID_DECLARACION = ?";
        $query = $c->prepare($sql);
        return $query->execute([$chofer, $placa, $fecha, $hora_ingreso, $hora_salida, $peso_ingreso, $peso_salida, $observaciones, $ruta_archivo, $id]);
    }
    public function Contar_Declaraciones_MesActual() {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT COUNT(*) AS TOTAL 
                FROM DECLARACIONES_JURADAS 
                WHERE MONTH(FECHA) = MONTH(GETDATE()) 
                  AND YEAR(FECHA) = YEAR(GETDATE())";
        $query = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado['TOTAL'];
    }
    public function Contar_Declaraciones_EntreFechas($fecha_inicio, $fecha_fin) {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT COUNT(*) AS TOTAL 
                FROM DECLARACIONES_JURADAS 
                WHERE FECHA BETWEEN ? AND ?";
        $query = $c->prepare($sql);
        $query->execute([$fecha_inicio, $fecha_fin]);
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado['TOTAL'];
    }
    
    
    
}
?>
