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
        public function Registrar_Area($area){
            $c = conexionBD::conexionPDO();
            $sql = "exec SP_REGISTRAR_AREA ?";
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$area);
            $query -> execute();
            if($row = $query -> fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }
        public function Modificar_Area($area,$estatus){
            $c = conexionBD::conexionPDO();
            $sql = "exec SP_MODIFICAR_AREA ? , ?";
            $query = $c -> prepare($sql);
            $query -> bindParam(1,$area);
            $query -> bindParam(2,$estatus);
            $query -> execute();
            if($row = $query -> fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }
    }


?>