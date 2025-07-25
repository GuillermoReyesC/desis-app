<?php

require_once '../db.php';
require_once '../models/Agencies.php';
require_once '../controllers/AgencyController.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? null;
$controller = new AgencyController();

//validar acción
switch ($action) {
    case 'list':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido (GET esperado)']);
            exit;
        }

        echo json_encode($controller->listAjax());
        exit;

    case 'listByWarehouse':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido (GET esperado)']);
            exit;
        }

        $warehouseId = $_GET['warehouse_id'] ?? null;
        if (!$warehouseId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID de bodega requerido']);
            exit;
        }

        echo json_encode($controller->listByWarehouse($warehouseId));
        exit;

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
        exit;
}