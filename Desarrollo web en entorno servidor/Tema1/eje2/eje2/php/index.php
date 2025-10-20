<?php include "head.php"; ?>
<?php include "header.php";?>
<article>
    <h1>Daily Memes</h1>
    <?php ?>
    <?php   //(int) = parse int
    // el date se que me devuelve un string de 2 diguitos por lo que cojo el ultimo y le ago un parse int.
    // Los string son arrais especiales por lo que sigen normas parecidas
    $numberimgs=(int) date("s")[1]?>
    <img src="../imagenes/<?php echo nameimgs[$numberimgs];?>.jpeg" alt="Meme del día">
</article>
<?php include "footer.php" ?>