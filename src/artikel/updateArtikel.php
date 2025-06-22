<?php
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

$artikel = new Artikel();

if (!isset($_GET['artId']) || !is_numeric($_GET['artId'])) {
    header("Location: read.php");
    exit;
}

$artId = (int)$_GET['artId'];
$record = $artikel->getArtikelById($artId);

if (!$record) {
    echo "Artikel niet gevonden.";
    exit;
}

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
    if ($artikel->updateArtikel($artId, $data)) {
        header("Location: read.php");
        exit;
    } else {
        $error = "Bijwerken mislukt!";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikel Wijzigen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Artikel Wijzigen</h1>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <label>Omschrijving:<br>
                <input type="text" name="artOmschrijving" value="<?= htmlspecialchars($record['artOmschrijving']) ?>" required>
            </label><br><br>
            <label>Inkoopprijs:<br>
                <input type="number" step="0.01" name="artInkoop" value="<?= htmlspecialchars($record['artInkoop']) ?>" required>
            </label><br><br>
            <label>Verkoopprijs:<br>
                <input type="number" step="0.01" name="artVerkoop" value="<?= htmlspecialchars($record['artVerkoop']) ?>" required>
            </label><br><br>
            <label>Voorraad:<br>
                <input type="number" name="artVoorraad" value="<?= htmlspecialchars($record['artVoorraad']) ?>" required>
            </label><br><br>
            <label>Min. Voorraad:<br>
                <input type="number" name="artMinVoorraad" value="<?= htmlspecialchars($record['artMinVoorraad']) ?>" required>
            </label><br><br>
            <label>Max. Voorraad:<br>
                <input type="number" name="artMaxVoorraad" value="<?= htmlspecialchars($record['artMaxVoorraad']) ?>" required>
            </label><br><br>
            <label>Locatie:<br>
                <input type="text" name="artLocatie" value="<?= htmlspecialchars($record['artLocatie']) ?>" required>
            </label><br><br>
            <button type="submit" class="button">Opslaan</button>
            <a href="read.php" class="button" style="background:#64748b;">Annuleren</a>
        </form>
    </div>
</body>
</html>
