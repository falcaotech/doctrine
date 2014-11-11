<?php

require_once '../bootstrap.php';

$app->error(function (\Exception $e, $code) use($app) {
    return $app->json(array("success" => false, "msg" => $e->getMessage()),$code);
});

$app->get('/', function() use ($app)
{
    return $app->redirect($app['url_generator']->generate('produtos'));
});

$app->get('/produtos', function() use ($app)
{
    $produtos = $app['produtoService']->read();

    return $app['twig']->render('produtos/listagem.twig', ['produtos' => $produtos]);
})->bind('produtos');

$app->get('/produtos/listagem', function() use ($app)
{
    $produtos = $app['produtoService']->read();

    return $app->json($produtos);
});

$app->post('/produto/cadastrar', function(\Symfony\Component\HttpFoundation\Request $request) use ($app)
{
    $dados = $request->request->all();

    if($app['produtoService']->insert($dados))
    {
        return $app->json(['success' => true, 'msg' => 'Produto cadastrado com sucesso!']);
    }

    return $app->json(['success' => false, 'msg' => 'Erro ao cadastrar produto!'], 400);
});

$app->post('/produto/atualizar', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $dados = $request->request->all();

    if($app['produtoService']->updateColumn($dados))
    {
        return $app->json(['success' => true, 'msg' => 'Produto atualizado com sucesso!']);
    }

    return $app->json(['success' => false, 'msg' => 'Erro ao atualizar produto!'], 400);
});

$app->get('/produto/excluir/{id}', function($id) use ($app)
{
    if($app['produtoService']->delete($id)) {
        return $app->redirect($app['url_generator']->generate('produtos'));
    }
})->bind('produto-excluir');

$app->run();