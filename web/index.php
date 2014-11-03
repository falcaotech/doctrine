<?php

require_once '../bootstrap.php';

$app->get('/', function() use ($app)
{
});

$app->get('/clientes', function() use($clientes)
{
    $gerador = new \JRP\Gerador\Gerador();
    $clientes = $gerador->clientes();

    return new \Symfony\Component\HttpFoundation\JsonResponse($clientes);
});

//$app->run();