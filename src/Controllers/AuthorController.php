<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Services\Author\RegisterFirstAuthor;

class AuthorController
{
    public function create(Request $request, Response $response, array $args): Response
    {
        $params = (array)$request->getParsedBody();
        
        $registerFirstAuthor = new RegisterFirstAuthor($params);

        $response->getBody()->write(json_encode($registerFirstAuthor()));
        return $response;
    }
}
