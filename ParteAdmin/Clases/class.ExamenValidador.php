<?php
//En esta clase se validan y normalizan los datos del Examen antes de enviarlo a su clase

class ValidadorExamen
{
    private $tipo;
    private $fecha;
    private $carrera;
    private $escuelaP;
    private $preguntas = [];
    private $errores = [];
    private $claveCarrera;

    //esta función va a recibir los datos del post y va a comprobar que no hayan elementos vacíos
    public function validarCamposVacios($datos)
    {

        //se comprueba el valor de name en el POST
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


    //esta va a validar la escuela de procedencia y que sea de más de 3 caracteres. 
    public function validarEscuela($nombreEscuela)
    {
        //Aquí valida el nombre de la escuela como variable del post escuela_procedencia;
        $this->escuelaP = strtoupper($nombreEscuela);

        if (empty($nombreEscuela) || strlen($nombreEscuela) < 3) {
            $this->errores['escuela_procedencia'] = "El nombre de la escuela debe tener al menos 3 caracteres.";
            return false;
        }
        return true;
    }

    public function normalizarTipo($datos){
        $this->tipo = strtoupper($datos['tipo_examen']);
    }

    public function hayErrores()
    {
        return !empty($this->errores);
    }

    public function obtenerErrores()
    {
        return $this->errores;
    }

    public function ponerClave($datos){

        if(!isset($datos['clave_carrera'])){
            if ($datos['nombre_carrera'] == 'IC') {
                $this->claveCarrera = 1;
            } elseif ($datos['nombre_carrera'] == 'ICE') {
                $this->claveCarrera = 2;
            }elseif ($datos['nombre_carrera'] == 'IM') {
                $this->claveCarrera = 3;
            }elseif ($datos['nombre_carrera'] == 'ISISA') {
                $this->claveCarrera = 4;
            }

            
        }
    }

    public function validarTodo($datos)
    {
        $this->setDatos($datos);
        $this->ponerClave($datos);
        $this->validarCamposVacios($datos);
        $this->validarEscuela($datos['escuela_procedencia'] ?? '');
        $this->normalizarTipo($datos);
        
        return !$this->hayErrores();
    }

    //se hace un arreglo asociativo de los datos para que se manden limpios los datos. 
    public function getDatos()
    {
        return [
            'tipo_examen' => $this->tipo,
            'fecha_examen' => $this->fecha,
            'nombre_carrera' => $this->carrera,            
            'clave_carrera' => $this->claveCarrera,
            'escuela_procedencia' => $this->escuelaP,
            'pregunta_1' => $this->preguntas[0],
            'pregunta_2' => $this->preguntas[1],
            'pregunta_3' => $this->preguntas[2],
            'pregunta_4' => $this->preguntas[3],
            'pregunta_5' => $this->preguntas[4]
        ];
    }


    public function getPreguntas()
    {
        return $this->preguntas;
    }

    public function setDatos($datos)
    {
        $this->tipo = $datos['tipo_examen'];
        $this->fecha = $datos['fecha_examen'];
        $this->carrera = $datos['nombre_carrera'];
        $this->escuelaP = $datos['escuela_procedencia'];
        $this->preguntas = [
            $datos['pregunta_1'] ?? 0,
            $datos['pregunta_2'] ?? 0,
            $datos['pregunta_3'] ?? 0,
            $datos['pregunta_4'] ?? 0,
            $datos['pregunta_5'] ?? 0,
        ];
    }
}
