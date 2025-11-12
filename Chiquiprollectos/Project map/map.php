<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa Interactivo</title>
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <!--Mini mapa,mini interactivo-->
    <div id="map-container">
        <div id="map-layer">
            <div class="token" id="token-1" style="left: 2px; top: 2px;"></div>
            <div class="token" id="token-2" style="left: 302px; top: 202px;"></div>
        </div>
    </div>
    <div class="texts">
        <p>ddddd</p>
        <div>
            <?php
// 1. Verificamos si la solicitud se hizo por POST y si el campo existe.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mensaje_usuario'])) {
    
    // 2. Capturamos el dato usando el 'name' del textarea.
    // Usamos htmlspecialchars() para prevenir ataques XSS al mostrar los datos.
    $texto_textarea = htmlspecialchars($_POST['mensaje_usuario']);
    
    // 3. Mostramos el resultado.
    echo "<h1>Resultado del Textarea</h1>";
    echo "<p>El texto que ingresaste es:</p>";
    // nl2br() se usa para convertir los saltos de línea (\n) en etiquetas <br> para HTML.
    echo nl2br($texto_textarea);

} else {
    echo "<p>No se recibieron datos del formulario.</p>";
}
?>
        </div>
        <form method="POST" action="procesar.php">
            <label for="comentarios">Escriba sus comentarios:</label>
            <br>
            <textarea id="comentarios" name="mensaje_usuario" rows="6" cols="50">¡Hola desde el formulario!
            </textarea>
            <br>
            <button type="submit">Enviar Datos</button>
        </form>
    </div>
    <script type="module" src="./javascipts/main.js"></script>
</body>

</html>