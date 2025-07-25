<?php
declare(strict_types=1);

class Warehouse
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        return $this->db
            ->query("SELECT * FROM warehouses ORDER BY id DESC")
             ->fetchAll(PDO::FETCH_ASSOC);
    }


}