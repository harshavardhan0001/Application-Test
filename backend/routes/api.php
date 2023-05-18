<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();

$routes->add('getAllProducts', new Route(constant('URL_SUBFOLDER') . '/products', array('controller' => 'ProductController', 'method'=>'getAllProducts'), ['GET']));

$routes->add('addProduct', new Route(constant('URL_SUBFOLDER') . '/products/add', array('controller' => 'ProductController', 'method'=>'addProduct'), ['POST']));

$routes->add('updateProduct', new Route(constant('URL_SUBFOLDER') . '/products/update', array('controller' => 'ProductController', 'method'=>'updateProduct'), ['POST']));


$routes->add('deleteProduct', new Route(constant('URL_SUBFOLDER') . '/products/delete', array('controller' => 'ProductController', 'method'=>'deleteProduct'), ['POST']));