<?php
echo "¡Hola, mundo!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!--Normalización: -->
    <link rel="preload" href="CSS/normalize.css" as="style">
    <link rel="stylesheet" href="CSS/normalize.css">
    <link href="CSS/HojaDeEstilos.css" rel="stylesheet"> 
    <a name="Inicio"></a>
</head>
<body>
    <header>
        <section class="ContenedorHeader">
            <div>
                <img src="ImgInicio/ipnlogo.png" alt="IPN Logo" width="150" height="100">
            </div>
            <div>
                <h1>Bienvenido al sistema de información de exámenes propedéuticos de la ESIME Culhuacán</h1>
            </div>
            <div>
                <img src="ImgInicio/esimelogo.png" alt="ESIME Logo" width="80" height="100">
            </div>
        </section>
        <section class="ContenedorHeader Subtitulo">
            <h3>Por favor selecciona tu rol</h3>
        </section>
    </header>
    
    <main>
        <section class="ContenedorMain"> 
            <a href="ParteAdmin/PagAdmin.php" class="Pill">
                
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                        <path d="M12 16h-8a1 1 0 0 1 -1 -1v-10a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v7"></path>
                        <path d="M7 20h5"></path>
                        <path d="M9 16v4"></path>
                        <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M19.001 15.5v1.5"></path>
                        <path d="M19.001 21v1.5"></path>
                        <path d="M22.032 17.25l-1.299 .75"></path>
                        <path d="M17.27 20l-1.3 .75"></path>
                        <path d="M15.97 17.25l1.3 .75"></path>
                        <path d="M20.733 20l1.3 .75"></path>
                    </svg>
                    <p> Administrador </p>
                
            </a>
            <a href="Maestro/PagMaestro.html" class="Pill">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                    <path d="M8 4h-2l-3 10"></path>
                    <path d="M16 4h2l3 10"></path>
                    <path d="M10 16l4 0"></path>
                    <path d="M21 16.5a3.5 3.5 0 0 1 -7 0v-2.5h7v2.5"></path>
                    <path d="M10 16.5a3.5 3.5 0 0 1 -7 0v-2.5h7v2.5"></path>
                </svg>
                <p> Maestro </p>
            </a>
            <a href="Alumno/PagAlumno.html" class="Pill">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                    <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                    <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
                </svg>
                <p> Alumno </p>
            </a>
        </section>
    </main>

    <footer>

        <section class="ContenedorFin">
            <div class="ContCol1">   
                <p>Página elaborada para titulación de Ingeniería en Computación</p>
            </div>
            <div>
                <a href="Creditos/PagCreditos.html" class="Pill--selected"> Créditos </a>
            </div>
        </section>
    </footer>
</body>
</html>