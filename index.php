<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <!-- Diseño en cascada de bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>

    <main>
        <section>
            <div class="container mt-5 pt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-6 m-auto">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <img src="/ImgInicio/ipnlogo.png" class="rounded float-right img-fluid" width="120" height="200" alt="Logo del IPN">
                                        </div>
                                        <div class="col">
                                            <h1>Bienvenido</h1>
                                        </div>
                                        <div class="col">
                                            <img src="/ImgInicio/esimelogo.png" class="rounded float-left img-fluid" width="70" height="150" alt="Logo de la ESIME">

                                        </div>
                                    </div>

                                    <svg class="mx-auto my-3" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                    </svg>
                                </div>
                                <form action="ParteAdmin/adminIndex.php" method="POST">
                                    <input type="text" name="usuario" id="usuario" class="form-control my-4 py-2" placeholder="Usuario" />
                                    <input type="text" name="password" id="password" class="form-control my-4 py-2" placeholder="Contraseña" />
                                    <div class="text-center">
                                        <button class="btn btn-primary">
                                            Iniciar sesión
                                        </button>
                                        <a href="" class="nav-link">FAQ</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-dark py-4 mt-4 fixed-bottom">
        <div class="container text-light text-right">
            <!-- <p class="display-5 mb-3"> </p>-->
            <small class="text-white-50">
                <?php echo date("F, Y"); ?>
            </small>
        </div>
    </footer>

    <!-- bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>