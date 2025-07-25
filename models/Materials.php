<?php
declare(strict_types=1);

class Materials
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        return $this->db
            ->query("SELECT * FROM materials ORDER BY id DESC")
            ->fetchAll();
    }
    
}