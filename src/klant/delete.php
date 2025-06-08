<?php 
// auteur: marlon
// functie: 

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["verwijderen"])){
	// Maak een object Klant
	$klant = new Klant();

	// Haal klantId op uit GET of POST
	if (isset($_GET['klantId'])) {
		$klantId = (int)$_GET['klantId'];
	} elseif (isset($_POST['klantId'])) {
		$klantId = (int)$_POST['klantId'];
	} else {
		echo '<script>alert("Geen klantId opgegeven")</script>';
		echo "<script> location.replace('read.php'); </script>";
		exit;
	}

	// Delete Klant op basis van NR
	$klant->deleteKlant($klantId);

	echo '<script>alert("Klant verwijderd")</script>';
	echo "<script> location.replace('read.php'); </script>";
}
?>



