<?php

namespace App\Model;

use PDO;

class SubjectManager extends AbstractManager
{
    public const TABLE = 'subject';

    public function selectAllByThemeId(int $themeId): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE `theme_id` = :themeid");
        $statement->bindValue('themeid', $themeId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
