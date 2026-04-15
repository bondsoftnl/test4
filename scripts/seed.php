<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/Database.php';

$env = env_load(__DIR__ . '/../.env');

try {
    $pdo = db_pdo($env);

    $items = [
        ['env-ready', 'Environment configured', 'The .env file is present and APP_KEY is generated.', 'done'],
        ['db-ready', 'Database connected', 'MySQL credentials are valid and migrations are applied.', 'done'],
        ['ui-ready', 'AdminLTE + Vue booted', 'The authentication setup screen is rendering correctly.', 'done'],
    ];

    $stmt = $pdo->prepare(
        'INSERT INTO auth_workspace_status (slug, title, details, status)
         VALUES (:slug, :title, :details, :status)
         ON DUPLICATE KEY UPDATE title = VALUES(title), details = VALUES(details), status = VALUES(status)'
    );

    foreach ($items as [$slug, $title, $details, $status]) {
        $stmt->execute(compact('slug', 'title', 'details', 'status'));
    }

    echo "Seed data upserted.\n";
} catch (Throwable $exception) {
    fwrite(STDERR, "Seeding failed: {$exception->getMessage()}\n");
    exit(1);
}
