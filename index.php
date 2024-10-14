<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

ob_start();

$route = new Router(url(), ":");

$route->namespace("Source\App");

$route->group(null);

$route->get("/", "Web:home");
$route->get("/entrar", "Web:login");
$route->get("/cadastro", "Web:register");
$route->get("/loja", "Web:shop");
$route->get("/sobre", "Web:about");


$route->group("/app");

$route->get("/perfil", "App:profile");


$route->group(null);


$route->group("/admin");

$route->get("/", "Admin:login");
$route->get("/inicio", "Admin:home");
$route->get("/editar-produto", "Admin:edit_product");
$route->get("/editar-usuario", "Admin:edit_user");
$route->get("/adicionar-categoria", "Admin:add_category");
$route->get("/editar-categoria", "Admin:edit_category");
$route->group(null);

$route->get("/ops/{errcode}", "Web:error");

$route->group(null);

$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();