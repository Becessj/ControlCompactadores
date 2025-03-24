<?php
require_once 'model_conexion.php';

class Modelo_Asignacion extends conexionBD {
    public function Generar_Codigo_Tripulacion($usuario) {
        $c = conexionBD::conexionPDO();
    
        try {
            // 1️⃣ Llamar al procedimiento almacenado
            $sql_cod = "{CALL GENERAR_SIGUIENTE_CODIGO(?, ?, ?, ?)}";
            $query_cod = $c->prepare($sql_cod);
    
            // Definir variables
            $tipo = 'TRIPULA';
            $paramOutput = str_repeat(' ', 10); // Relleno para evitar NULLs
    
            // Asociar parámetros
            $query_cod->bindParam(1, $tipo, PDO::PARAM_STR);
            $query_cod->bindParam(2, $usuario, PDO::PARAM_STR);
            $query_cod->bindParam(3, $tipo, PDO::PARAM_STR);
            $query_cod->bindParam(4, $paramOutput, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 10);
    
            $query_cod->execute();
    
            // 2️⃣ Capturar y limpiar el código generado
            $codTripulacion = trim(str_replace("\0", '', $paramOutput)); // Elimina NULLs y espacios
    
            // Verificar si el código es válido
            if (empty($codTripulacion) || strlen($codTripulacion) < 6) {
                throw new Exception("Error al generar COD_TRIPULACION. Código recibido: " . json_encode($codTripulacion));
            }
    
            error_log("COD_TRIPULACION generado correctamente: '" . $codTripulacion . "'");
            return $codTripulacion;
    
        } catch (Exception $e) {
            error_log("SQL Error en Generar_Codigo_Tripulacion: " . $e->getMessage());
            return null;
        }
    }
    
    
    
    public function Registrar_Asignacion($compactadorID, $personas, $fechaInicio, $fechaFin, $turno, $idRuta, $usuario) {
        $c = conexionBD::conexionPDO();
        
        try {
            $c->beginTransaction();
    
            // 1️⃣ Generar el código de tripulación antes de la asignación
            $codTripulacion = $this->Generar_Codigo_Tripulacion($usuario);
    
            if (!$codTripulacion) {
                throw new Exception("Error al obtener el COD_TRIPULACION.");
            }
    
            // 2️⃣ Insertar asignaciones con el mismo COD_TRIPULACION
            $sql_insert = "INSERT INTO ASIGNACION_COMPACTADOR 
                          (ID_COMPACTADOR, PERSONA, FECHA_INICIO, FECHA_FIN, TURNO, ID_RUTA, ESTADO, USUARIO_CREA, COD_TRIPULACION) 
                          VALUES (?, ?, ?, ?, ?, ?, 'Programado', ?, ?)";
            $query = $c->prepare($sql_insert);
    
            foreach ($personas as $persona) {
                error_log("Insertando persona con COD_TRIPULACION " . $codTripulacion . ": " . json_encode($persona));
                if (!$query->execute([$compactadorID, $persona['id'], $fechaInicio, $fechaFin, $turno, $idRuta, $usuario, $codTripulacion])) {
                    throw new Exception("Error al insertar la asignación para la persona: " . $persona['id']);
                }
            }
    
            $c->commit();
            return true;
    
        } catch (Exception $e) {
            $c->rollBack();
            error_log("SQL Error en Registrar_Asignacion: " . $e->getMessage());
            return ["success" => false, "error" => $e->getMessage()];
        }
    }
    
    
    
