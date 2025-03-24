<?php
    require_once 'model_conexion.php';
    class Modelo_Cuenta extends conexionBD{
        public function Listar_Cuenta($resp){
            $c = conexionBD::conexionPDO();
            $sql = "SET NOCOUNT ON  EXEC REPORTE_ESTADO_CTA_LIMPIEZA ?";
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$resp);
            $query -> execute();
            $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
        public function Listar_Periodo($agno){
            $c = conexionBD::conexionPDO();
            $sql = "set nocount on SELECT	P.* FROM	PERIODO_PAGO P INNER JOIN GENERADOR G ON G.GENERADOR=P.GENERADOR WHERE
                    AGNO= $agno AND G.AREA LIKE 'ARBITRIOS' ORDER BY P.GENERADOR,P.PERIODO";
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$agno);
            $query -> execute();
            $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
        public function Listar_Predios($resp){
            $c = conexionBD::conexionPDO();
            $sql = " SELECT * FROM VS_RESPONSABLE_PREDIO_ARBITRIO
            WHERE RESPONSABLE = '$resp'";
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$resp);
            $query -> execute();
            $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
        public function Listar_Predios2($resp){
            $c = conexionBD::conexionPDO();
            $sql = "SELECT A.PREDIO_U AS PREDIO,P.OBS_UBICACION + CASE WHEN ISNULL( P.MANZANA,'') = '' THEN '' ELSE ' Manzana.'  +P.MANZANA END
            + CASE WHEN ISNULL(P.LOTE,'') = '' THEN '' ELSE ' Lote.'  +P.LOTE END 
            + CASE WHEN ISNULL(P.NUMERO,'') = '' THEN '' ELSE ' Nro.'  +P.NUMERO END  AS DIRECCION
            FROM RESPONSABLE_PU A, PREDIO_U P
            WHERE A.PREDIO_U = P.PREDIO_U
            AND A.RESPONSABLE = '$resp'
            UNION
            SELECT A.PREDIO_R AS PREDIO, P.OBS_UBICACION AS DIRECCION 
            FROM RESPONSABLE_PR A, PREDIO_R P
            WHERE A.PREDIO_R = P.PREDIO_R
            AND A.RESPONSABLE = '$resp'";
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$resp);
            $query -> execute();
            $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
        public function Listar_Cuentas_Pendientes($resp){
            $c = conexionBD::conexionPDO();
            $sql = "DECLARE @ERROR nvarchar(4000)
                    DECLARE @NROERROR int
                    SET NOCOUNT ON EXECUTE SELECCION_CUENTAS_ARBITRIOS_GENERAL 
                        ?
                        ,'LIMPPU'
                        ,'@ERROR OUTPUT'
                        ,@NROERROR OUTPUT";
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$resp);
            $query -> execute();
            $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
        public function Cargar_Select_Todos_Periodos(){
            $c = conexionBD::conexionPDO();
            $sql = "select PERIODO from periodo_pago where generador ='LIMPPU' ORDER BY PERIODO DESC";
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
        public function Btn_Generar_Deuda($agno,$generador,$fraccionar,$periodoini,$periodofin,$gastoadm,$clave,$usuario,$error,$nroerror){
            $c = conexionBD::conexionPDO();
            $sql = "set nocount on EXEC CREAR_CUENTAS_ANUALES_LIMPU_PERIODOS ?,?,?,?,?,?,?,?,?,?";
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$agno);
            $query -> bindParam(2,$generador);
            $query -> bindParam(3,$fraccionar);
            $query -> bindParam(4,$periodoini);
            $query -> bindParam(5,$periodofin);
            $query -> bindParam(6,$gastoadm);
            $query -> bindParam(7,$clave);
            $query -> bindParam(8,$usuario);
            $query -> bindParam(9,$error);
            $query -> bindParam(10,$nroerror);
            $query -> execute();
            $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
        public function Listar_Deudas_Generadas($resp,$periodoini,$periodofin,$predio){
            $c = conexionBD::conexionPDO();
            $sql = "SELECT	C.PERIODO,MONTO,GASTOADM,CA.PREDIO_U AS PREDIO,C.E, CAST(CASE WHEN C.GENERADOR = 'LIMPPU' THEN 'LIMPIEZA' ELSE 'PARQUES Y JARDINES' END AS VARCHAR(50)) AS TIPO
            FROM dbo.CUENTA_A C  INNER JOIN dbo.CUENTA_ARBITRIO CA
                      ON C.CUENTA=CA.CUENTA 
            WHERE	 CONTRIBUYENTE='$resp'
                  AND C.PERIODO>='$periodoini'
                  AND C.PERIODO<='$periodofin'
                  AND C.GENERADOR='LIMPPU'
                              AND CA.PREDIO_U LIKE '$predio'
                              AND C.E = 'A'
            ORDER BY CA.PREDIO_U, C.PERIODO";
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$resp);
            $query -> bindParam(2,$periodoini);
            $query -> bindParam(3,$periodofin);
            $query -> bindParam(4,$predio);
            $query -> execute();
            $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
        public function Insertar_Clave($clave,$respons,$predio,$tipo_resp,$A){
            $c = conexionBD::conexionPDO();
            $sql = "set nocount on INSERT INTO SELECCION_CONTRIBUYENTE_ARB (CLAVE,CONTRIBUYENTE,PREDIO,TIPO_RESPONSABLE,E) values ($clave,'$respons','$predio','$tipo_resp','$A')";
       
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$clave);
            $query -> bindParam(2,$respons);
            $query -> bindParam(3,$predio);
            $query -> bindParam(4,$tipo_resp);
            $query -> bindParam(5,$A);
            $query -> execute();
           // var_dump($query);
            if($row = $query -> fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();
        }
        public function Eliminar_Clave($clave){
            $c = conexionBD::conexionPDO();
            $sql = "delete from SELECCION_CONTRIBUYENTE_ARB where clave='$clave'";
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$clave);
            $query -> execute();
            var_dump($query);
            if($row = $query -> fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();
        }
        
   
        
    }
?>