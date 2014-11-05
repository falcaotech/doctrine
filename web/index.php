<?php

require_once '../bootstrap.php';

$app->get('/', function() use ($app)
{
    return $app->redirect('/produto/listagem');
});

$app->get('/produto/listagem', function() use($app){
    if(!$app['produtoService']->count())
    {
        return $app->abort(200, 'Não há nenhum produto cadastrado na tabela do banco de dados!');
    }

    return $app->json($app['produtoService']->read());
});

$app->get('/produto/inserir/', function() use ($app){
    return $app->redirect('/produto/inserir/nome/descricao/10');
});

$app->get('/produto/inserir/{nome}/{descricao}/{valor}', function($nome , $descricao, $valor) use($app) {
    $data = array("nome" => $nome, "descricao" => $descricao, "valor" => $valor);

    return $app->json($app['produtoService']->insert($data));
});

$app->run();