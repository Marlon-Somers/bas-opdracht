<?php
// filepath: c:\xampp\htdocs\GitHub\bas\src\classes\Verkooporder.php
namespace Bas\classes;

require_once "Database.php";

class Verkooporder extends Database
{
    public function insertVerkooporder($data)
    {
        $sql = "INSERT INTO verkooporder 
            (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus)
            VALUES 
            (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':klantId'           => $data['klantId'],
            ':artId'             => $data['artId'],
            ':verkOrdDatum'      => $data['verkOrdDatum'],
            ':verkOrdBestAantal' => $data['verkOrdBestAantal'],
            ':verkOrdStatus'     => $data['verkOrdStatus'],
        ]);
    }
    public function getAllVerkooporders()
    {
        $sql = "SELECT * FROM verkooporder";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function crudVerkooporder() : void {
        $lijst = $this->getAllVerkooporders();

        $txt = "<table>";
        // Voeg de kolomnamen boven de tabel
        if (count($lijst) > 0) {
            $txt .= "<tr>";
            foreach (array_keys($lijst[0]) as $col) {
                $txt .= "<th>" . htmlspecialchars($col) . "</th>";
            }
            $txt .= "<th>Wijzig</th><th>Verwijder</th></tr>";
            foreach ($lijst as $row) {
                $txt .= "<tr>";
                foreach ($row as $value) {
                    $txt .= "<td>" . htmlspecialchars($value) . "</td>";
                }
                // Wijzig knop
                $txt .= "<td>
                    <form method='post' action='update.php?verkOrdId={$row['verkOrdId']}'>
                        <button name='update'>Wzg</button>
                    </form>
                </td>";
                // Verwijder knop
                $txt .= "<td>
                    <form method='post' action='delete.php?verkOrdId={$row['verkOrdId']}'>
                        <button name='verwijderen'>Verwijderen</button>
                    </form>
                </td>";
                $txt .= "</tr>";
            }
        } else {
            $txt .= "<tr><td colspan='8'>Geen verkooporders gevonden.</td></tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }
public function bestaatVerkooporder($klantId, $artId)
{
    $sql = "SELECT 1 FROM verkooporder WHERE klantId = :klantId AND artId = :artId";
    $stmt = self::$conn->prepare($sql);
    $stmt->execute([
        ':klantId' => $klantId,
        ':artId' => $artId
    ]);
    return $stmt->fetch(\PDO::FETCH_ASSOC) !== false;
} }
