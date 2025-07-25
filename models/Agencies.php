<?php
declare(strict_types=1);
//agency = sucursal
class Agencies
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        return $this->db
            ->query("SELECT * FROM agencies ORDER BY id DESC")
            ->fetchAll();
    }

    public function getByWarehouse(int $warehouseId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM agencies WHERE warehouse_id = :id ORDER BY id DESC");
        $stmt->bindParam(':id', $warehouseId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
