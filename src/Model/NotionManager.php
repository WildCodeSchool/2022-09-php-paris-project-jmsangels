<?php

namespace App\Model;

use PDO;

class NotionManager extends AbstractManager
{
    public const TABLE = 'notion';

    public function selectAllBySubjectId(int $subjectId): array
    {

        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE `subject_id` = :subject_id");
        $statement->bindValue('subject_id', $subjectId, PDO::PARAM_INT);
        $statement->execute();


        return $statement->fetchAll();
    }
}
