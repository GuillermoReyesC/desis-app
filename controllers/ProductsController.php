<?php
declare(strict_types=1);

class ProductController
{
    private Product $model;

    public function __construct()
    {
        $db = getPDOConnection();
        $this->model = new Product($db);
    }

    public function storeAjax(array $data): array
    {
        try {
            // Sanitize & validate
            $productCode = trim($data['code'] ?? '');
            $productName = trim($data['name'] ?? '');
            $warehouseId = (int)($data['warehouse_id'] ?? 0);
            $agencyId    = (int)($data['agency_id'] ?? 0);
            $currencyId  = (int)($data['currency_id'] ?? 0);
            $price       = (float)($data['price'] ?? 0);
            $description = trim($data['description'] ?? '');

            if (
                $productCode === '' || $productName === '' || $description === '' ||
                $warehouseId <= 0 || $agencyId <= 0 || $currencyId <= 0 || $price <= 0
            ) 
                {
                return [
                    'success' => false,
                    'message' => 'Datos inválidos o incompletos',
                    'data'    => $data   // Para debug, puedes quitar en producción
                ];
            }

            $newId = $this->model->create(
                $productCode,
                $productName,
                $warehouseId,
                $agencyId,
                $currencyId,
                $price,
                $description
            );

             // Insertar materiales asociados (si existen)
            if (isset($data['materials']) && is_array($data['materials']) && !empty($data['materials'])) {
                // Instancia el modelo que maneja materiales
                $productMaterialModel = new ProductsMaterial(getPDOConnection());
                
                foreach ($data['materials'] as $materialId) {
                    // Inserta la relación producto-material
                    $productMaterialModel->create($newId, (int)$materialId);
                }
            }

            return [
                'success' => true,
                'message' => 'Producto creado y materiales agregados exitosamente',
                'id'      => $newId
            ];
        } catch (Throwable $e) {
            error_log('storeAjax error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Excepción capturada',
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ];
        }
    }

    

    public function listAjax(): array
    {
        try {
            $products = $this->model->getAll();
            return ['success' => true, 'data' => $products];
        } catch (Throwable $e) {
            error_log('listAjax error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Error al obtener productos',
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ];
        }
    }

    public function checkCodeExistsAjax(string $code): array
    {
        try {
            $exists = $this->model->existByCode($code);
            return [
                'success' => true,
                'exists'  => $exists
            ];
        } catch (Throwable $e) {
            error_log('checkCodeExistsAjax error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Excepción al verificar código',
                'error'   => $e->getMessage()
            ];
        }
    }
}