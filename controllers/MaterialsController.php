<?php
declare(strict_types=1);

class MaterialsController
{
    private Materials $model;

    public function __construct()
    {
        $db = getPDOConnection();
        $this->model = new Materials($db);
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