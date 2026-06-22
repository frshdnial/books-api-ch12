<?php
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use App\Middleware\SecurityHeaders;
use App\Middleware\Cors;

require __DIR__ . '/../vendor/autoload.php';

// Only attempt to load a local .env file if it actually exists (local machine)
if (file_exists(__DIR__ . '/../.env')) {
    Dotenv::createImmutable(__DIR__ . '/..')->load();
}

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->add(new SecurityHeaders()); 
$app->add(new Cors());            
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

(require __DIR__ . '/../src/routes.php')($app);

$app->run();