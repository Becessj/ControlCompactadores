<?php
class conexionBD{
    public function conexionPDO(){
        $host = "DESKTOP-0UKIJS0\SQLEXPRESS";
        $usuario = "sa";
        $contrasena = "gpa";
        $dbName = "RENTAS";
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