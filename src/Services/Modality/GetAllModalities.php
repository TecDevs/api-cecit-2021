<?php

namespace App\Services\Modality;

use App\Database;

class GetAllModalities
{
    public function __invoke(): array
    {
        try {
            $db = new Database();
            $db = $db->connect();

            $sql = "SELECT * FROM modalidades";

            $stmt = $db->prepare($sql);

            $stmt->execute();

            $dbModalities = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return [
                'error'  => false,
                'status' => 200,
                'data'   => (array) $dbModalities
            ];
        } catch (\Exception $exception) {
            return [
                'error'  => true,
                'status' => 500,
                'data' => array('message' => 'Ocurrio un error en el servidor: ' . $exception->getMessage())
            ];
        }
    }
}
