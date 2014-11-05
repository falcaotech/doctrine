<?php

require_once 'vendor/autoload.php';

use JRP\Db\Db;
use Aura\Di\Container;
use Aura\Di\Factory;

$di = new Container(new Factory());
$db = new Db("mysql:host=localhost;dbname=soa", "root", "82214290");

$di->set('db.conn', $db->getConn());

$app = new \JRP\Application\App(array('debug' => true));

$app['produtoService'] = function() use ($di){
    $produtoMapper = new \JRP\Produto\Mapper\ProdutoMapper($di);
    $produtoService = new \JRP\Produto\Service\ProdutoService($produtoMapper, new \JRP\Produto\Entity\Produto());

    return $produtoService;
};