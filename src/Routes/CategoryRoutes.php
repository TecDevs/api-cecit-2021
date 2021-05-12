<?php

use Slim\Routing\RouteCollectorProxy;

$app->group('/category', function (RouteCollectorProxy $group) {
    $group->get('/get-all', 'App\Controllers\CategoryController:getAll');
});
