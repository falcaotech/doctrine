<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/doctrine-bootstrap.php';

$app = new \JRP\Application\App(array('debug' => true));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/src/JRP/Views/',
));

$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

$app['produtoService'] = function() use ($em){
    $produtoService = new \JRP\Produto\Service\ProdutoService($em, new \JRP\Produto\Entity\Produto());

    return $produtoService;
};

$app['produtoSerializer'] = function() {
    return new \JRP\Produto\Serializer\ProdutoSerializer();
};