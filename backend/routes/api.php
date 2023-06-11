<?php 
require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/Controllers/ProductController.php';


$route = new Router('api');

// Get all products route
$route->router('GET', '/products', new ProductController(), 'getAllProducts');
$route->router('POST', '/products', new ProductController(), 'addProduct');
$route->router('PUT', '/products', new ProductController(), 'updateProduct');
$route->router('PUT', '/product/delete', new ProductController(), 'deleteProduct');
// With named parameters
$route->router('GET', '/product/(?<id>\d+)', new ProductController(), 'getProduct');


header("HTTP/1.0 404 Not Found");
echo '404 Not Found';
