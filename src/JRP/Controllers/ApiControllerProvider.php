<?php

namespace JRP\Controllers;


use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class ApiControllerProvider implements ControllerProviderInterface {
    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/produtos', function() use ($app)
        {
            $produtos = $app['produtoService']->read();

            return $app->json($produtos);
        });

        $controllers->get('/produtos/{id}', function($id) use ($app)
        {
            $produto = $app['produtoService']->read($id);

            return $app->json($produto);
        });

        $controllers->post('/produtos', function(\Symfony\Component\HttpFoundation\Request $request) use ($app){
            $dados = $request->request->all();

            $result = $app['produtoService']->insert($dados);

            if($result)
            {
                return $app->json(['success' => true, 'msg' => 'Produto inserido com sucesso!', 'produto' => ['id' => $result]]);
            }

            return $app->json(['success' => false, 'msg' => 'Erro ao inserir produto!'], 400);
        });

        $controllers->put('/produtos', function(\Symfony\Component\HttpFoundation\Request $request) use ($app){
            $dados = $request->request->all();

            if($app['produtoService']->update($dados))
            {
                return $app->json(['success' => true, 'msg' => 'Produto atualizado com sucesso!']);
            }

            return $app->json(['success' => false, 'msg' => 'Erro ao cadastrar produto!'], 400);
        });

        $controllers->delete('/produtos/{id}', function ($id) use ($app)
        {
            if($app['produtoService']->delete($id)) {
                return $app->json(['success' => true, 'msg' => 'Produto excluído com sucesso!']);
            }

            return $app->json(['success' => false, 'msg' => 'Erro ao excluir produto!']);
        });

        return $controllers;
    }

} 