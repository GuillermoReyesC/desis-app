<?php
declare(strict_types=1);

class WarehouseController
{
    private Warehouse $model;

    public function __construct()
    {
        $db = getPDOConnection();
        $this->model = new Warehouse($db);
    }

    public function listAjax(): array
    {
        try {
            $warehouses = $this->model->getAll();
            return ['success' => true, 'data' => $warehouses];
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