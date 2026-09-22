<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width,
                   initial-scale=1.0">

    <title>
        <?= isset($titulo)
            ? $titulo
            : 'SCN Inventario'
        ?>
    </title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <link
        href="<?= base_url('assets/css/estilos.css') ?>"
        rel="stylesheet">

</head>


<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">


        <a
            class="navbar-brand"
            href="<?= site_url('productos') ?>">

            Catalogo

        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div
            class="collapse navbar-collapse"
            id="menu">


            <ul class="navbar-nav me-auto">


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="<?= site_url('productos') ?>">

                        Productos

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#">

                        Líneas

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#">

                        linea

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#">

                        Proveedores

                    </a>

                </li>








 


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#">

                        Usuarios

                    </a>

                </li>


            </ul>

        </div>

    </div>

</nav>


<div class="container py-4">