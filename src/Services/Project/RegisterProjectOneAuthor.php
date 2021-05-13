<?php

namespace App\Services\Project;

use App\Constants;
use App\Database;
use App\Models\AssessorModel;
use App\Models\AuthorModel;
use App\Models\ProjectModel;


class RegisterProjectOneAuthor
{
    private AssessorModel $assessor;
    private AuthorModel $firstAuthor;
    private ProjectModel $project;

    public function __construct(array $params)
    {
        $this->assessor = new AssessorModel(array(
            'adviser_name' => $params['adviser_name'],
            'last_name' => $params['last_name'],
            'second_last_name' => $params['second_last_name'],
            'address' => $params['address'],
            'suburb' => $params['suburb'],
            'postal_code' => $params['postal_code'],
            'curp' => $params['curp'],
            'rfc' => $params['rfc'],
            'phone_contact' => $params['phone_contact'],
            'email' => $params['email'],
            'city' => $params['city'],
            'locality' => $params['locality'],
            'school_institute' => $params['school_institute'],
            'facebook' => $params['facebook'],
            'twitter' => $params['twitter'],
            'participation_description' => $params['participation_description'],
            'image_ine' => $params['image_ine']
        ));
        $this->firstAuthor = new AuthorModel(array(
            'author_id' => $params['author_id']
        ));
        $this->project = new ProjectModel(array(
            'project_name' => $params['project_name'],
            'project_description' => $params['project_description'],
            'id_sedes' => $params['id_sedes'],
            'id_category' => $params['id_category'],
            'url_video' => $params['url_video'],
            'id_area' => $params['id_area'],
            'id_modality' => $params['id_modality'],
            'project_image' => $params['project_image']
        ));
    }

    public function __invoke(): array
    {
        try {

            $projectImageDirectory =
                Constants::FILE_UPLOAD_BASE_DIR
                . DIRECTORY_SEPARATOR
                . 'projects';
            $projectImageExtension = pathinfo($this->project->image->getClientFilename(), PATHINFO_EXTENSION);
            $projectImageBasename =
                'project-'
                . $this->firstAuthor->authorId
                . '-'
                . $this->project->campusId
                . '-'
                . $this->project->categoryId;
            $projectImageFilename = sprintf('%s.%0.8s', $projectImageBasename, $projectImageExtension);
            $this->project->image->moveTo($projectImageDirectory . DIRECTORY_SEPARATOR . $projectImageFilename);
            $this->project->imageUrl = $projectImageDirectory . DIRECTORY_SEPARATOR . $projectImageFilename;

            $assessorINEImageDirectory =
                Constants::FILE_UPLOAD_BASE_DIR
                . DIRECTORY_SEPARATOR
                . 'assessors-ine';
            $assessorINEImageExtension = pathinfo($this->assessor->ineImage->getClientFilename(), PATHINFO_EXTENSION);
            $assessorINEImageBasename =
                'assessor-'
                . $this->assessor->curp;
            $assessorINEImageFilename = sprintf('%s.%0.8s', $assessorINEImageBasename, $assessorINEImageExtension);
            $this->assessor->ineImage->moveTo($assessorINEImageDirectory . DIRECTORY_SEPARATOR . $assessorINEImageFilename);
            $this->assessor->ineImageUrl = $assessorINEImageDirectory . DIRECTORY_SEPARATOR . $assessorINEImageFilename;

            $db = new Database();
            $db = $db->connect();

            $sql =
                "CALL SP_insert_project_m1 (
                    :id_categorias_in,
                    :id_modalidades_in,
                    :id_sedes_in,
                    :id_areas_in,
                    :nombre_in,
                    :descripcion_in,
                    :url_in,
                    :imagen_in,
                    @result,
                    :nombre_asesor_in,
                    :ape_pat_in,
                    :ape_mat_in,
                    :domicilio_in,
                    :colonia_in,
                    :cp_in,
                    :curp_in,
                    :rfc_in,
                    :telefono_in,
                    :email_in,
                    :municipio_in,
                    :localidad_in,
                    :escuela_in,
                    :facebook_in,
                    :twitter_in,
                    :descripcion_asesor_in,
                    :img_ine_in,
                    :id_autores_in
                )";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_categorias_in', $this->project->categoryId, \PDO::PARAM_INT);
            $stmt->bindParam(':id_modalidades_in', $this->project->modalityId, \PDO::PARAM_INT);
            $stmt->bindParam(':id_sedes_in', $this->project->campusId, \PDO::PARAM_INT);
            $stmt->bindParam(':id_areas_in', $this->project->areaId, \PDO::PARAM_INT);
            $stmt->bindParam(':nombre_in', $this->project->name, \PDO::PARAM_STR);
            $stmt->bindParam(':descripcion_in', $this->project->description, \PDO::PARAM_STR);
            $stmt->bindParam(':url_in', $this->project->url, \PDO::PARAM_STR);
            $stmt->bindParam(':imagen_in', $this->project->imageUrl, \PDO::PARAM_STR);
            $stmt->bindParam(':nombre_asesor_in', $this->assessor->name, \PDO::PARAM_STR);
            $stmt->bindParam(':ape_pat_in', $this->assessor->firstLastName, \PDO::PARAM_STR);
            $stmt->bindParam(':ape_mat_in', $this->assessor->secondLastName, \PDO::PARAM_STR);
            $stmt->bindParam(':domicilio_in', $this->assessor->address, \PDO::PARAM_STR);
            $stmt->bindParam(':colonia_in', $this->assessor->suburb, \PDO::PARAM_STR);
            $stmt->bindParam(':cp_in', $this->assessor->postalCode, \PDO::PARAM_STR);
            $stmt->bindParam(':curp_in', $this->assessor->curp, \PDO::PARAM_STR);
            $stmt->bindParam(':rfc_in', $this->assessor->rfc, \PDO::PARAM_STR);
            $stmt->bindParam(':telefono_in', $this->assessor->phone, \PDO::PARAM_STR);
            $stmt->bindParam(':email_in', $this->assessor->email, \PDO::PARAM_STR);
            $stmt->bindParam(':municipio_in', $this->assessor->city, \PDO::PARAM_STR);
            $stmt->bindParam(':localidad_in', $this->assessor->locality, \PDO::PARAM_STR);
            $stmt->bindParam(':escuela_in', $this->assessor->school, \PDO::PARAM_STR);
            $stmt->bindParam(':facebook_in', $this->assessor->facebook, \PDO::PARAM_STR);
            $stmt->bindParam(':twitter_in', $this->assessor->twitter, \PDO::PARAM_STR);
            $stmt->bindParam(':descripcion_asesor_in', $this->assessor->description, \PDO::PARAM_STR);
            $stmt->bindParam(':img_ine_in', $this->assessor->ineImageUrl, \PDO::PARAM_STR);
            $stmt->bindParam(':id_autores_in', $this->firstAuthor->authorId, \PDO::PARAM_INT);

            $stmt->execute();

            return [
                'error'  => false,
                'status' => 200,
                'data' => array('message' => 'Se ha registrado el proyecto correctamente')
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
