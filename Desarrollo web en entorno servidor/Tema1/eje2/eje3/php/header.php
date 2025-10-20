<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class=" nav-link navbar-brand <?php if ($_GET['page']==='main') echo 'merequetenge';?>  " href="index.php?page=main">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($_GET['page']==='about') echo 'merequetenge';?>" aria-current="page" href="./index.php?page=about">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($_GET['page']==='contact') echo 'merequetenge';?>" href="./index.php?page=contact">Contacto</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if ($_GET['page']==='viral'||$_GET['page']==='creation') echo 'merequetenge';?>" href="./service.php" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Servicios
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?php if ($_GET['page']==='creation') echo 'merequetenge';?>" href="./index.php?page=creation">Creacion de MEMES</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item <?php if ($_GET['page']==='viral') echo 'merequetenge';?>" href="./index.php?page=viral">Viralizacion de los MEMES</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true">
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