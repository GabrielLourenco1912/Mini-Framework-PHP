<?php

use App\Core\Router;
use App\Core\Response;
use App\Core\Exceptions\HttpException;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

$router = new Router();

$router->setPrefix('/api');

require __DIR__ . '/../config/routes/api.php';

$router->setPrefix('');

require __DIR__ . '/../config/routes/web.php';

try {
    $router->dispatch();
} catch (HttpException $e) {
    $response = new Response();
    $code = $e->getStatusCode();
    $response->setStatusCode($code)
        ->view('errors/error', ['code' => $code, 'message' => $e->getMessage()])
        ->send();
} catch (\Throwable $e) {
    $response = new Response();
    $code = (int) $e->getCode() ?: 500;
    $response->setStatusCode($code)
        ->view('errors/error', ['code' => $code, 'message' => $e->getMessage()])
        ->send();
}