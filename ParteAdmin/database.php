<?php

$conn = mysqli_connect('localhost', 'AdmnP', 'Revenant2159!', 'SistemaExamenes');
if (!$conn) {
    echo "Conexión fallida :(";
}else{
    echo "Conexión exitosa! <3";
}
