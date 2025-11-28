<footer class="footer-main">
    <p class="footer-address">Dirección: Pl. Mayor 8, 28000 Madrid, España</p>
    <p class="footer-hours">Horario: L-V 07:00-14:30 / 17:30-20:00 | S 07:30-14:30 | D Cerrado</p>
    <p class="footer-copyright">&copy; 2025 Horno San Miguel. Pan Artesanal desde 1982.</p>
</footer>
<?php $page = $_GET['page'] ?? 'main';

// Mostrar contenido basado en el parámetro 'page'
if($page === 'shop') {
    echo '<script src="../javaScript/shop.js" type="module"></script>';
}
?>
</body>
</html>