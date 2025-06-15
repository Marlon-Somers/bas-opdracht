<!--
	Auteur: marlon
	Function: home page CRUD Klant
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <!-- Voeg eventueel een logo toe -->
        <img src="../ontwerpen/bas-van-der-heijden-supermarkt-logo-png_seeklogo-276038.png" alt="Bas logo">
        <h1 style="color:white; margin-left:20px;">CRUD Klant</h1>
    </header>
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='insert.php'>Toevoegen nieuwe klant</a><br>
        <a href='search.php' class='square-btn'>Zoek klant</a><br><br>
    </nav>
    <main>
        <?php
        // Autoloader classes via composer
        require '../../vendor/autoload.php';
        use Bas\classes\Klant;
        // Maak een object Klant
        $klant = new Klant;
        // Start CRUD
        $klant->crudKlant();
        ?>
    </main>
    <footer>
        <p style="color:white; text-align:center; line-height:52px; margin:0;">&copy; 2025 Bas van der Heijden Supermarkt</p>
    </footer>
</body>
</html>