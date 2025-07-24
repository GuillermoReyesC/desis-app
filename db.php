<?php

function getPDOConnection(): PDO
{
    $host = 'mysql';
    $dbname = "desis_db";
    $username = 'root';
    $password = 'rootpassword';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // <- Esto lanza excepciones
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        // Log interno
        error_log('DB Connection error: ' . $e->getMessage());
        // Puedes lanzar de nuevo para que el controlador lo capture
        throw $e;
    }
}