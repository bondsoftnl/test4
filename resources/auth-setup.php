<?php

declare(strict_types=1);

$envReady = !empty($env);
$appKeyReady = !empty($env['APP_KEY'] ?? '');
$dbReady = $dbError === null;
$summary = $dbReady ? 'Среда готова: можно переходить к задачам auth.' : 'Среда частично готова: завершите шаг с базой данных.';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication setup workspace</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div id="app" class="wrapper">
    <div class="content-wrapper" style="min-height: 100vh;">
        <div class="content pt-4">
            <div class="container">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h1 class="card-title"><strong>Header</strong>: Authentication setup workspace</h1>
                    </div>
                    <div class="card-body">
                        <p><strong>Summary</strong>: <?= htmlspecialchars($summary, ENT_QUOTES, 'UTF-8') ?></p>

                        <h3 class="h5 mt-4 mb-3"><strong>Main content</strong></h3>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>.env configured</span>
                                <span class="badge <?= $envReady ? 'bg-success' : 'bg-danger' ?>"><?= $envReady ? 'OK' : 'Missing' ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>APP_KEY generated</span>
                                <span class="badge <?= $appKeyReady ? 'bg-success' : 'bg-warning' ?>"><?= $appKeyReady ? 'OK' : 'Run key:generate' ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>MySQL connection + migrations + seeds</span>
                                <span class="badge <?= $dbReady ? 'bg-success' : 'bg-danger' ?>"><?= $dbReady ? 'OK' : 'Check DB credentials' ?></span>
                            </li>
                        </ul>

                        <?php if ($dbError): ?>
                            <div class="alert alert-warning"><strong>DB check:</strong> <?= htmlspecialchars($dbError, ENT_QUOTES, 'UTF-8') ?></div>
                        <?php endif; ?>

                        <?php if ($statusCards): ?>
                            <div class="row">
                                <?php foreach ($statusCards as $card): ?>
                                    <div class="col-md-4">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h5><?= htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8') ?></h5>
                                                <p><?= htmlspecialchars((string) $card['details'], ENT_QUOTES, 'UTF-8') ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="alert alert-light border mt-3 mb-0">
                            <strong>Next step</strong>: implement real login/registration flows in a dedicated auth module,
                            without mixing this setup checker into business auth logic.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"></script>
<script>
    Vue.createApp({
        mounted() {
            console.info('Auth setup screen mounted');
        }
    }).mount('#app');
</script>
</body>
</html>
