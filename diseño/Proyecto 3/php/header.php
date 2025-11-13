
<header>
    <div>
        <img src="../imgs/logo.svg" alt="">
        <h1>Horno San Miguel</h1>
    </div>
    <nav>
        <ul>
            <li><a class="<?php if($_GET['page']=="main") echo "active"?>" href="./index.php?page=main">Inicio</a></li>
            <li><a class="<?php if($_GET['page']=="product") echo "active"?>"href="./index.php?page=product">Productos</a></li>
            <li><a class="<?php if($_GET['page']=="about") echo "active"?>"href="./index.php?page=about">Sobre Nosotros</a></li>
            <li><a class="<?php if($_GET['page']=="contact") echo "active"?>"href="./index.php?page=contact">Contacto</a></li>
            <li><a class="<?php if($_GET['page']=="shop") echo "active"?>"href="./index.php?page=shop">Carrito</a></li>
        </ul>
    </nav>
</header>