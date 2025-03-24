<?php
require_once 'model_conexion.php';
class Modelo_Asistencia extends conexionBD{

    public function Registrar_Entrada($id_asignacion, $persona, $firma_entrada) {
        try {
            $c = conexionBD::conexionPDO();
            $sql = "INSERT INTO ASISTENCIA_PERSONAL (ID_ASIGNACION, PERSONA, HORA_ENTRADA, FIRMA_ENTRADA, ESTADO, USUARIO_REGISTRO)
                    VALUES (?, ?, GETDATE(), ?, 'PENDIENTE', 'ADMIN')";
            $query = $c->prepare($sql);
            $query->execute([$id_asignacion, $persona, $firma_entrada]);
            return ["success" => true];
        } catch (PDOException $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    public function Registrar_Salida($id_asistencia, $firma_salida) {
        try {
            $c = conexionBD::conexionPDO();
            $sql = "UPDATE ASISTENCIA_PERSONAL SET HORA_SALIDA = GETDATE(), FIRMA_SALIDA = ?, ESTADO = 'COMPLETADO' WHERE ID_ASISTENCIA = ?";
            $query = $c->prepare($sql);
            $query->execute([$firma_salida, $id_asistencia]);
            return ["success" => true];
        } catch (PDOException $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    public function Listar_Asistencia() {
        try {
            $c = conexionBD::conexionPDO();
            $sql = "SELECT ID_ASISTENCIA, PERSONA, FECHA, HORA_ENTRADA, HORA_SALIDA, ESTADO FROM ASISTENCIA_PERSONAL";
            $query = $c->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }
    
}
?>

