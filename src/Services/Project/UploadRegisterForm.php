<?php

namespace App\Services\Project;

use App\Constants;
use App\Database;
use App\Models\ProjectModel;


class UploadRegisterForm
{
    private ProjectModel $project;
    private \Psr\Http\Message\UploadedFileInterface $registerForm;


    public function __construct(array $params)
    {
        $this->project = new ProjectModel(array(
            'project_id' => $params['project_id']
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
                'project-'
                . $this->project->projectId;
            $registerFormFilename = sprintf('%s.%0.8s', $registerFormBasename, $registerFormExtension);
            $this->registerForm->moveTo(Constants::FILE_UPLOAD_BASE_DIR . $registerFormDirectory . DIRECTORY_SEPARATOR . $registerFormFilename);
            $registerFormUrl = $registerFormDirectory . DIRECTORY_SEPARATOR . $registerFormFilename;

            $db = new Database();
            $db = $db->connect();

            $sql =
                "UPDATE proyectos SET 
                    doc_proyecto = :doc_proyecto
                WHERE
                    id_proyectos = :id_proyectos;
                ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':doc_proyecto', $registerFormUrl, \PDO::PARAM_STR);
            $stmt->bindParam(':id_proyectos', $this->project->projectId, \PDO::PARAM_INT);

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
