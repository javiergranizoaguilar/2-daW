
<header class="header-main">
    <div class="header-logo-container">
        <img src="../imgs/logo.svg" alt="" class="header-logo">
        <h1 class="header-title">Horno San Miguel</h1>
    </div>
    <nav class="header-nav">
        <ul class="header-nav-list"><?php $page = $_GET['page'] ?? 'main'; ?>
            <li class="header-nav-item"><a class="header-nav-link <?php if($page=="main") echo "header-nav-active"?>" href="./index.php?page=main">Inicio</a></li>
            <li class="header-nav-item"><a class="header-nav-link <?php if($page=="product") echo "header-nav-active"?>"href="./index.php?page=product">Productos</a></li>
            <li class="header-nav-item"><a class="header-nav-link <?php if($page=="about") echo "header-nav-active"?>"href="./index.php?page=about">Sobre Nosotros</a></li>
            <li class="header-nav-item"><a class="header-nav-link <?php if($page=="contact") echo "header-nav-active"?>"href="./index.php?page=contact">Contacto</a></li>
            <li class="header-nav-item"><a class="header-nav-link <?php if($page=="shop") echo "header-nav-active"?>"href="./index.php?page=shop">Carrito</a></li>
        </ul>
    </nav>
</header>