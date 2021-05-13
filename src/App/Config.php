<?php

// Santi
// $environmentPath = '/APIS-CORAZAI-2.0';

// Kt
// $environmentPath = '/applications/api-cotacyt-2021';

// cotacyt
$environmentPath = '/api-cecit-2021';

// acm
// $environmentPath = '/api-cecit-2021';

$app->setBasePath($environmentPath);
$app->addBodyParsingMiddleware();