<?php

namespace App\Model;

use PDO;

class ThemeManager extends AbstractManager
{
    public const TABLE = 'theme';

    // public function getThemeName(int $theme_id): string
    // {
    //     $statement = $this->pdo->prepare("SELECT name FROM " . self::TABLE . " WHERE id =:theme_id");
    //     $statement->bindValue('theme_id', $theme_id, PDO::PARAM_INT);
    //     $statement->execute();
    //     $name = $statement->fetch();
    //     return !empty($name) ? $name['name'] : "";
    // }
}
