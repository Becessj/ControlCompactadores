<?php
    require_once 'model_conexion.php';
    class Modelo_Responsable extends conexionBD{
        public function Listar_Responsable(){
            $c = conexionBD::conexionPDO();
            $sql = "SELECT * FROM VS_CONTRIBUYENTE_ARB";
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
        public function Registrar_Responsable($apaterno,$amaterno,$nomb,$direc,$ndoc,$tpersona,$usu){
            $c = conexionBD::conexionPDO();
            $sql = "exec SP_INSERTAR_ARBITRIO ?,?,?,?,?,?,?";
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$apaterno);
            $query -> bindParam(2,$amaterno);
            $query -> bindParam(3,$nomb);
            $query -> bindParam(4,$direc);
            $query -> bindParam(5,$ndoc);
            $query -> bindParam(6,$tpersona);
            $query -> bindParam(7,$usu);
            $query -> execute();
            if($row = $query -> fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }
        public function Modificar_Responsable($responsable,$apaterno,$amaterno,$nomb,$direc,$ndoc,$tpersona,$usu){
            $c = conexionBD::conexionPDO();
            $sql = "SET NOCOUNT ON  exec SP_EDITAR_ARBITRIO ?,?,?,?,?,?,?,?";
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$responsable);
            $query -> bindParam(2,$apaterno);
            $query -> bindParam(3,$amaterno);
            $query -> bindParam(4,$nomb);
            $query -> bindParam(5,$direc);
            $query -> bindParam(6,$ndoc);
            $query -> bindParam(7,$tpersona);
            $query -> bindParam(8,$usu);
            $query -> execute();
            if($row = $query -> fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }
    }


?>