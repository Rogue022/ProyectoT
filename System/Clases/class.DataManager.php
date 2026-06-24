<?php
// esta clase se va a encargar de hacer las conexiones y recuperar la información de la base de datos
//o sea, esto es puro gets!!!!

class DataManager
{
    private static $conexionDB = null; //nombre común a una instancia de PHP que es estática para que no se vuelva a crear cuando se vuelva a llamar


    public static function iniciaConexion(): PDO
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

    public static function cierraConexion()
    {
        self::$conexionDB = NULL;
    }

    public static function _getConexion()
    {
        return self::$conexionDB;
    }

    public static function muestraConexion()
    {
        try {
            self::iniciaConexion();
            if (self::$conexionDB instanceof PDO) {
                echo "Estás conectada";
            } else {
                echo "error";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //altas y bajas

    //insertar datos del examen (viene de formulario)
    public static function insertarExamen($examen)
    {

        self::iniciaConexion();

        try {
            //como el insert de un examen involucra un buen de tablas, hay que hacerlo en orden y con paciencia
            //y por supuesto con control de transacciones.
            //1. Se inician las transacciones
            self::$conexionDB->beginTransaction();


            //1. Insertar en PROCEDENCIA
            $insertProcedencia = self::$conexionDB->prepare("INSERT INTO Procedencia (nomProcedencia, Apariciones) VALUES (:escuelaProcedencia, 1)
                                                            ON DUPLICATE KEY UPDATE apariciones = apariciones+1");
            $insertProcedencia->execute([':escuelaProcedencia' => $examen['escuela_procedencia']]);


            //para recuperar el id de procedencia, debemos de buscar el último id para ponerlo en elemento (Examen)
            $recupera = self::$conexionDB->prepare("SELECT idProcedencia FROM Procedencia WHERE nomProcedencia = :nombre");
            $recupera->execute([':nombre' => $examen['escuela_procedencia']]);
            $idProcedencia = $recupera->fetchColumn();


            //2. Insertar en PARAMETROSEXAMEN
            $insertParam = self::$conexionDB->prepare("INSERT INTO ParametrosExamen (nomExamen, FechaExamen, Semestre) VALUES 
                                                        (:nomExamen, :fechaExamen, :semestre)");
            $insertParam->execute([
                ':nomExamen' => $examen['tipo_examen'],
                ':fechaExamen' => $examen['fecha_examen'],
                ':semestre' => 1
            ]);
            //recuperamos el id de parametros examen
            $idParametros = self::$conexionDB->lastInsertId();

            //3. insertar un nuevo elemento
            $query = self::$conexionDB->prepare("INSERT INTO Elemento 
                                                (Carrera_idCarrera, Procedencia_idProcedencia, ParametrosExamen_idExamen, Calificacion, NumReactivos) VALUES 
                                                (:carrera, :procedencia, :param_exam, :calificacion, :numReactivos)");

            $query->execute([
                ':carrera' => $examen['clave_carrera'],
                ':procedencia' => $idProcedencia,
                ':param_exam' => $idParametros,
                ':calificacion' => $examen['calificacion'],
                ':numReactivos' => 5
            ]);

            echo "<br>Inserción exitosa";

            //se hace commit al final, si no, rollback
            self::$conexionDB->commit();
        } catch (PDOException $e) {
            //aquí es el rollback: 
            self::$conexionDB->rollBack();
            echo "Hubo un error al ingresar tu examen....";
            echo "Error: " . $e->getMessage();
        }
    }

    //para insertar un key que se genere por cada documento pdf subido
    public static function insertarDocumento($nuevoNombre, $destArch, $numeroPags)
    {
        echo "Llegaste a insertarDocumento en datamanager";
        echo $nuevoNombre;
        echo $destArch;
        echo $numeroPags;
    }

    public static function _getUsuarios()
    {
        self::iniciaConexion();

        try {
            $sql = 'SELECT * FROM Usuarios';
            //query es una clase de PDO que se usa para
            //ejecutar una sentencia SQL directamente cuando no
            //necesitas usar parámetros
            //devuelve un objeto de tipo PDOStatement, que es la consulta preparada o ejecutada
            //permite extraer los datos fila por fila o todos juntos
            $stmt = self::$conexionDB->query($sql);
            $listaUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $listaUsuarios;
        } catch (PDOException $E) {
            echo $E;
        }
    }

    public static function _getExamen()
    {

        self::iniciaConexion();

        try {

            $declaracion = self::$conexionDB->query("SELECT idExamen, nomExamen FROM ParametrosExamen WHERE EstatusEx = 'ACTIVO'");
            $examen = $declaracion->fetch(PDO::FETCH_ASSOC);

            return $examen;
        } catch (PDOException $e) {
            echo "Error al recuperar examen: " . $e;
        }
    }



    //recuperar preguntas del examen para visualización

    public static function _getPregunta($numeroExamen)
    {

        self::iniciaConexion();

        try {
            //como voy a ocupar una variable, hago el query con prepare 

            $declaracion = self::$conexionDB->prepare("SELECT * FROM Pregunta WHERE PreguntaExamen_idExamen = :num");

            $declaracion->execute([
                ':num' => $numeroExamen
            ]);

            return $declaracion->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e;
        }
    }

    public static function _setExamenActivo($numeroExamen)
    {
        self::iniciaConexion();
        
        try {
            //como voy a ocupar una variable, hago el query con prepare 
            $decSEL = self::$conexionDB->prepare("SELECT EstatusEx FROM ParametrosExamen WHERE idExamen = :num");

            $decSEL->execute([':num' => $numeroExamen]);

            if ($decSEL->rowCount()==0)
            {
                echo "ID de examen no encontrado";
                exit;
            } else {
                self::$conexionDB->query("CALL proc_syncEstatusInactivo()");

                $declararUpdate = self::$conexionDB->prepare("UPDATE ParametrosExamen SET EstatusEx = 'ACTIVO' WHERE idExamen = :num");

                $declararUpdate->execute([
                    ':num' => $numeroExamen
                ]);

                echo "Examen actualizado al ID: " . $numeroExamen. "<br> Recargar la pagina. ";

            }
        } catch (PDOException $e) {
            echo "Error: " . $e;
        }
    }
}
