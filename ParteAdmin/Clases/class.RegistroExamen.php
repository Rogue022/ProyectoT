<?php
require_once('class.PropiedadesObjeto.php');

class RegistroExamen extends PropiedadesObjeto {
    public function __construct($arData = []) {
        $this->tablaPropiedades = [
            'tipoExamen'   => 'nomExamen',
            'fechaExamen'  => 'FechaExamen'
        ];
        parent::__construct($arData);
    }

    public function validar(): bool {
        // Accede al valor real en $this->datos utilizando el nombre en tablaPropiedades
        return !empty($this->datos[$this->tablaPropiedades['tipoExamen']]) && 
               !empty($this->datos[$this->tablaPropiedades['fechaExamen']]);
    }
    
}
