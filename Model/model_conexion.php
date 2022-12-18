<?php
class conexionBD{
    public function conexionPDO(){
        $host = "PC-218\SQL2014";
        $usuario = "sa";
        $contrasena = "gpa";
        $dbName = "RENTAS_CANCHIS";
        try {
            $pdo = new PDO("sqlsrv:server=$host;database=$dbName", $usuario, $contrasena);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$pdo -> exec("set names utf8");
            return $pdo;
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }
    public function cerrar_conexion(){
        $this -> $pdo=null;

    }
}
?>