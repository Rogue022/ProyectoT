<?php 
    require_once('class.PropertyObject.php');
    require_once('class.DataManager.php');
    
    
    class TipoExamen extends PropiedadesObjeto {
        protected $propertyTable = [
            "Examen" => "nomExamen",
            "FechaExamen" => "fechaExamen",
            "Semestre" => "semestre",
            "Carrera" => "carrera",
            "EscuelaProcedencia" => "escuela",
            "Reactivos" => "reactivos", // Será un array
            "Calificacion" => "calificacion"
        ];
    
        public function __construct($data) {
            parent::__construct($data);
        }
    
        public function registrar() {
            return DataManager::registraExamen(
                $this->Examen,
                $this->FechaExamen,
                $this->Semestre,
                $this->Carrera,
                $this->EscuelaProcedencia,
                $this->Reactivos,
                $this->Calificacion
            );
        }
    }
    


?>