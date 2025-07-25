<?php
declare(strict_types=1);

class Product
{
    private PDO $db;
    public function __construct(PDO $db) { $this->db = $db; }

    public function getAll(): array
    {
        return $this->db
            ->query("SELECT * FROM products ORDER BY id DESC")
            ->fetchAll();
    }

    /**
     * Devuelve el ID insertado o excepción si algo falla.
     */
    public function create(
        string $productCode,
        string $productName,
        int $warehouseId,
        int $agencyId,
        int $currencyId,
        float $price,
        string $description
    ): int {
        $sql = "INSERT INTO products (
                    code,
                    name,
                    warehouse_id,
                    agency_id,
                    currency_id,
                    price,
                    description
                ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $ok   = $stmt->execute([
            $productCode,
            $productName,
            $warehouseId,
            $agencyId,
            $currencyId,
            $price,
            $description
        ]);

        if (!$ok || $stmt->rowCount() === 0) {
            // Obten info detallada de error de PDO (no lanza excepción si ERRMODE no setea)
            $info = $stmt->errorInfo();
            throw new RuntimeException('No se insertó el producto. ErrorInfo: ' . implode(' | ', $info));
        }

        return (int)$this->db->lastInsertId();
    }


    public function existByCode(string $code): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM products WHERE code = ?");
        $stmt->execute([$code]);
        return (bool)$stmt->fetchColumn();// devuelve true si existe
    }

}