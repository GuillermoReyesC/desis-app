<?php

declare(strict_types=1);

class Agencycontroller
{
    private Agencies $model;

    public function __construct()
    {
        $db = getPDOConnection();
        $this->model = new Agencies($db);
    }

    public function listAjax(): array
    {
        try {
            $agencies = $this->model->getAll();
            return ['success' => true, 'data' => $agencies];
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

    public function listByWarehouse(int $warehouseId): array
    {
        try {
            $agencies = $this->model->getByWarehouse($warehouseId);
            return ['success' => true, 'data' => $agencies];
        } catch (Throwable $e) {
            error_log('listByWarehouse error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Excepción capturada',
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ];
        }
    }
}