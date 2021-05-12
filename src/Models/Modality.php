<?php

namespace App\Models;

class ModalityModel
{
    public int $modalityId;
    public string $modality;

    public function __construct(array $modalityParams)
    {
        $this->modalityId = $modalityParams['id_modality'] ?? 0;
        $this->modality = $modalityParams['modality'] ?? '';
    }
}
