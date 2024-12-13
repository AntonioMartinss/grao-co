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
$route->put("/update/{id}","Users:updateUser");
$route->get("/list", "Users:listUsers");
$route->get("/me","Users:getUser");
$route->post("/photo","Users:updatePhoto");
$route->get("/photo","Users:getPhoto");
$route->get("/list/{id}","Users:listById");

$route->group("null");


$route->group("/products");

$route->get("/list","Products:listProduct");
$route->get("/list/{id}","Products:listById");
$route->post("/insert","Products:insertProduct");
$route->put("/update-product/{id}","Products:updateProduct");
$route->delete("/delete-product/{id}","Products:deleteProduct");

$route->group("null");

$route->group("/images");

$route->get("/list","Images:listProduct");
$route->get("/list/{id}","Images:listById");
$route->post("/insert","Images:insertPhoto");
$route->put("/update-product/{id}","Images:updateProduct");
$route->delete("/delete-product/{id}","Images:deleteProduct");

$route->group("null");

$route->group("/categories");

$route->get("/list","Categories:listCategory");
$route->get("/list/{id}","Categories:listById");
$route->post("/insert-category","Categories:insertCategory");
$route->put("/update-category/{id}","Categories:updateCategory");
$route->delete("/delete-category/{id}","Categories:deleteCategory");

$route->group("null");


$route->group("/orders");

$route->get("/list","Orders:listOrder");
$route->get("/list/{id}","Orders:listById");
$route->post("/insert","Orders:insertOrder");
$route->put("/update-order/{id}","Orders:updateOrder");
$route->delete("/delete-order/{id}","Orders:deleteOrder");

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