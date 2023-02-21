<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once(realpath(dirname(__FILE__)) . '\Products.php');

$route = str_replace("/index.php/","",$_SERVER['PHP_SELF']);

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if($route == "api/products") Products::getProducts();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($route == "api/products")  Products::add() ;
    if($route == "api/products/update") Products::update();
}
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    if($route == "api/products") Products::delete();
}

header("HTTP/1.0 404 Not Found");

