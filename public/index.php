<?php

declare(strict_types=1);

$route = require __DIR__ . '/../routes/web.php';
extract($route['data'], EXTR_SKIP);
require $route['view'];
