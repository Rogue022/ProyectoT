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

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.css">

    <script defer
        src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.js">
    </script>

    <script defer
        src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/contrib/auto-render.min.js"
        onload="renderMathInElement(document.body);">
    </script>


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
        <h2 id="numExamen">Examen: </h2>
        <h4>Revisa las respuestas haciendo click en mostrar u ocultar. </h4>

        <!-- Container -->

        <div class="container">
            <div class="row">
                <div class="row main_q">
                    <h5 id="pregunta1"></h5>
                </div>
                <div id="respuesta1" class="main_r">  </div>
                <div class="column">
                    <button class="btn btn-info" onclick="mostrar1()">Mostrar/Ocultar</button>
                </div>
                <div class="column"></div>
            </div>

            <div class="row">
                <div class="row main_q">
                    <h5 id="pregunta2"> </h5>
                </div>
                <div id="respuesta2" class="main_r"> </div>
                <div class="column">
                    <button class="btn btn-info" onclick="mostrar2()">Mostrar/Ocultar</button>
                </div>
                <div class="column"></div>
            </div>

            <div class="row">
                <div class="row main_q">
                    <h5 id="pregunta3"> </h5>
                </div>
                <div id="respuesta3" class="main_r"> </div>
                <div class="column">
                    <button class="btn btn-info" onclick="mostrar3()">Mostrar/Ocultar</button>
                </div>
                <div class="column"></div>
            </div>

            <div class="row">
                <div class="row main_q">
                    <h5 id="pregunta4"> </h5>
                </div>
                <div id="respuesta4" class="main_r"> </div>
                <div class="column">
                    <button class="btn btn-info" onclick="mostrar4()">Mostrar/Ocultar</button>
                </div>
                <div class="column"></div>
            </div>

            <div class="row">
                <div class="row main_q">
                    <h5 id="pregunta5"> </h5>
                </div>
                <div id="respuesta5" class="main_r"> </div>
                <div class="column">
                    <button class="btn btn-info" onclick="mostrar5()">Mostrar/Ocultar</button>
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
    <script defer type="text/javascript" src="Scripts/scriptPreguntas.js">



    </script>


</body>

</html>