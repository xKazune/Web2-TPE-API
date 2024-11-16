<?php
    
    require_once 'libs/router.php';

    require_once 'app/controllers/game.api.controller.php';
    require_once 'app/controllers/platform.api.controller.php';
    require_once 'app/controllers/user.api.controller.php';
    require_once 'app/middlewares/jwt.auth.middleware.php';
    
    $router = new Router();

    $router->addMiddleware(new JWTAuthMiddleware());

    #                 endpoint        verbo      controller              metodo
    $router->addRoute('videojuegos',  'GET',  'GameApiController',      'getAll');
    $router->addRoute('plataformas',  'GET',  'PlatformApiController',  'getAll');

    $router->addRoute('videojuegos/:id','GET', 'GameApiController',     'get');
    $router->addRoute('plataformas/:id','GET', 'PlatformApiController', 'get');

    $router->addRoute('videojuegos','POST','GameApiController',      'create');
    $router->addRoute('plataformas','POST','PlatformApiController',      'create');
    
    $router->addRoute('videojuegos/:id','PUT','GameApiController',      'update');
    $router->addRoute('plataformas/:id','PUT','PlatformApiController',   'update');
    
    $router->addRoute('videojuegos/:id','DELETE','GameApiController',   'delete');
    $router->addRoute('plataformas/:id','DELETE','PlatformApiController','delete');
  
    $router->addRoute('usuario/token' , 'GET', 'UserApiController',   'getToken');

    //Rutea
    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
