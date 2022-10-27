<?php

namespace App\Model;

use PDO;

class SubjectManager extends AbstractManager
{
    public const TABLE = 'subject';

    public function selectAll(int $idtheme): array
    {

        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE `theme_id` = :idtheme");
        $statement->bindValue('idtheme', $idtheme, PDO::PARAM_INT);
        $statement->execute();


        return $statement->fetchAll();
        // return (int)$this->pdo->lastInsertId();
    }
}
