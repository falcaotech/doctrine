<?php

require_once 'vendor/autoload.php';

use JRP\Db\Db;
use Aura\Di\Container;
use Aura\Di\Factory;

$di = new Container(new Factory());
$db = new Db("mysql:host=localhost;dbname=soa", "root", "82214290");

$di->set('db.conn', $db->getConn());

$app = new Silex\Application(array('debug' => true));

$produtoMapper = new \JRP\Produto\Mapper\ProdutoMapper($di);

$produto = new \JRP\Produto\Entity\Produto();
$produto->setId(1);
$produto->setNome('teste');
$produto->setValor(100);

var_dump($produtoMapper->update($produto));

var_dump($produtoMapper->delete($produto));