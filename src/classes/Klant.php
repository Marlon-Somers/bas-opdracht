<?php
// auteur: marlon
// functie: definitie class Klant
namespace Bas\classes;

use Bas\classes\Database;

include_once "functions.php";

class Klant extends Database {
    public $klantId;
    public $klantemail = null;
    public $klantnaam;
    public $klantwoonplaats;
    private $table_name = "Klant";

    // Methods

    /**
     * Summary of crudKlant
     * @return void
     */
    public function crudKlant() : void {
        // Haal alle klant op uit de database mbv de method getKlant()
        $lijst = $this->getKlanten();

        // Print een HTML tabel van de lijst    
        $this->showTable($lijst);
    }

public function getKlanten() : array {
    try {
        $sql = "SELECT klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats FROM $this->table_name";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        echo "Fout bij ophalen klanten: " . $e->getMessage();
        return [];
    }
}

public function getKlant(int $klantId) : array {
    try {
        $sql = "SELECT klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats FROM $this->table_name WHERE klantId = :klantId";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['klantId' => $klantId]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: [];
    } catch (\PDOException $e) {
        echo "Fout bij ophalen klant: " . $e->getMessage();
        return [];
    }
}



    public function dropDownKlant($row_selected = -1) {

        // Haal alle klanten op uit de database mbv de method getKlanten()
        $lijst = $this->getKlanten();

        echo "<label for='Klant'>Choose a klant:</label>";
        echo "<select name='klantId'>";
        foreach ($lijst as $row){
            $selected = ($row_selected == $row["klantId"]) ? "selected='selected'" : "";
            echo "<option value='{$row['klantId']}' $selected> {$row['klantNaam']} {$row['klantEmail']}</option>\n";
        }
        echo "</select>";
    }

    /**
     * Summary of showTable
     * @param mixed $lijst
     * @return void
     */
    public function showTable($lijst) : void {

        $txt = "<table>";

        // Voeg de kolomnamen boven de tabel
        $txt .= getTableHeader($lijst[0]);

        foreach($lijst as $row){
            $txt .= "<tr>";
            $txt .=  "<td>" . $row["klantId"] . "</td>";
            $txt .=  "<td>" . $row["klantNaam"] . "</td>";
            $txt .=  "<td>" . $row["klantEmail"] . "</td>";
            $txt .=  "<td>" . $row["klantAdres"] . "</td>";
			$txt .=  "<td>" . $row["klantPostcode"] . "</td>";
			$txt .=  "<td>" . $row["klantWoonplaats"] . "</td>";
            //Update
            // Wijzig knopje
            $txt .=  "<td>";
            $txt .= " 
            <form method='post' action='update.php?klantId={$row['klantId']}' >       
                <button name='update'>Wzg</button>     
            </form> </td>";

            //Delete
            $txt .=  "<td>";
            $txt .= " 
            <form method='post' action='delete.php?klantId={$row['klantId']}' >       
                <button name='verwijderen'>Verwijderen</button>     
            </form> </td>";
            $txt .= "</tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }

    // Delete klant
    /**
     * Verwijder klant uit database
     * @param int $klantId
     * @return bool
     */
    public function deleteKlant(int $klantId) : bool {
        try {
            $sql = "DELETE FROM $this->table_name WHERE klantId = :klantId";
            $stmt = self::$conn->prepare($sql);
            return $stmt->execute(['klantId' => $klantId]);
        } catch (\PDOException $e) {
            echo "Fout bij verwijderen: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Update klantgegevens
     * @param array $row
     * @return bool
     */
    public function updateKlant($row) : bool {
        try {
            $sql = "UPDATE $this->table_name SET klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats WHERE klantId = :klantId";
            $stmt = self::$conn->prepare($sql);
            return $stmt->execute([
                'klantId' => $row['klantId'],
                'klantNaam' => $row['klantNaam'],
                'klantEmail' => $row['klantEmail'],
                'klantAdres' => $row['klantAdres'],
                'klantPostcode' => $row['klantPostcode'],
                'klantWoonplaats' => $row['klantWoonplaats']
            ]);
        } catch (\PDOException $e) {
            echo "Fout bij update: " . $e->getMessage();
            return false;
        }
    }


    /**
     * Summary of BepMaxKlantId
     * @return int
     */
    private function BepMaxKlantId() : int {

        // Bepaal uniek nummer
        $sql="SELECT MAX(klantId)+1 FROM $this->table_name";
        return  (int) self::$conn->query($sql)->fetchColumn();
    }

    // Summary of insertKlant

    public function insertKlant($row): bool {
        try {
            if (!isset($row['klantNaam']) || !isset($row['klantEmail'])) {
                echo "Fout: klantNaam en klantEmail zijn verplicht.";
                return false;
            }

            $klantId = $this->BepMaxKlantId();
            $sql = "INSERT INTO $this->table_name 
                    (klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) 
                    VALUES (:klantId, :klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)";
            $stmt = self::$conn->prepare($sql);
            return $stmt->execute([
                'klantId' => $klantId,
                'klantNaam' => $row['klantNaam'],
                'klantEmail' => $row['klantEmail'],
                'klantAdres' => $row['klantAdres'] ?? '',
                'klantPostcode' => $row['klantPostcode'] ?? '',
                'klantWoonplaats' => $row['klantWoonplaats'] ?? '',
            ]);
        } catch (\PDOException $e) {
            echo "Fout bij insert: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Zoek klanten op naam (LIKE)
     * @param string $naam
     * @return array
     */
    public function zoekOpNaam(string $naam): array {
        try {
            $sql = "SELECT klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats FROM $this->table_name WHERE klantNaam LIKE :naam";
            $stmt = self::$conn->prepare($sql);
            $stmt->execute(['naam' => "%$naam%"]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Fout bij zoeken: " . $e->getMessage();
            return [];
        }
    }
}
