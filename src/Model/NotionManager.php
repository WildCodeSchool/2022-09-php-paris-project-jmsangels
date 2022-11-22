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

    public function create(array $notion): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`subject_id`, `name`, `lesson`, `sample`, `file_image`) 
            VALUES (:subject_id, :name, :lesson, :sample, :file_image)");
        $statement->bindValue('subject_id', $notion['subject_id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $notion['name'], \PDO::PARAM_STR);
        $statement->bindValue('lesson', $notion['lesson'], \PDO::PARAM_STR);
        $statement->bindValue('sample', $notion['sample'], \PDO::PARAM_STR);
        $statement->bindValue('file_image', $notion['file_image'], \PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $notion)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET name=:name, lesson=:lesson, sample=:sample, file_image=:file_image WHERE id=:notion_id");
        $statement->bindValue('notion_id', $notion['notion_id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $notion['name'], \PDO::PARAM_STR);
        $statement->bindValue('lesson', $notion['lesson'], \PDO::PARAM_STR);
        $statement->bindValue('sample', $notion['sample'], \PDO::PARAM_STR);
        $statement->bindValue('file_image', $notion['file_image'], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function remove(int $notionId): bool
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:notion_id");
        $statement->bindValue('notion_id', $notionId, \PDO::PARAM_INT);
        return $statement->execute();
    }
}
