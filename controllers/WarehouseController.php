<?php
// cabecera de respuesta
header('Content-Type: application/json');

$sql = "SELECT id_bodega, nombre_bodega FROM bodegas ORDER BY nombre_bodega ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$bodegas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($bodegas);
