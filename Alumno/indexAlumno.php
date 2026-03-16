<!DOCTYPE html>
<!-- en caso de:  <html lang="en" data-bs-theme="dark">  -->
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="/Alumno/CSSAlumno/estiloA.css">

</head>

<body>

    <div class="grid-container">
        <!-- Header -->
        <header class="header">
            <div class="menu-icon">

            </div>
        </header>
        <!-- End header -->

        <!--Sidebar  -->
        <aside id="sidebar">

        </aside>
        <!-- End Sidebar -->

        <!-- Main -->
        <main class="main-container">
            <div class="main-title">
                <h3>Bienvenido alumno</h3>
            </div>


            <div class="main-cards">
                
                    <div class="card" onclick="revision()">
                        <h4 class="card-title mx-auto card-2">Revisión de examen</h4>
                        <div class="card-inner mx-auto">
                            <img src="ImgA/img1.png" style="width: 150px; height: 150px;" alt="Revisar examen">
                        </div>
                    </div>
                

                <div class="card" onclick="enviarInfo()">
                    <h4 class="card-title mx-auto">Enviar información</h4>
                    <div class="card-inner mx-auto">
                        <img src="ImgA/img2.png" style="width: 150px; height: 150px;" alt="Enviar información">
                    </div>
                </div>

                <div class="card" id="openDialog">
                    <h4 class="card-title mx-auto">Finalizar sesión</h4>
                    <div class="card-inner mx-auto">
                        <img src="ImgA/img3.png" style="width: 150px; height: 150px;" alt="Finalizar sesión">
                    </div>
                </div>


                <dialog id="modal" class="dialog">
                    <h1>Finalizar sesión </h1>
                    <p>Una vez finalizada la sesión, no podrás regresar. ¿Finalizar?</p>
                    <button type="button" class="btn btn-info" id="closeDialog">Regresar</button>
                    <button type="button" class="btn btn-warning" id="endDialog">Finalizar</button>
                </dialog>


            </div>
        </main>

        <!-- End Main -->

        <!-- Scripting -->
        <script>
            const dialog = document.getElementById('modal');
            const btnOpen = document.getElementById('openDialog');
            const btnClose = document.getElementById('closeDialog');
            const btnEnd = document.getElementById('endDialog');

            function revision() {
                window.location.href = "../Alumno/revision.php";
            }

            function enviarInfo() {
                window.location.href = "../Alumno/enviarInformacion.php";
            }

            btnOpen.addEventListener('click', e => {
                dialog.showModal();
                k
            });

            btnClose.addEventListener('click', e => {
                dialog.close();
            });

            btnEnd.addEventListener('click', e => {
                e.preventDefault();
                sessionStorage.clear();
                window.location.href = "../index.php";
            });
        </script>
</body>

</html>