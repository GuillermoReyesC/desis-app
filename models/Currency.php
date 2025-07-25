<?php

declare(strict_types=1);

class Currency
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        return $this->db
            ->query("SELECT * FROM currencies ORDER BY id DESC")
            ->fetchAll();
    }
}