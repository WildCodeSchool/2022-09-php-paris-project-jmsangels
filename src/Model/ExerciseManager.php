<?php

namespace App\Model;

use PDO;

class ExerciseManager extends AbstractManager
{
    public const TABLE = 'exercise';

    public function selectAllByNotion(int $notionId): array
    {

        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE `notion_id` = :id");
        $statement->bindValue('id', $notionId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
