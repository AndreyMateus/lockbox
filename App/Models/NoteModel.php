<?php

namespace App\Models;

use App\Database\Database;
use PDOException;

class NoteModel
{
    public int $id;
    public string $title;
    public string $content;
    public  string $created_at;
    public  string $updated_at;
    public int $user_id;

    public static function all(string | null $search = null): array
    {
        $conn = new Database();

        // with search
        if ($search) {
            $stmt = $conn->query("SELECT 
        id,
        title,
        content,
        created_at,
        updated_at 
        FROM notes AS n
        WHERE n.user_id = :user_id AND (n.title LIKE :search OR n.content LIKE :search)
        ORDER BY n.updated_at DESC
        ", [
                ':user_id' => auth()->id,
                ':search' => "%$search%"
            ], self::class);
        }

        // no search
        if (!isset($search) || empty($search)) {
            $stmt = $conn->query("SELECT 
        id,
        title,
        content,
        created_at,
        updated_at 
        FROM notes AS n
        WHERE n.user_id = :user_id
        ORDER BY n.updated_at DESC
        ", [
                ':user_id' => auth()->id
            ], self::class);
        }

        $result = [];

        while ($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }


    public static function sumAllNotes()
    {
        try {
            $conn = new Database();

            $stmt = $conn->query("SELECT COUNT(n.id) AS qtd_total_notes FROM notes AS n 
            WHERE n.user_id = :user_id
        ", [
                ':user_id' => auth()->id
            ]);

            $row = $stmt->fetch();

            return $row;
        } catch (PDOException) {
            // 
        }
    }

    public static function sumAllNotesToday()
    {
        try {
            $conn = new Database();

            $stmt = $conn->query("SELECT COUNT(n.id) AS qtd_total_notes_today 
            FROM notes AS n 
            WHERE n.user_id = :user_id AND DATE_FORMAT(n.created_at, '%Y-%m-%d') LIKE CURDATE();
        ", [
                ':user_id' => auth()->id
            ]);

            $row = $stmt->fetch();

            return $row;
        } catch (PDOException) {
            // 
        }
    }

    public static function lastNote()
    {
        try {
            $conn = new Database();
            $stmt = $conn->query("SELECT id,title,content,created_at,updated_at,user_id FROM notes AS n 
            WHERE n.user_id = :user_id 
            ORDER BY n.updated_at DESC
            LIMIT 1
            ", [
                ':user_id' => auth()->id
            ], NoteModel::class);

            $row = $stmt->fetch();

            return $row;
        } catch (PDOException $err) {
            // 
        }
    }
}
