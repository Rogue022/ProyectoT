<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//cargar autoloader de composer creado por composer
require '/srv/PrTitulacion/ProyectoT/vendor/autoload.php';


$mail = new PHPMailer(true);
$datos = $_POST;
$datenv = parse_ini_file('.env');

$correo=$datos['correo-e'];

try {
    //Settings del servidor SMTP
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();    
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $datenv['M_USER'];
    $mail->Password = $datenv['M_PWD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';

    //Recipientes
    $mail->setFrom('noreply.examenespropedeuticos@gmail.com', 'Exámenes Propedéuticos de Matemáticas');
    $mail->addAddress($correo);     //Add a recipient

    //Archivos adjuntos!!!!!!!!
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name


    //contenido
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Guía de estudio de cursos propedéuticos';
    $mail->Body    = 'Estimado usuario del curso propedéutico de la ESIME Culhuacán. 
    Enviamos este correo con la guía de estudio de los temas que se han visto durante este <b>curso</b>. 
    Recuerda que el acceso al portal es limitado. Si tienes preguntas favor de contactar al departamento de matemáticas de la escuela.';



    $mail->send();
    echo 'El correo ha sido enviado a '. $correo. 'Espéralo en los próximos minutos.';

} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Mailer error: {$mail->ErrorInfo}";
}


?>