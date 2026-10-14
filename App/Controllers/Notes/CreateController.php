<?php

namespace App\Controllers\Notes;

use App\Database\Database;
use App\Models\NoteModel;
use Core\Helpers\Request;
use Core\Utils\Encrypt;
use Core\Utils\Validation;
use Exception;

class CreateController
{
    public function index()
    {
        // search param
        $search = Request::getFieldFormByName('search');

        // todas as notas
        $notes = NoteModel::all($search);

        return view('notes/create', 'app', data: [
            'notes' => $notes,
        ]);
    }

    public function store()
    {
        try {
            $validations = [
                'title' => [
                    'min' => 1,
                    // max -> title is varchar(80) in colunm of table in database.
                    'max' => 80,
                ],
                'content' => [
                    'min' => 1,
                    // max -> content(1000) is my choice.
                    'max' => 1000,
                ],
            ];

            $errors = Validation::valide($_POST, $validations);

            foreach ($errors as $index) {
                // se index for um array, então teve um erro retornado pelo Validation::valide()
                if (is_array($index)) {
                    return view('notes/create', 'app', [
                        'errors' => $errors,
                    ]);
                }
            }

            $conn = new Database;

            $title = Request::getFieldPostFormByName('title');
            $content = Request::getFieldPostFormByName('content');

            $iv = Encrypt::generateIV(returnBase64: false);
            $key = Encrypt::getSimetricKey(returnBase64: false);

            $titleEncrypted = Encrypt::encrypt($title, $key, $iv);
            $contentEncrypted = Encrypt::encrypt($content, $key, $iv);

            $conn->query('INSERT INTO notes (title, content,user_id,iv_cypher_note) VALUES(:title, :content, :user_id, :iv_cypher_note)', [
                ':title' => $titleEncrypted,
                ':content' =>  $contentEncrypted,
                ':user_id' => auth()->id,
                ':iv_cypher_note' => base64_encode($iv)
            ]);

            $stmt = $conn->query('SELECT id FROM notes AS n
        WHERE n.user_id = :user_id
        ORDER BY n.created_at DESC
        LIMIT 1
        ', [
                ':user_id' => auth()->id,
            ]);

            $createdNoteId = $stmt->fetch()['id'];

            return redirect("/notes?id=$createdNoteId");
        } catch (Exception $e) {
            writeInFileLog([
                'title' => $e->getMessage(),
                'msg' => $e->getTraceAsString(),
            ]);
        }
    }
}
