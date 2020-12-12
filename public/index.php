<?php

/**
 * Autoloader
 */
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Helper
 */
require dirname(__DIR__) . '/App/Helper.php';

/**
 * Routing
 */
$router = new Core\Router();
$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('/login', ['controller' => 'Home', 'action' => 'loginForm']);
$router->add('/sign-in', ['controller' => 'Home', 'action' => 'signIn']);
$router->add('/sign-out', ['controller' => 'Home', 'action' => 'signOut']);
$router->add('/add-page', ['controller' => 'Home', 'action' => 'addPage']);
$router->add('/remove-page', ['controller' => 'Home', 'action' => 'removePage']);
$router->add('/edit-page', ['controller' => 'Home', 'action' => 'editPage']);

$router->dispatch($_SERVER['REQUEST_URI']);