<?php
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

$artikel = new Artikel();
$melding = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'artOmschrijving'   => $_POST['artOmschrijving'],
        'artInkoop'         => $_POST['artInkoop'],
        'artVerkoop'        => $_POST['artVerkoop'],
        'artVoorraad'       => $_POST['artVoorraad'],
        'artMinVoorraad'    => $_POST['artMinVoorraad'],
        'artMaxVoorraad'    => $_POST['artMaxVoorraad'],
        'artLocatie'        => $_POST['artLocatie']
    ];
    if ($artikel->insertArtikel($data)) {
        header("Location: read.php");
        exit;
    } else {
        $melding = "Toevoegen mislukt!";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikel Toevoegen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Nieuw Artikel Toevoegen</h1>
        <?php if ($melding) echo "<p style='color:red;'>$melding</p>"; ?>
        <form method="post">
            <label>Omschrijving:<br>
                <input type="text" name="artOmschrijving" required>
            </label><br><br>
            <label>Inkoopprijs:<br>
                <input type="number" step="0.01" name="artInkoop" required>
            </label><br><br>
            <label>Verkoopprijs:<br>
                <input type="number" step="0.01" name="artVerkoop" required>
            </label><br><br>
            <label>Voorraad:<br>
                <input type="number" name="artVoorraad" required>
            </label><br><br>
            <label>Min. Voorraad:<br>
                <input type="number" name="artMinVoorraad" required>
            </label><br><br>
            <label>Max. Voorraad:<br>
                <input type="number" name="artMaxVoorraad" required>
            </label><br><br>
            <label>Locatie:<br>
                <input type="text" name="artLocatie" required>
            </label><br><br>
            <button type="submit" class="button">Toevoegen</button>
            <a href="read.php" class="button" style="background:#64748b;">Annuleren</a>
        </form>
    </div>
</body>
</html>
