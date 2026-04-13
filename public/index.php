<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode check
$maintenanceFile = __DIR__ . '/../storage/framework/maintenance.php';
if (file_exists($maintenanceFile)) {
    require $maintenanceFile;
}

// Composer autoloader
$autoloadFile = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($autoloadFile)) {
    die('Autoload file not found. Run composer install.');
}
require $autoloadFile;

// Bootstrap Laravel
$appFile = __DIR__ . '/../bootstrap/app.php';
if (!file_exists($appFile)) {
    die('Bootstrap file not found.');
}
$app = require_once $appFile;

// Handle the incoming request
/** @var \Illuminate\Contracts\Http\Kernel $kernel */
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Request::capture();
$response = $kernel->handle($request);

// Send response to the browser
$response->send();
$kernel->terminate($request, $response);
