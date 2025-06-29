<?php
// Auteur: marlon
// Function: home page CRUD Verkooporder
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Verkooporders</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <img src="../ontwerpen/bas-van-der-heijden-supermarkt-logo-png_seeklogo-276038.png" alt="Bas logo">
        <h1 style="color:white; margin-left:20px;">CRUD Verkooporder</h1>
    </header>
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='insert.php'>Toevoegen nieuwe verkooporder</a><br>
        <!-- <a href='search.php' class='square-btn'>Zoek verkooporder</a><br> -->
        <br>
    </nav>
    <main>
        <?php
        require '../../vendor/autoload.php';
        use Bas\classes\Verkooporder;
        $verkooporder = new Verkooporder();
        $orders = $verkooporder->getAllVerkooporders();

        echo "<div class='container'>";
        echo "<table>";
        echo "<tr>
                <th>verkOrdId</th>
                <th>klantId</th>
                <th>artId</th>
                <th>verkOrdDatum</th>
                <th>verkOrdBestAantal</th>
                <th>verkOrdStatus</th>
              </tr>";
        if ($orders && count($orders) > 0) {
            foreach ($orders as $order) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($order['verkOrdId']) . "</td>";
                echo "<td>" . htmlspecialchars($order['klantId']) . "</td>";
                echo "<td>" . htmlspecialchars($order['artId']) . "</td>";
                echo "<td>" . htmlspecialchars($order['verkOrdDatum']) . "</td>";
                echo "<td>" . htmlspecialchars($order['verkOrdBestAantal']) . "</td>";
                echo "<td>" . htmlspecialchars($order['verkOrdStatus']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Geen verkooporders gevonden.</td></tr>";
        }
        echo "</table>";
        echo "</div>";
        ?>
    </main>
    <footer>
        <p style="color:white; text-align:center; line-height:52px; margin:0;">&copy; 2025 Bas van der Heijden Supermarkt</p>
    </footer>
</body>
</html>