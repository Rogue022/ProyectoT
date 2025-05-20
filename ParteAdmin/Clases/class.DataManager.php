<?php
// esta clase se va a encargar de hacer las conexiones y recuperar la información de la base de datos
//o sea, esto es puro gets!!!!

class DataManager
{
    private static $conexionDB = null; //nombre común a una instancia de PHP que es estática para que no se vuelva a crear cuando se vuelva a llamar

    private static function iniciaConexion () : PDO
     {
        if (self::$conexionDB === NULL) //si no está instanciada, se crea la conexión a la BD
        {
            $dotenv = parse_ini_file('.env'); //elementos ocultos por seguridad
            try {
                //se envían los elementos de inicio se sesión a la db
                self::$conexionDB = new PDO(
                    "mysql:host={$dotenv['DB_HOST']};dbname={$dotenv['DB_NAME']}",
                    $dotenv['DB_USER'],
                    $dotenv['DB_PASS'],
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]

                );
            } catch (PDOException $e) { //manejo de excepciones para la conexión a la base de datos
                die("Error de conexión: " . $e->getMessage()); //mensajes ya prediseñados
            }
        }
        return self::$conexionDB; //si ya está abierta la sesión, devuelve el resultado. 
    }

    public static function _getConexion():PDO{
        return self::$conexionDB;
    }

    public static function muestraConexion()
    {
        try {
            $nuevaConexion = self::iniciaConexion();

            if ($nuevaConexion instanceof PDO) {
                echo "Conectada";
            } else {
                echo "error";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
