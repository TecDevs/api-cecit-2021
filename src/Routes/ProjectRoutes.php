<?php

use Slim\Routing\RouteCollectorProxy;

$app->group('/project', function (RouteCollectorProxy $group) {
    $group->post('/create-one-author', 'App\Controllers\ProjectController:createOneAuthor');
    $group->post('/create-two-authors', 'App\Controllers\ProjectController:createTwoAuthors');
});
