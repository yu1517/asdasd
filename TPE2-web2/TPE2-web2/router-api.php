<?php
require_once './libs/Router.php';
require_once './app/controller/apiBookController.php';

//creo el router
$router = new Router();

// arma la tabla de ruteo
$router->addRoute('books', 'GET', 'ApiBookController', 'getAll');
$router->addRoute('books/:ID', 'GET', 'ApiBookController', 'getBook');
$router->addRoute('books', 'POST', 'ApiBookController', 'insertBook');
$router->addRoute('books/:ID', 'DELETE', 'ApiBookController', 'removeBook');
$router->addRoute('books/:ID', 'PUT', 'ApiBookController', 'updateBook');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);