    public function Listar_Asignaciones() {
        $c = conexionBD::conexionPDO();
        $sql_update = "UPDATE ASIGNACION_COMPACTADOR
                       SET ESTADO = CASE 
                           WHEN FECHA_FIN < CAST(GETDATE() AS DATE) THEN 'FINALIZADO'
                           ELSE 'PROGRAMADO'
                       END;";
        $c->prepare($sql_update)->execute();
    
        $sql = "SELECT 
                A.COD_TRIPULACION, 
                A.ID_ASIGNACION, 
                C.CODIGO AS COMPACTADOR, 
                A.FECHA_INICIO, 
                A.FECHA_FIN, 
                A.TURNO, 
                R.NOMBRE AS RUTA, -- Se reemplaza A.RUTA por R.NOMBRE
                A.ESTADO, 
                P.NOMBRE_COMPLETO AS EMPLEADO, 
                COALESCE(DC.CARGO, 'Sin Cargo') AS CARGO
            FROM ASIGNACION_COMPACTADOR A
            JOIN INVENTARIO_COMPACTADORES C ON A.ID_COMPACTADOR = C.ID_COMPACTADOR
            JOIN PERSONA P ON A.PERSONA = P.PERSONA
            LEFT JOIN RUTAS R ON A.ID_RUTA = R.ID_RUTA -- Se agrega JOIN con la tabla RUTAS
            LEFT JOIN DETALLE_CARGO DC ON A.PERSONA = DC.PERSONA 
                AND DC.F_INICIO = (SELECT MAX(F_INICIO) 
                                FROM DETALLE_CARGO 
                                WHERE DETALLE_CARGO.PERSONA = A.PERSONA)
            ORDER BY A.FECHA_INICIO DESC;
            ";
    
        $query = $c->prepare($sql);
        $query->execute();
        $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
    
        $asignacionesAgrupadas = [];
    
        foreach ($resultados as $fila) {
            $codTripulacion = $fila['COD_TRIPULACION'];
    
            if (!isset($asignacionesAgrupadas[$codTripulacion])) {
                $asignacionesAgrupadas[$codTripulacion] = [
                    "ID_ASIGNACION" => $fila["ID_ASIGNACION"],
                    "COD_TRIPULACION" => $codTripulacion,
                    "COMPACTADOR" => $fila["COMPACTADOR"],
                    "FECHA_INICIO" => $fila["FECHA_INICIO"],
                    "FECHA_FIN" => $fila["FECHA_FIN"],
                    "TURNO" => $fila["TURNO"],
                    "RUTA" => $fila["RUTA"],
                    "ESTADO" => $fila["ESTADO"],
                    "EMPLEADOS" => [] // Lista de empleados con cargos
                ];
            }
    
            // Agregar empleados con su respectivo cargo
            $asignacionesAgrupadas[$codTripulacion]["EMPLEADOS"][] = [
                "nombre" => $fila["EMPLEADO"],
                "cargo" => $fila["CARGO"]
            ];
        }
    
        return json_encode(["data" => array_values($asignacionesAgrupadas)], JSON_UNESCAPED_UNICODE);
    }
    public function Actualizar_Estado_Asignacion($idAsignacion, $estado, $usuario) {
        $c = conexionBD::conexionPDO();
        $sql = "UPDATE ASIGNACION_COMPACTADOR SET ESTADO = ?, USUARIO_MODIFICA = ?, F_MODIFICA = GETDATE() WHERE ID_ASIGNACION = ?";
        $query = $c->prepare($sql);
        return $query->execute([$estado, $usuario, $idAsignacion]);
    }
    
    public function Eliminar_Asignacion($idAsignacion) {
        $c = conexionBD::conexionPDO();
        $sql = "DELETE FROM ASIGNACION_COMPACTADOR WHERE ID_ASIGNACION = ?";
        $query = $c->prepare($sql);
        return $query->execute([$idAsignacion]);
    }
    public function Listar_AsignacionesPorMes($mes, $compactadorID = null) {
        $c = conexionBD::conexionPDO();
    
        $sql = "SELECT A.ID_ASIGNACION, C.CODIGO AS COMPACTADOR, A.FECHA_INICIO, A.FECHA_FIN, 
                       A.TURNO, R.NOMBRE AS RUTA, A.ESTADO, P.NOMBRE_COMPLETO AS EMPLEADO, 
                       COALESCE(DC.CARGO, 'AYUDANTE') AS CARGO, A.COD_TRIPULACION
                FROM ASIGNACION_COMPACTADOR A
                JOIN INVENTARIO_COMPACTADORES C ON A.ID_COMPACTADOR = C.ID_COMPACTADOR
                JOIN PERSONA P ON A.PERSONA = P.PERSONA
                JOIN RUTAS R ON A.ID_RUTA = R.ID_RUTA
                LEFT JOIN DETALLE_CARGO DC ON A.PERSONA = DC.PERSONA 
                    AND DC.F_INICIO = (SELECT MAX(F_INICIO) 
                                       FROM DETALLE_CARGO 
                                       WHERE DETALLE_CARGO.PERSONA = A.PERSONA)
                WHERE MONTH(A.FECHA_INICIO) = ?";
    
        // Si se seleccionó un compactador específico, agregar el filtro
        if (!is_null($compactadorID) && $compactadorID !== '') {
            $sql .= " AND A.ID_COMPACTADOR = ?";
            $query = $c->prepare($sql);
            $query->execute([$mes, $compactadorID]);
        } else {
            $query = $c->prepare($sql);
            $query->execute([$mes]); // No filtra por compactador, muestra todos
        }
    
        $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
    
        $asignacionesAgrupadas = [];
    
        foreach ($resultados as $fila) {
            $codTripulacion = $fila['COD_TRIPULACION'];
    
            if (!isset($asignacionesAgrupadas[$codTripulacion])) {
                $asignacionesAgrupadas[$codTripulacion] = [
                    "ID_ASIGNACION" => $fila["ID_ASIGNACION"],
                    "COMPACTADOR" => $fila["COMPACTADOR"],
                    "FECHA_INICIO" => $fila["FECHA_INICIO"],
                    "FECHA_FIN" => $fila["FECHA_FIN"],
                    "TURNO" => $fila["TURNO"],
                    "RUTA" => $fila["RUTA"],
                    "ESTADO" => $fila["ESTADO"],
                    "EMPLEADOS" => []
                ];
            }
    
            // Agregar empleados con su respectivo cargo
            $asignacionesAgrupadas[$codTripulacion]["EMPLEADOS"][] = [
                "nombre" => $fila["EMPLEADO"],
                "cargo" => $fila["CARGO"]
            ];
        }
    
        return json_encode(["data" => array_values($asignacionesAgrupadas)], JSON_UNESCAPED_UNICODE);
    }
    
    
    
    

}

?>