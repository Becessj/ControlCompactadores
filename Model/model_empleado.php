<?php
    require_once 'model_conexion.php';
    class Modelo_Empleado extends conexionBD{
        public function Listar_Cargo(){
            $c = conexionBD::conexionPDO();
            $sql = "SELECT P.PERSONA, P.NOMBRE_COMPLETO, P.DIRECCION_FISCAL, P.TIPO_DOC, P.NRO_DOC, D.CARGO 
            FROM PERSONA P
            JOIN DETALLE_CARGO D ON P.PERSONA = D.PERSONA
            WHERE P.E = 'A' and D.CARGO IN('CHOFER','RECOGEDOR') AND GETDATE() <= D.F_FINAL";
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
        public function Listar_Empleado(){
            $c = conexionBD::conexionPDO();
            $sql = "SELECT * FROM PERSONA WHERE E = 'A' ORDER BY PERSONA DESC";

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
        public function combo_empleado(){
            $c = conexionBD::conexionPDO();
            $sql = "SELECT P.PERSONA, P.NOMBRE_COMPLETO, P.DIRECCION_FISCAL, P.TIPO_DOC, P.NRO_DOC, D.CARGO ,D.BREVETE 
            FROM PERSONA P
            JOIN DETALLE_CARGO D ON P.PERSONA = D.PERSONA
            WHERE P.E = 'A' and D.CARGO IN('CONDUCTOR','AYUDANTE') AND GETDATE() <= D.F_FINAL";
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
        public function Generar_Codigo_Persona($usuario) { 
            $c = conexionBD::conexionPDO();
        
            try {
                // 1️⃣ Llamar al procedimiento almacenado
                $sql_cod = "{CALL GENERAR_SIGUIENTE_CODIGO(?, ?, ?, ?)}";
                $query_cod = $c->prepare($sql_cod);
        
                // Definir variables
                $tipo = 'PERSONA';
                $paramOutput = str_repeat(' ', 10); // Relleno para evitar NULLs
        
                // Asociar parámetros
                $query_cod->bindParam(1, $tipo, PDO::PARAM_STR);
                $query_cod->bindParam(2, $usuario, PDO::PARAM_STR);
                $query_cod->bindParam(3, $tipo, PDO::PARAM_STR);
                $query_cod->bindParam(4, $paramOutput, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 10);
        
                $query_cod->execute();
        
                // 2️⃣ Capturar y limpiar el código generado
                $codPersona = trim(str_replace("\0", '', $paramOutput)); // Elimina NULLs y espacios
        
                // Verificar si el código es válido
                if (empty($codPersona) || strlen($codPersona) < 6) {
                    throw new Exception("Error al generar COD_PERSONA. Código recibido: " . json_encode($codPersona));
                }
        
                error_log("COD_PERSONA generado correctamente: '" . $codPersona . "'");
                return $codPersona;
        
            } catch (Exception $e) {
                error_log("SQL Error en Generar_Codigo_Persona: " . $e->getMessage());
                return null;
            }
        }
        public function Registrar_Empleado($ap, $am, $nombres, $nombreCompleto, $direccion, $tipo_doc, $nro_doc, $tipo_persona, $celular, $email, $usuario_crea) {
            $c = conexionBD::conexionPDO();
            
            try {
                $c->beginTransaction();

                // 1️⃣ Generar el código de persona
                $persona = $this->Generar_Codigo_Persona($usuario_crea);
           
                if (!$persona) {
                    throw new Exception("Error al obtener el COD_PERSONA.");
                }


                // 3️⃣ Insertar persona en la base de datos
                $sql = "INSERT INTO PERSONA (PERSONA, AP, AM, NOMBRES, NOMBRE_COMPLETO, DIRECCION_FISCAL, 
                                            TIPO_DOC, NRO_DOC, TIPO_PERSONA, CELULAR, EMAIL, 
                                            E, CENTRAL, USUARIO_CREA, F_CREA,USUARIO_MODIFICA,F_MODIFICA)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'A', 'N', ?, GETDATE(),'ADMINWEB',GETDATE())";

                $query = $c->prepare($sql);
                $query->execute([$persona, $ap, $am, $nombres, $nombreCompleto, $direccion, 
                                $tipo_doc, $nro_doc, $tipo_persona, $celular, $email, $usuario_crea]);

                $c->commit();
                return true;

            } catch (Exception $e) {
                $c->rollBack();
                error_log("SQL Error en Registrar_Empleado: " . $e->getMessage());
                return false;
            }
}
                // 🔹 Editar un empleado existente
        public function Editar_Empleado($persona, $ap, $am, $nombres, $nombreCompleto, $direccion, $tipo_doc, $nro_doc, $tipo_persona, $celular, $email, $usuario_modifica) {
            $c = conexionBD::conexionPDO();

            try {
                $sql = "UPDATE PERSONA SET AP = ?, AM = ?, NOMBRES = ?, NOMBRE_COMPLETO = ?, 
                        DIRECCION_FISCAL = ?, TIPO_DOC = ?, NRO_DOC = ?, TIPO_PERSONA = ?, 
                        CELULAR = ?, EMAIL = ?, USUARIO_MODIFICA = ?, F_MODIFICA = GETDATE()
                        WHERE PERSONA = ?";

                $query = $c->prepare($sql);
                $resultado = $query->execute([$ap, $am, $nombres, $nombreCompleto, $direccion, $tipo_doc, $nro_doc, $tipo_persona, $celular, $email, $usuario_modifica, $persona]);

                return $resultado;

            } catch (Exception $e) {
                error_log("SQL Error en Editar_Empleado: " . $e->getMessage());
                return false;
            }
        }
        public function Personas_Mensual() {
            $c = conexionBD::conexionPDO();
            $sql = "SELECT COUNT(*) AS TOTAL_PERSONAS
                    FROM PERSONA
                    WHERE 
                         E = 'A'"; 
            $query = $c->prepare($sql);
            $query->execute();
            return json_encode($query->fetchAll(PDO::FETCH_ASSOC)); // Devuelve la cantidad total
        }
        
        
   
                
      
    }
?>