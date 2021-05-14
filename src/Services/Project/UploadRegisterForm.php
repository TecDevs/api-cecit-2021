<?php

namespace App\Services\Project;

use App\Constants;
use App\Database;
use App\Models\AuthorModel;


class UploadRegisterForm
{
    private AuthorModel $author;
    private \Psr\Http\Message\UploadedFileInterface $registerForm;


    public function __construct(array $params)
    {
        $this->author = new authorModel(array(
            'author_id' => $params['author_id']
        ));
        $this->registerForm = $params['register_form'];
    }

    public function __invoke(): array
    {
        try {

            $registerFormDirectory =
                DIRECTORY_SEPARATOR
                . 'register-form';
            $registerFormExtension = pathinfo($this->registerForm->getClientFilename(), PATHINFO_EXTENSION);
            $registerFormBasename =
                'author-'
                . $this->author->authorId;
            $registerFormFilename = sprintf('%s.%0.8s', $registerFormBasename, $registerFormExtension);
            $this->registerForm->moveTo(Constants::FILE_UPLOAD_BASE_DIR . $registerFormDirectory . DIRECTORY_SEPARATOR . $registerFormFilename);
            $registerFormUrl = $registerFormDirectory . DIRECTORY_SEPARATOR . $registerFormFilename;

            $db = new Database();
            $db = $db->connect();

            $sql = "SELECT id_proyectos FROM autores WHERE id_autores = :id_autores";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_autores', $this->author->authorId, \PDO::PARAM_INT);
            $stmt->execute();

            $projectId = $stmt->fetchColumn();

            $sql =
                "UPDATE proyectos SET 
                    doc_proyecto = :doc_proyecto
                WHERE
                    id_proyectos = :id_proyectos;
                ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':doc_proyecto', $registerFormUrl, \PDO::PARAM_STR);
            $stmt->bindParam(':id_proyectos', $projectId, \PDO::PARAM_INT);

            $stmt->execute();

            return [
                'error'  => false,
                'status' => 200,
                'data' => array('message' => 'Se ha subido el documento con éxito')
            ];
        } catch (\Exception $exception) {
            return [
                'error'  => true,
                'status' => 500,
                'data' => array('message' => 'Ocurrió un error en el servidor: ' . $exception->getMessage())
            ];
        }
    }
}
