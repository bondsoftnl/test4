<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/Database.php';

$env = env_load(__DIR__ . '/../.env');
$statusCards = [];
$dbError = null;

try {
    $pdo = db_pdo($env);
    $statusCards = $pdo->query('SELECT title, details, status FROM auth_workspace_status ORDER BY id')->fetchAll();
} catch (Throwable $exception) {
    $dbError = $exception->getMessage();
}

return [
    'view' => __DIR__ . '/../resources/auth-setup.php',
    'data' => [
        'env' => $env,
        'statusCards' => $statusCards,
        'dbError' => $dbError,
    ],
];
