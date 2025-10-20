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
    case 'contact':
    include './Contact.php';
    break;
    case 'creation':
    include './creation.php';
    break;
    case 'viral':
        include './viral.php';
        break;
    default:
    include './404.php';
    break;
}
?>
<?php include "footer.php" ?>
