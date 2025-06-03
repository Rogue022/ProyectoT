<?php
//Este examen se encarga de calificar y establecer atributos y métodos correspondientes a un examen. 
class Examen
{
    private $tipo;
    private $fecha;
    private $carrera;
    private $escuelaP;
    private $calificacion;
    private $correctas = 0;
    private $total = 0;
    private $respuestas;
    private $claveCarrera;

    //el constructor pasa automáticamente los datos del POST y 
    //construye un examen. No se ha validado aún. 
    public function __construct($datos)
    {
        $this->tipo = $datos['tipo_examen'];
        $this->fecha = $datos['fecha_examen'];
        $this->carrera = $datos['nombre_carrera'];
        $this->claveCarrera = $datos['clave_carrera'];
        $this->escuelaP = $datos['escuela_procedencia'];
        $this->respuestas = [
            $datos['pregunta_1'] ,
            $datos['pregunta_2'] ,
            $datos['pregunta_3'] ,
            $datos['pregunta_4'] ,
            $datos['pregunta_5'] ,
        ];
    }

    //setters
    public function _setTipo($tipoExamen){
        $this->tipo = $tipoExamen;
    }

    public function _setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function _setCarrera($carrera){
        $this->carrera = $carrera;
    }

    public function _setEscuela($escuela){
        $this->escuelaP = $escuela;
    }

    public function _setCalificacion($calif){
        $this->calificacion = $calif;
    }
    
    //getters
    public function _getTipo(){
        return $this->tipo;
    }
    public function _getFecha(){
        return $this->fecha;
    }
    public function _getEscuelaP(){
        return $this->escuelaP;
    }

    public function _getCarrera(){
        return $this->carrera;
    }

    public function _getCalificacion(){
        return $this->calificacion;
    }

    public function _getCorrectas(){
        return $this->correctas;
    }

    //Regresa el arreglo de las respuestas
    public function _getElementos(){
        return $this->respuestas;
    }

    //evaluación del examen, por cada pregunta son 2 (valor estipulado en el formulario)
    public function evaluar()
    {
        foreach ($this->respuestas as $key => $respuesta) {
            if ($respuesta != 0) {
                $this->correctas++;
                $this->total += $respuesta;
            }
        }
        $this->calificacion = $this->total;
    }

    //Se muestran los resultados de los exámenes ya evaluados.

     public function mostrarResultados()
    {
        echo "<br>Tipo de examen: " . $this->tipo;
        echo "<br>Fecha de examen: " . $this->fecha;
        echo "<br>Carrera: " . $this->carrera;
        echo "<br>Clave de la carrera: " . $this->claveCarrera;
        echo "<br>Escuela Procedencia: " . $this->escuelaP;
        echo "<br>Respuestas correctas: " . $this->correctas;
        echo "<br>Calificacion: " . $this->calificacion;
    }


    public function _getExamenFull(){
        return [
            'tipo_examen' => $this->tipo,
            'fecha_examen' => $this->fecha,
            'nombre_carrera' => $this->carrera,
            'clave_carrera' => $this->claveCarrera,
            'escuela_procedencia' => $this->escuelaP,
            'calificacion' => $this->calificacion
        ];
    
    }
}
