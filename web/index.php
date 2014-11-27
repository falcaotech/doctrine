<?php

require_once '../bootstrap.php';

use JRP\Controllers\ProdutosControllerProvider;
use JRP\Controllers\ApiControllerProvider;

$app->error(function (\Exception $e, $code) use($app) {
    return $app->json(array("success" => false, "msg" => $e->getMessage()),$code);
});

$app->get('/', function() use ($app)
{
    return $app->redirect($app['url_generator']->generate('produtos'));
});

$app->mount('/produtos', new ProdutosControllerProvider());
$app->mount('/api', new ApiControllerProvider());
$app->run();