<?php
declare(strict_types=1);
$configFile = dirname(__DIR__) . '/config/config.php';
if (!is_file($configFile)) throw new RuntimeException('API не настроен: создайте api/config/config.php');
$config = require $configFile;
date_default_timezone_set($config['app']['timezone'] ?? 'Europe/Kyiv');
spl_autoload_register(static function (string $class): void { $file = __DIR__ . '/' . str_replace('Wms\\', '', $class) . '.php'; if (is_file($file)) require $file; });
