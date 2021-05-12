<?php

use Slim\Routing\RouteCollectorProxy;

$app->group('/author', function (RouteCollectorProxy $group) {
    $group->post('/create', 'App\Controllers\AuthorController:create');
    $group->post('/login', 'App\Controllers\AuthorController:login');
});
