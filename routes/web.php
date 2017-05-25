<?php

use \Illuminate\Routing\Router;

/** @var \Illuminate\Routing\Router $router */
$router->group(
        ['as' => 'home::'],
        function (Router $router) : void {
            $router->get('/', [
                'as'   => 'index',
                'uses' => 'HomeController@index'
            ]
        );
   }
);
