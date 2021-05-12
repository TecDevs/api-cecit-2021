<?php

use Slim\Routing\RouteCollectorProxy;

$app->group('/area', function (RouteCollectorProxy $group) {
    $group->get('/get-all', 'App\Controllers\AreaController:getAll');
});
