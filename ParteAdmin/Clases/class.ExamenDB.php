<?php 
//aquí es el CRUD de los datos antes de pasarse a la BD

include 'class/class.Datamanager.php';
include 'class/class.Examenes.php';

class ExamenBD {
    
    public function Insertar(){
        $nuevaConexion = DataManager::_getConexion();

        $sql = "INSERT INTO Prueba VALUES ";
    }
    
    
}
?>