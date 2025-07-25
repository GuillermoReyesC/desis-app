<?php
declare(strict_types=1);

class ProductsMaterial
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        return $this->db
            ->query("SELECT * FROM product_material ORDER BY product_id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($product_id, $material_id)
    {
        $query = "INSERT IGNORE INTO product_material (product_id, material_id) VALUES (:product_id, :material_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':material_id', $material_id);
        $stmt->execute();
        //no
        return $this->db->lastInsertId();
    }
}
