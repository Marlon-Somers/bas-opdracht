<?php
// auteur: marlon

namespace Bas\classes;

require_once "Database.php";

class Artikel extends Database
{
    public function getAllArtikelen()
    {
        $sql = "SELECT * FROM artikel";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getArtikelById($artId)
    {
        $sql = "SELECT * FROM artikel WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        $stmt->bindParam(':artId', $artId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insertArtikel($data)
    {
        $sql = "INSERT INTO artikel 
            (artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
            VALUES 
            (:artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':artOmschrijving' => $data['artOmschrijving'],
            ':artInkoop' => $data['artInkoop'],
            ':artVerkoop' => $data['artVerkoop'],
            ':artVoorraad' => $data['artVoorraad'],
            ':artMinVoorraad' => $data['artMinVoorraad'],
            ':artMaxVoorraad' => $data['artMaxVoorraad'],
            ':artLocatie' => $data['artLocatie'],
        ]);
    }

    public function updateArtikel($artId, $data)
    {
        $sql = "UPDATE artikel SET 
            artOmschrijving = :artOmschrijving, 
            artInkoop = :artInkoop, 
            artVerkoop = :artVerkoop, 
            artVoorraad = :artVoorraad,
            artMinVoorraad = :artMinVoorraad,
            artMaxVoorraad = :artMaxVoorraad,
            artLocatie = :artLocatie
            WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':artOmschrijving' => $data['artOmschrijving'],
            ':artInkoop' => $data['artInkoop'],
            ':artVerkoop' => $data['artVerkoop'],
            ':artVoorraad' => $data['artVoorraad'],
            ':artMinVoorraad' => $data['artMinVoorraad'],
            ':artMaxVoorraad' => $data['artMaxVoorraad'],
            ':artLocatie' => $data['artLocatie'],
            ':artId' => $artId,
        ]);
    }

    public function deleteArtikel($artId)
    {
        $sql = "DELETE FROM artikel WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([':artId' => $artId]);
    }
}
?>