<?php
    require_once 'model_conexion.php';
    class Modelo_Area extends conexionBD{
        public function Listar_Area(){
            $c = conexionBD::conexionPDO();
            $sql = "exec SP_LISTAR_AREA";
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