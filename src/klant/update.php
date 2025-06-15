<?php
    // auteur: marlon
    // functie: update class Klant

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    use Bas\classes\Klant;
    
    $klant = new Klant;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){
        // Code voor een update
        $row = [
            'klantId' => $_POST['klantId'],
            'klantNaam' => $_POST['klantnaam'],
            'klantEmail' => $_POST['klantemail'],
            'klantAdres' => $_POST['klantadres'],
            'klantPostcode' => $_POST['klantpostcode'],
            'klantWoonplaats' => $_POST['klantwoonplaats']
        ];
        if ($klant->updateKlant($row)) {
            echo "<p style='color:green;'>Klant succesvol gewijzigd!</p>";
        } else {
            echo "<p style='color:red;'>Fout bij het wijzigen van de klant.</p>";
        }
    }

    if (isset($_GET['klantId'])){
        $row = $klant->getKlant($_GET['klantId']);


?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css" />
</head>
<body>
  <header>
    <img src="../ontwerpen/bas-van-der-heijden-supermarkt-logo-png_seeklogo-276038.png" alt="Bas logo" />
    <h1 style="color:white; margin-left:20px;">CRUD Klant</h1>
  </header>
  <nav>
    <a href="read.php">Terug</a>
  </nav>
  <main>
    <h2>Wijzigen</h2>
    <form method="post">
        <input type="hidden" name="klantId" value="<?php if(isset($row)) { echo $row['klantId']; } ?>">
        <label>Klantnaam:
            <input type="text" name="klantnaam" required value="<?php if(isset($row)) {echo $row['klantNaam']; }?>">
        </label>
        <label>Klantemail:
            <input type="email" name="klantemail" required value="<?php if(isset($row)) {echo $row['klantEmail']; }?>">
        </label>
        <label>Klantadres:
            <input type="text" name="klantadres" required value="<?php if(isset($row)) {echo $row['klantAdres']; }?>">
        </label>
        <label>Klantpostcode:
            <input type="text" name="klantpostcode" required value="<?php if(isset($row)) {echo $row['klantPostcode']; }?>">
        </label>
        <label>Klantwoonplaats:
            <input type="text" name="klantwoonplaats" required value="<?php if(isset($row)) {echo $row['klantWoonplaats']; }?>">
        </label>
        <button type="submit" name="update" value="Wijzigen">Wijzig klant</button>
    </form>
  </main>
  <footer>
    <p style="color:white; text-align:center; line-height:52px; margin:0;">&copy; 2025 Bas van der Heijden Supermarkt</p>
  </footer>
</body>
</html>

<?php
    } else {
        echo "Geen klantId opgegeven<br>";
    }
?>
