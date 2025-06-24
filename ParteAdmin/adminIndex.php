<?php
//establecer la fecha en la zona de cdmx
date_default_timezone_set('America/Mexico_City');

//establecer el idioma
setlocale(LC_TIME, 'es_MX.UTF-8');

/*Cabecera lateral */
include $_SERVER['DOCUMENT_ROOT'] . '/Templates/cabeceraLateral.php';

?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3">
            <h4><?php echo date("F j, Y, g:i a"); ?> </h4>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body p-0 d-flex flex-fill">
                        <div class="row g-0 w-100">

                            <!-- columnas del card -->

                            <div class="col-12">
                                <div class="p-3 m-1">
                                    <h1>Administrador</h1>
                                    <p>Seleccione una tarea del menú de la izquierda</p>

                                </div>
                            </div>
                            <!-- Si hace falta otra columna
                            <div class="col-6 align-self-end text-end">
                            </div>
                            -->

                        </div>
                    </div>

                </div>
            </div>
            <!-- Columnas a la derecha si se requieren -->

        </div>
    </div>

</main>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/Templates/piePagina.php'; ?>