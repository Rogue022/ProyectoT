<?php 
require_once('interface.validador.php');

abstract class PropiedadesObjeto implements Validador {

    protected $tablaPropiedades = [];     
    protected $propiedadesModificadas = [];  
    protected $datos = [];               
    protected $errores = [];

    public function __construct($arData = []) {
        foreach ($arData as $clave => $valor) {
            $this->__set($clave, $valor);
        }
    }

    public function __get($nombreAtributo) {
        if (!array_key_exists($nombreAtributo, $this->tablaPropiedades)) {
            throw new Exception("Atributo no válido \"$nombreAtributo\"!");
        }
    
        if (method_exists($this, 'get' . $nombreAtributo)) {
            return call_user_func([$this, 'get' . $nombreAtributo]);
        } else {
            $key = $this->tablaPropiedades[$nombreAtributo];
            return $this->datos[$key] ?? null;  // <<< AQUI EL CAMBIO
        }
    }
    

    public function __set($nombreAtributo, $value) {
        echo "Intentando asignar '$nombreAtributo' = '$value'...\n";


        if (!array_key_exists($nombreAtributo, $this->tablaPropiedades)) {
            echo "❌ No existe en tablaPropiedades\n";
            throw new Exception("Atributo no válido \"$nombreAtributo\"!");
        }

        if (method_exists($this, 'set' . $nombreAtributo)) {
            echo "Sí fue asignado <br>";
            return call_user_func([$this, 'set' . $nombreAtributo], $value);
        } else {
            echo "Sí fue asignado <br>";
            $key = $this->tablaPropiedades[$nombreAtributo];
            if (!isset($this->datos[$key]) || $this->datos[$key] != $value) {
                if (!in_array($nombreAtributo, $this->propiedadesModificadas)) {
                    $this->propiedadesModificadas[] = $nombreAtributo;
                }
                $this->datos[$key] = $value;
            }
        }
    }

    public function getPropiedadesModificadas() {
        return $this->propiedadesModificadas;
    }

    public function validar(): bool {
        return true;
    }
}
?>
