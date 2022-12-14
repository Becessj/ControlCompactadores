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
                $arreglo[] = $resp;
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
    }


?>