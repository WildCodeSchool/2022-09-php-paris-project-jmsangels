<?php

namespace App\Model;

use PDO;

class SubjectManager extends AbstractManager
{
    public const TABLE = 'subject';

    public function selectAllByThemeId(int $theme_id): array
    {

        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE `theme_id` = :idtheme");
        $statement->bindValue('idtheme', $theme_id, PDO::PARAM_INT);
        $statement->execute();


        return $statement->fetchAll();
        // return (int)$this->pdo->lastInsertId();
    }

    // public function getThemeId(int $subject_id): int
    // {

    //     $statement = $this->pdo->prepare("SELECT theme_id FROM " . self::TABLE . " WHERE `id` = :idsubject");
    //     $statement->bindValue('idsubject', $subject_id, PDO::PARAM_INT);
    //     $statement->execute();

    //     $theme = $statement->fetch();

    //     return $theme ? (int)$theme['theme_id'] : 0;
    // }
}
