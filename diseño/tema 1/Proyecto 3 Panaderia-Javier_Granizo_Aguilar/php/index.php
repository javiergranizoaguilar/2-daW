<?php include "head.php"; ?>
<?php include "header.php";?>

<?php $page = $_GET['page'] ?? 'main';

// Mostrar contenido basado en el parámetro 'page'
switch($page) {
    case 'main':
    include './main.php';
    break;
    case 'about':
    include './about.php';
    break;
    case 'product':
    include './product.php';
    break;
    case 'contact':
    include './contact.php';
    break;
    case 'shop':
        include './shop.php';
        break;
    default:
    include './404.php';
    break;
}
?>

<?php include "footer.php" ?>
