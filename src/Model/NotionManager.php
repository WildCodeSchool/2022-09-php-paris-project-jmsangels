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

    public function select(int $idnotion): array
    {

        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE `id` = :idnotion");
        $statement->bindValue('idnotion', $idnotion, PDO::PARAM_INT);
        $statement->execute();


        return $statement->fetch();
        // return (int)$this->pdo->lastInsertId();
    }

    public function getIDSubject(int $idnotion): int
    {

        $statement = $this->pdo->prepare("SELECT subject_id FROM " . self::TABLE . " WHERE `id` = :idnotion");
        $statement->bindValue('idnotion', $idnotion, PDO::PARAM_INT);
        $statement->execute();

        return (int)$statement->fetch()['subject_id'];
    }
}
