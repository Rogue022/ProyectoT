<?php 
    require_once('class.PropiedadesObjeto.php');
    
    //clase hija de propiedades objeto
    
    class RegistroExamen extends PropiedadesObjeto {
        protected $propertyTable = [
            'tipoExamen' => 'tipo_examen',
            'fechaExamen' => 'fecha_examen'
        ];
    
        //constructor
        public function __construct($tipoExamen, $fechaExamen)
        {
            parent::__construct([
                'tipoExamen' => $tipoExamen,
                'fechaExamen' => $fechaExamen
            ]);
        }
        
        //validación
        public function validar():bool {
            if(empty($this->data['tipoExamen']) || empty($this->data['fechaExamen'])){
                $this->errores[] = 'El tipo de examen y la fecha son requeridos... ';
            }
            return true;
        }
        
    }
    


?>