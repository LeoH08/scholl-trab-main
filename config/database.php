<?php

declare(strict_types=1);

require_once __DIR__ . '/env.php';

function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }
    $host    = app_env('DB_HOST', '127.0.0.1');
    $db      = app_env('DB_NAME', '');
    $user    = app_env('DB_USER', '');
    $pass    = app_env('DB_PASS', '');
    $charset = app_env('DB_CHARSET', 'utf8mb4');
    $timeout = (int)(app_env('DB_TIMEOUT', '5'));
    $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_TIMEOUT            => $timeout,
    ];
    if (app_env_bool('DB_PERSISTENT', false)) {
        $options[PDO::ATTR_PERSISTENT] = true;
    }
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        if (app_env_bool('APP_DEBUG', false)) {
            error_log('DB connection error: ' . $e->getMessage());
        }
        http_response_code(500);
        exit('Erro interno.');
    }
    return $pdo;
}
