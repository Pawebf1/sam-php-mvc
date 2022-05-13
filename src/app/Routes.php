<?php


namespace App;

class Routes
{
    public function __construct()
    {
        try {
            $router = new Router();

            $router
                ->get('/', [Controllers\HomeController::class, 'index']);

            echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

        } catch (Exceptions\RouteNotFoundException $e) {
            http_response_code(404);
            echo View::make('error/404');
        }

    }
}