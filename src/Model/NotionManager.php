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

    public function select(int $notion_id): array
    {

        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE `id` = :idnotion");
        $statement->bindValue('idnotion', $notion_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
