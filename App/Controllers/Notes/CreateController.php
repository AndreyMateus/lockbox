<?php

namespace App\Controllers\Notes;

use App\Models\NoteModel;
use Core\Helpers\Request;
use App\Database\Database;
use Core\Utils\Validation;

class CreateController
{
    public function index()
    {
        // search param
        $search = Request::getFieldFormByName('search');

        // todas as notas
        $notes = NoteModel::all($search);

        return view('notes/create', 'app', data: [
            'notes' => $notes
        ]);
    }
    public function store()
    {
        $validations = [
            'title' => [
                'min' => 1,
                // max -> title is varchar(80) in colunm of table in database.
                'max' => 80
            ],
            'content' => [
                'min' => 1,
                // max -> content(1000) is my choice.
                'max' => 1000,
            ]
        ];

        $errors = Validation::valide($_POST, $validations);

        foreach ($errors as $index) {
            // se index for um array, então teve um erro retornado pelo Validation::valide()
            if (is_array($index)) {
                return view('notes/create', 'app', [
                    'errors' => $errors
                ]);
            }
        }

        $conn = new Database();

        $conn->query("INSERT INTO notes (title, content,user_id) VALUES(:title, :content, :user_id)", [
            ':title' => $_POST["title"],
            ':content' => $_POST["content"],
            ':user_id' => auth()->id
        ]);

        $stmt = $conn->query("SELECT id FROM notes AS n
        WHERE n.user_id = :user_id
        ORDER BY n.created_at DESC
        LIMIT 1
        ", [
            ':user_id' => auth()->id
        ]);

        $createdNoteId = $stmt->fetch()['id'];

        return redirect("/notes?id=$createdNoteId");
    }
}
