<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/Database.php';

$env = env_load(__DIR__ . '/../.env');

try {
    $pdo = db_pdo($env);

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS auth_workspace_status (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            slug VARCHAR(120) UNIQUE NOT NULL,
            title VARCHAR(255) NOT NULL,
            details TEXT,
            status VARCHAR(20) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
    );

    echo "Migrations completed.\n";
} catch (Throwable $exception) {
    fwrite(STDERR, "Migration failed: {$exception->getMessage()}\n");
    exit(1);
}
