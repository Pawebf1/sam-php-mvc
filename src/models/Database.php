<?php
declare(strict_types=1);

namespace Models;

use PDO;

class Database
{
    private PDO $db;
    private array $POST;
    private array $FILES;
    private string $airplane;
    private int $cargoNumber;
    private int $id;

    public function __construct(int $cargoNumber, array $POST, array $FILES)
    {
        $this->POST = $POST;
        $this->FILES = $FILES;
        $this->cargoNumber = $cargoNumber;

        if ($this->POST['inputGroupSelectAirplane'] == '35000')
            $this->airplane = "Airbus A380";
        else
            $this->airplane = "Boeing 747";

        try {
            $this->db = new PDO('mysql:host=' . $_ENV['MYSQL_DB_HOST'] . ';dbname=' . $_ENV['MYSQL_DB_NAME'], $_ENV['MYSQL_USERNAME'], $_ENV['MYSQL_ROOT_PASSWORD']);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function storeInDB(): void
    {
        $documents = "";
        for ($i = 0; $i < count($this->FILES['documents']['tmp_name']); $i++)
            $documents .= $this->FILES['documents']['name'][$i] . " ";

        $query = 'INSERT INTO transport (transport_from, transport_to, airplane_type, transport_date, documents) 
                  VALUES (:transportFrom, :transportTo, :airplane, :transportDate, :documents)';

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'transportFrom' => $this->POST['transportFrom'],
            'transportTo' => $this->POST['transportTo'],
            'airplane' => $this->airplane,
            'transportDate' => $this->POST['transportDate'],
            'documents' => $documents]);

        $this->id = (int)$this->db->lastInsertId();
        $x = 0;
        do {
            $query = 'INSERT INTO cargo (transport_id, cargo_name, cargo_weight, cargo_type) VALUES (:transportID, :cargoName, :cargoWeight, :cargoType)';
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'transportID' => $this->id,
                'cargoName' => $this->POST["cargoName$x"],
                'cargoWeight' => $this->POST["cargoWeight$x"],
                'cargoType' => $this->POST["cargoType$x"],
            ]);
            $x++;
        } while ($x < $this->cargoNumber);
    }

    private function storeDocuments(): void
    {
        $folderPath = STORAGE_PATH . '/' . $this->POST['transportDate'] . '/';
        mkdir($folderPath);

        $folderPath .= $this->id . '/';
        mkdir($folderPath);
        
        for ($i = 0; $i < count($this->FILES['documents']['tmp_name']); $i++) {
            $filePath = STORAGE_PATH . '/' . $this->POST['transportDate'] . '/' . $this->id . '/' . $this->FILES['documents']['name'][$i];
            move_uploaded_file($this->FILES['documents']['tmp_name'][$i], $filePath);
        }

    }

    public function save(): void
    {
        $this->storeInDB();
        if (file_exists($this->FILES['documents']['tmp_name'][0]))
            $this->storeDocuments();
    }

}