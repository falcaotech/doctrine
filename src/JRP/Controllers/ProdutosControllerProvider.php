<?php

namespace JRP\Controllers;


use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class ProdutosControllerProvider implements ControllerProviderInterface {

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

        $controllers->get('/', function() use ($app)
        {
            $produtos = $app['produtoService']->read();

            return $app['twig']->render('produtos/listagem.twig', ['produtos' => $produtos]);
        })->bind('produtos');

        $controllers->post('/', function(\Symfony\Component\HttpFoundation\Request $request) use ($app)
        {
            $dados = $request->request->all();

            if($app['produtoService']->insert($dados))
            {
                return $app->json(['success' => true, 'msg' => 'Produto cadastrado com sucesso!']);
            }

            return $app->json(['success' => false, 'msg' => 'Erro ao cadastrar produto!'], 400);
        });

        $controllers->get('/listagem', function() use ($app)
        {
            $produtos = $app['produtoService']->read();

            return $app->json($produtos);
        });

        $controllers->post('/atualizar', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
            $dados = $request->request->all();

            if($app['produtoService']->updateColumn($dados))
            {
                return $app->json(['success' => true, 'msg' => 'Produto atualizado com sucesso!']);
            }

            return $app->json(['success' => false, 'msg' => 'Erro ao atualizar produto!'], 400);
        });

        $controllers->get('/excluir/{id}', function($id) use ($app)
        {
            if($app['produtoService']->delete($id)) {
                return $app->redirect($app['url_generator']->generate('produtos'));
            }
        })->bind('produto-excluir');

        return $controllers;
    }

} 