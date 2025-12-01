<main class="product-main">
    <article class="product-article">
        <div class="product-wrapper">
            <section class="product-intro">
                <h1 class="product-title">Nuestros Productos</h1>
                <figure class="product-showcase">
                    <img src="../imgs/diego.jpg" alt="Surtido de panes de masa madre y bollería artesanal" class="product-showcase-image">
                    <figcaption class="product-showcase-caption">Elaboración diaria con ingredientes naturales desde 1993.</figcaption>
                </figure>
            </section>
            <?php $tipe = $_GET['tipe'] ?? 'all';?>
            <nav class="product-filter-nav">
                <a class="product-filter-btn <?php if ($tipe==="all")echo "active"?>"  href="./index.php?page=product&tipe=all">Todos</a>
                <a class="product-filter-btn <?php if ($tipe==="p")echo "active"?>" href="./index.php?page=product&tipe=p">Panes</a>
                <a class="product-filter-btn <?php if ($tipe==="d")echo "active"?>" href="./index.php?page=product&tipe=d">Bollería</a>
                <a class="product-filter-btn <?php if ($tipe==="s")echo "active"?>" href="./index.php?page=product&tipe=s">Salados</a>
            </nav>

            <section class="product-grid">
                <?php include "configuration.php"?>
            </section>

            <aside class="product-allergen-notice">
                <h3>⚠️ Aviso de Alérgenos Importantes</h3>
                <p>Nuestros productos contienen o pueden contener gluten, soja, ajonjolí/sésamo, frutos secos y trazas de mostaza. Consulta en tienda si tienes alergias o intolerancias alimentarias. Todos nuestros procesos se realizan en instalaciones compartidas con estos alérgenos.</p>
            </aside>
        </div>
    </article>
</main>