<?php
require_once '../db.php';
require_once '../models/Products.php';
require_once '../models/ProductsMaterial.php';  // <--- Agrega esta línea
require_once '../controllers/ProductMaterialController.php'; 
require_once '../controllers/ProductsController.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? null;
$controller = new ProductController();

// Validar acción
switch ($action) {
    case 'checkCode':
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido (GET esperado)']);
        exit;
    }

    $code = $_GET['code'] ?? '';
    echo json_encode($controller->checkCodeExistsAjax($code));
    exit;
    
    case 'list':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido (GET esperado)']);
            exit;
        }
        echo json_encode($controller->listAjax());
        exit;
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido (POST esperado)']);
            exit;
        }
        $rawInput = file_get_contents('php://input');
        $data = json_decode($rawInput, true);

        if (!is_array($data)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Entrada JSON inválida']);
            exit;
        }
        echo json_encode($controller->storeAjax($data));
        exit;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
        exit;
}