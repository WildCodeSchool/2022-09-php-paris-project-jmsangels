<?php

namespace App\Model;

use PDO;

class NotionManager extends AbstractManager
{
    public const TABLE = 'notion';

    public function selectAll(int $subject_id): array
    {

        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE `subject_id` = :subject_id");
        $statement->bindValue('subject_id', $subject_id, PDO::PARAM_INT);
        $statement->execute();


        return $statement->fetchAll();
        // return (int)$this->pdo->lastInsertId();
    }

    // public function select(int $notion_id): array
    // {

    //     $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE `id` = :idnotion");
    //     $statement->bindValue('idnotion', $notion_id, PDO::PARAM_INT);
    //     $statement->execute();

    //     return $statement->fetch();
    // }

    public function getSubjectId(int $notion_id): int
    {
        $statement = $this->pdo->prepare("SELECT subject_id FROM " . self::TABLE . " WHERE `id` = :idnotion");
        $statement->bindValue('idnotion', $notion_id, PDO::PARAM_INT);
        $statement->execute();

        $subject = $statement->fetch();

        return $subject ? (int)$subject['subject_id'] : 0;
    }
}
