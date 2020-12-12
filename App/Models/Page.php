<?php

namespace App\Models;

use Core\Model;
use PDO;

class Page extends Model
{
    /**
     * @param int $parentId
     * @param string $title
     * @param string $description
     */
    public static function create(int $parentId, string $title, string $description): void
    {
        $db = static::getDB();
        $stmt = $db->prepare("
            INSERT INTO `page`
            (parent_id, title, description)
            VALUES (:parentId, :title, :description);
        ");
        $stmt->execute([
            'parentId' => $parentId,
            'title' => $title,
            'description' => $description,
        ]);
    }

    /**
     * @return array
     */
    public static function getPageListTitleDescription(): array
    {
        $pages = self::findAll();
        $result = [];

        foreach ($pages as $page) {
            $result[$page['id']] = [
                'title' => $page['title'],
                'description' => $page['description'],
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    public static function findAll(): array
    {
        $db = static::getDB();
        $stmt = $db->query("
            SELECT *
            FROM page
            ORDER BY id;
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public static function getTree(): array
    {
        $pages = self::findAll();

        return self::getStructuredByParent($pages, 0);
    }

    /**
     * @param array $pages
     * @param int $parentId
     * @return array
     */
    private static function getStructuredByParent(array $pages, int $parentId): array
    {
        $result = [];

        foreach ($pages as $key => $page) {
            if ($page['parent_id'] === $parentId) {
                $result[] = array_merge(
                    $page,
                    ['children' => self::getStructuredByParent($pages, $page['id'])]
                );
            }
        }

        return $result;
    }

    /**
     * @param int $pageId
     */
    public static function remove(int $pageId): void
    {
        $db = static::getDB();
        $stmt = $db->prepare("
            DELETE FROM `page`
            WHERE id = :id;
        ");
        $stmt->execute([
            'id' => $pageId,
        ]);
    }

    public static function update(int $pageId, string $title, string $description): void
    {
        $db = static::getDB();
        $stmt = $db->prepare("
            UPDATE `page`
            SET title = :title,
                description = :description
            WHERE id = :id
        ");
        $stmt->execute([
            'id' => $pageId,
            'title' => $title,
            'description' => $description,
        ]);
    }
}
