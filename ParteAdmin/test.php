<?php
    // Incluir la interfaz y la clase implementada
    require_once('interface.validator.php');
    require_once('Clases/class.EmailAddress.php');

    // Crear una instancia de EmailValidator
    $emailValidator = new EmailValidator("hola");

    // Verificar si el correo electrónico es válido
    if ($emailValidator->validate()) {
        echo "El correo electrónico es válido.";
    } else {
        echo "El correo electrónico no es válido.";
    }
?>
