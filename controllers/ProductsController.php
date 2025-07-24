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
            $productCode = trim($data['product_code'] ?? '');
            $productName = trim($data['product_name'] ?? '');
            $warehouseId = (int)($data['warehouse_id'] ?? 0);
            $agencyId    = (int)($data['agency_id'] ?? 0);
            $currencyId  = (int)($data['currency_id'] ?? 0);
            $price       = (float)($data['price'] ?? 0);
            $description = trim($data['description'] ?? '');

            if (
                $productCode === '' || $productName === '' || $description === '' ||
                $warehouseId <= 0 || $agencyId <= 0 || $currencyId <= 0 || $price <= 0
            ) {
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

            return [
                'success' => true,
                'message' => 'Producto creado exitosamente',
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
}