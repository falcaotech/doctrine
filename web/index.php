<?php

require_once '../bootstrap.php';

$app->get('/', function() use ($app)
{
    return $app->redirect($app['url_generator']->generate('produtos'));
});

$app->get('/produtos', function() use ($app)
{
    $produtos = $app['produtoService']->read();

    return $app['twig']->render('produtos/listagem.twig', ['produtos' => $produtos]);
})->bind('produtos');

$app->get('/produto/cadastrar', function() use($app)
{
    return $app['twig']->render('produtos/cadastrar.twig');
})->bind('produto-cadastrar');

$app->post('/produto/cadastrar', function(\Symfony\Component\HttpFoundation\Request $request) use ($app)
{
    $dados = $request->request->all();

    if($app['produtoService']->insert($dados))
    {
        return $app->redirect($app['url_generator']->generate('produtos'));
    }

    return "Erro ao cadastrar produto!";
});

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