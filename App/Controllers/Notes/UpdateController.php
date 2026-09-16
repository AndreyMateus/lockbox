<?php

namespace App\Controllers\Notes;

use App\Models\NoteModel;
use App\Database\Database;
use Core\Helpers\Request;
use DateTime;
use PDOException;

class UpdateController
{
    public function __invoke()
    {
        $id = request()::getFieldFormByName('id');
        settype($id, 'int');

        $notes = NoteModel::all();

        $selectedNote = array_find($notes, fn($value, $key) => $value->id === $id); // OLD VERSION (new version in the NoteModel)

        // pegando ultima nota se o id nao for valido
        if (!intval($id) || $id === 0) {
            $selectedNote = NoteModel::lastNote();
        }

        return view('notes/update', 'app', [
            'notes' => $notes,
            'id' => $id,
            'selectedNote' => $selectedNote
        ]);
    }
    public function update()
    {
        $title = Request::getFieldFormByName('title');
        $content = Request::getFieldFormByName('content');
        $id = Request::getFieldFormByName('id');

        if (!$id || !$title || !$content) {
            return redirect('/notes');
        }

        $updated_at_date = new DateTime()->format('Y-m-d H:i:s');

        try {
            $conn = new Database();

            $conn->query(
                "UPDATE notes AS n 
            SET title = :title,
            content = :content,
            updated_at = :updated_at 
            WHERE n.id = :id",
                [
                    ':title' => $title,
                    ':content' => $content,
                    'id' => $id,
                    ':updated_at' => $updated_at_date
                ]
            );
        } catch (PDOException $err) {
            // 
        }

        return redirect('/notes');
    }
}
