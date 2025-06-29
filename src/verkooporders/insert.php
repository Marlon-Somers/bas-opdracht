<?php
// auteur: marlon
// functie: insert verkooporder
require '../../vendor/autoload.php';
use Bas\classes\Verkooporder;
use Bas\classes\Klant;      // Voor klant-check
use Bas\classes\Artikel;    // Voor artikel-check

$melding = "";

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $klant = new Klant();
    $artikel = new Artikel();
    $verkooporder = new Verkooporder();

    // Check of klantId bestaat
    $klantBestaat = $klant->getKlant((int)$_POST['klantid']);
    // Check of artId bestaat
    $artikelBestaat = $artikel->getArtikelById((int)$_POST['artid']);

    if (!$klantBestaat) {
        $melding = "<p style='color:red;'>Klant ID bestaat niet!</p>";
    } elseif (!$artikelBestaat) {
        $melding = "<p style='color:red;'>Artikel ID bestaat niet!</p>";
    } else {
        // Controleer of deze combinatie al bestaat
        $bestaandeOrder = $verkooporder->bestaatVerkooporder($_POST['klantid'], $_POST['artid']);
        if ($bestaandeOrder) {
            $melding = "<p style='color:red;'>Deze klant-artikel combinatie bestaat al als verkooporder!</p>";
        } else {
            $row = [
                'klantId'           => $_POST['klantid'],
                'artId'             => $_POST['artid'],
                'verkOrdDatum'      => $_POST['verkorddatum'],
                'verkOrdBestAantal' => $_POST['verkordbestaantal'],
                'verkOrdStatus'     => $_POST['verkordstatus']
            ];

            if ($verkooporder->insertVerkooporder($row)) {
                $melding = "<p style='color:green;'>Verkooporder succesvol toegevoegd!</p>";
            } else {
                $melding = "<p style='color:red;'>Fout bij het toevoegen van de verkooporder.</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verkooporder Toevoegen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>CRUD Verkooporder</h1>
    </header>
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='read.php'>Overzicht verkooporders</a><br><br>
    </nav>
    <main>
        <h2>Toevoegen</h2>
        <?php if ($melding) echo $melding; ?>
        <form method="post">
            <label for="kid">Klant ID:</label>
            <input type="number" id="kid" name="klantid" placeholder="Klant ID" required/>
            <br>
            <label for="aid">Artikel ID:</label>
            <input type="number" id="aid" name="artid" placeholder="Artikel ID" required/>
            <br>
            <label for="vd">Orderdatum:</label>
            <input type="date" id="vd" name="verkorddatum" required/>
            <br>
            <label for="ba">Bestel Aantal:</label>
            <input type="number" id="ba" name="verkordbestaantal" placeholder="Aantal" required/>
            <br>
            <label for="vs">Orderstatus:</label>
            <input type="text" id="vs" name="verkordstatus" placeholder="Status" required/>
            <br><br>
            <input type='submit' name='insert' value='Toevoegen'>
        </form>
    </main>
    <footer>
        <p>&copy; 2025 Bas van der Heijden Supermarkt</p>
    </footer>
</body>
</html>