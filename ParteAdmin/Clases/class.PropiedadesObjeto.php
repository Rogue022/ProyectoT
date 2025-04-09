<?php 
require_once('interface.validator.php');

//clase plantilla !!! no se harán objetos con esta
//get y set para todas las clases


abstract class PropiedadesObjeto implements Validador {

    protected $tablaPropiedades = array();      // puede recoger cualquier tabla de la BD
    protected $propiedadesModificadas = array();  // propiedades modificadas
    protected $datos = array();               // datos reales
    protected $errores = array();             // errores de validación


    public function __construct($arData) {
        $this->datos = $arData;
    }

    //recupera la información del atributo
    public function __get($nombreAtributo) {
        if (!array_key_exists($nombreAtributo, $this->tablaPropiedades)) {
            throw new Exception("Atributo no válido \"$nombreAtributo\"!");
        }

        
        if (method_exists($this, 'get'.$nombreAtributo)) {
            return call_user_func([$this, 'get'.$nombreAtributo]);
        } else {
            return $this->datos[$this->tablaPropiedades[$nombreAtributo]];
        }
    }


    //establece las propiedades del atributo, modificadas o no
    public function __set($nombreAtributo, $value) {
        if (!array_key_exists($nombreAtributo, $this->tablaPropiedades)) {
            throw new Exception("Atributo no válido \"$nombreAtributo\"!");
        }

        if (method_exists($this, 'set'.$nombreAtributo)) {
            return call_user_func([$this, 'set'.$nombreAtributo], $value);
        } else {
            // Si cambió el valor, lo marcamos como "modificado"
            $key = $this->tablaPropiedades[$nombreAtributo];

            if (!isset($this->datos[$key]) || $this->datos[$key] != $value) {
                if (!in_array($nombreAtributo, $this->propiedadesModificadas)) {
                    $this->propiedadesModificadas[] = $nombreAtributo;
                }
                $this->datos[$key] = $value;
            }
        }
    }

    // Devuelve arreglo de propiedades modificadas
    public function getPropiedadesModificadas() {
        return $this->propiedadesModificadas;
    }

    // Puedes sobrescribir esto en tus clases hijas
    public function validar():bool {
        return true; // Por defecto no hay validación
    }
}
?>
