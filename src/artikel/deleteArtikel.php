<?php
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

$artikel = new Artikel();

if (isset($_POST['verwijderen']) && isset($_POST['artId'])) {
    $artId = (int)$_POST['artId'];
    $artikel->deleteArtikel($artId);
    header("Location: read.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikel Verwijderen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Artikel verwijderen</h1>
        <p>Artikel wordt verwijderd...</p>
        <a href="read.php" class="button">Terug</a>
    </div>
</body>
</html>