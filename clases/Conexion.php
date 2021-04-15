<?php
namespace Clases;
use PDO;
use PDOException;
// Creo la clase. Debe tener el mismo nombre que el archivo. En este caso, Conexion
class Conexion {
    protected static $conexion;

    public function __construct() {
        if(self::$conexion==null) {
            self::crearConexion();
        }
    }
    public static function crearConexion() {
        // 1.- leemos el archivo de configuración
        $opciones=parse_ini_file('../.config'); //localizado a un nivel anterior del directorio actual
        $mibase=$opciones["bbdd"];
        $miUser=$opciones["usuario"];
        $miPass=$opciones["pass"];
        $miHost=$opciones["host"];
        // 2.- Creo el dns (descriptor de servicio) con estos parámetros
        $dns="mysql:host=$miHost;dbname=$mibase;charset=utf8mb4";
        // 3.- Creo la conexión
        try {
            self::$conexion=new PDO($dns, $miUser, $miPass);
            // Lo siguiente solo para depurar errores
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $ex) {
            die("Error al conectar a la BBDD, mensaje: ".$ex->getMessage());
        }
    }
}
?>