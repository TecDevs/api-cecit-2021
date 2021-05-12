<?php

use Slim\Routing\RouteCollectorProxy;

$app->group('/modality', function (RouteCollectorProxy $group) {
    $group->get('/get-all', 'App\Controllers\ModalityController:getAll');
});
