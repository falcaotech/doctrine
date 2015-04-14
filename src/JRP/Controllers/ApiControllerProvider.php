<?php

namespace JRP\Controllers;


use JRP\Produto\Serializer\ProdutoSerializer;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

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

            return $app->json($app['produtoSerializer']->serializeAll($produtos));
        });

        $controllers->get('/produtos/{id}', function($id) use ($app)
        {
            $produto = $app['produtoService']->read($id);

            return $app->json($app['produtoSerializer']->serialize($produto));
        });

        $controllers->post('/produtos', function(Request $request) use ($app){
            $dados = $request->request->all();

            return $app->json($app['produtoService']->insert($dados));
        });

        $controllers->put('/produtos', function(Request $request) use ($app){
            $dados = $request->request->all();

            return $app->json($app['produtoService']->update($dados));
        });

        $controllers->delete('/produtos/{id}', function ($id) use ($app)
        {
            return $app->json($app['produtoService']->delete($id));
        });

        return $controllers;
    }

} 