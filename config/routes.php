<?php

declare(strict_types=1);

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function (Request $request, Response $response) {
    return $response->withRedirect($this->router->pathFor('status'));
});

$app->get('/status', function (Request $request, Response $response) {
    return $response->withStatus(\Slim\Http\StatusCode::HTTP_OK);
})->setName('status');

// Swagger
$app->get('/v1/docs', function () {
    $dir     = __DIR__ . '/../src/UI/Http/Controller'; // Scan Controller folder
    $openapi = \OpenApi\scan($dir);
    header('Content-type: application/x-yaml');

    return $openapi->toYaml();
});


$app->group('/seller', function () use ($app) {
    $app->post('', 'CreateSellerController:create');
    $app->delete('/uuid/{uuid}', 'DeleteSellerController:delete');
});

$app->group('/product', function () use ($app) {
    $app->post('', 'CreateProductController:create');
    $app->delete('/uuid/{uuid}', 'DeleteProductController:delete');
});

$app->group('/cart', function () use ($app) {
    $app->post('/product', 'AddProductController:add');
    $app->put('/product', 'RemoveProductFromCartController:remove');
    $app->get('/total/{customer_uuid}', 'GetTotalCartController:get');
    $app->delete('/customer/uuid/{uuid}', 'DeleteCartController:delete');
    $app->put('/buy', 'BuyCartController:buy');
});
