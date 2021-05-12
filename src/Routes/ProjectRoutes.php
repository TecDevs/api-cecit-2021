<?php

use Slim\Routing\RouteCollectorProxy;

$app->group('/project', function (RouteCollectorProxy $group) {
    $group->post('/create', 'App\Controllers\ProjectController:create');
});
