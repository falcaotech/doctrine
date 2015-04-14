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
            $data = $app['produtoService']->read();
            $produtos = $app['produtoSerializer']->serializeAll($data);

            return $app['twig']->render('produtos/listagem.twig', ['produtos' => $produtos]);
        })->bind('produtos');

        $controllers->post('/', function(\Symfony\Component\HttpFoundation\Request $request) use ($app)
        {
            $dados = $request->request->all();

            return $app->json($app['produtoService']->insert($dados));
        });

        $controllers->get('/listagem', function() use ($app)
        {
            $produtos = $app['produtoSerializer']->serializeAll($app['produtoService']->read());

            return $app->json($produtos);
        });

        $controllers->post('/atualizar', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
            $dados = $request->request->all();

            return $app->json($app['produtoService']->updateColumn($dados));
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