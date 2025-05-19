<?php
require_once('class.PropiedadesObjeto.php');

class RegistroExamen extends PropiedadesObjeto
{
    public function __construct($arData = [])
    {
        $this->tablaPropiedades = [
            'tipo_examen' => 'tipo_examen',
            'fecha_examen' => 'fecha_examen',
            'nombre_carrera' => 'nombre_carrera',
            'escuela_procedencia' => 'escuela_procedencia',
            'pregunta_1' => 'pregunta_1',
            'pregunta_2' => 'pregunta_2',
            'pregunta_3' => 'pregunta_3',
            'pregunta_4' => 'pregunta_4',
            'pregunta_5' => 'pregunta_5',
            'calificacion' => 'calificacion' 
        ];
        parent::__construct($arData); // ← aquí ya deberían estar listas las propiedades
    }

    public function validar(): bool
    {
        // Accede al valor real en $this->datos utilizando el nombre en tablaPropiedades
        return !empty($this->datos[$this->tablaPropiedades['tipoExamen']]) &&
            !empty($this->datos[$this->tablaPropiedades['fechaExamen']]);
    }
}
