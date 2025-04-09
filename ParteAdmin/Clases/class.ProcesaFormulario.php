<?php 
    
    require_once('class.tipoexamen.php');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            "Examen" => $_POST['Examen'],
            "FechaExamen" => $_POST['FechaExamen'],
            "Semestre" => $_POST['Semestre'],
            "Carrera" => $_POST['Carrera'],
            "EscuelaProcedencia" => $_POST['EscuelaProcedencia'],
            "Reactivos" => isset($_POST['Reactivos']) ? $_POST['Reactivos'] : [],
            "Calificacion" => $_POST['Calificacion']
        ];
    
        $examen = new TipoExamen($data);
    
        if ($examen->registrar()) {
            echo "Registro exitoso.";
        } else {
            echo "Ocurrió un error al registrar.";
        }
    }
    



?>