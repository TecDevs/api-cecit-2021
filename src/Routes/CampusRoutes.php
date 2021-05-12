<?php

use Slim\Routing\RouteCollectorProxy;

$app->group('/campus', function (RouteCollectorProxy $group) {
    $group->get('/get-all', 'App\Controllers\CampusController:getAll');
});
