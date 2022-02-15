<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$mw = function (Request $request, RequestHandler $handler) {
    $response = $handler->handle($request);
    $response->getBody()->write('World');

    return $response;
};

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write('Hello ');

    return $response;
})->add($mw);

$app->run();
