<?php

namespace App\Models;

class ProjectModel
{
    public int $projectId;
    public int $assessorId;
    public int $categoryId;
    public int $modalityId;
    public int $campusId;
    public int $areaId;
    public string $name;
    public string $description;
    public string $url;
    public \Psr\Http\Message\UploadedFileInterface $image;
    public string $imageUrl;

    public function __construct(array $projectParams)
    {
        $this->projectId = $projectParams['project_id'] ?? 0;
        $this->assessorId = $projectParams['assessor_id'] ?? 0;
        $this->categoryId = $projectParams['id_category'] ?? 0;
        $this->modalityId = $projectParams['id_modality'] ?? 0;
        $this->campusId = $projectParams['id_sedes'] ?? 0;
        $this->areaId = $projectParams['id_area'] ?? 0;
        $this->name = $projectParams['proyect_name'] ?? '';
        $this->description = $projectParams['proyect_description'] ?? '';
        $this->url = $projectParams['url_video'] ?? '';
        $this->image = $projectParams['proyect_image'] ?? null;
        $this->imageUrl = $projectParams['project_image_url'];
    }
}
