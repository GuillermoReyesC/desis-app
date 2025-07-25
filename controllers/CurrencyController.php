<?php
declare(strict_types=1);

class CurrencyController
{
    private Currency $model;

    public function __construct()
    {
        $db = getPDOConnection();
        $this->model = new Currency($db);
    }

    public function listAjax(): array
    {
        try {
            $currencies = $this->model->getAll();
            return ['success' => true, 'data' => $currencies];
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