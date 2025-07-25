<?php

require_once '../db.php';
require_once '../models/Warehouse.php';
require_once '../controllers/WarehouseController.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? null;
$controller = new WarehouseController();
// Validar acción
switch ($action) {
    case 'list':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido (GET esperado)']);
            exit;
        }

        echo json_encode($controller->listAjax());
        exit;
        
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
        exit;


}
