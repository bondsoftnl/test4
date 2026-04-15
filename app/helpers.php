<?php

declare(strict_types=1);

function env_load(string $path): array
{
    if (!file_exists($path)) {
        return [];
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $env = [];

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        [$key, $value] = array_pad(explode('=', $line, 2), 2, '');
        $value = trim($value);
        if ((str_starts_with($value, '"') && str_ends_with($value, '"')) || (str_starts_with($value, "'") && str_ends_with($value, "'"))) {
            $value = substr($value, 1, -1);
        }

        $env[trim($key)] = $value;
    }

    return $env;
}

function env_get(array $env, string $key, ?string $default = null): ?string
{
    return $env[$key] ?? $default;
}

function env_write(string $path, array $values): void
{
    $content = [];
    foreach ($values as $key => $value) {
        $escaped = preg_match('/\s/', (string) $value) ? '"' . $value . '"' : $value;
        $content[] = sprintf('%s=%s', $key, $escaped);
    }

    file_put_contents($path, implode(PHP_EOL, $content) . PHP_EOL);
}
