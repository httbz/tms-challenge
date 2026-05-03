<?php

namespace App;

use PDO;

class Database
{
    private static ?PDO $instance = null;

    public static function connection(): PDO
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        $envFile = __DIR__ . '/../.env';
        if (!file_exists($envFile)) {
            http_response_code(500);
            echo json_encode(['erro' => 'Arquivo .env não encontrado. Copie .env.example para .env.']);
            exit;
        }

        $env = parse_ini_file($envFile);
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $env['DB_HOST'] ?? 'localhost',
            $env['DB_PORT'] ?? '3306',
            $env['DB_NAME'] ?? 'brudam_test'
        );

        self::$instance = new PDO($dsn, $env['DB_USER'] ?? 'root', $env['DB_PASS'] ?? '', [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        return self::$instance;
    }
}
