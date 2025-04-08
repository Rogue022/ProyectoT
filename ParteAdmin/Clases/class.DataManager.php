<?php 

    class DataManager{

        private static $pdo = null;

        private static function _getConnection(){
            
            if (self::$pdo === NULL)
            {
                $dotenv = parse_ini_file('.env');
                try
                {
                    self::$pdo = new PDO( 
                        "mysql:host={$dotenv['DB_HOST']};dbname={$dotenv['DB_NAME']}",
                        $dotenv['DB_USER'],
                        $dotenv['DB_PASS'],
                        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                        
                    );
                    
                } catch (PDOException $e) {
                    die("Error de conexión: " . $e->getMessage());
                }
            }
            return self::$pdo;
        }

        public static function insertDocument($fileName, $filePath, $numPages){
            try {
                $pdo = self::_getConnection();

                $stmt = $pdo->prepare(
                    "INSERT INTO controlDocumentos
                    (NombreDocumento, FechaCreacion, UltimaModificacion, RutaArchivo, NumPags, Borrado)
                    VALUES (?, NOW(), NOW(), ?, ?, 0)"
                );

                $stmt->execute([$fileName, $filePath, $numPages]);

                return $pdo->lastInsertId(); // Retorna el último ID insertado
                
            } catch (PDOException $e) {
                echo "Error al insertar en la base de datos: " . $e->getMessage();
                return false;
            }
        }
    }
?>