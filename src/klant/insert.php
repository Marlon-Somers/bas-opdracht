<?php
// auteur: marlon
// functie: insert class Klant
// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
	$klant = new Klant();

	// Formulierdata ophalen
	$row = [
		'klantNaam' => $_POST['klantnaam'],
		'klantEmail' => $_POST['klantemail'],
		'klantAdres' => $_POST['klantadres'],
		'klantPostcode' => $_POST['klantpostcode'],
		'klantWoonplaats' => $_POST['klantwoonplaats']
		
	];

	if ($klant->insertKlant($row)) {
		echo "<p style='color:green;'>Klant succesvol toegevoegd!</p>";
	} else {
		echo "<p style='color:red;'>Fout bij het toevoegen van de klant.</p>";
	}
}
?>

<!--
    Auteur: marlon
    Function: klant toevoegen
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
        <img src="../ontwerpen/bas-van-der-heijden-supermarkt-logo-png_seeklogo-276038.png" alt="Bas logo">
        <h1>CRUD Klant</h1>
    </header>
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='read.php'>Overzicht klanten</a><br><br>
    </nav>
    <main>
        <!-- Formulier voor klant toevoegen -->
        <h2>Toevoegen</h2>
        <form method="post">
            <label for="nv">Klantnaam:</label>
            <input type="text" id="nv" name="klantnaam" placeholder="Klantnaam" required/>
            <br>
            <label for="an">Klantemail:</label>
            <input type="email" id="an" name="klantemail" placeholder="Klantemail" required/>
            <br>
            <label for="adres">Klantadres:</label>
            <input type="text" id="adres" name="klantadres" placeholder="Klantadres" required/>
            <br>
            <label for="postcode">Klantpostcode:</label>
            <input type="text" id="postcode" name="klantpostcode" placeholder="Klantpostcode" required/>
            <br>
            <label for="wp">Klantwoonplaats:</label>
            <input type="text" id="wp" name="klantwoonplaats" placeholder="Klantwoonplaats" required/>
            <br><br>
            <input type='submit' name='insert' value='Toevoegen'>
        </form>
    </main>
    <footer>
        <p>&copy; 2025 Bas van der Heijden Supermarkt</p>
    </footer>
</body>
</html>
