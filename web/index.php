<?php

require_once '../bootstrap.php';

$app->get('/', function() use ($app)
{
    return $app->redirect('/produto/listagem');
});

$app->get('/produto/listagem', function() use ($app)
{
    $produtos = $app['produtoService']->read();

    return $app['twig']->render('produtos/listagem.twig', ['produtos' => $produtos]);
})->bind('produtos');

$app->get('/produto/cadastrar', function()
{

})->bind('produto-cadastrar');

$app->get('/produto/editar/{id}', function($id) use ($app)
{
    return 'editar';
})->bind('produto-editar');

$app->get('/produto/excluir/{id}', function($id) use ($app)
{
    if($app['produtoService']->delete($id)) {
        return $app->redirect($app['url_generator']->generate('produtos'));
    }
})->bind('produto-excluir');

$app->run();