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
    }


?>