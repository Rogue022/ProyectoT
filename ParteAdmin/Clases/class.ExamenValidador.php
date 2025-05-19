<?php

class ValidarExamen
{
    private $tipo;
    private $fecha;
    private $carrera;
    private $escuelaP;
    private $errores = [];

    public function validarVacios($datos)
    {
        if (empty($datos['tipo_examen'])) {
            $this->errores['tipo_examen'] = "El tipo de examen es obligatorio";
        }
        if (empty($datos['fecha_examen'])) {
            $this->errores['fecha_examen'] = "Falta fecha de examen";
        }
        if (empty($datos['nombre_carrera'])) {
            $this->errores['nombre_carrera'] = "Falta carrera";
        }
        if (empty($datos['escuela_procedencia'])) {
            $this->errores['escuela_procedencia'] = "Falta completar escuela de procedencia";
        }
    }

    public function validarEscuela($nombreEscuela)
    {
        if (empty($nombreEscuela) || strlen($nombreEscuela) < 2) {
            $this->errores['escuela_procedencia'] = "El nombre de la escuela debe tener al menos 2 caracteres.";
            return false;
        }
        return true;
    }

    public function normalizar($datos)
    {
        $this->tipo = strtoupper(trim($datos['tipo_examen']));
        $this->fecha = strtoupper(trim($datos['fecha_examen']));
        $this->carrera = strtoupper(trim($datos['nombre_carrera']));
        $this->escuelaP = strtoupper(trim($datos['escuela_procedencia']));
    }

    public function validarTodo($datos)
    {
        $this->validarVacios($datos);
        $this->validarEscuela($datos['escuela_procedencia'] ?? '');
        return !$this->hayErrores();
    }

    public function hayErrores()
    {
        return !empty($this->errores);
    }

    public function obtenerErrores()
    {
        return $this->errores;
    }

    public function getDatosNormalizados()
    {
        return [
            'tipo_examen' => $this->tipo,
            'fecha_examen' => $this->fecha,
            'nombre_carrera' => $this->carrera,
            'escuela_procedencia' => $this->escuelaP
        ];
    }
}
