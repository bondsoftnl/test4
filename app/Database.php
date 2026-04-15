<?php

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

function db_pdo(array $env): PDO
{
    $host = env_get($env, 'DB_HOST', '127.0.0.1');
    $port = env_get($env, 'DB_PORT', '3306');
    $database = env_get($env, 'DB_DATABASE', 'auth_workspace');
    $username = env_get($env, 'DB_USERNAME', 'root');
    $password = env_get($env, 'DB_PASSWORD', '');

    $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";

    return new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}
