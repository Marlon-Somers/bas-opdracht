<?php
require '../../vendor/autoload.php';
require_once '../classes/functions.php';

use Bas\classes\Artikel;

$artikel = new Artikel();
$artikelen = $artikel->getAllArtikelen();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikelen Overzicht</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <a href="../index.html" class="button">Home</a>
    </header>
    <main>
        <h1>Artikelen Overzicht</h1>
        <div class="menu-container" style="margin-bottom: 24px;">
            <a href="insertArtikel.php" class="button">Artikel toevoegen</a>
        </div>
        <div class="container">
            <table>
                <?php
                if ($artikelen && count($artikelen) > 0) {
                    echo getTableHeader($artikelen[0]);
                    foreach ($artikelen as $row) {
                        echo "<tr>";
                        foreach ($row as $value) {
                            echo "<td>" . htmlspecialchars($value) . "</td>";
                        }
                        echo "<td>
                                <a href='updateArtikel.php?artId={$row['artId']}' class='action-link'>Wijzigen</a>
                                <form method='post' action='deleteArtikel.php' style='display:inline;'>
                                    <input type='hidden' name='artId' value='{$row['artId']}'>
                                    <button type='submit' name='verwijderen' onclick=\"return confirm('Weet je zeker dat je dit artikel wilt verwijderen?');\">Verwijderen</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Geen artikelen gevonden.</td></tr>";
                }
                ?>
            </table>
        </div>
        <footer></footer>
    </main>
</body>
</html>