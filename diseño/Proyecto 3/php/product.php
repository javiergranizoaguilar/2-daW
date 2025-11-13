<main>
        <section class="productos">
            <h2>Nuestros Productos</h2>
            <figure class="product-image">
                <img src="img/panaderia_variedad.jpg" alt="Surtido de panes de masa madre y bollería artesanal">
                <figcaption>Elaboración diaria con masa madre desde 1982.</figcaption>
            </figure>
        </section>

        <nav class="category-nav">
            <button class="category-button active" >Todos</button>
            <button class="category-button" >Panes</button>
            <button class="category-button" >Bollería</button>
            <button class="category-button" >Salados</button>
        </nav>

        <section class="product-grid">

            <article class="product-card panes">
                <img src="../imgs/panes/hogaza.webp" alt="Hogaza de Masa Madre Tradicional">
                <h3>Hogaza Tradicional</h3>
                <p class="price">Desde 4,50€</p>
                <div class="allergen-tag">Contiene Gluten</div>
                <a href="" class="detail-link">Añadir al Carrito</a>
            </article>

            <article class="product-card bolleria">
                <img src="../imgs/panes/croisan.webp" alt="Croissant de Mantequilla Artesano">
                <h3>Croissant de Mantequilla</h3>
                <p class="price">Desde 1,80€</p>
                <div class="allergen-tag">Gluten, Lácteos</div>
                <a href="" class="detail-link">Añadir al Carrito</a>
            </article>

            <article class="product-card salados">
                <img src="../imgs/panes/empanada.webp" alt="Empanada de Atún y Pimiento">
                <h3>Empanada de Atún</h3>
                <p class="price">Desde 3,90€ (por porción)</p>
                <div class="allergen-tag">Gluten, Pescado</div>
                <a href="" class="detail-link">Añadir al Carrito</a>
            </article>
            <?php include "configuration.php"?>

        </section>

        <aside class="allergen-notice">
            <p>**Aviso Alérgenos:** Consulta en tienda si tienes alergias. Indicamos los más comunes.</p>
        </aside>
    </main>