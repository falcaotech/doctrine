<?php

require_once __DIR__ . '/doctrine-bootstrap.php';

$app = new \JRP\Application\App(array('debug' => true));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/src/JRP/Views/',
));

$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

$app['produtoService'] = function() use ($em){
    $produtoMapper = new \JRP\Produto\Mapper\ProdutoMapper($em);
    $produtoService = new \JRP\Produto\Service\ProdutoService($produtoMapper, new \JRP\Produto\Entity\Produto());

    return $produtoService;
};