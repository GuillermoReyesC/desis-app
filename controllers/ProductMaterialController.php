<?php
declare(strict_types=1);

class ProductMaterialController
{
    private ProductsMaterial $model;

    public function __construct()
    {
        $db = getPDOConnection();
        $this->model = new ProductsMaterial($db);
    }

    public function storeAjax($data)
    {
        try {
            $product_id = $data['product_id'] ?? null;
            $materiales = $data['materiales'] ?? [];

            if (!$product_id || empty($materiales)) {
                throw new Exception("Datos incompletos");
            }

           $model = $this->model;

            foreach ($materiales as $material_id) {
                $model->create($product_id, $material_id);
            }

            return json_encode([
                'success' => true,
                'message' => 'Materiales asociados correctamente'
            ]);
        } catch (Exception $e) {
            return json_encode([
                'success' => false,
                'message' => 'Excepción capturada',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function listAjax(): array
    {
        try {
            $materials = $this->model->getAll();
            return ['success' => true, 'data' => $materials];
        } catch (Throwable $e) {
            error_log('listAjax error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Excepción capturada',
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ];
        }
    }
}
