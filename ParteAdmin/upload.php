<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name'];
    $fileTMPName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];


    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    /*Tipos de archivos que se pueden subir:*/
    $allowed = array('pdf');

    /*Checar si es el archivo permitido*/
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'ParteAdmin/Uploads/'.$fileNameNew;
                move_uploaded_file($fileTMPName, $fileDestination);
                header("Ubicación: PagAdmin.php?uploadsuccess");
            }else{
                echo "El archivo es demasiado grande";
            }
        } else {
            echo "Hubo un error al subir el archivo";
        }
    } else    {
        echo "Solo se admiten archivos .pdf";
    }
}