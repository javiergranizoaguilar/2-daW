<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Servicios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Creacion de MEMES</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Viralizacion de los MEMES</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">
                        <?php
                        date_default_timezone_set('Europe/Madrid');
                        echo date("G:i:s");
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</header>
<article>
    <h1>Daily Memes</h1>
    <?php $nameimgs=["images","images1","images2","images3","images4","images5","images6","images7","images8","images9"]?>
    <?php   //(int) = parse int
            // el date se que me devuelve un string de 2 diguitos por lo que cojo el ultimo y le ago un parse int.
            // Los string son arrais especiales por lo que sigen normas parecidas
    $numberimgs=(int) date("s")[1]?>
    <img src="./imagenes/<?php echo $nameimgs[$numberimgs];?>.jpeg" alt="Meme del día">
</article>
<footer class=" text-white pt-5 pb-4">
    <div class="container">
        <div class="row text-center text-md-left">
            <!-- Column 1 - About -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Daily Memes</h5>
                <p>Tu fuente diaria de humor y entretenimiento. Compartiendo los mejores memes desde 2025.</p>
            </div>

            <!-- Column 2 - Contact -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contacto</h5>
                <p>
                    <i class="fas fa-home mr-3"></i> Madrid, ES
                </p>
                <p>
                    <i class="fas fa-envelope mr-3"></i> info@dailymemes.com
                </p>
                <p>
                    <i class="fas fa-phone mr-3"></i> +34 612 345 678
                </p>
            </div>
        </div>

        <!-- Copyright -->
        <hr class="mb-4">
        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p>Copyright ©<?php echo date('Y'); ?> Todos los derechos reservados por:
                    <a href="#" class="text-warning" style="text-decoration: none;">
                        <strong>Daily Memes</strong>
                    </a>
                </p>
            </div>
            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>