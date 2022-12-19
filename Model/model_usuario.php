<?php
    require_once 'model_conexion.php';
    class Modelo_Usuario extends conexionBD{
        public function Verificar_Usuario($usu,$con){
            $c = conexionBD::conexionPDO();
            $sql = "exec SP_VERIFICAR_USUARIO ?";
            $arreglo = array();
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$usu);
            $query -> execute();
            $resultado = $query -> fetchAll();
            foreach($resultado as $resp){
                 if($con ==$resp['CLAVE']){
                    $arreglo[] = $resp;
                }
            }
            return $arreglo;
            conexionBD::cerrar_conexion();

        }

        public function Listar_Usuario(){
            $c = conexionBD::conexionPDO();
            $sql = "exec SP_LISTAR_USUARIO";
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
        public function Cargar_Select_Usuario(){
            $c = conexionBD::conexionPDO();
            $sql = "exec SP_CARGAR_SELECT_USUARIO";
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
        public function Cargar_Select_Area(){
            $c = conexionBD::conexionPDO();
            $sql = "exec SP_CARGAR_SELECT_AREA";
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
        public function Registrar_Usuario($nombecompleto,$usu,$con,$direc,$ida,$rol){
            $c = conexionBD::conexionPDO();
            $sql = "exec SP_REGISTRAR_USUARIO ?,?,?,?,?,?";
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$nombecompleto);
            $query -> bindParam(2,$usu);
            $query -> bindParam(3,$con);
            $query -> bindParam(4,$direc);
            $query -> bindParam(5,$ida);
            $query -> bindParam(6,$rol);
            $query -> execute();
            if($row = $query -> fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }
        public function Modificar_Usuario($nomb,$direc,$usu,$con,$rol,$est){
            $c = conexionBD::conexionPDO();
            $sql = "exec SP_MODIFICAR_USUARIO ?,?,?,?,?,?";
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$nomb);
            $query -> bindParam(2,$direc);
            $query -> bindParam(3,$usu);
            $query -> bindParam(4,$con);
            $query -> bindParam(5,$rol);
            $query -> bindParam(6,$est);
            $query -> execute();
            if($row = $query -> fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }
    }


?>