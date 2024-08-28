<?php

ob_start();

require  __DIR__ . "/../vendor/autoload.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Credentials: true');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

use CoffeeCode\Router\Router;

$route = new Router(url(),":");

$route->namespace("Source\App\Api");


$route->group("/users");

$route->post("/","Users:createUser");
$route->post("/login","Users:loginUser");
$route->post("/admin","Users:loginAdmin");
$route->post("/update","Users:updateUser");
$route->get("/list", "Users:listUsers");
$route->get("/list/{id}","Users:listById");
$route->post("/set-password","Users:setPassword");

$route->group("null");


$route->group("/products");

$route->get("/list","Products:listProduct");
$route->get("/list/{id}","Products:listById");
$route->post("/insert-product","Products:insertProduct");
$route->post("/update-product/{id}","Products:updateProduct");
$route->delete("/delete-product/{id}","Products:deleteProduct");



$route->group("null");

$route->group("/categories");

$route->get("/list","Categories:listProduct");
$route->get("/list/{id}","Categories:listById");
$route->post("/insert-product","Categories:insertProduct");
$route->post("/update-product/{id}","Categories:updateProduct");
$route->delete("/delete-product/{id}","Categories:deleteProduct");



$route->group("null");


$route->group("/admin");

$route->post("/","Admins:insert");

$route->group("null");

$route->dispatch();

/** ERROR REDIRECT */
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type " => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

ob_end_flush();