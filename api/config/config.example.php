<?php
declare(strict_types=1);
return [
    'db' => ['host' => 'localhost', 'port' => 3306, 'name' => 'YOUR_DATABASE', 'user' => 'YOUR_USER', 'password' => 'YOUR_PASSWORD', 'charset' => 'utf8mb4'],
    'app' => ['allowed_origins' => ['https://warehouse.example.com'], 'session_days' => 365, 'page_size' => 25, 'timezone' => 'Europe/Kyiv'],
];
