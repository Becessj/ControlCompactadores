<?php
require_once 'model_conexion.php';

class Modelo_Cargo extends conexionBD {

    public function Registrar_Cargo($persona, $cargoNombre, $area, $fecha_inicio, $fecha_fin, $brevete, $categoria, $fecha_vencimiento, $usuario_crea) {
        try {
            $c = conexionBD::conexionPDO();
    
            if (!$c) {
                throw new Exception("Error de conexión a la base de datos");
            }
    
            // Si el cargo es "Conductor", guardar brevete, categoría y fecha de vencimiento
            if ($cargoNombre === "CONDUCTOR") {
                $sql = "INSERT INTO DETALLE_CARGO (PERSONA, CARGO, AREA, F_INICIO, F_FINAL, E, USUARIO_CREA, F_CREA, USUARIO_MODIFICA, F_MODIFICA, ALMACEN, BREVETE, CATEGORIA, FECHA_VENCIMIENTO)  
                        VALUES (?, ?, ?, ?, ?, 'A', ?, GETDATE(), 'ADMINWEB', GETDATE(), 'CAMPAMENTO', ?, ?, ?)";
                
                $query = $c->prepare($sql);
                $params = [$persona, $cargoNombre, $area, $fecha_inicio, $fecha_fin, $usuario_crea, $brevete, $categoria, $fecha_vencimiento];
            } else {
                // Si NO es "Conductor", no guardar brevete ni categoría ni fecha de vencimiento
                $sql = "INSERT INTO DETALLE_CARGO (PERSONA, CARGO, AREA, F_INICIO, F_FINAL, E, USUARIO_CREA, F_CREA, USUARIO_MODIFICA, F_MODIFICA, ALMACEN)  
                        VALUES (?, ?, ?, ?, ?, 'A', ?, GETDATE(), 'ADMINWEB', GETDATE(), 'CAMPAMENTO')";
                
                $query = $c->prepare($sql);
                $params = [$persona, $cargoNombre, $area, $fecha_inicio, $fecha_fin, $usuario_crea];
            }
    
            if (!$query->execute($params)) {
                $errorInfo = $query->errorInfo();
                throw new Exception("Error SQL: " . $errorInfo[2]);
            }
    
            return true;
    
        } catch (Exception $e) {
            error_log("SQL Error en Registrar_Cargo: " . $e->getMessage());
            return false;
        }
    }
    
    public function Listar_Cargos(){
        $c = conexionBD::conexionPDO();
        $sql = "SELECT DC.DET_CARGO,P.NOMBRE_COMPLETO,DC.BREVETE, DC.CATEGORIA, DC.FECHA_VENCIMIENTO,  P.DIRECCION_FISCAL,DC.PERSONA, DC.CARGO, DC.F_INICIO, DC.F_FINAL, DC.AREA, DC.E
                FROM DETALLE_CARGO DC
                JOIN PERSONA P ON DC.PERSONA = P.PERSONA
				WHERE P.E = 'A' and DC.CARGO IN('CONDUCTOR','AYUDANTE') AND GETDATE() <= DC.F_FINAL
                ORDER BY DC.DET_CARGO DESC";
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
    // ✅ Función para actualizar un cargo en la BD
    public function Editar_Cargo($id_cargo, $cargoNombre, $area, $fecha_inicio, $fecha_fin, $estado, $brevete = null, $categoria = null, $fecha_vencimiento = null) {
        try {
            $c = conexionBD::conexionPDO();
    
            // Si el cargo es "CONDUCTOR", incluir brevete, categoría y fecha de vencimiento en la actualización
            if ($cargoNombre === "CONDUCTOR") {
                $sql = "UPDATE DETALLE_CARGO 
                        SET CARGO = ?, AREA = ?, F_INICIO = ?, F_FINAL = ?, 
                            USUARIO_MODIFICA = 'ADMINWEB', F_MODIFICA = GETDATE(), 
                            E = ?, BREVETE = ?, CATEGORIA = ?, FECHA_VENCIMIENTO = ?
                        WHERE DET_CARGO = ?";
                $query = $c->prepare($sql);
                return $query->execute([$cargoNombre, $area, $fecha_inicio, $fecha_fin, $estado, $brevete, $categoria, $fecha_vencimiento, $id_cargo]);
            } else {
                // Si NO es "CONDUCTOR", actualizar solo los datos básicos y limpiar brevete/categoría/fecha_vencimiento
                $sql = "UPDATE DETALLE_CARGO 
                        SET CARGO = ?, AREA = ?, F_INICIO = ?, F_FINAL = ?, 
                            USUARIO_MODIFICA = 'ADMINWEB', F_MODIFICA = GETDATE(), 
                            E = ?, BREVETE = NULL, CATEGORIA = NULL, FECHA_VENCIMIENTO = NULL
                        WHERE DET_CARGO = ?";
                $query = $c->prepare($sql);
                return $query->execute([$cargoNombre, $area, $fecha_inicio, $fecha_fin, $estado, $id_cargo]);
            }
        } catch (Exception $e) {
            error_log("Error en Editar_Cargo: " . $e->getMessage());
            return false;
        }
    }
    
}
?>
