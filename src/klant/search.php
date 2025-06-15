<!--
    Auteur: marlon
    Function: zoeken op klantnaam
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant zoeken</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <img src="../ontwerpen/bas-van-der-heijden-supermarkt-logo-png_seeklogo-276038.png" alt="Bas logo">
        <h1>CRUD Klant</h1>
    </header>
    <nav>
        <a href='../index.html'>Home</a>
        <a href='read.php'>Overzicht klanten</a>
        <a href='insert.php'>Toevoegen</a>
    </nav>
    <main>
        <h2>Zoeken op klantnaam</h2>
        <form method="get" style="display:flex; gap:10px; align-items:center;">
            <input type="text" name="zoeknaam" placeholder="Voer klantnaam in" required>
            <button type="submit" style="background:#c62828;color:white;border:none;padding:8px 18px;border-radius:4px;cursor:pointer;font-weight:bold;">Zoek klant</button>
        </form>
        <?php
        require '../../vendor/autoload.php';
        use Bas\classes\Klant;
        if (isset($_GET['zoeknaam'])) {
            $klant = new Klant();
            $zoeknaam = $_GET['zoeknaam'];
            $resultaten = $klant->zoekOpNaam($zoeknaam);
            if ($resultaten && count($resultaten) > 0) {
                echo '<table><tr><th>ID</th><th>Naam</th><th>Email</th><th>Adres</th><th>Postcode</th><th>Woonplaats</th></tr>';
                foreach ($resultaten as $row) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['klantId']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['klantNaam']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['klantEmail']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['klantAdres']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['klantPostcode']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['klantWoonplaats']) . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p>Geen resultaten gevonden.</p>';
            }
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2025 Bas van der Heijden Supermarkt</p>
    </footer>
</body>
</html>
