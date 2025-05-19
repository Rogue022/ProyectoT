<?php
//viene de recibeDatos y va para ExamenValidador


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

    public function __construct($datos)
    {
        $this->tipo = $datos['tipo_examen'];
        $this->fecha = $datos['fecha_examen'];
        $this->carrera = $datos['nombre_carrera'];
        $this->escuelaP = $datos['escuela_procedencia'];
        $this->respuestas = [
            $datos['pregunta_1'] ?? 0,
            $datos['pregunta_2'] ?? 0,
            $datos['pregunta_3'] ?? 0,
            $datos['pregunta_4'] ?? 0,
            $datos['pregunta_5'] ?? 0,
        ];
    }

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

    public function mostrarResultados()
    {
        echo "<br>Tipo de examen: " . $this->tipo;
        echo "<br>Fecha de examen: " . $this->fecha;
        echo "<br>Carrera: " . $this->carrera;
        echo "<br>Escuela Procedencia: " . $this->escuelaP;
        echo "<br>Respuestas correctas: " . $this->correctas;
        echo "<br>Calificacion: " . $this->calificacion;
    }

    public function _getCalificacion(){
        return $this->calificacion;
    }

    public function _getCorrectas(){
        return $this->correctas;
    }
}
