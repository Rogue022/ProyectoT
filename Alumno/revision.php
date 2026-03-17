<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

include_once(__DIR__ . '/../Control_Login/class.Login.php');

$alumno = new Usuario();

if (isset($_SESSION['usuario'])) {
    echo $_SESSION['usuario'];
} else {
    echo "<script>alert('Por favor, inicia sesión');</script>";
    header("Location: ../index.php?expired=1");
    exit;
}

?>

<!DOCTYPE html>
<!-- en caso de:  <html lang="en" data-bs-theme="dark">  -->
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revision de examen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="/Alumno/CSSAlumno/estiloA.css">

</head>

<body>

    <!-- Header -->
    <header class="header">
        <div class="menu-icon">

        </div>
    </header>
    <!-- End header -->

    <main>
        <br>
        <h4>Revisa tus preguntas haciendo click en mostrar respuesta. </h4>

        <!-- Container -->

        <div class="container">
            <div class="row">
                <div class="row main_q">
                    <h5>Pregunta 1</h5>
                </div>
                <div id="pregunta1" class="main_r"> Respuesta 1</div>
                <div class="column">
                    <button class="btn btn-info" onclick="mostrar1()">Mostrar Respuesta 1</button>
                </div>
                <div class="column"></div>
            </div>

            <div class="row">
                <div class="row main_q">
                    <h5>Pregunta 2</h5>
                </div>
                <div id="pregunta2" class="main_r"> Respuesta 2</div>
                <div class="column">
                    <button class="btn btn-info" onclick="mostrar2()">Mostrar Respuesta 2</button>
                </div>
                <div class="column"></div>
            </div>

            <div class="row">
                <div class="row main_q">
                    <h5>Pregunta 3</h5>
                </div>
                <div id="pregunta3" class="main_r"> Respuesta 3</div>
                <div class="column">
                    <button class="btn btn-info" onclick="mostrar3()">Mostrar Respuesta 3</button>
                </div>
                <div class="column"></div>
            </div>

            <div class="row">
                <div class="row main_q">
                    <h5>Pregunta 4</h5>
                </div>
                <div id="pregunta4" class="main_r"> Respuesta 4</div>
                <div class="column">
                    <button class="btn btn-info" onclick="mostrar4()">Mostrar Respuesta 4</button>
                </div>
                <div class="column"></div>
            </div>

            <div class="row">
                <div class="row main_q">
                    <h5>Pregunta 5</h5>
                </div>
                <div id="pregunta5" class="main_r"> Respuesta 5</div>
                <div class="column">
                    <button class="btn btn-info" onclick="mostrar5()">Mostrar Respuesta 5</button>
                </div>
                <div class="column"></div>
            </div>
        </div>

    <div class="boton_container">
        <div class="row">
            <div class="column">
                <button id="btnRegresar" class="btn btn-success" onclick="regresar()">Regresar</button>
            </div>
        </div>
    </div>

    </main>

    

    <!-- Scripting -->
    <script src="Scripts/scriptPreguntas.js"></script>


</body>

</html>