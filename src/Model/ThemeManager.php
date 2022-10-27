<?php

namespace App\Model;

use PDO;

class ThemeManager extends AbstractManager
{
    public const TABLE = 'theme';

    /**
     * Insert new item in database
     */
    //     public function insert(array $item): int
    //     {
    //         $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
    //         $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

    // se        $statement->execute();
    //         return (int)$this->pdo->lastInsertId();
    //     }

    //     /**
    //      * Update item in database
    //      */
    //     public function update(array $item): bool
    //     {
    //         $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
    //         $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
    //         $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

    //         return $statement->execute();
    //     }

    public function selectAll(): array
    {

        $query = 'SELECT * FROM ' . static::TABLE;
        return $this->pdo->query($query)->fetchAll();
        // return (int)$this->pdo->lastInsertId();
    }
}
