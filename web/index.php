<?php

require_once '../bootstrap.php';

$gerador = new \JRP\Gerador\Gerador();
$clientes = $gerador->clientes();

$app->get('/clientes', function() use($clientes)
{
    return new \Symfony\Component\HttpFoundation\JsonResponse($clientes);
});

$app->run();