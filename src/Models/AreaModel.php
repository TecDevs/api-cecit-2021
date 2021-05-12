<?php

namespace App\Models;

class AreaModel
{
    public int $areaId;
    public string $area;

    public function __construct(array $areaParams)
    {
        $this->areaId = $areaParams['id_area'] ?? 0;
        $this->area = $areaParams['area'] ?? '';
    }
}
