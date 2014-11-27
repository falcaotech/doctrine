<?php

require_once '../bootstrap.php';

$app->error(function (\Exception $e, $code) use($app) {
    return $app->json(array("success" => false, "msg" => $e->getMessage()),$code);
});

$app->get('/', function() use ($app)
{
    return $app->redirect($app['url_generator']->generate('produtos'));
});

/* API REST - Start */

$apiRest = $app['controllers_factory'];

$apiRest->get('/produtos', function() use ($app)
{
    $produtos = $app['produtoService']->read();

    return $app->json($produtos);
});

$apiRest->get('/produtos/{id}', function($id) use ($app)
{
    $produto = $app['produtoService']->read($id);

    return $app->json($produto);
});

$apiRest->post('/produtos', function(\Symfony\Component\HttpFoundation\Request $request) use ($app){
    $dados = $request->request->all();

    $result = $app['produtoService']->insert($dados);

    if($result)
    {
        return $app->json(['success' => true, 'msg' => 'Produto inserido com sucesso!', 'produto' => ['id' => $result]]);
    }

    return $app->json(['success' => false, 'msg' => 'Erro ao inserir produto!'], 400);
});

$apiRest->put('/produtos', function(\Symfony\Component\HttpFoundation\Request $request) use ($app){
    $dados = $request->request->all();

    if($app['produtoService']->update($dados))
    {
        return $app->json(['success' => true, 'msg' => 'Produto atualizado com sucesso!']);
    }

    return $app->json(['success' => false, 'msg' => 'Erro ao cadastrar produto!'], 400);
});

$apiRest->delete('/produtos/{id}', function ($id) use ($app)
{
    if($app['produtoService']->delete($id)) {
        return $app->json(['success' => true, 'msg' => 'Produto excluído com sucesso!']);
    }

    return $app->json(['success' => false, 'msg' => 'Erro ao excluir produto!']);
});

/* API REST - End */

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

$app->post('/produtos', function(\Symfony\Component\HttpFoundation\Request $request) use ($app)
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

$app->mount('/api', $apiRest);
$app->run();