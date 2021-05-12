<?php

namespace App\Models;

class CampusModel
{
    public int $campusId;
    public string $campus;

    public function __construct(array $campusParams)
    {
        $this->campusId = $campusParams['id_sedes'] ?? 0;
        $this->campus = $campusParams['campus'] ?? '';
    }
}
