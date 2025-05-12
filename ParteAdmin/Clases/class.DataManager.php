<?php 
    // esta clase se va a encargar de hacer las conexiones y recuperar la información de la base de datos
    //o sea, esto es puro gets!!!!

    class DataManager{
        private static $pdo = null; //nombre común a una instancia de PHP que es estática para que no se vuelva a crear cuando se vuelva a llamar
        private static function _getConnection(){
            
            if (self::$pdo === NULL) //si no está instanciada, se crea la conexión a la BD
            {
                $dotenv = parse_ini_file('.env'); //elementos ocultos por seguridad
                try
                {
                    self::$pdo = new PDO( 
                        "mysql:host={$dotenv['DB_HOST']};dbname={$dotenv['DB_NAME']}",
                        $dotenv['DB_USER'],
                        $dotenv['DB_PASS'],
                        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                        
                    );
                    
                } catch (PDOException $e) { //manejo de excepciones para la conexión a la base de datos
                    die("Error de conexión: " . $e->getMessage()); //mensajes ya prediseñados
                }
            }
            return self::$pdo; //si ya está abierta la sesión, devuelve el resultado. 
        }

        public static function insertarDocumento($nombreArchivo, $direccionArchivo, $numeroPaginas){
            try {
                $pdo = self::_getConnection(); //vemos si está conectada la base de datos

                $consulta = $pdo->prepare( //preparamos la consulta con los placeholders
                    "INSERT INTO controlDocumentos
                    (NombreDocumento, FechaCreacion, UltimaModificacion, RutaArchivo, NumPags, Borrado)
                    VALUES (?, NOW(), NOW(), ?, ?, 0)" 
                );

                $consulta->execute([$nombreArchivo, $direccionArchivo, $numeroPaginas]); //placeholders se llenan

                return $pdo->lastInsertId(); // Retorna el último ID insertado para comprobar el ingreso

            } catch (PDOException $e) { //manejo de excepciones para ingresarlo en la base de datos
                echo "Error al insertar en la base de datos: " . $e->getMessage();
                return false;
            }
        } 

        public static function guardaExamen(RegistroExamen $examen) {
            try {
                // Conexión a la base de datos
                $pdo = self::_getConnection();


                // Insertar el examen en la base de datos
                $sql = "INSERT INTO parametrosexamen(nomExamen, FechaExamen, Semestre) VALUES (?, ?, 1)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$examen->tipoExamen, $examen->fechaExamen]);
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        
    }

?>