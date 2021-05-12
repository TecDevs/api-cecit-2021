<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Services\Project\RegisterProjectOneAuthor;
use App\Services\Project\RegisterProjectTwoAuthors;

class ProjectController
{
    public function createOneAuthor(Request $request, Response $response, array $args): Response
    {
        $params = (array)$request->getParsedBody();
        $files = $request->getUploadedFiles();
        $params['image_ine'] = $files['image_ine'];
        $params['project_image'] = $files['project_image'];

        $registerProjectOneAuthor = new RegisterProjectOneAuthor($params);
        $response->getBody()->write(json_encode($registerProjectOneAuthor()));
        return $response;
    }

    public function createTwoAuthors(Request $request, Response $response, array $args): Response
    {
        $params = (array)$request->getParsedBody();
        $files = $request->getUploadedFiles();
        $params['image_ine'] = $files['image_ine'];
        $params['project_image'] = $files['project_image'];

        $registerProjectTwoAuthors = new RegisterProjectTwoAuthors($params);
        $response->getBody()->write(json_encode($registerProjectTwoAuthors()));
        return $response;
    }
}
