<?php
header('Content-Type: text/html; charset=UTF-8');
include_once(__DIR__ . '/../ParteAdmin/Clases/class.DataManager.php');


// Incluir autoload de Composer
require '../vendor/autoload.php'; // Cargar las dependencias de Composer para manejar el PDF
use setasign\Fpdi\Fpdi; // Uso de namespaces


//lo que va a hacer esta clase es que va a guardar y a administrar el examen físico (que será escaneado)

class ExamenFisico extends Examen
{
    private $directorioDestino = __DIR__ . "../Uploads/"; //carpeta de destino en donde se guardarán los archivos
    private $max_size = 10 * 1024 * 1024; //tamaño máximo de los archivos
    private $nuevoNombre;
    private $numeroPags = 0;
    private $ultimo_id;
    private $destArch;

    public function verificaArchivo($arch_tmp)
    {
        //verificación que sea PDF
        $tipoArch = mime_content_type($arch_tmp); //detecta el tipo MIME del archivo por su contenido para prevenir falsificaciones

        if ($tipoArch !== "application/pdf") {
            die("Solo se permiten archivos PDF.");
        }
        //verificación del tamaño PDF
        if ($_FILES["archivoPDF"]["size"] > $this->max_size) {
            die("El archivo excede el tamaño máximo permitido (5 MB).");
        }
    }

    public function setNombreArchivo()
    {
        //nuevo nombre de archivo para subirlo a la carpeta destino
        $this->nuevoNombre = uniqid("doc_", true) . ".pdf";
        return $this->nuevoNombre;
    }

    public function contarPaginasPDF($archivoPDF)
    {
        $pdf = new Fpdi();
        return $pdf->setSourceFile($archivoPDF);
    }

    public function subirArchivo()
    {
        // Subir archivos::
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivoPDF'])) { //el formulario se envía con el método POST y se envía un archivo con nombre archivoPDF

            //conceder acceso al directorio "Uploads" donde se guardarán los documentos 
            if (!is_dir($this->directorioDestino)) { //si no se encuentra, lo crea
                mkdir($this->directorioDestino, 0755, true); //permiso para lectura y escritura
            }

            //copiar de manera temporal el archivo PDF
            $arch_tmp = $_FILES["archivoPDF"]["tmp_name"];  //RUTA temporal
            $nomArch = basename($_FILES["archivoPDF"]["name"]); //obtiene el mismo nombre del archivo fuente

            $this->verificaArchivo($arch_tmp);

            //nuevo nombre de archivo
            $destArch = $this->directorioDestino . $this->setNombreArchivo();

            // Primero movemos el archivo
            if (move_uploaded_file($arch_tmp, $destArch)) {

                // Ahora que está en su destino, usamos FPDI para contar páginas
                $this->numeroPags = $this->contarPaginasPDF($destArch);

                if ($this->numeroPags > 30) {
                    unlink($destArch); // Borra el archivo si no cumple la regla
                    die("El archivo contiene más de 30 páginas.");
                }

                // Incluir clase y guardar en base de datos
                $this->subirArchivo_BD($this->ultimo_id);

            } else { //depurar algún error de subida de archivo
                echo "Error al mover el archivo.<br>";
                echo "Temp file: $arch_tmp<br>";
                echo "Target file: $destArch<br>";
                echo "¿Existe el archivo temporal?: " . (file_exists($arch_tmp) ? 'Sí' : 'No') . "<br>";
                echo "¿Existe el directorio destino?: " . (is_dir($this->directorioDestino) ? 'Sí' : 'No') . "<br>";
                echo "Permisos del destino: " . substr(sprintf('%o', fileperms($this->directorioDestino)), -4);
            }
        }
    }

    public function subirArchivo_BD($ultimo_id)
    {
        $ultimo_id = DataManager::insertarDocumento($this->nuevoNombre, $this->destArch, $this->numeroPags);

        if ($this->ultimo_id) {
            echo "Archivo subido y registrado exitosamente. ID: $ultimo_id";
        } else {
            echo "Archivo subido, pero no se pudo insertar en la base de datos.";
        }
    }
}
